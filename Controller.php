<?php
include('libs/utils.php');
include('clases/sesiones.php');
include_once('Config.php');
class Controller
{
    public function login(){
        require 'templates/login.php';
    }
    public function registry(){
        require 'templates/registry.php';
    }
    public function main(){
        require 'templates/main.php';
    }
}