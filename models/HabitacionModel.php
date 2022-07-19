<?php

class HabitacionModel{

    private $codHabitacion;
    private $nombre;
    private $precio;
    private $detalle;
    private $codTipoHabitacion;
    private $codNivelHabitacion;
    private $codEstadoHabitacion;
    private $conexion;

    public function __construct(){
        $this->conexion = Database::connect();
    }

    /**
     * @return mixed
     */
    public function getCodHabitacion()
    {
        return $this->codHabitacion;
    }

    /**
     * @param mixed $codHabitacion
     */
    public function setCodHabitacion($codHabitacion): void
    {
        $this->codHabitacion = $codHabitacion;
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
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * @param mixed $detalle
     */
    public function setDetalle($detalle): void
    {
        $this->detalle = $detalle;
    }

    /**
     * @return mixed
     */
    public function getCodTipoHabitacion()
    {
        return $this->codTipoHabitacion;
    }

    /**
     * @param mixed $codTipoHabitacion
     */
    public function setCodTipoHabitacion($codTipoHabitacion): void
    {
        $this->codTipoHabitacion = $codTipoHabitacion;
    }

    /**
     * @return mixed
     */
    public function getCodNivelHabitacion()
    {
        return $this->codNivelHabitacion;
    }

    /**
     * @param mixed $codNivelHabitacion
     */
    public function setCodNivelHabitacion($codNivelHabitacion): void
    {
        $this->codNivelHabitacion = $codNivelHabitacion;
    }

    /**
     * @return mixed
     */
    public function getCodEstadoHabitacion()
    {
        return $this->codEstadoHabitacion;
    }

    /**
     * @param mixed $codEstadoHabitacion
     */
    public function setCodEstadoHabitacion($codEstadoHabitacion): void
    {
        $this->codEstadoHabitacion = $codEstadoHabitacion;
    }

    public function save(){

        $nombre = $this->getNombre();
        $precio = $this->getPrecio();
        $detalle = $this->getDetalle();
        $codTipoHabitacion = $this->getCodTipoHabitacion();
        $codNivelHabitacion = $this->getCodNivelHabitacion();
        $codEstadoHabitacion = $this->getCodEstadoHabitacion();

        $sql = "INSERT INTO habitacion VALUES(NULL,'$nombre','$precio','$detalle','$codTipoHabitacion','$codNivelHabitacion','$codEstadoHabitacion')";
        $save = $this->conexion->query($sql);

        return !$save ? $this->conexion->errorInfo() : True;

    }

    public function searchHabitacion(){

        $nombre = $this->getNombre();

        $sql = "SELECT * FROM habitacion WHERE nombre = '$nombre'";
        $save = $this->conexion->query($sql)->rowCount();

        return $save >= 1 ? False : True;
    }

    public function allHabitacion(){

        $sql = "SELECT * FROM vista_habitacion";
        $all = $this->conexion->query($sql);

        return $all;
    }

    public function delete(){

        $codHabitacion = $this->getCodHabitacion();
        $sql = "DELETE FROM habitacion WHERE cod_habitacion = '$codHabitacion'";
        $delete = $this->conexion->query($sql);

        return !$delete ? $this->conexion->errorInfo() : True;
    }

    public function getOne(){
        $codHabitacion = $this->getCodHabitacion();

        $sql = "SELECT * FROM habitacion WHERE cod_habitacion = '$codHabitacion'";
        $getOne = $this->conexion->query($sql);

        return $getOne;

    }

    public function actualizar(){
        $codHabitacion = $this->getCodHabitacion();
        $precio = $this->getPrecio();
        $detalle = $this->getDetalle();

        $sql = "UPDATE habitacion SET precio = '$precio', detalle = '$detalle' WHERE cod_habitacion = '$codHabitacion'";
        $actualizar = $this->conexion->query($sql);

        return !$actualizar ? $this->conexion->errorInfo() : True;
    }

    public function actualizarEstado(){
        $codHabitacion = $this->getCodHabitacion();
        $codEstado = $this->getCodEstadoHabitacion();

        $sql = "UPDATE habitacion SET cod_estado_habitacion = '$codEstado' WHERE cod_habitacion = '$codHabitacion'";
        $actualizar = $this->conexion->query($sql);

        return !$actualizar ? $this->conexion->errorInfo() : True;
    }

}