<?php
include('libs/utils.php');
include('clases/sesiones.php');
include("clases/validar.php");
include_once('Config.php');
class Controller
{
    public function login()
    {
        require 'templates/login.php';
    }
    public function registry()
    {
        try {
            $params = array(
                'msg' => '',
                'resultado'=>array()
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
                    /*$foto=campoImagen();*/
                    if(empty($errores)){
                        $m = new Model();
                        $params["resultado"]=$m->intentaRegistro($nombre,$pass, $email);
                        if($params["resultado"])
                            $params["msg"]="Exito al crear el usuario";
                        else
                        $params["msg"]="Error al crear el usuario";
                        
                    }

                } else {
                    foreach ($validaciones as $key => $errores) {
                        foreach ($errores as $error) {
                            $params['msg'] .= "<div id='error'>
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
            $params = array(
                'actDate' => date('d-m-Y'),
                'nextDate' => date('d-m-Y', strtotime("+1 day")),
                'dataActDate' => '',
                'dataNextDate' => ''
            );
            $m = new Model();
            //Cambiamos formato a la fecha para hacer la consulta
            $newActDate = date("Y-m-d", strtotime($params["actDate"]));
            $newNextDate = date("Y-m-d", strtotime($params["nextDate"]));
            $arrayActDate = $m->dameEventosActual($newActDate);
            $arrayNextDate = $m->dameEventosActual($newNextDate);

            /* Llenamos la lista del dia Actual */
            foreach ($arrayActDate as $linea) {
                $hora1 = $linea[3];
                $titulo1 = $linea["title"];
                $id1 = $linea["id_user"];
                $params["dataActDate"] .= "
                <li class='elementList' data-id='" . $id1 . "'>
                <p class='paragEelemntList'>" . $hora1 . " - " . $titulo1 . "</p>
                <div class='iconos'>
                <i class='far fa-square importancia'></i>
                <i class='iconos fas fa-trash-alt'></i>
                <i class='iconos fas fa-pencil-alt'></i>
                </div>
                </li>
                ";
            }

            /* Llenamos la lista del dia Siguiente */
            foreach ($arrayNextDate as $linea) {
                $hora1 = $linea[3];
                $titulo1 = $linea["title"];
                $id1 = $linea["id_user"];
                $params["dataActDate"] .= "
                <li class='elementList' data-id='" . $id1 . "'>
                <p class='paragEelemntList'>" . $hora1 . " - " . $titulo1 . "</p>
                <div class='iconos'>
                <i class='far fa-square importancia'></i>
                <i class='iconos fas fa-trash-alt'></i>
                <i class='iconos fas fa-pencil-alt'></i>
                </div>
                </li>
                ";
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . 'En (Controller)' . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
        require 'templates/main.php';
    }
}
