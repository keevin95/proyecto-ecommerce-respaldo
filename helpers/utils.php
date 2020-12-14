<?php
class Utils
{

    public static function showStatus($status){
        $value = 'pendiente';
        if($status == 'confirm'){
           $value  = 'Pendiente';
        }elseif($status =='preparation'){
            $value = 'En preparacion';
        }elseif($status =='ready'){
            $value = 'Preparado para enviar';
        }elseif($status == 'sended'){
            $value = 'Enviado';
        }
        return $value;
    }



    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }


    public static function isAdmin(){
        if (!isset($_SESSION['admin'])) {
            header("Location:".base_url);
        } else {
            return true;
        }
    }

    public static function isIdentity(){
        if (!isset($_SESSION['identity'])) {
            header("Location:".base_url);
        } else {
            return true;
        }
    }



    public static function showCategorias(){
        require_once 'models/modelo_categoria.php';
        $categoria = new Categoria();
        $categorias= $categoria->getAllCategorias();
        return $categorias;
    }
    public static function statsCarrito(){
        $stats = array(
            'count'=>0,
            'total'=>0
        );
        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);

            foreach($_SESSION['carrito'] as $producto){
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }

        }
        return $stats;
    }

}
function mostrarErrores($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class= 'errores_registro'>" . $errores[$campo] . "</div>";
    }

    return $alerta;
}


function borrarErrores()
{
    $borrado = false;
    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrado = $_SESSION['errores'];
        return $borrado;
    }
    if (isset($_SESSION['register'])) {
        $_SESSION['failed'] = null;
        $completado_borrado = $_SESSION['failed'];
        return $completado_borrado;
    }
}
