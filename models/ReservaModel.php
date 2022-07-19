<?php

class ReservaModel{
    private $codReserva;
    private $codCliente;
    private $fechaInicio;
    private $fechaFin;
    private $adelanto;
    private $codHabitacion;
    private $codEstadoReserva;
    private $conexion;

    public function __construct(){
        $this->conexion = Database::connect();
    }

    /**
     * @return mixed
     */
    public function getCodReserva()
    {
        return $this->codReserva;
    }

    /**
     * @param mixed $codReserva
     */
    public function setCodReserva($codReserva): void
    {
        $this->codReserva = $codReserva;
    }

    /**
     * @return mixed
     */
    public function getCodCliente()
    {
        return $this->codCliente;
    }

    /**
     * @param mixed $codCliente
     */
    public function setCodCliente($codCliente): void
    {
        $this->codCliente = $codCliente;
    }

    /**
     * @return mixed
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * @param mixed $fechaInicio
     */
    public function setFechaInicio($fechaInicio): void
    {
        $this->fechaInicio = $fechaInicio;
    }

    /**
     * @return mixed
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * @param mixed $fechaFin
     */
    public function setFechaFin($fechaFin): void
    {
        $this->fechaFin = $fechaFin;
    }

    /**
     * @return mixed
     */
    public function getAdelanto()
    {
        return $this->adelanto;
    }

    /**
     * @param mixed $adelanto
     */
    public function setAdelanto($adelanto): void
    {
        $this->adelanto = $adelanto;
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
    public function getCodEstadoReserva()
    {
        return $this->codEstadoReserva;
    }

    /**
     * @param mixed $codEstadoReserva
     */
    public function setCodEstadoReserva($codEstadoReserva): void
    {
        $this->codEstadoReserva = $codEstadoReserva;
    }


    public function save(){
        $codCliente = $this->getCodCliente();
        $fechaInicio = $this->getFechaInicio();
        $fechaFin = $this->getFechaFin();
        $adelanto = $this->getAdelanto();
        $codHabitacion = $this->getCodHabitacion();
        $codEstadoReserva = $this->getCodEstadoReserva();

        $sql = "INSERT INTO reserva VALUES (NULL,'$codCliente','$fechaInicio','$fechaFin','$adelanto','$codHabitacion','$codEstadoReserva')";
        $save = $this->conexion->query($sql);

        return !$save ? $this->conexion->errorInfo() : True;

    }

    public function searchReserva(){
        //obtenemos valores seteados por el usuairo
        $codHabitacion = $this->getCodHabitacion();
        $fechaInicio = date('Y-m-d', strtotime($this->getFechaInicio())) . " 00:00:00";
        $fechaFin = date('Y-m-d', strtotime($this->getFechaFin())) . " 23:59:59";

        //validamos que no exista una fecha final
        $sql = "SELECT * FROM reserva WHERE cod_habitacion = '$codHabitacion' AND 
                            fecha_inicio BETWEEN '$fechaInicio' AND '$fechaFin' AND
                            fecha_fin BETWEEN '$fechaInicio' AND '$fechaFin'";

        //ejecutamos query y lo convertimos a numero
        $search = $this->conexion->query($sql)->rowCount();

        return $search >= 1 ? False : True;
    }

    public function getAll(){
        $sql = "SELECT * FROM vista_reserva";
        $all = $this->conexion->query($sql);

        return $all;
    }

    public function getOne(){
        $codReserva = $this->getCodReserva();

        $sql = "SELECT * FROM reserva WHERE cod_reserva = '$codReserva'";
        $one = $this->conexion->query($sql)->fetchObject();
        return $one;
    }

    public function actualizar(){
        $codReserva = $this->getCodReserva();
        $codCliente = $this->getCodCliente();
        $fechaInicio = $this->getFechaInicio();
        $fechaFin = $this->getFechaFin();
        $adelanto = $this->getAdelanto();
        $codEstadoReserva = $this->getCodEstadoReserva();

        $sql = "UPDATE reserva 
                    SET fecha_inicio = '$fechaInicio', fecha_fin = '$fechaFin', 
                    adelanto = '$adelanto',cod_estado_reserva = '$codEstadoReserva' 
                     WHERE cod_reserva = '$codReserva'";

        $actualizar = $this->conexion->query($sql);

        return !$actualizar ? $this->conexion->errorInfo() : True;
    }

    public function eliminar(){
        $codReserva = $this->getCodReserva();

        $sql = "DELETE FROM reserva WHERE cod_reserva = '$codReserva'";
        $eliminar = $this->conexion->query($sql);

        return !$eliminar ? $this->conexion->errorInfo() : True;
    }

    public function getAllReservaCheckIn(){
        $sql = "SELECT * FROM vista_reserva WHERE estado_reserva = 'Check In'";
        $all = $this->conexion->query($sql);

        return $all;
    }

    public function actualizarEstado(){
        $codReserva = (int)$this->getCodReserva();
        $codEstadoReserva = $this->getCodEstadoReserva();


        $sql = "UPDATE reserva SET cod_estado_reserva = '$codEstadoReserva' WHERE cod_reserva = '$codReserva'";
        $actualizar = $this->conexion->query($sql);

        return !$actualizar ? $this->conexion->errorInfo() : True;
    }

}