<?php

require_once 'models/modelo_usuario.php';


class usuarioController{
    public function index(){
        echo 'controlador Usuarios, Accion index';
    }

    public function registro(){
        require_once 'views/usuario/registro.php';
    }

    public function save(){
        
        $errores = array();
    

        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos= isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email= isset($_POST['email']) ? $_POST['email'] : false;
            $password= isset($_POST['password']) ? $_POST['password'] : false;

             //Si la variable no esta vacia, y no es un numero, y no hay numeros de 0 al 9 en la variable nombre
            if(!empty($nombre) && !is_numeric($nombre)&& !preg_match("/[0-9]/",$nombre)){
                $nombre_validado=true;
            }else{

                $nombre_validado=false;
                $errores['nombre']= 'El nombre no es valido';
                
            }
            if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)){
                $apellidos_validado =  true;
            }else{
                $apellidos_validado = false;
                $errores['apellidos'] = 'El Apellido no es valido';
            }
            
   
            if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
                $email_validado =  true;
            }else{
                $email_validado = false;
                $errores['email'] = 'El Email no es valido';
            }
            if(!empty($password)){
                $password_validado =  true;
            }else{
                $password_validado = false;
                $errores['password'] = 'Las password esta vacia';
            }


        
            //Si todo esta ok y no hay errores..
            // EL PROBLEMA ESTA ACA NO ENTRA PORQUE HAY ERRORES!!!
            if(count($errores)==0){
            
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $save=$usuario->save();
                


                //REVISAR ESTA PARTE NO ME HACE BIEN LA CARGA DE USUARIOS, SI ME MUESTRA CORRECTAMENTE LOS ERRORES
                if($save){
                    $_SESSION['register']='complete';
                    header("Location:".base_url.'usuario/registro');
                }

            }else{
                $_SESSION['register']='failed';
                $_SESSION['errores']=$errores;
            }
        }
            header("Location:".base_url.'usuario/registro');

    }


    public function login(){
        if(isset($_POST)){
            //IDENTIFICAR USUARIO
            //Consultamos a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            $identity = $usuario->login();
            
            //Creamos sesion
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                if($identity->rol=='admin'){
                    $_SESSION['admin']=true;
                }
            }else{
                $_SESSION['error_login']='identificacion fallida';
            }
        }
        header("Location:".base_url);
        ob_start();
    }


    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);

        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        header("Location:".base_url);
        ob_start();
    }
}//fin clase


?>