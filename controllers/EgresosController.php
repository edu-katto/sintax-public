<?php

require_once 'models/EgresoModel.php';
require_once 'models/CajaModel.php';

class EgresosController{

    public function Registrar(){
        utils::isSessionInit();
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){

            if ( utils::existPOST(['egreso','fecha_egreso','detalle','monto']) ){

                $nombre = utils::protege($_POST['egreso']);
                $fechaEgreso = utils::protege($_POST['fecha_egreso']);
                $detalle = utils::protege($_POST['detalle']);
                $monto = utils::protege($_POST['monto']);

                $egreso = new EgresoModel();
                $caja = new CajaModel();

                $codCaja = $caja->allCajaOpen()->fetchObject()->cod_caja;

                $egreso->setEgreso($nombre);
                $egreso->setFechaEgreso($fechaEgreso);
                $egreso->setDescripcion($detalle);
                $egreso->setMonto($monto);
                $egreso->setCodCaja($codCaja);

                $save = $egreso->save();

                if ( is_array( $save ) ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al registrar egreso - $save[0] - $save[20]",'error'];
                    header("location: " . base_url . "Egresos/Registrar");
                    exit();
                }

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Exito al registrar egreso",'success'];
                header("location: " . base_url . "Egresos/Registrar");
                exit();

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
                header("location: " . base_url . "Egresos/Registrar");
                exit();
            }

        } else {

            $egreso = new EgresoModel();
            $listaEgreso = $egreso->getAll();
            require_once 'views/egresos/egresos.php';
        }
    }

}