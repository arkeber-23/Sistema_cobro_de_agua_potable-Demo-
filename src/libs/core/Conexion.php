<?php

class Conexion extends PDO
{

    private function __construct()
    {
        try {
            $opciones = [
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $url = "mysql:host=" . ENV['DB_HOST'] . "; dbname=" . ENV["DB_NAME"] . ";" . ENV["DB_CHAR"];
            return parent::__construct($url, ENV['DB_USER'], ENV['DB_PASS'], $opciones);
        } catch (PDOException $e) {
            return "Error Conexion! " . $e->getMessage();
            die();
        }
    }

    public static function con()
    {
        return new Conexion();
    }

}
