<?php
//Aqui pondremos las funciones de validación de los campos

function validarDatos($n, $e, $p, $hc, $f, $g)
{
    return (is_string($n) &
        is_numeric($e) &
        is_numeric($p) &
        is_numeric($hc) &
        is_numeric($f) &
        is_numeric($g));
}


function recoge($var)
{
    if (isset($_REQUEST[$var]))
        $tmp=strip_tags(sinEspacios($_REQUEST[$var]));
        else
            $tmp= "";
            
            return $tmp;
}

function sinEspacios($frase) {
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}
function campoImagen($nombre, $dir, &$errores, $extensionesValidas, $usuario)
{
	if ($_FILES[$nombre]['error'] != 0) {
		switch ($_FILES[$nombre]['error']) {
			case 1:
				$errores[$nombre] = "Fichero demasiado grande";
				break;
			case 2:
				$errores[$nombre] = 'El fichero es demasiado grande';
				break;
			case 3:
				$errores[$nombre] = 'El fichero no se ha podido subir entero';
				break;
			case 4:
				$errores[$nombre] = 'No se ha podido subir el fichero';
				break;
			case 6:
				$errores[$nombre] = "Falta carpeta temporal";
				break;
			case 7:
				$errores[$nombre] = "No se ha podido escribir en el disco";
				break;
			default:
				$errores[$nombre] = 'Error indeterminado.';
		}
		return 0;
	} else {
		$nombreArchivo = $_FILES[$nombre]['name'];
		$directorioTemp = $_FILES[$nombre]['tmp_name'];
		 $extension = $_FILES[$nombre]['type'];
            if (!in_array($extension, $extensionesValidas)) {
                $errores[$nombre] = "La extensión del archivo no es válida o no se ha subido ningún archivo $directorioTemp";
                return 0;
            }

		if (!isset($errores[$nombre])) {

			$nombreArchivo = $dir . $usuario . "." . pathinfo($nombreArchivo, PATHINFO_EXTENSION);

			if (is_dir($dir))
				if (move_uploaded_file($directorioTemp, $nombreArchivo)) {
					return $nombreArchivo;
				} else {
					$errores[$nombre] = "Error: No se puede mover el fichero a su destino";
					return 0;
				} else
				$errores[] = "Error: No se puede mover el fichero a su destino";
		}
	}
}
function encriptar_contraseña($pass){
	  $salt = '$2a$07$usesomesillystringforsalt$';
	  $pass = crypt($pass, $salt);
	  return $pass;
	}
