<?php

class EgresoModel{
    private $codEgreso;
    private $egreso;
    private $descripcion;
    private $fechaEgreso;
    private $monto;
    private $codCaja;
    private $conexion;

    public function __construct(){
        $this->conexion = Database::connect();
    }

    /**
     * @return mixed
     */
    public function getCodEgreso()
    {
        return $this->codEgreso;
    }

    /**
     * @param mixed $codEgreso
     */
    public function setCodEgreso($codEgreso): void
    {
        $this->codEgreso = $codEgreso;
    }

    /**
     * @return mixed
     */
    public function getEgreso()
    {
        return $this->egreso;
    }

    /**
     * @param mixed $egreso
     */
    public function setEgreso($egreso): void
    {
        $this->egreso = $egreso;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getFechaEgreso()
    {
        return $this->fechaEgreso;
    }

    /**
     * @param mixed $fechaEgreso
     */
    public function setFechaEgreso($fechaEgreso): void
    {
        $this->fechaEgreso = $fechaEgreso;
    }

    /**
     * @return mixed
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * @param mixed $monto
     */
    public function setMonto($monto): void
    {
        $this->monto = $monto;
    }

    /**
     * @return mixed
     */
    public function getCodCaja()
    {
        return $this->codCaja;
    }

    /**
     * @param mixed $codCaja
     */
    public function setCodCaja($codCaja): void
    {
        $this->codCaja = $codCaja;
    }

    public function getAll(){
        $sql = "SELECT * FROM egreso";
        $all = $this->conexion->query($sql);

        return $all;
    }

    public function save(){

        $egreso = $this->getEgreso();
        $fechaEgreso = $this->getFechaEgreso();
        $detalle = $this->getDescripcion();
        $monto = $this->getMonto();
        $codCaja = $this->getCodCaja();

        $sql = "INSERT INTO egreso VALUES(NULL,'$egreso','$detalle','$fechaEgreso','$monto','$codCaja')";
        $save = $this->conexion->query($sql);

        return !$save ? $this->conexion->errorInfo() : True;

    }
}