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
            echo $evento["id"];
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
        //Agregar destinatario
        $mail->AddAddress("pedrojuan36022@gmail.com");
        $mail->Subject = "Mensaje de prueba Aplicación";
        $mail->Body = "Cuerpo del Mensaje";
        if($mail->Send()){
            echo "Exito";
            error_log("Se ha enviado el correo correctamente" .date("Y-m-d H:i:s"). PHP_EOL, 3, "logErrorCron.txt");
        }else{
            echo "Error";
            error_log("No se ha enviado el correo correctamente" .date("Y-m-d H:i:s"). PHP_EOL, 3, "logErrorCron.txt");
            /* error_log($mail . PHP_EOL, 3, "logErrorCron.txt"); */
           /* print_r($mail); */
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
print_r($usuarios);
$eventos = getEventsExpireTomorrow();
setEventsExpireTomorrow($eventos);
/* print_r($eventos[1]); */
/* enviamosSpam(1); */
echo "hey";
