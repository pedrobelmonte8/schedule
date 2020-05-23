<?php

/* require 'Model.php'; */

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
function enviamosSpam($arrayUsuarios){
    try {
        $m = new Model();
        foreach ($arrayUsuarios as $usuarios => $usuario) {
            $m->setEventsExpireTomorrow($usuario);
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
