<?php

class Categoria
{
    private $id;
    private $nombre;
    private $db;

    public function __construct()
    {
        $this->db =  Database::connect();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
        
        return $this;
    }

    public function getAllCategorias()
    {
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categorias;
    }
    public function getOneCategorias(){
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()};");
        return $categoria->fetch_object();
    }

    public function save()
    {
        $sql = "INSERT INTO categorias VALUES(NULL,'{$this->getNombre()}');";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
            return $result;
        }
        return $result;
    }
}
