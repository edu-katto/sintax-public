<?php

require_once 'models/BaseModel.php';
require_once 'models/ClienteModel.php';

class ClienteController{

    public function RegistrarCliente(){
        utils::isSessionInit();
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){

            if ( utils::existPOST(['nombre', 'tipoDocumento', 'documento', 'telefono', 'direccion','tipoCliente']) ){

                $nombre = utils::protege($_POST['nombre']);
                $tipoDocumento = utils::protege($_POST['tipoDocumento']);
                $documento = utils::protege($_POST['documento']);
                $telefono = utils::protege($_POST['telefono']);
                $direccion = utils::protege($_POST['direccion']);
                $tipoCliente = utils::protege($_POST['tipoCliente']);

                $cliente = new ClienteModel();

                $cliente->setNombre($nombre);
                $cliente->setCodTipoDocumento($tipoDocumento);
                $cliente->setDocumento($documento);
                $cliente->setTelefono($telefono);
                $cliente->setDireccion($direccion);
                $cliente->setCodTipoCliente($tipoCliente);

                if ( !$cliente->searchDocument() ) {
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error','Ya exite un cliente con este documento','error'];
                    header("location: ". base_url . "Cliente/RegistrarCliente");
                    exit();
                }

                if ( !$cliente->searchTelefono() ) {
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error','Ya existe un cliente con este numero de telefono','error'];
                    header("location: ". base_url . "Cliente/RegistrarCliente");
                    exit();
                }

                $save = $cliente->save();

                if ( is_array( $save ) ) {
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al registrar cliente - codigo: $save[0]",'error'];
                    header("location: ". base_url . "Cliente/RegistrarCliente");
                    exit();
                }

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Cliente registrado con exito",'success'];
                header("location: ". base_url . "Cliente/RegistrarCliente");

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los campos son obligatorios",'error'];
                header("location: ". base_url . "Cliente/RegistrarCliente");
            }

        } else {

            $baseModel = new BaseModel();
            $listDocumento = $baseModel->getAll('tipo_documento');
            $listaTipoCliente = $baseModel->getAll('tipo_cliente');

            require_once 'views/user/cliente/registrarCliente.php';
        }

    }

    public function ListaClientes(){
        utils::isSessionInit();
        $cliente = new ClienteModel();

        $lista = $cliente->allCliente();
        require_once 'views/user/cliente/listaCliente.php';
    }

    public function Eliminar(){
        utils::isSessionInit();
        if ( utils::existGET(['cod_cliente']) ){

            $codCliente = utils::protege($_GET['cod_cliente']);

            $cliente = new ClienteModel();
            $cliente->setCodCliente($codCliente);

            $delete = $cliente->delete();

            if ( !$delete ){

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Error al eliminar cliente - codigo: $delete[0]",'error'];
                header("location: ". base_url . "Cliente/ListaClientes");
                exit();
            }

            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Exito',"Cliente registrado con exito",'success'];
            header("location: ". base_url . "Cliente/ListaClientes");

        } else {

            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Error',"Todos los campos son obligatorios",'error'];
            header("location: ". base_url . "Cliente/ListaClientes");
        }
    }

    public function Actualizar(){
        utils::isSessionInit();
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){

            if ( utils::existPOST(['nombre', 'tipoDocumento', 'documento', 'telefono', 'direccion','cod_cliente', 'tipoCliente']) ){

                $nombre = utils::protege($_POST['nombre']);
                $tipoDocumento = utils::protege($_POST['tipoDocumento']);
                $documento = utils::protege($_POST['documento']);
                $telefono = utils::protege($_POST['telefono']);
                $direccion = utils::protege($_POST['direccion']);
                $codCliente = utils::protege($_POST['cod_cliente']);
                $tipoCliente = utils::protege($_POST['tipoCliente']);

                $cliente = new ClienteModel();

                $cliente->setNombre($nombre);
                $cliente->setCodTipoDocumento($tipoDocumento);
                $cliente->setDocumento($documento);
                $cliente->setTelefono($telefono);
                $cliente->setDireccion($direccion);
                $cliente->setCodTipoCliente($tipoCliente);

                $actualizar = $cliente->actualizar();

                if ( is_array( $actualizar ) ) {
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al actualizar - codigo: $actualizar[0]",'error'];
                    header("location: ". base_url . "Cliente/Actualizar&cod_cliente=$codCliente");
                    exit();
                }

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Cliente actualizado con exito",'success'];
                header("location: ". base_url . "Cliente/ListaClientes");

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los campos son obligatorios",'error'];
                header("location: ". base_url . "Cliente/ListaClientes");
            }

        } else {

            if ( utils::existGET(['cod_cliente']) ){

                $codCliente = utils::protege($_GET['cod_cliente']);

                $baseModel = new BaseModel();
                $cliente = new ClienteModel();

                $listaTipoCliente = $baseModel->getAll('tipo_cliente');
                $listDocumento = $baseModel->getAll('tipo_documento');

                $cliente->setCodCliente($codCliente);

                $data = $cliente->oneCliente()->fetchObject();

                require_once 'views/user/cliente/actualizarRegistro.php';

            } else {

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los campos son obligatorios",'error'];
                header("location: ". base_url . "Cliente/ListaClientes");
            }
        }
    }

}