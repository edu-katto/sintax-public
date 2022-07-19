<?php

class CajaModel{
    private $codCaja;
    private $fechaInicio;
    private $fechaFin;
    private $montoApertura;
    private $montoSinCierre;
    private $montoActualMasCierre;
    private $conexion;

    public function __construct() {
        $this->conexion = Database::connect();
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
    public function getMontoApertura()
    {
        return $this->montoApertura;
    }

    /**
     * @param mixed $montoApertura
     */
    public function setMontoApertura($montoApertura): void
    {
        $this->montoApertura = $montoApertura;
    }

    /**
     * @return mixed
     */
    public function getMontoSinCierre()
    {
        return $this->montoSinCierre;
    }

    /**
     * @param mixed $montoSinCierre
     */
    public function setMontoSinCierre($montoSinCierre): void
    {
        $this->montoSinCierre = $montoSinCierre;
    }

    /**
     * @return mixed
     */
    public function getMontoActualMasCierre()
    {
        return $this->montoActualMasCierre;
    }

    /**
     * @param mixed $montoActualMasCierre
     */
    public function setMontoActualMasCierre($montoActualMasCierre): void
    {
        $this->montoActualMasCierre = $montoActualMasCierre;
    }

    public function save(){
        //obtenemos valores seteados por el usuairo
        $montoApertura = $this->getMontoApertura();
        $montoActualMasCierre = $this->getMontoApertura();

        //preparamos quey para insertar los datos
        $sql = "INSERT INTO caja VALUES(NULL,CURRENT_TIMESTAMP,NULL,'$montoApertura',NULL,'$montoActualMasCierre')";

        //ejecutamos el query en la base de datos
        $save = $this->conexion->query($sql);

        //respues query
        return !$save ? $this->conexion->errorInfo() : True;
    }

    public function verificarApertura(){

        //preparamos el quey varificadon que exita por lo mejos un registro con la fecha fin null
        $sql = "SELECT * FROM caja WHERE fecha_fin IS NULL";

        //ejecutamos la query y el resultado lo convertimos a numero
        $verificar = $this->conexion->query($sql)->rowCount();

        //respuesta query
        return $verificar >= 1 ? False : True;
    }

    public function allCajaOpen(){
        //preparamos query para traes todas las cajas que esten abiertas
        $sql = "SELECT * FROM caja WHERE fecha_fin IS NULL";

        //ejecutamos query
        $all = $this->conexion->query($sql);

        //respuesta query
        return $all;
    }

    public function allCaja(){
        //preparas query todas las cajas
        $sql = "SELECT * FROM caja ORDER BY cod_caja DESC";

        //ejecutamos query
        $all = $this->conexion->query($sql);

        //respuesta query
        return $all;
    }

    public function addMonto(){
        //obtenemos valores seteados por el usuairo
        $codCaja = $this->getCodCaja();
        $montoSinCierre = $this->getMontoSinCierre();
        $montoActualMasCierre = $this->getMontoActualMasCierre();

        //Preparamos query para actualizar el monto total sin cierre de la caja
        $sql = "UPDATE caja SET monto_sin_cierre = '$montoSinCierre', monto_actual_mas_cierre = '$montoActualMasCierre' WHERE cod_caja = '$codCaja'";

        //ejecutamos query
        $add = $this->conexion->query($sql);

        //respuesta query
        return !$add ? $this->conexion->errorInfo() : True;

    }

    public function cierreCaja(){
        //obtenemos valores seteados por el usuairo
        $montoSinCierre = $this->getMontoSinCierre();
        $codCaja = $this->getCodCaja();

        //preparamos query
        $sql = "UPDATE caja SET fecha_fin = CURRENT_TIMESTAMP, monto_sin_cierre = '$montoSinCierre' WHERE cod_caja = '$codCaja'";

        //ejecutamos query
        $cierre = $this->conexion->query($sql);

        //respues quey
        return !$cierre ? $this->conexion->errorInfo() : True;
    }

}