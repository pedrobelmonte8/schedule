<?php
include('libs/utils.php');
include('clases/sesiones.php');
include("clases/validar.php");
include_once('Config.php');
class Controller
{
    public function login()
    {
        try {
            $sesion = new Sesiones();
            //Si la sesion está iniciada no le dejamos entrar al Login
            if (isset($_SESSION["nivel"])) {
                if ($_SESSION["nivel"] > 0) {
                    header("Location:index.php?ctl=main");
                }
            }
            $params = array(
                "resultado" => array(),
                "msg" => ""
            );
            $m = new Model();
            if (isset($_POST['inputLogin'])) {
                $datos = $_POST;
                $validacion = new Validacion();
                $regla = array(
                    array('name' => 'logEmail', 'regla' => 'no-empty'),
                    array('name' => 'logPass', 'regla' => 'no-empty')
                );
                $validaciones = $validacion->rules($regla, $datos);
                if ($validaciones == 1) {
                    $email = recoge("logEmail");
                    $pass = recoge("logPass");
                    $params["resultado"] = $m->intentaLogin($email, $pass);
                    //Si todo va bien vamos al main, iniciando Sesiones
                    if (count($params['resultado']) == 1) {
                        $sesion->inicioSesion($params["resultado"][0]["name"], $params["resultado"][0]["permissions"], $params["resultado"][0]["id"], $params["resultado"][0]["img"]);
                        header('Location:index.php?ctl=main');
                    } else
                        $params["msg"] .= "<div class='error'>
                        <p><i class='fa fa-times-circle'></i> " . "Error en el Login" . "</p>
                        </div>
                       ";
                } else {
                    foreach ($validaciones as $key => $errores) {
                        foreach ($errores as $error) {
                            $params['msg'] .= "<div class='error'>
                            <p><i class='fa fa-times-circle'></i> " . $error . "</p>
                            </div>
                           ";
                        }
                    }
                }
            }
            //Login con Google APLAZADO
            /*if (isset($_POST["btnGoogle"])) {
                $session = new Sesiones;
                $googleClient = new Google_Client();
                $auth = new GoogleAuth($googleClient);
                if (!$auth->isLoggedIn()) {
                    header("Location:" . $auth->getAuthUrl());
                    //ARREGLAR
                } else {
                    header("Location:index.php?ctl=main");
                }
            } */
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            return false;
        }
        require 'templates/login.php';
    }
    public function registry()
    {
        try {
            //Si la sesion está iniciada no le dejamos entrar al Login
            if (isset($_SESSION["nivel"])) {
                if ($_SESSION["nivel"] > 0) {
                    header("Location:index.php?ctl=main");
                }
            }
            $params = array(
                'msg' => '',
                'resultado' => array()
            );
            if (isset($_POST["inputRegister"])) {
                // Validamos con la clase validar
                $datos = $_POST;
                $validacion = new Validacion();
                //COLOCAR LAS REGLAS NECESARIAS
                $regla = array(
                    array('name' => 'inputName', 'regla' => 'no-empty, name'),
                    array('name' => 'inputEmail', 'regla' => 'no-empty, email'),
                    array('name' => 'inputPassword', 'regla' => 'no-empty, password'),
                    array('name' => 'inputRepPassword', 'regla' => 'no-empty')
                );
                $validaciones = $validacion->rules($regla, $datos);
                //Si no hay errores...
                if ($validaciones == 1) {
                    $nombre = recoge("inputName");
                    $email = recoge("inputEmail");
                    $pass = recoge("inputPassword");
                    $errores = [];
                    $foto = campoImagen('inputFile', './images/', $errores, Config::$extensionesValidas, $nombre);
                    if (empty($errores)) {
                        $m = new Model();
                        $params["resultado"] = $m->intentaRegistro($nombre, $pass, $email, $foto);
                        if ($params["resultado"])
                            $params["msg"] = "Exito al crear el usuario";
                        else
                            $params["msg"] = "Error al crear el usuario";
                    } else {
                        //Si la imagen da problemas...
                        foreach ($errores as $error) {
                            $params['msg'] .=  "<div class='error'>
                            <p><i class='fa fa-times-circle'></i> " . $error . "</p>
                            </div>
                           ";
                        }
                    }
                } else {
                    foreach ($validaciones as $key => $errores) {
                        foreach ($errores as $error) {
                            $params['msg'] .= "<div class='error'>
                            <p><i class='fa fa-times-circle'></i> " . $error . "</p>
                            </div>
                           ";
                        }
                    }
                }
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            return false;
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            return false;
        }
        require 'templates/registry.php';
    }
    public function main()
    {
        try {
            if (isset($_POST['logout'])) {
                /* unset($_SESSION["access_token"]); */
                $sesion = new Sesiones;
                $sesion->destruir_sesion();
                header('location:index.php');
            }
            $params = array(
                'actDate' => date('d-m-Y'),
                'nextDate' => date('d-m-Y', strtotime("+1 day"))
            );
            /*             
            $googleClient = new Google_Client();
            $auth = new GoogleAuth($googleClient);
            if ($auth->checkRedirectCode()) {
                header("Location:index.php?ctl=main");
                echo "Entro";
            } else {
                echo "Error";
            } */
            $session = new Sesiones;
            $session->caduca();
            //Cambiamos formato a la fecha para hacer la consulta
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
        require 'templates/main.php';
    }

    public function getListaEventos()
    {
        try {
            $fecha = $_POST["fechaActual"];
            $usuario = $_SESSION["id"];
            $m = new Model();
            $session = new Sesiones;
            $session->caduca();
            $datos = $m->dameEventos($fecha, $usuario);
            echo json_encode($datos);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }

    public function getEvento()
    {
        try {
            $id = $_POST["id"];
            $m = new Model();
            $session = new Sesiones;
            $session->caduca();
            $datos = $m->dameInfoEvento($id);
            echo json_encode($datos);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }
    public function modificarEvento()
    {
        try {
            $m = new Model();
            $session = new Sesiones;
            $session->caduca();
            $id = $_POST["id"];
            $titulo = $_POST["titulo"];
            $detalles = $_POST["masDetalles"];
            $importancia = $_POST["importancia"];
            $fecha = $_POST["fecha"];
            $datos = $m->modificarEvento($id, $titulo, $detalles, $fecha, $importancia);
            echo json_encode($datos);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }
    public function notificaciones()
    {
        try {
            $session = new Sesiones;
            $session->caduca();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
        require 'templates/notifications.php';
    }
    public function changePassword()
    {
        try {
            $session = new Sesiones;
            $session->caduca();
            $m = new Model();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
        require 'templates/changepassword.php';
    }
    public function nuevoEvento()
    {
        try {
            $session = new Sesiones;
            $session->caduca();
            $titulo = $_POST["titulo"];
            $masDetalles = $_POST["masDetalles"];
            $hora = $_POST["hora"];
            $fecha = $_POST["fecha"];
            $importancia = $_POST["importancia"];
            $user = $_SESSION["id"];
            $fechaCompleta = $fecha . " " . $hora;
            $m = new Model();
            echo $m->nuevoEvento($titulo, $masDetalles, $fechaCompleta, $importancia, $user) ? json_encode(true) : json_encode(false);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }
    public function eliminarEvento()
    {
        try {
            $session = new Sesiones;
            $session->caduca();
            $id = $_POST["id"];
            $m = new Model();
            echo $m->eliminarEvento($id) ? json_encode(true) : json_encode(false);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }
    public function configuracion()
    {
        try {
            $session = new Sesiones;
            $session->caduca();
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
        require 'templates/settings.php';
    }

    public function cargarDatosUsuario()
    {
        try {
            $session = new Sesiones;
            $session->caduca();
            $m = new Model();
            $datos = $m->dameInfoUsuario($_SESSION["id"]);
            echo json_encode($datos);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }
    public function cambiarDatosUsuario()
    {
        try {
            $session = new Sesiones;
            $session->caduca();
            $m = new Model();
           /* Código para que funcione la subida de archivos, no he conseguido hacerlo, existe un problema , pero no se localizarlo, supongo que será tema del Ajax o Cliente-Servidor */
            /* $errores = [];
             if ($_POST["img"] == 0) {
                $datos = $m->setInfoUsuario($_SESSION["id"], $_POST["user"], $_POST["email"], $_POST["notEmail"]);
            } else {
                $foto = campoImagen('formSettingsImg', './images/', $errores, Config::$extensionesValidas, $_POST["user"]);
                if (empty($errores)) {
                    $datos = $m->setInfoUsuario($_SESSION["id"], $_POST["user"], $_POST["email"], $_POST["notEmail"], $foto);
                    error_log("Entro en empty" . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
                } else {
                    foreach ($errores as $error) {
                        error_log($error . " " . microtime() . $_SESSION["id"] . $_POST["user"] . $_POST["email"] . $_POST["notEmail"] . 'Foto' . PHP_EOL, 3, "logException.txt");
                    }
                    $datos = false;
                }
            } */
            $datos = $m->setInfoUsuario($_SESSION["id"], $_POST["user"], $_POST["email"], $_POST["notEmail"]);
            if($datos){
                $session->cambioDatosDeSesion($_POST["user"]);
            }
            echo json_encode($datos);
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
    }

    public function logout()
    {
        try {
            $sesion = new Sesiones;
            $sesion->destruir_sesion();
            header('Location:index.php');
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
    }
}
