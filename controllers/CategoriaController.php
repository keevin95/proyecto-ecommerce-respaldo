<?php

require_once './models/modelo_categoria.php';
require_once './models/modelo_producto.php';

class CategoriaController{


    public function index(){
        
        $categoria = new Categoria();
        $categorias= $categoria->getAllCategorias();
        require_once 'views/categoria/index.php';
    }
    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save(){
        Utils::isAdmin();

        //Guardamos la categoria
        if(isset($_POST) && isset(($_POST['nombre']))){
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
        }
        header("Location:".base_url."categoria/index");
    }
    public function ver(){
        if(isset($_GET['id'])){
        //Conseguir categoria
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);

            $categoria = $categoria->getOneCategorias();
        //Conseguir producto
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();

            
        }
        require_once './views/categoria/ver.php';
    }
}


?>