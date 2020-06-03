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
            error_log($e->getMessage() . microtime() . 'En (Model:dameInfoUsuario)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:dameInfoUsuario)' . PHP_EOL, 3, "logError.txt");
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
            error_log($e->getMessage() . microtime() . 'En (Model:setInfoUsuario)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:setInfoUsuario)' . PHP_EOL, 3, "logError.txt");
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
            error_log($e->getMessage() . microtime() . 'En (Model:dameEventos)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:dameEventos)' . PHP_EOL, 3, "logError.txt");
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
            error_log($e->getMessage() . microtime() . 'En (Model:dameInfoEvento)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:dameInfoEvento)' . PHP_EOL, 3, "logError.txt");
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
            error_log($e->getMessage() . microtime() . 'En (Model:modificarEvento)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:modificarEvento)' . PHP_EOL, 3, "logError.txt");
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
            error_log($e->getMessage() . microtime() . 'En (Model:nuevoEvento)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:nuevoEvento)' . PHP_EOL, 3, "logError.txt");
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
            error_log($e->getMessage() . microtime() . 'En (Model:eliminarEvento)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:eliminarEvento)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function buscarEvento($id, $texto)
    {
        try {
            $consulta = "select id, title, date FROM event WHERE id_user='$id' and title like '%$texto%' ORDER BY date desc";
            $result = $this->conexion->query($consulta);
            if ($result->rowCount() == 0) {
                return 1;
            }
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:buscarEvento)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:buscarEvento)' . PHP_EOL, 3, "logError.txt");
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
            error_log($e->getMessage() . microtime() . 'En (Model:intentaLogin):  ' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:intentaLogin)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }


    //Funciones relacionadas con cambiar contraseña desde Settings
    public function cambiarContraseña($old, $new, $id)
    {
        try {
            //Primero comprobamos que la contraseña antigua es correcta
            $oldBD = encriptar_contraseña($old);
            $consulta = "SELECT pass from users WHERE id=:id";
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(':id', $id);
            $result->execute();
            $flag = $result->fetch();
            if ($flag["pass"] == $oldBD) {
                $consulta = "UPDATE users set pass=:pass WHERE id=:id";
                $result = $this->conexion->prepare($consulta);
                $newBD = encriptar_contraseña($new);
                $result->bindParam(':pass', $newBD);
                $result->bindParam(':id', $id);
                $result->execute();
                $flag = $result->rowCount();
                return $flag;
            } else {
                return 0;
            }
            /*  $result->bindParam(':old', $old);
            $result->bindParam(':new', $new); */
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:cambiarContraseña)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:cambiarContraseña)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    //Funciones relacionadas con las notificaciones
    public function getNotificaciones($id)
    {
        try {
            $consulta = "SELECT id,title,date FROM notifications WHERE id_user=$id order by date desc";
            $result = $this->conexion->query($consulta);
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:intentaRegistro)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:intentaRegistro)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function eliminarNotificacion($id)
    {
        try {
            $consulta = "DELETE FROM notifications WHERE id=$id";
            $result = $this->conexion->query($consulta);
            if ($result->rowCount() == 1) {
                return true;
            } else
                return false;
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:eliminarNotificacion)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:eliminarNotificacion)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    //Funciones relacionadas con el Script diario
    public function getUsersNotEmail()
    {
        try {
            $consulta = "SELECT id, email, name FROM users WHERE not_email=1";
            $result = $this->conexion->query($consulta);
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:getUsersNotEmail)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:getUsersNotEmail)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function getEventsExpireTomorrow($date)
    {
        try {
            $consulta = "SELECT * FROM event WHERE date like '%$date%' and importance=1";
            $result = $this->conexion->query($consulta);
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:getEventsExpireTomorrow)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:getEventsExpireTomorrow)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function getNotificationsExpireTomorrow($date, $user)
    {
        try {
            $consulta = "SELECT title, date FROM notifications WHERE date like '%$date%' and id_user=$user";
            $result = $this->conexion->query($consulta);
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:getNotificationsExpireTomorrow)' . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:getNotificationsExpireTomorrow)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
    public function setEventsExpireTomorrow($arrayEvento)
    {
        try {
            $consulta = "INSERT INTO notifications (id_user, id_event, title, description, date) VALUES(?,?,?,?,?)";

            $result = $this->conexion->prepare($consulta);
            $result->bindParam(1, $arrayEvento["id_user"]);
            $result->bindParam(2, $arrayEvento["id"]);
            $result->bindParam(3, $arrayEvento["title"]);
            $result->bindParam(4, $arrayEvento["description"]);
            $result->bindParam(5, $arrayEvento["date"]);
            return $result->execute();
        } catch (Exception $e) {
            //Queremos evitar saturar el log de Errores, si el error es de Indice duplicado no escribimos error en el Log
            if (!$e->getCode() == 23000) {
                error_log($e->getMessage() . $e->getCode() . microtime() . 'En (Model:setEventsExpireTomorrow)' . PHP_EOL, 3, "logException.txt");
                return false;
            } else {
                return false;
            }
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . 'En (Model:setEventsExpireTomorrow)' . PHP_EOL, 3, "logError.txt");
            return false;
        }
    }
}
