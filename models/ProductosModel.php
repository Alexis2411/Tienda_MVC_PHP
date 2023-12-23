<?php
class Productos
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $conexiondb;

    // Método constructor
    public function __construct()
    {
        $this->conexiondb = ConexionDB::connect();
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of categoria_id
     */ 
    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    /**
     * Set the value of categoria_id
     *
     * @return  self
     */ 
    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of descripcion
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */ 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of oferta
     */ 
    public function getOferta()
    {
        return $this->oferta;
    }

    /**
     * Set the value of oferta
     *
     * @return  self
     */ 
    public function setOferta($oferta)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getAll(){
        $productos=$this->conexiondb->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }

    public function getOne(){
        $producto=$this->conexiondb->query("SELECT * FROM productos WHERE id = {$this->getId()}");
        return $producto->fetch_object();
    }

    public function save(){
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
        $categoria = $this->getCategoria_id();
        $precio = $this->getPrecio();
        $stock = $this->getStock();
        $imagen = $this->getImagen();

        // Escapa los valores y hashea la contraseña
        $nombre = $this->conexiondb->real_escape_string($nombre);
        $descripcion = $this->conexiondb->real_escape_string($descripcion);
        $precio = $this->conexiondb->real_escape_string($precio);
        $stock = $this->conexiondb->real_escape_string($stock);

        // Crea la sentencia SQL con los valores
        $sql = "INSERT INTO productos VALUES(NULL, $categoria ,'$nombre', '$descripcion', '$precio', '$stock', NULL, CURDATE(), '$imagen');";
        $save = $this->conexiondb->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function edit(){
        $nombre = $this->getNombre();
        $descripcion = $this->getDescripcion();
        $categoria = $this->getCategoria_id();
        $precio = $this->getPrecio();
        $stock = $this->getStock();

        $nombre = $this->conexiondb->real_escape_string($nombre);
        $descripcion = $this->conexiondb->real_escape_string($descripcion);
        $precio = $this->conexiondb->real_escape_string($precio);
        $stock = $this->conexiondb->real_escape_string($stock);


        $sql = "UPDATE productos SET categoria_id = '$categoria' , nombre = '$nombre', descripcion='$descripcion', precio=$precio, stock=$stock";
        
        if($this->getImagen() != null);{
            $sql .=", imagen = '{$this->getImagen()}'";
        }

        $sql .= " WHERE id = {$this->id};";
        $save = $this->conexiondb->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete(){
        $id= $this->getId();
        $sql = "DELETE FROM productos WHERE id='$id';";
        $delete=$this->conexiondb->query($sql);
        $result=false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }
}
?>