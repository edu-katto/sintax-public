<?php

require_once 'models/UsuarioModel.php';

class UserController{
    public function Login(){
        utils::isLoggedin();
        require_once 'views/user/login.php';
    }

    public function CheckLogin(){
        utils::isLoggedin();
        if (utils::existPOST(['usuario','password'])){

            $user = new UsuarioModel();

            $usuario = utils::protege($_POST['usuario']);
            $password = utils::protege($_POST['password']);

            $user->setUsuario($usuario);
            $user->setPassword($password);

            $userData = $user->login();

            if ( $userData ){

                $_SESSION['loggedin'] = true;
                $_SESSION['codUsuario'] = $userData->cod_usuario;
                $_SESSION['usuario'] = $userData->usuario;
                $_SESSION['nombre'] = $userData->nombre;

                header("Location:" . base_url . 'DashBoard/Panel');

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error','Usuario o clave incorrecta','error'];
                header("location: ". base_url . "User/Login");
            }

        } else {
            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Error','Todos los campos son obligatorios','error'];
            header("location: ". base_url . "User/Login");
        }
    }

    public function RegistrarUsuario(){
        utils::isSessionInit();
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){

            if (utils::existPOST(['nombre','usuario','password'])){

                $nombre = utils::protege($_POST['nombre']);
                $usuario = utils::protege($_POST['usuario']);
                $password = utils::protege($_POST['password']);
                $hast = password_hash($password, PASSWORD_BCRYPT);

                $user = new UsuarioModel();

                $user->setNombre($nombre);
                $user->setUsuario($usuario);
                $user->setPassword($hast);

                if ( !$user->searchUser() ){
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error','Ya existe un usuario creado con este nombre','error'];
                    header("location: ". base_url . "User/RegistrarUsuario");
                    exit();

                }

                $save = $user->save();

                if ( is_array( $save ) ) {
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al registrar usuario - codigo: $save[0]",'error'];
                    header("location: ". base_url . "User/RegistrarUsuario");
                    exit();
                }

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Usuario registrado",'success'];
                header("location: ". base_url . "User/RegistrarUsuario");

            }else{

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los campos son obligatorios",'error'];
                header("location: ". base_url . "User/RegistrarUsuario");

            }

        } else {

            require_once 'views/user/registrarUsuario.php';

        }

    }

    public function ListaUsuarios(){
        utils::isSessionInit();

        $user = new UsuarioModel();
        $lista = $user->allUsuario();

        require_once 'views/user/listaUsuario.php';

    }

    public function Eliminar(){
        utils::isSessionInit();

        if (utils::existGET(['cod_usuario'])){

            $codUsuario = utils::protege($_GET['cod_usuario']);
            $user = new UsuarioModel();

            $user->setCodUsuario($codUsuario);
            $delete = $user->delete();

            if ( is_array( $delete ) ) {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Error al eliminar usuario - codigo: $delete[0]",'error'];
                header("location: ". base_url . "User/ListaUsuarios");
                exit();
            }

            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Exito',"Exito al eliminar usuario",'success'];
            header("location: ". base_url . "User/ListaUsuarios");

        } else {

            //1)Titulo 2)Mensaje 3)Tipo
            $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
            header("location: ". base_url . "User/ListaUsuarios");

        }
    }

    public function Actualizar(){
        utils::isSessionInit();
        $tipoPeticion = $_SERVER['REQUEST_METHOD'];

        if ( $tipoPeticion == 'POST' ){

            if (utils::existPOST(['nombre', 'cod_usuario'])){
                $nombre = utils::protege($_POST['nombre']);
                $codUsuario = utils::protege($_POST['cod_usuario']);
                $password = utils::protege($_POST['password'] != NULL ? $_POST['password'] : NULL);
                $hash = password_hash($password, PASSWORD_BCRYPT);

                $user = new UsuarioModel();

                $user->setNombre($nombre);
                $user->setCodUsuario($codUsuario);

                if ($password != NULL){
                    $user->setPassword($hash);
                } else {
                    $user->setPassword($password);
                }

                $actualizar = $user->actualizar();

                if ( is_array( $actualizar ) ) {
                    //1)Titulo 2)Mensaje 3)Tipo
                    $_SESSION['message'] = ['Error',"Error al actualizar usuario - codigo: $actualizar[0]",'error'];
                    header("location: ". base_url . "User/Actualizar&cod_usuario=$codUsuario");
                    exit();
                }

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Exito',"Exito al Actualizar usuario",'success'];
                header("location: ". base_url . "User/ListaUsuarios");

            } else {
                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
                header("location: ". base_url . "User/ListaUsuarios");
            }

        } else {

            if ( utils::existGET(['cod_usuario']) ){

                $codUsuario = utils::protege($_GET['cod_usuario']);
                $user = new UsuarioModel();

                $user->setCodUsuario($codUsuario);

                $data = $user->oneUsuario()->fetchObject();

                require_once 'views/user/actualizarUsuario.php';

            } else {

                //1)Titulo 2)Mensaje 3)Tipo
                $_SESSION['message'] = ['Error',"Todos los datos son obligatorios",'error'];
                header("location: ". base_url . "User/ListaUsuarios");
            }
        }
    }

    public function Logout(){
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header("location: ". base_url);
    }
}