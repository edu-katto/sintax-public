<?php

require_once 'models/ReservaModel.php';
require_once 'models/HabitacionModel.php';

class CheckOutController{

    public function ListaReservas(){

        utils::isSessionInit();
        $reserva = new ReservaModel();

        $dataReserva = $reserva->getAllReservaCheckIn();

        require_once 'views/checkOut/listaCheckOut.php';
    }

    public function Salida(){
        utils::isSessionInit();

        if ( utils::existGET(['cod_reserva','cod_habitacion']) ){

            $codReservacion = utils::protege($_GET['cod_reserva']);
            $codHabitacion = utils::protege($_GET['cod_habitacion']);

            $habitacion = new HabitacionModel();
            $reseva = new ReservaModel();

            $habitacion->setCodHabitacion($codHabitacion);
            $habitacion->setCodEstadoHabitacion(1);

            $reseva->setCodReserva($codReservacion);
            $reseva->setCodEstadoReserva(2);


            //varificamos que la avitacion este Ocupada
            $estadoHabitacion = $habitacion->getOne()->fetchObject()->cod_estado_habitacion;

            $actualizarReserva = $reseva->actualizarEstado();

            if ( is_array( $actualizarReserva ) ){
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Error cerrar reservacion $actualizarReserva[0] - $actualizarReserva[2]",'error'];
                header("location: ". base_url . "CheckOut/ListaReservas");
                exit();
            }

            //comprobamos el estado para actualizar la habitacion
            if ($estadoHabitacion == 3){
                $habitacion->actualizarEstado();
            }

            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Exito',"Exito al realizar checkOut",'success'];
            header("location: ". base_url . "DashBoard/Panel");

        } else {
            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
            header("location: ". base_url . "CheckOut/ListaReservas");
        }
    }
}