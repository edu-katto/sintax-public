<?php

//llamado de modelos para las operaciones en base de datos
require_once 'models/CajaModel.php';

class CajaController{
    //nos permite abrir una caja para el flujo de caja
    public function AperturaCaja(){
        //valida que el usuairo este autenticado
        utils::isSessionInit();
        //validar peticion y encaminar respesta
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){
            //validar la informacion del formulario
            if (utils::existPOST(['monto_apertura'])){

                /* asignamos a una variable el monto enviado por el usuario
                * adicional validamos y hacemos un saneamiento de los datos
                */
                $montoApertura = utils::protege($_POST['monto_apertura']);

                //inicializamos un objeto con las propiedades de caja
                $caja = new CajaModel();

                //enviamos el monto a nuentro objeto
                $caja->setMontoApertura($montoApertura);

                //verificamos que no exita una caja abierta
                if ( !$caja->verificarApertura() ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Ya exite una caja abierta",'error'];
                    header("location: ". base_url . "Caja/AperturaCaja");
                    exit();
                }

                //Procedemos a guardar los datos de la nueva caja
                $save = $caja->save();

                //comprovamos que la informacion se guardo con exito en la base de datos
                if ( is_array( $save ) ) {
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al aperturar caja - codigo: $save[0]",'error'];
                    header("location: ". base_url . "Caja/AperturaCaja");
                    exit();
                }

                //Mensaje exito guardado
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Exito al crear caja",'success'];
                header("location: ". base_url . "Caja/AperturaCaja");

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los campos son obligatorios",'error'];
                header("location: ". base_url . "Caja/AperturaCaja");
            }

        } else {

            //establecemos metodo para busqueda de caja abierta
            $caja = new CajaModel();

            //obtenemos la ultima caja abirta
            $listaCaja = $caja->allCajaOpen();

            //invocamos la vista para que el usuario pueda ver el formulario y la ultima caja abierta
            require_once 'views/caja/apertura.php';
        }
    }

    public function CierreCaja(){
        //valida que el usuairo este autenticado
        utils::isSessionInit();

        //validar peticion y encaminar respesta
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){
            //validar la informacion del formulario
            if ( utils::existPOST(['cod_caja','monto_sin_cierre']) ){

                /* asignamos a una variable el monto enviado por el usuario
                * adicional validamos y hacemos un saneamiento de los datos
                */
                $codCaja = utils::protege($_POST['cod_caja']);
                $montoSinCerrar = utils::protege($_POST['monto_sin_cierre']);

                //inicializamos un objeto con las propiedades de caja
                $caja = new CajaModel();

                //enviamos los datos recolectados al objeto
                $caja->setCodCaja($codCaja);
                $caja->setMontoSinCierre($montoSinCerrar);

                //varificamos que exita una caja abierta
                $verificar = $caja->verificarApertura();

                if ( $verificar ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"No exite caja abierta por cerrar",'error'];
                    header("location: ". base_url . "Caja/CierreCaja");
                    exit();
                }

                //mandamos la accion de cerrar la caja
                $cierre = $caja->cierreCaja();

                if ( is_array( $cierre ) ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al cerrar caja - codigo: $cierre[0]",'error'];
                    header("location: ". base_url . "Caja/CierreCaja");
                    exit();
                }

                //mensaje de exito
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Exito al cerrar caja",'success'];
                header("location: ". base_url . "Caja/CierreCaja");

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los campos son obligatorios",'error'];
                header("location: ". base_url . "Caja/CierreCaja");
            }

        } else {

            //inicializamos objeto
            $caja = new CajaModel();

            //creamos ariables para asignar registros
            $listaCaja = $caja->allCaja();
            $cajaAbierta = $caja->allCajaOpen()->fetchObject();

            //invocamos Vita
            require_once 'views/caja/cierre.php';

        }
    }
}