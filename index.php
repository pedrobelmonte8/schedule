<?php

require_once 'Config.php';
require_once 'Model.php';
require_once 'Controller.php';
require_once 'clases/sesiones.php';
require_once 'clases/google_auth.php';
require_once 'vendor/autoload.php';
if (!isset($_SESSION['nivel'])) {
    $_SESSION['nivel'] = 0;
}
$map = array(

    'login' => array('controller' => 'Controller', 'action' => 'login', 'acceso' => 0),
    'registry' => array('controller' => 'Controller', 'action' => 'registry', 'acceso' => 0),
    'main' => array('controller' => 'Controller', 'action' => 'main', 'acceso' => 0)
);

if (isset($_REQUEST['ctl'])) {
    if (isset($map[$_REQUEST['ctl']])) {
        $ruta = $_REQUEST['ctl'];
    } else {
        header('location:index.php');
        exit;
    }
} else {
    $ruta = 'login';
}
$controlador = $map[$ruta];

if (method_exists($controlador['controller'], $controlador['action'])) {
    //Si tienes permisos
    if ($controlador['acceso'] <= $_SESSION['nivel']) {
        call_user_func(array(
            new $controlador['controller'],
            $controlador['action']
        ));
    } else {
        header('location:index.php?ctl=inicio');
    }
} else {
    header('location:index.php');
}