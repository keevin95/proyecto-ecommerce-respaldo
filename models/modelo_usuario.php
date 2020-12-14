<?php


class Usuario{
    //seran privadas porque solo vamos a acceder a traves
    // de metodos
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $roll;
    private $imagen;
    private $db;
    //conexion a la base de datos
    public function __construct()
    {
        $this->db =  Database::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre =$this->db->real_escape_string($nombre);

        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos =$this->db->real_escape_string($apellidos);

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);

        return $this;
    }

    public function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password),PASSWORD_BCRYPT,['cost'=>4]);
    }


    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getRoll()
    {
        return $this->roll;
    }


    public function setRoll($roll)
    {
        $this->roll = $roll;

        return $this;
    }


    public function getImagen()
    {
        return $this->imagen;
    }


    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}',
                '{$this->getPassword()}','user','NULL')";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
            return $result;
        }
        return $result;
    }


    public function login(){
        $result=false;
        $email = $this->email;
        $password = $this->password; 
             
        
        //COMPROBAR SI EXISTE EL USUARIO
        $sql = "SELECT * FROM usuarios WHERE email ='$email'";
        $login = $this->db->query($sql);

        
        //NOS DEBE DEVOLVER UNA UNICA FILA
        if($login && $login->num_rows ==1){
            //Con este metodo extraemos el objeto de la base de datos
            $usuario = $login->fetch_object();
            
            //VERIFICAR PASS
                                    //pass formulario VS pass en la base
            $verify = password_verify($password,$usuario->contrasenia);

            if($verify){
                $result=$usuario;
            }
        }
        return $result;

    }
}