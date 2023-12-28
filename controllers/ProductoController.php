<?php
require_once 'models/ProductosModel.php';
class productoController
{
    public function index()
    {
        $producto = new Productos();
        $productos = $producto->getRandom(6); 
        require_once 'views/producto/destacados.php';
    }

    public function ver(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Productos();
            $producto->setId($id);
            $datos = $producto->getOne();
            require_once 'views/producto/ver.php';
        } 
    }

    public function gestion()
    {
        Utils::isAdmin();
        $producto = new Productos();
        $productos = $producto->getAll();
        require_once 'views/producto/gestion.php';
    }

    public function create()
    {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Productos();
                $producto->setNombre($nombre);
                $producto->setCategoria_id($categoria);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);

                if (isset($_FILES)) {
                    $archivo = $_FILES['imagen'];
                    $filename = $archivo['name'];
                    $mimetype = $archivo['type'];

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        move_uploaded_file($archivo["tmp_name"], "uploads/images/" . $filename);
                        $producto->setImagen($filename);
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                    var_dump($save);
                } else {
                    $save = $producto->save();
                }

                if ($save) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }
        header('Location:' . base_url . 'producto/gestion');
    }

    public function editar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $editar = true;
            $producto = new Productos();
            $producto->setId($id);
            $datos = $producto->getOne();
            require_once 'views/producto/crear.php';
        } else {
            header("location:" . base_url . "producto/gestion");
        }

    }

    public function eliminar()
    {
        Utils::isAdmin();
        var_dump($_GET);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Productos();
            $producto->setId($id);
            if ($producto->delete()) {
                $_SESSION['eliminado'] = "complete";
            } else {
                $_SESSION['eliminado'] = "error";
            }
        } else {
            $_SESSION['eliminado'] = "error";
        }
        header("Location:" . base_url . "producto/gestion");
    }
}