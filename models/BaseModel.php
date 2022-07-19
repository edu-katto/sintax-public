<?php
class BaseModel{
    public $conexion;

    public function __construct() {
        $this->conexion = Database::connect();
    }

    public function getAll($tabla){
        $sql = $this->conexion->query("SELECT * FROM $tabla");
        return $sql;
    }

}
