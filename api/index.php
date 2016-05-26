<?php
require 'vendor/autoload.php';
include 'class/autoload.php';

$app = new Slim\App();

/**
 * funciones incluidas
 * dentro del directorio /rutas guardaremos archivos con la funciones que corresponderan a cada modulo
 * ejemplo marcas
 * digamos que en /rutas/marcas.php se encontraran todas las operaciones que se pueden hacer conmarcas y esto sera con cada modulo. 
 * no te olvides de incluir el archivo php aqui abajo.
 * 
 * Las funciones basicas y las url para consultarlas
 * nos saldremos un poco del estandar de resfull para que se te haga mas facil comprender como trabajaremos
 * todas las consultas simples las haremos por GET mientras que todas las modificaciones, altas, y busuqedas por POST
 * 
 * seguimos con el ejemplo de marcas
 * 
 * ***todas las url  comensaran por el nombre del modulo en este caso /marcas
 * ***posteriormente le seguira la opéracion deseada
 * los parametros se pasaran a traves de una cadena json  
 * 
 * 
 * get
 * /marcas
 * /marcas/{id}
 * 
 * post  los parametros dependeran del modulo y de la funcion. checar dentro de cada modulo 
 * /marcas/agregar/
 * /marcas/eliminar/
 * /marcas/modificar/ 
 * /marcas/buscar/
 * 
 * 
 * la respuesta tambien sera  a traves de una cadena json con el formato
 * 
 * {[{id:1,nombre:'sony'},{id:2,nombre:'hp'},]} 
 * 
 * las respuestas de confirmacion o de error de la siguiente forma
 * {"respuesta=true"}
 * 
 *los errores de la siguiente forma
 * 
 * 
 * {"errores"=[{"error"=1,"detalle"="La marca solicitada no existe"},{"error"=1,"detalle"="No se paso ningun parametro en la consulta"}]} 
 * 
 * 
 * 
 * en las respuesta pueden ir las tres formas dentro de un solo json
 * 
 */

/*rutas registradas**/
include "rutas/marcas.php";




$app->get('/', function ($request, $response, $args) {
    
    
    $response->write("Hola!");
    return $response;
});

$app->run();
