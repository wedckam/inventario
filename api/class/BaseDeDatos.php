<?php

namespace UtmInventario;

class BaseDeDatos {
    private $host;
    private $usuario;
    private $clave;
    private $bd;
    public $sqlConexion;
    public function __construct() {
        $this->host = "127.0.0.1";
        $this->usuario = "root";
        $this->clave = "";
        $this->bd = "utm_inventario";
        $this->sqlConexion = false;
        $this->abrirConexion(false);
    }
    public function abrirConexion($SiNoExiste = true) {
        global $CONEXION_BASE_DE_DATOS;
        if ($CONEXION_BASE_DE_DATOS and $this->sqlConexion === false) {
            $this->sqlConexion = $CONEXION_BASE_DE_DATOS;
        } elseif (!$CONEXION_BASE_DE_DATOS and $SiNoExiste) {
            $CONEXION_BASE_DE_DATOS = $this->sqlConexion = mysqli_connect($this->host, $this->usuario, $this->clave);
            //mysqli_query($this->sqlConexion, "SET NAMES 'utf8'");
            mysqli_select_db($this->sqlConexion, $this->bd);
        }
    }
    public function sqlQuery($sqlQuery) {
        $this->abrirConexion();
        $sqlResult = false;
        mysqli_autocommit($this->sqlConexion, FALSE);
        if (is_array($sqlQuery)) {
            foreach ($sqlQueryArray as $sqlQuery) {
                $sqlResult = mysqli_query($this->sqlConexion, $sqlQuery);
                if (!$sqlResult) {
                    mysqli_rollback($this->sqlConexion);
                    return false;
                }
            }
        } else {
            $sqlResult = mysqli_query($this->sqlConexion, $sqlQuery);
            if (!$sqlResult) {
                mysqli_rollback($this->sqlConexion);
                return false;
            }
        }
        mysqli_commit($this->sqlConexion);
        return $sqlResult;
    }
    public function insertId() {
        return mysqli_insert_id($this->sqlConexion);
    }
    public function cerrarConexion() {
        global $CONEXION_BASE_DE_DATOS;
        $CONEXION_BASE_DE_DATOS = false;
        return mysqli_close($this->sqlConexion);
    }
    public function limpiarTexto($texto) {
        $this->abrirConexion();
        return mysqli_real_escape_string($this->sqlConexion, $texto);
    }
}
