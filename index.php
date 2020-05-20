<?php

require_once 'Config.php';
require_once 'Model.php';
require_once 'Controller.php';
require_once 'clases/sesiones.php';
require_once 'clases/google_auth.php';
require_once 'vendor/autoload.php';
$f = new Sesiones();
/* if (!isset($_SESSION['nivel'])) {
    $_SESSION['nivel'] = 0;
} */
$map = array(

    'login' => array('controller' => 'Controller', 'action' => 'login', 'acceso' => 0),
    'registry' => array('controller' => 'Controller', 'action' => 'registry', 'acceso' => 0),
    'main' => array('controller' => 'Controller', 'action' => 'main', 'acceso' => 1),
    'notificaciones'=>array('controller'=>'Controller','action'=>'notificaciones','acceso'=>1),
    'configuracion' => array('controller' => 'Controller', 'action' => 'configuracion', 'acceso' => 1),
    'logout' => array('controller' => 'Controller', 'action' => 'logout', 'acceso' => 1),
    'getListaEventos'=>array('controller' => 'Controller', 'action' => 'getListaEventos', 'acceso' => 1),
    'nuevoEvento'=>array('controller' => 'Controller', 'action' => 'nuevoEvento', 'acceso' => 1),
    'eliminarEvento'=>array('controller' => 'Controller', 'action' => 'eliminarEvento', 'acceso' => 1),
    'dameInfoEvento'=>array('controller' => 'Controller', 'action' => 'getEvento', 'acceso' => 1),
    'modificarEvento'=>array('controller' => 'Controller', 'action' => 'modificarEvento', 'acceso' => 1)
);

if (isset($_REQUEST['ctl'])) {
    if (isset($map[$_REQUEST['ctl']])) {
        $ruta = $_REQUEST['ctl'];
    } else {
        header('location:index.php');
        exit;
    }
} else {
    $ruta = 'main';
}
$controlador = $map[$ruta];

if (method_exists($controlador['controller'], $controlador['action'])) {
    //Si tienes permisos
    $nivel = 0;
    if (isset($_SESSION["nivel"])) {
        $nivel = $_SESSION["nivel"];
    }
    if ($controlador['acceso'] <= $nivel /* ||isset($_SESSION["access_token"]) */) {
        call_user_func(array(
            new $controlador['controller'],
            $controlador['action']
        ));
    } else {
        if ($nivel > 0) {
            header('location:index.php?ctl=main');
        } else
            header('location:index.php?ctl=login');
    }
} else {
    header('location:index.php');
}
