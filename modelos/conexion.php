<?php

class Conexion
{
    const HOST = "localhost";
    const DBNAME = "controlstockcom_julia";
    const USER = "controlstockcom_julia";
    const PASSWORD = "Control968"; 

    // const HOST = "localhost";
    // const DBNAME = "trabajofinal";
    // const USER = "root";
    // const PASSWORD = "";

    static public function conectar()
    {
        try
        {
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $link = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DBNAME, self::USER, self::PASSWORD, $options);
            $link->exec("set names utf8");
            return $link;
        }
        catch (PDOException $e)
        {
            die("Error en la conexión a la base de datos: " . $e->getMessage());
        }
    }
}