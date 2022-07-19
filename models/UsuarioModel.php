<?php

class UsuarioModel{

    private $codUsuario;
    private $usuario;
    private $nombre;
    private $password;
    private $conexion;

    public function __construct() {
        $this->conexion = Database::connect();
    }

    /**
     * @return mixed
     */
    public function getCodUsuario()
    {
        return $this->codUsuario;
    }

    /**
     * @param mixed $codUsuario
     */
    public function setCodUsuario($codUsuario)
    {
        $this->codUsuario = $codUsuario;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function save(){
        $usuario = $this->getUsuario();
        $nombre = $this->getNombre();
        $password = $this->getPassword();

        $sql = "INSERT INTO usuario VALUES (NULL, '$usuario', '$nombre', '$password')";
        $save = $this->conexion->query($sql);

        return !$save ? $this->conexion->errorInfo() : True;
    }

    public function actualizar(){
        $usuario = $this->getUsuario();
        $nombre = $this->getNombre();
        $codUsuario = $this->getCodUsuario();
        $password = $this->getPassword();

        //verificamos si se mando una nueva clave
        if ($password != NULL){
            $sql = "UPDATE usuario SET  nombre = '$nombre', password = '$password' WHERE cod_usuario = '$codUsuario'";
        } else {
            $sql = "UPDATE usuario SET nombre = '$nombre' WHERE cod_usuario = '$codUsuario'";
        }

        //ejecutamos query
        $save = $this->conexion->query($sql);

        //respuesta query
        return !$save ? $this->conexion->errorInfo() : True;
    }

    public function oneUsuario(){
        $codUsuario = $this->getCodUsuario();

        $sql = "SELECT * FROM usuario WHERE cod_usuario = '$codUsuario'";
        $one = $this->conexion->query($sql);

        return $one;
    }

    public function allUsuario(){
        $sql = "SELECT * FROM usuario";
        $all = $this->conexion->query($sql);

        return $all;
    }

    public function delete(){

        $codUsuario = $this->getCodUsuario();

        $sql = "DELETE FROM usuario WHERE cod_usuario = '$codUsuario'";
        $delete = $this->conexion->query($sql);

        return !$delete ? $this->conexion->errorInfo() : True;
    }

    public function searchUser(){
        $usuario = $this->getUsuario();

        $sql = "SELECT usuario FROM usuario WHERE usuario = '$usuario'";
        $search = $this->conexion->query($sql)->rowCount();

        return $search >= 1 ? False : True;
    }

    public function login(){
        $result = false;

        //obtenemos los tados seteamos por el usuairo
        $user = $this->getUsuario();
        $password = $this->getPassword();

        //preparamos query para verificar usuario
        $sql = "SELECT * FROM usuario WHERE usuario = '$user'";

        //ejecutamos query
        $login = $this->conexion->query($sql);

        //comprobamos que exista un registro con este usuario
        if ($login->rowCount() == 1){

            //obtenemos los datos del usuario
            $usuario = $login->fetchObject();

            //verifico la contraseña
            $verify = password_verify($password, $usuario->password);

            //si es correcto retornamos la informacion del usuario
            if ($verify){
                $result = $usuario;
            }
        }

        return $result;
    }

}