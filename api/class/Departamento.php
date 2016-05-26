<?php

namespace UtmInventario;

class Departamento {
    public $id;
    public $nombre;

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
     * funciones para departamento
     */
    public function obtener($id) {
        $objBd = new BaseDeDatos();
        $sqlResult = $objBd->sqlQuery("SELECT * FROM `departamentos` WHERE `departamentos`.`id` = " . $id);
        $objDepartamento = mysqli_fetch_object($sqlResult, 'UtmInventario\Departamento');
        $this->asignarValores($objDepartamento);
    }
    /**
     * @param type $nombre
     * funcines para modelos
     */
   
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
