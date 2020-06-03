<?php

require '../Model.php';

use PHPMailer\PHPMailer\PHPMailer;

/* use PHPMailer\PHPMailer\Exception; */

require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/phpmailer/src/Exception.php';
function getUsersEmail()
{
    try {
        $m = new Model();
        $usuarios = $m->getUsersNotEmail();
        //Array con los ids de los usuarios con notificaciones activadas
        return $usuarios;
    } catch (Exception $e) {
        error_log($e->getMessage() . microtime() . '' . PHP_EOL, 3, "logErrorCron.txt");
        return false;
    } catch (Error $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logErrorCron.txt");
        return false;
    }
}
//Conseguimos los eventos que tiene fecha de mañana
function getEventsExpireTomorrow()
{
    try {
        $diadeExpiracion = date('Y-m-d', strtotime("+1 day"));
        /* echo $diadeExpiracion; */
        $m = new Model();
        $eventos = $m->getEventsExpireTomorrow($diadeExpiracion);
        return $eventos;
    } catch (Exception $e) {
        error_log($e->getMessage() . microtime() . '' . PHP_EOL, 3, "logErrorCron.txt");
        return false;
    } catch (Error $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logErrorCron.txt");
        return false;
    }
}
//Hacemos un insert del array que nos ha dado la función anterior, es decir los eventos que estén marcados como importantes
function setEventsExpireTomorrow($arrayEventos)
{
    try {
        $m = new Model();
        foreach ($arrayEventos as $eventos => $evento) {
            $m->setEventsExpireTomorrow($evento);
        }
    } catch (Exception $e) {
        error_log($e->getMessage() . microtime() . '' . PHP_EOL, 3, "logErrorCron.txt");
        return false;
    } catch (Error $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logErrorCron.txt");
        return false;
    }
}
function enviamosSpam($arrayUsuarios)
{
    try {
        $diadeExpiracion = date('Y-m-d', strtotime("+1 day"));
        $m = new Model();
        /*  foreach ($arrayUsuarios as $usuarios => $usuario) {
            $m->setEventsExpireTomorrow($usuario);
        } */
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->IsSMTP();

        //Configuracion servidor mail
        $mail->From = "schedulegroupss@gmail.com"; //remitente
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls'; //seguridad
        $mail->Host = "smtp.gmail.com"; // servidor smtp
        $mail->Port = 587; //puerto
        $mail->Username = 'schedulegroupss@gmail.com'; //nombre usuario
        $mail->Password = 'AdministradorAbastos'; //contraseña
        foreach ($arrayUsuarios as $array => $usuarios) {
            $emailDestino = $usuarios["email"];
            $usuario = $usuarios["name"];
            $cuerpo = "";
            echo "Usuario: <br>";
            print_r($emailDestino);
            echo "<br>";
            $arrayNotificaciones = $m->getNotificationsExpireTomorrow($diadeExpiracion, $usuarios["id"]);
            foreach ($arrayNotificaciones as $array => $notificacion) {
                echo "<br>Evento: ";
                print_r($notificacion);
                $cuerpo .= $notificacion["title"] . "<br>";
            }
            /*  echo "<br>Notificaciones: ";
            print_r($arrayNotificaciones); */
            //Agregar destinatario
            $mail->AddAddress($emailDestino);
            //CUERPO DEL MENSAJE
            $mail->Subject = "¡Hey $usuario, mañana tienes cosas que hacer!";
            $mail->Body = $cuerpo;
            echo "<br>Cuerpo del mensaje: <br>$cuerpo";
            if ($cuerpo != "") {
                if ($mail->Send()) {
                    echo "<br> Exito $emailDestino <br>";
                    error_log("Se ha enviado el correo correctamente" . date("Y-m-d H:i:s") . PHP_EOL, 3, "logErrorCron.txt");
                } else {
                    echo "<br> Error $emailDestino <br>";
                    error_log("No se ha enviado el correo correctamente" . date("Y-m-d H:i:s") . PHP_EOL, 3, "logErrorCron.txt");
                    //error_log($mail . PHP_EOL, 3, "logErrorCron.txt");
                    // print_r($mail); 
                }
            }else{
                echo "No hay contenido que envíar";
            }
        }
    } catch (Exception $e) {
        error_log($e->getMessage() . microtime() . '' . PHP_EOL, 3, "logErrorCron.txt");
        return false;
    } catch (Error $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logErrorCron.txt");
        return false;
    }
}
$usuarios = getUsersEmail();

$eventos = getEventsExpireTomorrow();
setEventsExpireTomorrow($eventos);
enviamosSpam($usuarios);
