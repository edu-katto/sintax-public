<?php

class ErrorController{

    public function Error404(){
        //invocamos la vista
        require_once 'views/error/404.php';
    }

    public function Error403(){
        //invocamos la vista
        require_once 'views/error/403.php';
    }
}