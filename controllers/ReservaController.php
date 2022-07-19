<?php
require_once 'models/BaseModel.php';
require_once 'models/ClienteModel.php';
require_once 'models/HabitacionModel.php';
require_once 'models/ReservaModel.php';
require_once 'models/CajaModel.php';

class ReservaController{

    public function RegistrarReserva(){
        //valida que el usuairo este autenticado
        utils::isSessionInit();

        //validar peticion y encaminar respesta
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){

            //validar la informacion del formulario
            if ( utils::existPOST(['cliente','fecha_inicio','fecha_fin','monto_adelanto','cod_habitacion']) ){

                /* asignamos a una variable el monto enviado por el usuario
                * adicional validamos y hacemos un saneamiento de los datos
                */

                $cliente = utils::protege($_POST['cliente']);
                $fechaInicio = utils::protege($_POST['fecha_inicio']);
                $fechaFin = utils::protege($_POST['fecha_fin']);
                $montoAdelanto = utils::protege($_POST['monto_adelanto']);
                $codHabitacion = utils::protege($_POST['cod_habitacion']);


                //inicializamos los modelos
                $reserva = new ReservaModel();
                $habitacion = new HabitacionModel();
                $caja = new CajaModel();

                //verificamos que exita una caja abierta
                if ( $caja->verificarApertura() ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"No se puede crear reservacion porque no exite caja abierta",'error'];
                    header("location: " . base_url . "Reserva/RegistrarReserva&cod_habitacion=$codHabitacion");
                    exit();
                }

                //enviamos los valores al modelo
                $reserva->setCodCliente($cliente);
                $reserva->setFechaInicio($fechaInicio);
                $reserva->setFechaFin($fechaFin);
                $reserva->setAdelanto($montoAdelanto);
                $reserva->setCodHabitacion($codHabitacion);
                $reserva->setCodEstadoReserva(3);

                $habitacion->setCodHabitacion($codHabitacion);
                $habitacion->setCodEstadoHabitacion(3);

                //buscasmos una reserva con los datos para verificar la disponibilidad de la habitacion
                $searchReserva = $reserva->searchReserva();
                if ( !$searchReserva ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Ya existe una reserva para ese dia",'error'];
                    header("location: " . base_url . "Reserva/RegistrarReserva&cod_habitacion=$codHabitacion");
                    exit();
                }

                //buscamos la ultima caja y le sumanos el adelanto
                $montoSinCierre = $caja->allCajaOpen()->fetchObject()->monto_sin_cierre + $montoAdelanto;
                $montoActualMasCierre = $caja->allCajaOpen()->fetchObject()->monto_actual_mas_cierre + $montoAdelanto;
                $codCaja = $caja->allCajaOpen()->fetchObject()->cod_caja;

                $caja->setMontoSinCierre($montoSinCierre);
                $caja->setMontoActualMasCierre($montoActualMasCierre);
                $caja->setCodCaja($codCaja);

                //cargamos los valores a la caja
                $caja->addMonto();

                //validamos que la reserva se guarde de forma correcta
                $save = $reserva->save();

                if ( is_array($save) ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al reservar - codigo: $save[0]",'error'];
                    header("location: " . base_url . "Reserva/RegistrarReserva&cod_habitacion=$codHabitacion");
                    exit();
                }

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Exito al Reservar",'success'];
                header("location: ". base_url . "DashBoard/Panel");
                exit();

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
                header("location: " . base_url . "Reserva/RegistrarReserva&cod_habitacion=" . utils::protege($_POST['cod_habitacion']));
                exit();
            }

        } else {
            /* asignamos a una variable el monto enviado por el usuario
             * adicional validamos y hacemos un saneamiento de los datos
            */
            if ( utils::existGET(['cod_habitacion']) ){

                $codHabitacion = utils::protege($_GET['cod_habitacion']);

                $cliente = new ClienteModel();
                //buscar todos los clientes
                $listaCliente = $cliente->allCliente();

                $habitacion = new HabitacionModel();
                $habitacion->setCodHabitacion($codHabitacion);

                //obtener los datos de la habitacion
                $habita = $habitacion->getOne()->fetchObject();

                require_once 'views/dashboard/reserva/registrarReserva.php';

            } else {

                //mostrar todas las habitaciones
                $baseModel = new BaseModel();
                $habitaciones = $baseModel->getAll('vista_habitacion');

                //invotamos la vista
                require_once 'views/dashboard/reserva/listaHabitaciones.php';
            }
        }

    }

    public function ListaReserva(){
        utils::isSessionInit();

        $reserva = new ReservaModel();
        $data = $reserva->getAll();

        require_once 'views/dashboard/reserva/listaReserva.php';

    }

    public function Actualizar(){
        //valida que el usuairo este autenticado
        utils::isSessionInit();

        //validar peticion y encaminar respesta
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){

            //validamos la informacion enviada por el usuario
            if ( utils::existPOST(['cliente','fecha_inicio','fecha_fin','monto_adelanto','cod_reserva','cod_estado_reserva','cod_habitacion']) ){

                /* asignamos a una variable el monto enviado por el usuario
                 * adicional validamos y hacemos un saneamiento de los datos
                */

                $codCliente = utils::protege($_POST['cliente']);
                $fechaInicio = utils::protege($_POST['fecha_inicio']);
                $fechaFin = utils::protege($_POST['fecha_fin']);
                $montoAdelanto = utils::protege($_POST['monto_adelanto']);
                $codReserva = utils::protege($_POST['cod_reserva']);
                $codEstadoReserva = utils::protege($_POST['cod_estado_reserva']);
                $codHabitacion = utils::protege($_POST['cod_habitacion']);

                //invocamos los metodos
                $reserva = new ReservaModel();
                $caja = new CajaModel();
                $habitacion = new HabitacionModel();


                //enviamos los datos al modelos
                $habitacion->setCodHabitacion($codHabitacion);
                $habitacion->setCodEstadoHabitacion(3);

                $reserva->setCodReserva($codReserva);
                $reserva->setFechaInicio($fechaInicio);
                $reserva->setFechaFin($fechaFin);
                $reserva->setAdelanto($montoAdelanto);
                $reserva->setCodEstadoReserva($codEstadoReserva);

                $fechaInicioOld = $reserva->getOne()->fecha_inicio;
                $fechaFinOld = $reserva->getOne()->fecha_fin;
                $montoAdelantoOld = $reserva->getOne()->adelanto;

                $detalleReserva = $reserva->getOne();

                if ( $detalleReserva->cod_estado_reserva != 3){
                    $_SESSION['message'] = ['Error',"Solo se pueden eliminar las reservas en uso",'error'];
                    header("location: " . base_url . "Reserva/ListaReserva");
                    exit();
                }


                //fechas convertidas para eliminar T
                $fechaInicioConvertida = date('Y-m-d H:i:s', strtotime($fechaInicio));
                $fechaFinConvertida = date('Y-m-d H:i:s', strtotime($fechaFin));

                //varificamos que este la caja abierta
                if ( $caja->verificarApertura() ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"No se puede actualizar la reservacion porque no exite caja abierta",'error'];
                    header("location: " . base_url . "Reserva/Actualizar&cod_reserva=$codReserva");
                    exit();
                }

                //verificamos el a actualizar para saber si es el mismo o cambio
                if ($montoAdelantoOld != $montoAdelanto){

                    //buscamos la ultima caja y le rectamos el adelanto viejo
                    $montoSinCierre = $caja->allCajaOpen()->fetchObject()->monto_sin_cierre - $montoAdelantoOld;
                    $montoActualMasCierre = $caja->allCajaOpen()->fetchObject()->monto_actual_mas_cierre - $montoAdelantoOld;
                    $codCaja = $caja->allCajaOpen()->fetchObject()->cod_caja;

                    $caja->setMontoSinCierre($montoSinCierre);
                    $caja->setMontoActualMasCierre($montoActualMasCierre);
                    $caja->setCodCaja($codCaja);

                    //cargamos los de la resta para agregar el nuevo adelanto
                    $caja->addMonto();

                    //buscamos la ultima caja y le sumamos el adelanto nuevo
                    $montoSinCierre = $caja->allCajaOpen()->fetchObject()->monto_sin_cierre + $montoAdelanto;
                    $montoActualMasCierre = $caja->allCajaOpen()->fetchObject()->monto_actual_mas_cierre + $montoAdelanto;
                    $codCaja = $caja->allCajaOpen()->fetchObject()->cod_caja;

                    $caja->setMontoSinCierre($montoSinCierre);
                    $caja->setMontoActualMasCierre($montoActualMasCierre);
                    $caja->setCodCaja($codCaja);

                    //cargamos los de la suma para agregar el nuevo adelanto
                    $caja->addMonto();
                }

                //verificamos si las fechas cambiaron para comprobar disponivilidad de actualizacion
                if ($fechaInicioConvertida != $fechaInicioOld || $fechaFinConvertida != $fechaFinOld){

                    //buscamos reservas entre las fechas actualizadas
                    $searchReserva = $reserva->searchReserva();
                    if ( !$searchReserva ){
                        //1)Titulo 2)Mensaje 3)Tipo
                        $_SESSION['message'] = ['Error',"Ya existe una reserva para ese dia",'error'];
                        header("location: " . base_url . "Reserva/Actualizar&cod_reserva=$codReserva");
                        exit();
                    }
                }

                //Actualizamos la disponibilidad de la habitacion simpre y cuando esta en check in
                $reserva->getCodEstadoReserva() == 1 ? $habitacion->actualizarEstado() : '';

                //ejecutamos el metodo para actualizar
                $actualizar = $reserva->actualizar();

                if ( is_array( $actualizar ) ){
                    $_SESSION['message'] = ['Error',"Error al actualizar reserva - codigo: $actualizar[0] - $actualizar[2]",'error'];
                    header("location: " . base_url . "Reserva/Actualizar&cod_reserva=$codReserva");
                    exit();
                }

                //mensaje exito
                $_SESSION['message'] = ['Exito',"Exito al actualizar reserva",'success'];
                header("location: " . base_url . "Reserva/ListaReserva");
                exit();

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
                header("location: " . base_url . "Reserva/Actualizar&cod_reserva=" . utils::protege($_POST['cod_reserva']));
                exit();
            }

        } else {

            if ( utils::existGET(['cod_reserva']) ){


                //inicializamos objetos
                $reserva = new ReservaModel();
                $cliente = new ClienteModel();
                $habitacion = new HabitacionModel();
                $baseModel = new BaseModel();

                /* asignamos a una variable el monto enviado por el usuario
                 * adicional validamos y hacemos un saneamiento de los datos
                */

                $codReserva = utils::protege($_GET['cod_reserva']);
                $reserva->setCodReserva($codReserva);

                $detalleReserva = $reserva->getOne();

                if ( $detalleReserva->cod_estado_reserva != 3){
                    $_SESSION['message'] = ['Error',"Solo se pueden modificar las reservas en uso",'error'];
                    header("location: " . base_url . "Reserva/ListaReserva");
                    exit();
                }

                //objenemos los atos de la reserva y cliente
                $dataReserva = $reserva->getOne();
                $listaCliente = $cliente->allCliente();

                //objenemos la lista de estamos
                $listaEstadoReserva = $baseModel->getAll('estado_reserva');

                //buscamos la informacion de la habitacion
                $habitacion->setCodHabitacion($dataReserva->cod_habitacion);
                $habita = $habitacion->getOne()->fetchObject();

                if ($habita->cod_estado_habitacion != 2){
                    $_SESSION['message'] = ['Error',"Verifique el estado de la habitacion ya que se encuentra en uso o limpieza",'error'];
                    header("location: " . base_url . "Reserva/ListaReserva");
                    exit();
                }

                //invocamos la vista
                require_once 'views/dashboard/reserva/actualizarReserva.php';

            } else {

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
                header("location: " . base_url . "Reserva/ListaReserva");
                exit();
            }
        }
    }

    public function Eliminar(){
        utils::isSessionInit();
        if ( utils::existGET(['cod_reserva']) ){

            $codReserva = utils::protege($_GET['cod_reserva']);

            $reserva = new ReservaModel();
            $reserva->setCodReserva($codReserva);

            $detalle = $reserva->getOne();

            if ( $detalle->cod_estado_reserva != 3){
                $_SESSION['message'] = ['Error',"Solo se pueden eliminar las reservas en estado reservado",'error'];
                header("location: " . base_url . "Reserva/ListaReserva");
                exit();
            }

            $eliminar = $reserva->eliminar();

            if ( is_array( $eliminar ) ){
                $_SESSION['message'] = ['Error',"Error al actualizar reserva - codigo: $eliminar[0] - $eliminar[2]",'error'];
                header("location: " . base_url . "Reserva/ListaReserva");
                exit();
            }

            $_SESSION['message'] = ['Exito',"Exito al Eliminar reserva",'success'];
            header("location: " . base_url . "Reserva/ListaReserva");
            exit();

        } else {

            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
            header("location: " . base_url . "Reserva/ListaReserva");
            exit();
        }
    }

    public function FullCalendarAll(){
        utils::isSessionInit();
        //convetimos la aplicacion a respuestas json
        header('Content-Type: application/json');

        //inicializamos objetos
        $reserva = new ReservaModel();

        //buscamos todas las reservas
        $dataReserva = $reserva->getAll();

        //resorremos todas las reservas
        while ($data = $dataReserva->fetchObject()){

            //validamos el estado de la reseerva
            $color = $data->estado_reserva == 'Reservado' ? 'green' : 'red';
            $textColor = $data->estado_reserva == 'Reservado' ? 'white' : 'dark';

            //se crea un array con la informacion validada
            $json[] = [
                'id' => $data->cod_reserva,
                'title' => $data->nombre_cliente . " Habitacion: $data->nombre - $data->nivel_habitacion",
                'start' => $data->fecha_inicio,
                'end' => $data->fecha_fin,
                'color' => $color,
                'textColor' => $textColor,
            ];
        }

        //se muestra el array convertido a json para su procesamiento
        echo json_encode($json);
    }

}