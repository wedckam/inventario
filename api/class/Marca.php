<?php

namespace UtmInventario;

class Marca {
    public $id;
    public $nombre;
    public $modelos;
    public function __construct($id = false) {
        if ($id) {
            $this->obtener($id);
        }
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
    /**
     * @param type $id
     * funciones para marca
     */
    public function obtener($id) {
        $objBd = new BaseDeDatos();
        $sqlResult = $objBd->sqlQuery("SELECT * FROM `marcas` WHERE `marcas`.`id` = " . $id);
        $objMarca = mysqli_fetch_object($sqlResult, 'UtmInventario\Marca');
        $this->asignarValores($objMarca);
    }
    /**
     * @param type $nombre
     * funcines para modelos
     */
    public function obtenerModelos($nombre = '') {
        $objBd = new BaseDeDatos();
        if ($nombre === '' or $nombre === false) {
            $filtro = '';
        } else {
            $filtro = " and `modelos`.`nombre` LIKE '%" . $nombre . "%'";
        }
        $sqlQuery = "SELECT * FROM `modelos` WHERE marcaId = '" . $this->id . "' " . $filtro . ";";
        $sqlResult = $objBd->sqlQuery($sqlQuery);
        while ($objModelo = mysqli_fetch_object($sqlResult, 'UtmInventario\Modelo')) {
            $this->modelos[] = $objModelo;
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
    /**
     * funciones para modelos
     */
    public function agregarModelo($objModelo) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "INSERT INTO `modelos`(`nombre`,'marcaId') VALUES ('$objModelo->nombre','$this->id')";
        //echo $sqlQuery;
        if ($objBd->sqlQuery($sqlQuery)) {
            return $objBd->insertId();
        } else {
            return false;
        }
    }
    public function modificarModelo($objModelo) {
        $objBd = new BaseDeDatos();
        if ($objModelo->marcaId === $this->id) {
            $sqlQuery = "UPDATE `modelos` SET `modelos`.`nombre`='" . $objModelo->nombre . "' WHERE `modelos`.id = " . $objModelo->id . ";";
            if ($objBd->sqlQuery($sqlQuery)) {
                return true;
            }
        }
        return false;
    }
    public function eliminarModelo($objModelo) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "DELETE FROM `modelos` WHERE `modelos`.`id` = '" . $objModelo->id . "' and `modelos`.marcaId = '$this->id';";
        if ($objBd->sqlQuery($sqlQuery)) {
            return true;
        }
        return false;
    }
    public function buscarModelo($nombre = false, $conModelos = false) {
        $objBd = new BaseDeDatos();
        $filtroNombre = ($nombre) ? "and `modelos`.`nombre` LIKE '%" . $nombre . "%'" : ' ';
        $sqlQuery = "SELECT * FROM `modelos` WHERE 1 $filtroNombre;";
        $sqlResult = $objBd->sqlQuery($sqlQuery);
        while ($objModelo = mysqli_fetch_object($sqlResult, 'UtmInventario\Modelo')) {
            if ($conModelos) {
                $objModelo->obtenerModelos();
            }
            $this->modelos[] = $objModelo;
        }
    }

}
