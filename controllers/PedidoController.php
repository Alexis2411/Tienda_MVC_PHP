<?php
require_once 'models/PedidoModel.php';
require_once 'models/ProductosModel.php';
class pedidoController{
    public function hacer(){
        require_once 'views/pedido/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia']:false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad']:false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion']:false;
            $stats = Utils::stateCarrito();
            $coste = $stats['total'];
            if ($provincia && $localidad && $direccion){
                $pedido = new Pedido();
                $pedido->setUsuarioId($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                $pedido->save_linea();

                if($save){
                    $_SESSION['pedido'] = 'confirmado';
                }else{
                    $_SESSION['pedido'] = 'negado';
                }
                header("Location:".base_url."pedido/confirmado");
            }


        }else{
            header("Location:".base_url);
        }
    }

    public function confirmado()
    {
        if (isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuarioId($identity->id);
            $pedido=$pedido->getOneByUser();
            $pedido_productos = new Pedido();
            $pedido_productos = $pedido_productos->getProductosByPedido($pedido->id)->fetch_all(MYSQLI_ASSOC);
            foreach ($pedido_productos as $prod){
                $almacen = new Productos();
                $almacen->setId($prod['id']);
                $almacen->downStock($prod['unidades']);
            }
        }
        require_once 'views/pedido/confirmado.php';
    }

    public function mis_Pedidos()
    {
        Utils::isLogged();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        $pedido->setUsuarioId($usuario_id);
        $pedidos = $pedido->getAllByUser();
        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle()
    {
        Utils::isLogged();
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            //sacar pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido=$pedido->getOne();
            //sacar los prodcutos
            $pedido_productos = new Pedido();
            $pedido_productos = $pedido_productos->getProductosByPedido($pedido->id);
            require_once 'views/pedido/detalle.php';
        }else{
            header('Location:'.base_url.'pedido/mis_pedidos');
        }
    }

    public function gestion()
    {
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();

        $pedidos=$pedido->getAll();
        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado()
    {
        Utils::isAdmin();
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])){
            $id=$_POST['pedido_id'];
            $estado = $_POST['estado'];
            $pedido= new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();
            header("Location:".base_url."pedido/detalle&id=".$id);
        }else{
            header("Location:".base_url);
        }
    }
}