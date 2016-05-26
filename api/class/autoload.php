<?php
//error_reporting(E_ALL); 
//ini_set("display_errors", 1); 

$CONEXION_BASE_DE_DATOS = false;

setlocale(LC_CTYPE, 'es-MX.' . 'UTF8');
date_default_timezone_set("America/Mexico_City");

require (dirname(__FILE__) . "/BaseDeDatos.php");
require (dirname(__FILE__) . "/Marcas.php");
require (dirname(__FILE__) . "/Marca.php");
require (dirname(__FILE__) . "/Modelo.php");
