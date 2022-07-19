<?php

require_once 'models/BaseModel.php';
require_once 'models/HabitacionModel.php';

class ConfiguracionController{

    public function RegistrarHabitacion(){
        utils::isSessionInit();
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){

            if ( utils::existPOST(['nombre_habitacion','precio_habitacion','detalle_habitacion','tipo_habitacion','piso_habitacion']) ){

                $nombreHabitacion = utils::protege($_POST['nombre_habitacion']);
                $precioHabitacion = utils::protege($_POST['precio_habitacion']);
                $detalleHabitacion = utils::protege($_POST['detalle_habitacion']);
                $tipoHabitacion = utils::protege($_POST['tipo_habitacion']);
                $pisoHabitacion = utils::protege($_POST['piso_habitacion']);

                $habitacion = new HabitacionModel();

                $habitacion->setNombre($nombreHabitacion);
                $habitacion->setPrecio($precioHabitacion);
                $habitacion->setDetalle($detalleHabitacion);
                $habitacion->setCodTipoHabitacion($tipoHabitacion);
                $habitacion->setCodNivelHabitacion($pisoHabitacion);
                $habitacion->setCodEstadoHabitacion(2);

                if ( !$habitacion->searchHabitacion() ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Ya existe una habitacion con este nombre",'error'];
                    header("location: ". base_url . "Configuracion/RegistrarHabitacion");
                    exit();
                }

                $save = $habitacion->save();

                if ( is_array($save) ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al registrar habitacion - codigo: $save[0]",'error'];
                    header("location: ". base_url . "Configuracion/RegistrarHabitacion");
                    exit();
                }

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Exito al crear habitacion",'success'];
                header("location: ". base_url . "Configuracion/RegistrarHabitacion");

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
                header("location: ". base_url . "Configuracion/RegistrarHabitacion");
            }

        } else {

            $baseModel = new BaseModel();

            $listaTipoHabitacion = $baseModel->getAll('tipo_habitacion');
            $listaPisoHabitacion = $baseModel->getAll('nivel_habitacion');

            require_once 'views/configuracion/habitacion/registrarHabitacion.php';

        }
    }

    public function ListaHabitacion(){
        utils::isSessionInit();

        $habitacion = new HabitacionModel();
        $lista = $habitacion->allHabitacion();

        require_once 'views/configuracion/habitacion/listaHabitacion.php';
    }

    public function EliminarHabitacion(){

        utils::isSessionInit();
        if ( utils::existGET(['cod_habitacion']) ){

            $codHabitacion = utils::protege($_GET['cod_habitacion']);

            $habitacion = new HabitacionModel();
            $habitacion->setCodHabitacion($codHabitacion);

            $delete = $habitacion->delete();

            if ( is_array($delete) ){
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Error al eliminar habitacion - codigo: $delete[0]",'error'];
                header("location: ". base_url . "Configuracion/ListaHabitacion");
                exit();
            }

            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Exito',"Exito al eliminar habitacion",'success'];
            header("location: ". base_url . "Configuracion/ListaHabitacion");

        } else {
            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
            header("location: ". base_url . "Configuracion/ListaHabitacion");
        }

    }

    public function ActualizarHabitacion(){
        utils::isSessionInit();
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){

            if ( utils::existPOST(['detalle_habitacion','precio_habitacion','cod_habitacion']) ){

                $detalleHabitacion = utils::protege($_POST['detalle_habitacion']);
                $precioHabitacion = utils::protege($_POST['precio_habitacion']);
                $codHabitacion = utils::protege($_POST['cod_habitacion']);

                $habitacion = new HabitacionModel();

                $habitacion->setDetalle($detalleHabitacion);
                $habitacion->setPrecio($precioHabitacion);
                $habitacion->setCodHabitacion($codHabitacion);

                $actualizar = $habitacion->actualizar();

                if ( is_array($actualizar) ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al actualizar habitacion - codigo: $actualizar[0]",'error'];
                    header("location: ". base_url . "Configuracion/ActualizarHabitacion&cod_usuario=$codHabitacion");
                    exit();
                }

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Exito al actualizar habitacion",'success'];
                header("location: ". base_url . "Configuracion/ListaHabitacion");

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
                header("location: ". base_url . "Configuracion/ListaHabitacion");
            }

        } else {

            if ( utils::existGET(['cod_habitacion']) ){

                $codHabitacion = utils::protege($_GET['cod_habitacion']);

                $baseModel = new BaseModel();
                $habitacion = new HabitacionModel();

                $listaTipoHabitacion = $baseModel->getAll('tipo_habitacion');
                $listaPisoHabitacion = $baseModel->getAll('nivel_habitacion');

                $habitacion->setCodHabitacion($codHabitacion);

                $data = $habitacion->getOne()->fetchObject();

                require_once 'views/configuracion/habitacion/actualizarHabitacion.php';

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
                header("location: ". base_url . "Configuracion/ListaHabitacion");
            }

        }
    }

}