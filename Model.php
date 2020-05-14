<?php

include_once('Config.php');
class Model extends PDO
{

    protected $conexion;

    public function __construct()
    {
        $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // Realiza el enlace con la BD en utf-8
        $this->conexion->exec("set names utf8");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function dameEventos($fecha)
    {
        try {
            $consulta = "SELECT id, title,description,DATE_FORMAT(date,'%T'),importance,id_user from event WHERE date LIKE '%$fecha%' AND id_user='1'";
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
    //Funciones relacionadas al registro
    public function intentaRegistro($name, $pass, $email, $img)
    {
        try {
            $consulta = "INSERT INTO users (name, email, pass,permissions, img) VALUES (:name, :email, :pass, :permissions,:img)";
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(':name', $name);
            $result->bindParam(':email', $email);
            $passBD = encriptar_contraseña($pass);
            $result->bindParam(':pass', $passBD);
            $result->bindValue(':permissions', 1);
            $result->bindParam(':img', $img);
            if ($result->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:intentaRegistro)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:intentaRegistro)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    //Funciones relacionadas con el Login
    public function intentaLogin($email, $pass)
    {
        try {
            $consulta = "select * from users where email=:email and pass=:pass";
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(':email', $email);
            $passBD = encriptar_contraseña($pass);
            $result->bindParam(':pass', $passBD);
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'Consulta: ' . $consulta . '' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }

}
