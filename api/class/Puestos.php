<?php

namespace UtmInventario;

class Puestos {
    public $puestos;
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

    public function obtenerPuestos($nombre = false) {
        $objBd = new BaseDeDatos();
        $filtroNombre = ($nombre) ? "and `puestos`.`nombre` LIKE '%" . $nombre . "%'" : ' ';
        $sqlQuery = "SELECT * FROM `puestos` WHERE 1 $filtroNombre;";
        $sqlResult = $objBd->sqlQuery($sqlQuery);
        while ($objPuesto = mysqli_fetch_object($sqlResult, 'UtmInventario\Puesto')) {
            $this->puestos[] = $objPuesto;
        }
    }

    public function agregarPuesto($objPuesto) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "INSERT INTO `puestos`(`nombre`) VALUES ('$objPuesto->nombre')";
        if ($objBd->sqlQuery($sqlQuery)) {
            return $objBd->insertId();
        } else {
            return false;
        }
    }

    public function modificarPuesto($objPuesto) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "UPDATE `puestos` SET `nombre`='" . $objPuesto->nombre . "' WHERE id = " . $objPuesto->id . ";";
        if ($objBd->sqlQuery($sqlQuery)) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarPuesto($objPuesto) {
        $objBd = new BaseDeDatos();
        $sqlQuery = "DELETE FROM `puestos` WHERE `id` = " . $objPuesto->id . ";";
        if ($objBd->sqlQuery($sqlQuery)) {
            return true;
        }
        return false;
    }

    public function buscarPuesto($nombre = false) {
        $objBd = new BaseDeDatos();
        $filtroNombre = ($nombre) ? "and `puestos`.`nombre` LIKE '%" . $nombre . "%'" : ' ';
        $sqlQuery = "SELECT * FROM `puestos` WHERE 1 $filtroNombre;";
        $sqlResult = $objBd->sqlQuery($sqlQuery);
        while ($objPuesto = mysqli_fetch_object($sqlResult, 'UtmInventario\Puesto')) {
            $this->puestos[] = $objPuesto;
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
