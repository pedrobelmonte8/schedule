<?php
include('libs/utils.php');
include('clases/sesiones.php');
include_once('Config.php');
class Controller
{
    public function login()
    {
        require 'templates/login.php';
    }
    public function registry()
    {
        require 'templates/registry.php';
    }
    public function main()
    {
        try {
            $params = array(
                'actDate' => date('d-m-Y'),
                'nextDate' => date('d-m-Y', strtotime("+1 day"))
            );
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        }
        require 'templates/main.php';
    }
}
