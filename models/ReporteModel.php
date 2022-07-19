<?php

class ReporteModel{
    private $fechaInicio;
    private $fechaFin;
    private $conexion;

    public function __construct(){
        $this->conexion = Database::connect();
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

    public function reporteTres(){
        $fechaInicio = date('Y-m-d', strtotime($this->getFechaInicio())) . " 00:00:00";
        $fechaFin = date('Y-m-d', strtotime($this->getFechaFin())) . " 23:59:59";

        $sql = "SELECT r.nombre_cliente,COUNT(r.documento) AS 'CantidadUsuario' FROM vista_reserva r
                    WHERE fecha_inicio >= '$fechaInicio' AND fecha_fin <= '$fechaFin' 
                    GROUP BY r.documento ORDER BY CantidadUsuario DESC LIMIT 5";

        $reporte = $this->conexion->query($sql);

        return $reporte;
    }

    public function reporteCuatro(){
        $fechaInicio = date('Y-m-d', strtotime($this->getFechaInicio())) . " 00:00:00";
        $fechaFin = date('Y-m-d', strtotime($this->getFechaFin())) . " 23:59:59";

        $sql = "SELECT SUM(r.adelanto) AS 'Ganancia' FROM vista_reserva r
                    WHERE fecha_inicio >= '$fechaInicio' AND fecha_fin <= '$fechaFin'";

        $reporte = $this->conexion->query($sql);

        return $reporte;
    }

    public function reporteCinco(){
        $fechaInicio = date('Y-m-d', strtotime($this->getFechaInicio())) . " 00:00:00";
        $fechaFin = date('Y-m-d', strtotime($this->getFechaFin())) . " 23:59:59";

        $sql = "SELECT r.nombre_cliente, TIMESTAMPDIFF(DAY, r.fecha_inicio, r.fecha_fin) AS 'Diferencia' FROM vista_reserva r
                    WHERE fecha_inicio >= '$fechaInicio' AND fecha_fin <= '$fechaFin' 
                    GROUP BY r.nombre_cliente ORDER BY Diferencia DESC LIMIT 5";

        $reporte = $this->conexion->query($sql);

        return $reporte;
    }

}