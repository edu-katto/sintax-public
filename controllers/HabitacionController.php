<?php

require_once 'models/HabitacionModel.php';

class HabitacionController{

    public function SalirLimpieza(){
        utils::isSessionInit();

        if ( utils::existGET(['cod_habitacion']) ){

            $codHabitacion = utils::protege($_GET['cod_habitacion']);

            $habitacion = new HabitacionModel();
            $habitacion->setCodHabitacion($codHabitacion);
            $habitacion->setCodEstadoHabitacion(2);

            //varificamos que la avitacion este Ocupada
            $estadoHabitacion = $habitacion->getOne()->fetchObject()->cod_estado_habitacion;

            //comprobamos el estado para actualizar la habitacion
            if ($estadoHabitacion == 1){
                $actualizar = $habitacion->actualizarEstado();

                if ( is_array($actualizar) ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al salir del modo limpieza $actualizar[0] - $actualizar[2]",'error'];
                    header("location: ". base_url . "CheckOut/ListaReservas");
                    exit();
                }
            }

            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Exito',"Exito al salir del modo limpieza",'success'];
            header("location: ". base_url . "DashBoard/Panel");

        } else {
            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
            header("location: ". base_url . "DashBoard/Panel");
        }
    }

}