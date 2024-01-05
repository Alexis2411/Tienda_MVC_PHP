<?php
require_once 'models/PedidoModel.php';
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
                    $_SESSION['pedido'] = 'complete';
                }else{
                    $_SESSION['pedido'] = 'false';
                }
            }

        }else{
            header("Location:".base_url);
        }
    }
}