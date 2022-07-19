<?php

class Database{
    public static function connect(){
        try {
            $host = 'localhost';
            $database = '';
            $user = '';
            $password = '';

            $conexion = new PDO('mysql:host='.$host.';dbname='.$database, $user, $password, array(
                PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

            return $conexion;
        } catch (PDOException $e) {
            error_log("Error al conectar la base de datos: ".$e->getMessage());
        }

    }
}