<?php

require_once 'models/BaseModel.php';

class DashBoardController{

    public function Panel(){
        utils::isSessionInit();
        $baseModel = new BaseModel();

        $habitaciones = $baseModel->getAll('vista_habitacion');
        require_once 'views/dashboard/panel.php';
    }

    public function Reserva(){
        utils::isSessionInit();
        require_once 'views/dashboard/reservacion.php';
    }
}