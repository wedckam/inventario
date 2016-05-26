<?php

$app->get('/marcas', function ($request, $response, $args) {
    try {
        /**
         * al consultar esta url obtendra todo el listado de marcas existentes
         */
        $objMarcas = new UtmInventario\Marcas();
        $objMarcas->obtenerMarcas();
        $response= $objMarcas->Json();
    } catch (Exception $e) {
        $app->response()->setStatus(404);
        $response= '{"errores":["error":{"text":' . $e->getMessage() . '}]}';
    }
    return $response;
});
$app->get('/marcas/modelos', function ($request, $response, $args) {
    try {
        /**
         * al consultar esta url obtendra todo el listado de marcas existentes
         */
        $objMarcas = new UtmInventario\Marcas();
        $objMarcas->obtenerMarcas(false,true);
        $response= $objMarcas->Json();
    } catch (Exception $e) {
        $app->response()->setStatus(404);
        $response= '{"errores":["error":{"text":' . $e->getMessage() . '}]}';
    }
    return $response;
});
$app->get('/marcas/{marcaId}', function ($request, $response, $args) {
    try {
        $objMarca = new \UtmInventario\Marca($args["marcaId"]);
        $response = $objMarca->Json();
    } catch (Exception $e) {
        $app->response()->setStatus(404);
        $response= '{"errores":["error":{"text":' . $e->getMessage() . '}]}';
    }
    return $response;
});
$app->get('/marcas/{marcaId}/modelos', function ($request, $response, $args) {
    /**
     * retornara todos los modelos una marca
     */
    $objMarca = new \UtmInventario\Marca($args["marcaId"]);
    $objMarca->obtenerModelos();
    $response = $objMarca->Json();
    return $response;
    
});



$app->post('/marcas/agregar', function($request, $response, $args) {
    // pasar todo primera letra de cada palabra a mayusculas.
    // agregar a la tabla un nuevo campo llamado key.
    // 
    // 
//$data = json_decode(file_get_contents("php://input"));
//    $name = $request->getParam('text'); /
//    //$data = $request->getParams(); // todos los parametros o cuerpo
    /**
     * cadena que recive {"nombre":"valor"}
     */
    return '{"respuesta":true,"marca":{"id":"1","nombre":"sony"},"errores":false}';
});
$app->post('/marcas/eliminar', function($request, $response, $args) {
    /**
     * si desea eliminar solo un elemento
     * cadena que recive {"id":"valor"}
     * si desea eliminar multiples elementos
     * cadena que recive {"Marcas":[{"id":"valor"},{"id":"valor"}]}
     */
    return '{"respuesta":true,"errores":false}';
});
$app->post('/marcas/modificar', function($request, $response, $args) {
    /**
     * si desea modificar solo un elemento
     * cadena que recive {"id":"valor","nombre":"valor"}
     * si desea modificar multiples elementos
     * cadena que recive {"Marcas":[{"id":"valor","nombre":"valor"},{"id":"valor","nombre":"valor"}]}
     */
    return "{{[{id:1,nombre:'sony'},{id:2,nombre:'hp'}]} }";
});
$app->post('/marcas/buscar', function($request, $response, $args) {
    /**
     * si desea modificar solo un elemento
     * cadena que recive {"nombre":"valor"}
     * si desea modificar multiples elementos
     * cadena que recive {"Marcas":[{"id":"valor","nombre":"valor"},{"id":"valor","nombre":"valor"}]}
     */
    return "{{[{id:1,nombre:'sony'},{id:2,nombre:'hp'}]} }";
});


