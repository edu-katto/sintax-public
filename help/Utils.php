<?php
class utils{

    public static function verificarToken($token){
        # La API en donde verificamos el token
        $url = "https://www.google.com/recaptcha/api/siteverify";
        # Los datos que enviamos a Google
        $datos = [
            "secret" => CLAVE_SECRETA,
            "response" => $token,
        ];
        // Crear opciones de la petición HTTP
        $opciones = array(
            "http" => array(
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($datos), # Agregar el contenido definido antes
            ),
        );
        # Preparar petición
        $contexto = stream_context_create($opciones);
        # Hacerla
        $resultado = file_get_contents($url, false, $contexto);
        # Si hay problemas con la petición (por ejemplo, que no hay internet o algo así)
        # entonces se regresa false. Este NO es un problema con el captcha, sino con la conexión
        # al servidor de Google
        if ($resultado === false) {
            # Error haciendo petición
            return false;
        }

        # En caso de que no haya regresado false, decodificamos con JSON

        $resultado = json_decode($resultado);
        # La variable que nos interesa para saber si el usuario pasó o no la prueba
        # está en success
        $pruebaPasada = $resultado->success;
        # Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
        return $pruebaPasada;
    }

    public static function acento($texto){
        //Minuscula
        $texto = str_replace("&aacute;", "á", $texto);
        $texto = str_replace("&eacute;", "é", $texto);
        $texto = str_replace("&iacute;", "í", $texto);
        $texto = str_replace("&oacute;", "ó", $texto);
        $texto = str_replace("&uacute;", "ú", $texto);
        $texto = str_replace("&ntilde;", "ñ", $texto);
        //Mayuscula
        $texto = str_replace("&Aacute;", "Á", $texto);
        $texto = str_replace("&Eacute;", "É", $texto);
        $texto = str_replace("&Iacute;", "Í", $texto);
        $texto = str_replace("&Oacute;", "Ó", $texto);
        $texto = str_replace("&Uacute;", "Ú", $texto);
        $texto = str_replace("&Ntilde;", "Ñ", $texto);
        //caracter especial
        $texto = htmlspecialchars_decode($texto, ENT_NOQUOTES);
        $texto = str_replace("&nbsp;", "", $texto);
        $texto = str_replace("&quot;", "", $texto);
        return $texto;
    }

    public static function protege($texto){
        $texto = str_replace("'", "\'", $texto);
        $texto = htmlspecialchars ($texto);
        $texto = htmlentities ($texto);
        $texto = trim ($texto);
        $texto = stripslashes($texto);
        return $texto;
    }

    public static function isLoggedin(){
        if (isset($_SESSION['loggedin'])){
            header("location: ". base_url . "DashBoard/Panel");
            exit();
        }else{
            return true;
        }
    }

    public static function isSessionInit(){
        if (!isset($_SESSION['loggedin'])){
            header("location: ". base_url);
            exit();
        }else{
            return true;
        }
    }


    public static function existPOST($params){
        foreach ($params as $param) {
            if(empty($_POST[$param])){
                return false;
            }
        }
        return true;
    }

    public static function existGET($params){
        foreach ($params as $param) {
            if(!isset($_GET[$param])){
                return false;
            }
        }
        return true;
    }

}