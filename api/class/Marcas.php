<?php

namespace UtmInventario;

class Marcas {
    public $marcas;
    public function __construct() {
        
    }
    public function __set($name, $value) {
        $this->$name = $value;
    }
    public function __get($name) {
        return $this->$name;
    }
    public function Json() {
        return json_encode($this);
    }
    public function obtenerMarcas($nombre=false,$conModelos = false) {
        $objBd = new BaseDeDatos();
        $filtroNombre = ($nombre)? "and `marcas`.`nombre` LIKE '%" . $nombre."%'":' ';
        $sqlQuery = "SELECT * FROM `marcas` WHERE 1 $filtroNombre;";
        $sqlResult = $objBd->sqlQuery($sqlQuery);
        while ($objMarca = mysqli_fetch_object($sqlResult, 'UtmInventario\Marca')){
            if($conModelos){
                $objMarca->obtenerModelos();
            }
            $this->marcas[] =$objMarca;
        }
    }
    public function agregarMarca($objMarca) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "INSERT INTO `marcas`(`nombre`) VALUES ('$objMarca->nombre')";
        //echo $sqlQuery;
        if($objBd->sqlQuery($sqlQuery)){
            return $objBd->insertId();
        }else{
            return false;
        }
    }
    public function modificarMarca($objMarca) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "UPDATE `marcas` SET `nombre`='".$objMarca->nombre."' WHERE id = ".$objMarca->id.";";
        if($objBd->sqlQuery($sqlQuery)){
            return true;
        }else{
            return false;
        }
    }
    public function eliminarMarca($marcaId) {
        $objBd = new BaseDeDatos();
        //DELETE FROM `marcas` WHERE `id` = 1
        $sqlQuery = "        //DELETE FROM `marcas` WHERE `id` = ".$marcaId.";";
        if($objBd->sqlQuery($sqlQuery)){
            return true;
        }else{
            return false;
        }
    }
    public function buscarMarca($nombre=false,$conModelos = false) {
        $objBd = new BaseDeDatos();
        $filtroNombre = ($nombre)? "and `marcas`.`nombre` LIKE '%" . $nombre."%'":' ';
        $sqlQuery = "SELECT * FROM `marcas` WHERE 1 $filtroNombre;";
        //echo $sqlQuery;
        $sqlResult = $objBd->sqlQuery($sqlQuery);
        while ($objMarca = mysqli_fetch_object($sqlResult, 'UtmInventario\Marca')){
            if($conModelos){
                $objMarca->obtenerModelos();
            }
            $this->marcas[] =$objMarca;
        }
    }
    private function asignarValores($valores) {
        if (is_array($valores)) {
            foreach ($valores as $nombre => $valor) {
                $this->$nombre = $valor;
            }
        } elseif (is_object($valores)) {
            foreach ($valores as $nombre => $valor) {
                $this->$nombre = $valor;
            }
        } else {
            $vars_clase = get_class_vars(get_class($this));
            foreach ($vars_clase as $nombre => $valor) {
                $this->$nombre = false;
            }
        }
    }
}
