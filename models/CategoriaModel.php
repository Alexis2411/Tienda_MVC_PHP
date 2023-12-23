<?php

class Categoria{
    private $id;
    private $nombre;
    private $conexiondb;

    public function __construct() {
        $this->conexiondb = Conexiondb::connect() ;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function getAll(){
        $sql="SELECT * FROM categorias";
        $resultado=$this->conexiondb->query($sql);
        return $resultado;
    }

    public function saveCategoria(){
        $nombre = $this->getNombre();
        $nombre = $this->conexiondb->real_escape_string($nombre);
    
        $sql="INSERT INTO categorias VALUES(NULL, '$nombre')";

        $save = $this->conexiondb->query($sql);

        $result = false;

        if($save){
            $result=true;
        }

        return $result;

    }
}