<?php
require_once './models/modelo_producto.php';
class CarritoController
{
    public function index()
    {   
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
            $carrito = ($_SESSION['carrito']);
        }else{
            $carrito = array();
        }
        
        require_once './views/carrito/index.php';
    }
    public function add()
    {
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header('Location:' . base_url);
        }

        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            //Recorre el carrito y por cada iteracion te saca el indice del array
            // y consigue tambien el elemento que hay en ese indice
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }
        if (!isset($counter) || $counter == 0){
            //Conseguir producto
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();


            //Añadir al carrito
            if (is_object($producto)) {
                //hacemos un array en la sesion
                $_SESSION['carrito'][] = array(
                    //no puedo usar los metodos get para mandarle los valores
                    // ya que $producto no es una instancia de la clase
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        header('Location:'.base_url."carrito/index");
    }

    public function delete(){
        if(isset($_GET['index'])){
            
            $id = $_GET['index'];

            unset($_SESSION['carrito'][$id]);
        }
        header('Location:'. base_url ."carrito/index");

    }

    public function delete_all()
    {
        unset($_SESSION['carrito']);
        header('Location:'. base_url ."carrito/index");
        ob_start();
    }
    public function up(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];

            $_SESSION['carrito'][$index]['unidades']++;

        }
        header('Location:'. base_url ."carrito/index");

    }

    public function down(){
        if(isset($_GET['index'])){
            
            $index = $_GET['index'];

            $_SESSION['carrito'][$index]['unidades']--;
            if(($_SESSION['carrito'][$index]['unidades'])==0){
                unset( $_SESSION['carrito'][$index]);
            }
        }
        header('Location:'. base_url ."carrito/index");

    }


}
