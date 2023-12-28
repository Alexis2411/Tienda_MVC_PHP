<?php
require_once 'models/CategoriaModel.php';
require_once 'models/ProductosModel.php';
class categoriaController{
    public function index(){
        Utils::isAdmin();
        $categoria=new Categoria();
        $categorias=$categoria->getAll();
        require_once 'views/categoria/index.php';
    }

    public function create(){
        Utils::isAdmin();
        require_once 'views/categoria/crearCategoria.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            if($nombre){
                $categoria=new Categoria();
                $categoria->setNombre($nombre);
                $save = $categoria->saveCategoria();
            }
        }
        header("Location:" . base_url."categoria/index");
    }

    public function ver(){
        if(isset($_GET['id'])){
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $categoria = $categoria->getOne();

            $productos = new Productos();
            $productos->setCategoria_Id($_GET['id']);
            $productos = $productos->getAllCategoria();

        }
        require_once 'views/categoria/ver.php';

    }
}