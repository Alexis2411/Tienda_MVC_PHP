<?php

class ConexionDB{
    public static function connect(){
        $conexiondb = new mysqli('localhost', 'root', '', 'tienda_master');
        $conexiondb->query("SET NAMES 'UTF-8'");
        return $conexiondb;
    }
}