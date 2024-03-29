<?php

class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name]=null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function isLogged(){
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    public static function showCategorias(){
        require_once 'models/CategoriaModel.php';
        $categorias= new Categoria();
        $resultado=$categorias->getAll();
        return $resultado;
    }

    public static function stateCarrito(){
        $stats = array(
            'count'=>0,
            'total' => 0
        );

        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);
            foreach($_SESSION['carrito'] as $producto){
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
        }

        return $stats;
    }

    public static function showStatus($status)
    {
        $value = "Pendiente";
        if ($status =="confirm"){
            $value="Pendiente";
        }elseif ($status=="preparation"){
            $value="En Preparacion";
        }elseif ($status=="ready"){
            $value="Preparado";
        }elseif ($status=="sendend"){
            $value="Enviado";
        }
        return $value;
    }
}