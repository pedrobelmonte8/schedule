<?php

/**
 * Clase para realizar validaciones en el modelo
 * Es utilizada para realizar validaciones en el modelo de nuestras clases.
 *
 * @author Carlos Belisario
 */
class Validacion
{
    protected $_atributos;
    protected $_error;
    public $mensaje;

    /**
     * Metodo para indicar la regla de validacion
     * El método retorna un valor verdadero si la validación es correcta, de lo contrario retorna el objeto
     * actual, permitiendo acceder al atributo Validacion::$mensaje ya que es publico
     */
    public function rules($rule = array(), $data)
    {

        if (!is_array($rule)) {
            $this->mensaje = "las reglas deben de estar en formato de arreglo";
            return $this;
        }
        foreach ($rule as $key => $rules) {
            $reglas = explode(',', $rules['regla']);
            if (array_key_exists($rules['name'], $data)) {
                foreach ($data as $indice => $valor) {
                    if ($indice === $rules['name']) {
                        foreach ($reglas as $clave => $valores) {
                            $validator = $this->_getInflectedName($valores);
                            if (!is_callable(array($this, $validator))) {
                                throw new BadMethodCallException("No se encontro el metodo actual");
                            }
                            $respuesta = $this->$validator($rules['name'], $valor);
                        }
                        break;
                    }
                }
            } else {
                $this->mensaje[$rules['name']] = "El campo $key no esta dentro de la regla de validación o en el formulario";
            }
        }
        if (isset($this->mensaje)) {
            return $this->mensaje;
        } else {
            return true;
        }
    }

    /**
     * Metodo inflector de la clase
     * por medio de este metodo llamamos a las reglas de validacion que se generen
     */
    private function _getInflectedName($text)
    {
        $validator="";
        $_validator = preg_replace('/[^A-Za-z0-9]+/', ' ', $text);
        $arrayValidator = explode(' ', $_validator);
        if (count($arrayValidator) > 1) {
            foreach ($arrayValidator as $key => $value) {
                if ($key == 0) {
                    $validator .= "_" . $value;
                } else {
                    $validator .= ucwords($value);
                }
            }
        } else {
            $validator = "_" . $_validator;
        }
        return $validator;
    }

    /**
     * Metodo de verificacion de que el dato no este vacio o NULL
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _noEmpty($campo, $valor)
    {
        if (isset($valor) && !empty($valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "El campo $campo debe de estar lleno";
            return false;
        }
    }
    /**
     * Metodo de verificacion de tipo numerico
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _numeric($campo, $valor)
    {
        if (is_numeric($valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "El campo $campo debe de ser numerico";
            return false;
        }
    }

    /**
     * Metodo de verificacion de tipo email
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _email($campo, $valor)
    {
        if (preg_match("/^[a-z]+([\.]?[a-z0-9_-]+)*@[a-z]+([\.-]+[a-z0-9]+)*\.[a-z]{2,}$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "El campo $campo debe tener el siguiente formato de email usuario@servidor.com";
            return false;
        }
    }
    protected function _emailAbastos($campo, $valor)
    {
        if (preg_match("/^[a-z]+([\.]?[a-z0-9_-]+)*@iesabastos\.org$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "The email must have this format: name@iesabastos.org ";
            return false;
        }
    }
    protected function _password($campo, $valor)
    {
        if (preg_match("/^[a-z0-9][a-z0-9_\-@]{7,20}$/i", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "La contraseña estará comprendida entre 8 y 21 caracteres, comenzando por una letra o un dígito (-, @, y _ están permitidos).";
            return false;
        }
    }
    protected function _name($campo, $valor)
    {
        if (preg_match("/^[a-z0-9][a-z0-9_\-@]{4,19}$/i", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "El usuario estará comprendido entre 5 y 20 caracteres, sin espacios, comenzando por una letra o un dígito (-, @, y _ están permitidos).";
            return false;
        }
    }
/* 
    protected function _password($campo, $valor)
    {
        if (preg_match("/^[a-z]+([\.]?[a-z0-9_-]+)*@[a-z]+([\.-]+[a-z0-9]+)*\.[a-z]{2,}$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "El campo $campo de estar en el formato de email usuario@servidor.com";
            return false;
        }
    } */
}

//el uso de la clase es muy sencillo aca dejo las pruebas que realice a la clase

/* $_POST['campo1'] = 1;
$_POST['campo2'] = "usuario@hotmail.com";
$datos = $_POST;
$validacion =  new Validacion();
$regla = array(
    array('name' => 'campo1', 'regla' => 'no-empty,numeric'),
    array('name' => 'campo2', 'regla' => 'no-empty,email')
);
$validaciones = $validacion->rules($regla, $datos);
print_r($validaciones); */
