<?php

namespace UtmInventario;

class Departamentos {

    public $departamentos;

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

    public function obtenerDepartamentos($nombre = false) {
        $objBd = new BaseDeDatos();
        $filtroNombre = ($nombre) ? "and `departamentos`.`nombre` LIKE '%" . $nombre . "%'" : ' ';
        $sqlQuery = "SELECT * FROM `departamentos` WHERE 1 $filtroNombre;";
        $sqlResult = $objBd->sqlQuery($sqlQuery);
        while ($objDepartamento = mysqli_fetch_object($sqlResult, 'UtmInventario\Departamento')) {
            $this->departamentos[] = $objDepartamento;
        }
    }

    public function agregarDepartamento($objDepartamento) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "INSERT INTO `departamentos`(`nombre`) VALUES ('$objDepartamento->nombre')";
        if ($objBd->sqlQuery($sqlQuery)) {
            return $objBd->insertId();
        } else {
            return false;
        }
    }

    public function modificarDepartamento($objDepartamento) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "UPDATE `departamentos` SET `nombre`='" . $objDepartamento->nombre . "' WHERE id = " . $objDepartamento->id . ";";
        if ($objBd->sqlQuery($sqlQuery)) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarDepartamento($objDepartamento) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "DELETE FROM `departamentos` WHERE `id` = " . $objDepartamento->id . ";";
        if ($objBd->sqlQuery($sqlQuery)) {
            return true;
        }
        return false;
    }

    public function buscarDepartamento($nombre = false) {
        $objBd = new BaseDeDatos();
        $filtroNombre = ($nombre) ? "and `departamentos`.`nombre` LIKE '%" . $nombre . "%'" : ' ';
        $sqlQuery = "SELECT * FROM `departamentos` WHERE 1 $filtroNombre;";
        $sqlResult = $objBd->sqlQuery($sqlQuery);
        while ($objDepartamento = mysqli_fetch_object($sqlResult, 'UtmInventario\Departamento')) {
            $this->departamentos[] = $objDepartamento;
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
