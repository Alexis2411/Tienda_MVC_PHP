<?php
class Pedido
{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $conexiondb;

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    // Método constructor
    public function __construct()
    {
        $this->conexiondb = ConexionDB::connect();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * @param mixed $usuario_id
     */
    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * @param mixed $localidad
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * @param mixed $coste
     */
    public function setCoste($coste)
    {
        $this->coste = $coste;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param mixed $hora
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    /**
     * @return mysqli
     */
    public function getConexiondb()
    {
        return $this->conexiondb;
    }

    /**
     * @param mysqli $conexiondb
     */
    public function setConexiondb($conexiondb)
    {
        $this->conexiondb = $conexiondb;
    }

    public function getAll()
    {
        $productos = $this->conexiondb->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $productos;
    }

    public function getOne()
    {
        $producto = $this->conexiondb->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $producto->fetch_object();
    }

    public function getOneByUser()
    {
        $producto = $this->conexiondb->query("SELECT id, coste FROM pedidos WHERE usuario_id = {$this->getUsuarioId()} ORDER BY id DESC LIMIT 1");
        return $producto->fetch_object();
    }

    public function getAllByUser()
    {
        $producto = $this->conexiondb->query("SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuarioId()} ORDER BY id DESC");
        return $producto;
    }

    public function getProductosByPedido($id)
    {
        //$sql = "SELECT * FROM productos WHERE id IN (SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id})";
        $sql = "SELECT pr.*, lp.unidades FROM productos pr INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id WHERE lp.pedido_id={$id}";
        $pedido = $this->conexiondb->query($sql);
        return $pedido;
    }

    public function save()
    {
        $usuario_id = $this->getUsuarioId();
        $provincia = $this->getprovincia();
        $localidad = $this->getLocalidad();
        $direccion = $this->getDireccion();
        $coste = $this->getCoste();

        // Escapa los valores y hashea la contraseña
        $usuario_id = $this->conexiondb->real_escape_string($usuario_id);
        $provincia = $this->conexiondb->real_escape_string($provincia);
        $localidad = $this->conexiondb->real_escape_string($localidad);
        $direccion = $this->conexiondb->real_escape_string($direccion);
        $coste = $this->conexiondb->real_escape_string($coste);

        // Crea la sentencia SQL con los valores
        $sql = "INSERT INTO pedidos VALUES(NULL, $usuario_id ,'$provincia', '$localidad', '$direccion', $coste, 'confirm', CURDATE(), CURTIME());";
        $save = $this->conexiondb->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function save_linea()
    {
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->conexiondb->query($sql);
        $pedido_id = $query->fetch_object()->pedido;


        foreach ($_SESSION['carrito'] as $elemento) {

            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']});";

            $save = $this->conexiondb->query($insert);

        }

        $result = false;

        if ($save) {
            $result = true;
        }

        return $result;


    }

    public function edit(){
        $sql="UPDATE pedidos SET estado = '{$this->getEstado()}' WHERE id = {$this->id};";
        $save = $this->conexiondb->query($sql);
        $result = false;
        if ($save){
            $result = true;
        }
        return $result;
    }

}
?>