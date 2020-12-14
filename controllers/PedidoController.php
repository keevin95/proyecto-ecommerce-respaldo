<?php
require_once 'models/modelo_pedido.php';

class PedidoController{
    public function hacer(){
        require_once './views/pedido/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
            //guardar datos
            if($provincia && $localidad && $direccion){
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

               $save = $pedido->save();
               //guardar linea pedido
                $save_lineas = $pedido->save_linea();

               if($save && $save_lineas){
                   $_SESSION['pedido'] = 'completo';
               }else{
                   $_SESSION['pedido'] = 'failed';
               }
            }else{
                $_SESSION['pedido'] = 'failed';
            }
            header("Location:".base_url.'pedido/confirmado');
        }else{
            //redirigir al index
            header("Location:".base_url);
        }
    }
    
    
    public function confirmado(){

        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido  = new Pedido();
            $pedido->setUsuario_id($identity->id);

            $pedido = $pedido->getOneByUser();
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);
        }
        require_once './views/pedido/confirmado.php';
 
        
    }

    public function mis_pedidos(){
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();

        //Sacar los pedidos del usuario
        $pedido->setUsuario_id($usuario_id);
        $pedidos=$pedido->getAllByUser();
        require_once './views/pedido/mis_pedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //Sacar el pedido
            $pedido  = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();
            //Sacar productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);

            require_once './views/pedido/detalle.php';
        }else{
            header("Location".base_url.'pedido/mis_pedidos');
        }
    }
    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAllPedidos();

        require_once './views/pedido/mis_pedidos.php';
    }
    
    public function estado(){
        
        Utils::isAdmin();
        if(isset($_POST['pedido_id'])&& isset($_POST['estado'])){
            //Recojo dato del form
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            //Update del estado del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();

            header("Location:".base_url.'pedido/gestion');
            ob_start();

        }else{
            header("Location:".base_url);
            ob_start();
        }
    }
    
}


?>