<?php

class ClienteModel{
    private $codCliente;
    private $codTipoDocumento;
    private $documento;
    private $telefono;
    private $nombre;
    private $direccion;
    private $codTipoCliente;
    private $conexion;

    public function __construct() {
        $this->conexion = Database::connect();
    }

    /**
     * @return mixed
     */
    public function getCodTipoCliente()
    {
        return $this->codTipoCliente;
    }

    /**
     * @param mixed $codTipoCliente
     */
    public function setCodTipoCliente($codTipoCliente): void
    {
        $this->codTipoCliente = $codTipoCliente;
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
    public function setCodCliente($codCliente)
    {
        $this->codCliente = $codCliente;
    }

    /**
     * @return mixed
     */
    public function getCodTipoDocumento()
    {
        return $this->codTipoDocumento;
    }

    /**
     * @param mixed $codTipoDocumento
     */
    public function setCodTipoDocumento($codTipoDocumento)
    {
        $this->codTipoDocumento = $codTipoDocumento;
    }

    /**
     * @return mixed
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * @param mixed $documento
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
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
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function save(){

        $nombre = $this->getNombre();
        $tipoDocumento = $this->getCodTipoDocumento();
        $documento = $this->getDocumento();
        $telefono = $this->getTelefono();
        $direccion = $this->getDireccion();
        $tipoCliente = $this->getCodTipoCliente();

        $sql = "INSERT INTO cliente VALUES (NULL, '$tipoDocumento', '$documento', '$telefono', '$nombre', '$direccion', '$tipoCliente')";
        $save = $this->conexion->query($sql);

        return !$save ? $this->conexion->errorInfo() : True;

    }

    public function actualizar(){

        $nombre = $this->getNombre();
        $tipoDocumento = $this->getCodTipoDocumento();
        $documento = $this->getDocumento();
        $telefono = $this->getTelefono();
        $direccion = $this->getDireccion();
        $tipoCliente = $this->getCodTipoCliente();

        $sql = "UPDATE cliente SET cod_tipo_documento = '$tipoDocumento', telefono = '$telefono', nombre = '$nombre', direccion = '$direccion', cod_tipo_cliente = '$tipoCliente' WHERE documento = '$documento'";
        $actualizar = $this->conexion->query($sql);

        return !$actualizar ? $this->conexion->errorInfo() : True;

    }

    public function searchDocument(){
        $documento = $this->getDocumento();

        $sql = "SELECT documento FROM cliente WHERE documento = '$documento'";
        $search = $this->conexion->query($sql)->rowCount();

        return $search >= 1 ? False : True;
    }

    public function searchTelefono(){
        $telefono = $this->getTelefono();

        $sql = "SELECT telefono FROM cliente WHERE telefono = '$telefono'";
        $search = $this->conexion->query($sql)->rowCount();

        return $search >= 1 ? False : True;
    }

    public function oneCliente(){
        $codCliente = $this->getcodCliente();

        $sql = "SELECT * FROM cliente WHERE cod_cliente = '$codCliente'";
        $one = $this->conexion->query($sql);

        return $one;
    }

    public function allCliente(){
        $sql = "SELECT * FROM vista_cliente";
        $all = $this->conexion->query($sql);

        return $all;
    }

    public function delete(){

        $codCliente = $this->getCodCliente();

        $sql = "DELETE FROM cliente WHERE cod_cliente = '$codCliente'";
        $all = $this->conexion->query($sql);

        return !$all ? $this->conexion->errorInfo() : True;
    }

}