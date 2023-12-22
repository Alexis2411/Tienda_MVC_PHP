<?php

class ConexionDB{
    public static function connect(){
        $conexiondb = new mysqli('localhost', 'root', '', 'tienda_master');
        return $conexiondb;
    }
}