<?php

include_once('Config.php');
class Model extends PDO{
   
    protected $conexion;

    public function __construct()
    {
        $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // Realiza el enlace con la BD en utf-8
        $this->conexion->exec("set names utf8");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function dameEventosActual($fecha)
    {
        try {
        $consulta="SELECT id, title,description,DATE_FORMAT(date,'%T'),importance,id_user from event WHERE date LIKE '%$fecha%' AND id_user='1'";
            $result = $this->conexion->query($consulta);
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }


}
