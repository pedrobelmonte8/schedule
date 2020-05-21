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
    public function dameInfoUsuario($id)
    {
        try {
            $consulta = "SELECT * FROM users WHERE id=$id";
            $result = $this->conexion->query($consulta);
            return $result->fetch();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function setInfoUsuario($id, $user, $email, $not_email, $img = 0)
    {
        try {
            $consulta = "UPDATE users set name='$user',email='$email',not_email='$not_email' WHERE id=$id";
            $result = $this->conexion->query($consulta);
            return $result->rowCount();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function dameEventos($fecha, $user)
    {
        try {
            $consulta = "SELECT id, title,description,DATE_FORMAT(date,'%T'),importance,id_user from event WHERE date LIKE '%$fecha%' AND id_user=$user";
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
    public function dameInfoEvento($id)
    {
        try {
            $consulta = "SELECT title,description,DATE_FORMAT(date,'%H:%i'),DATE_FORMAT(date,'%Y-%m-%d'),importance from event WHERE id=$id";
            $result = $this->conexion->query($consulta);
            return $result->fetch();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function modificarEvento($id, $titulo, $detalles, $fecha, $importancia)
    {
        try {
            /*  $consulta = "UPDATE event set title=? ,description=? ,date=? ,importance=? WHERE id=?"; */
            $consulta = "UPDATE event set title='$titulo', description='$detalles', date='$fecha', importance='$importancia' WHERE id=$id";
            /*  $result = $this->conexion->prepare($consulta);
            $result->bindParam(1, $titulo);
            $result->bindParam(2, $detalles);
            $result->bindParam(3, $fecha);
            $result->bindParam(4, $importancia);
            $result->bindParam(5, $id); */
            /*  error_log($consulta . microtime() . 'En (Model)' . PHP_EOL, 3, "logException.txt"); */
            /*  $result->execute(); */
            $result = $this->conexion->query($consulta);
            return $result->rowCount();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }

    public function nuevoEvento($titulo, $description, $fecha, $hora, $user)
    {
        try {
            $consulta = "INSERT INTO event(title, description, date, importance,id_user) VALUES(?,?,?,?,?) ";
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(1, $titulo);
            $result->bindParam(2, $description);
            $result->bindParam(3, $fecha);
            $result->bindParam(4, $hora);
            $result->bindParam(5, $user);
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

    public function eliminarEvento($id)
    {
        try {
            $consulta = "DELETE FROM event WHERE id=?";
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(1, $id);
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
    //Funciones relacionadas al registro
    public function intentaRegistro($name, $pass, $email, $img)
    {
        try {
            $consulta = "INSERT INTO users (name, email, pass,permissions, img, not_email) VALUES (:name, :email, :pass, :permissions,:img,:not_email)";
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(':name', $name);
            $result->bindParam(':email', $email);
            $passBD = encriptar_contraseña($pass);
            $result->bindParam(':pass', $passBD);
            $result->bindValue(':permissions', 1);
            $result->bindParam(':img', $img);
            $result->bindValue(':not_email', 0);
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
