<?php

//Bloque de errores
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

session_start();

require_once 'autoload.php';//cargamos todos los controladores
require_once 'help/Utils.php'; //ayudas para mejorar la seguridad
require_once 'config/parameters.php'; //cargado de parametros pre establecidos
require_once 'config/db.php';//conexion a la base de datos

function show_error(){
    $error = new ErrorController();
    $error->Error404();
}

if(isset($_GET['controller'])){
	$nombre_controlador = $_GET['controller'].'Controller';

}elseif (!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controlador = controller_default;

}else{
    show_error();
	exit();
}

if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador();
	
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
		$action = $_GET['action'];
		$controlador->$action();

	}elseif (!isset($_GET['controller']) && !isset($_GET['action'])){
	    $action_default = action_default;
	    $controlador->$action_default();

    }else{
        show_error();
	}
}else{
    show_error();
}

