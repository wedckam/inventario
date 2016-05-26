<!DOCTYPE html>
<html lang="es" ng-app="buscarMarcas" class="ng-scope">
    <head>  
        <meta charset="utf-8">
    </head>
    <body>
        <div ng-controller="buscarMarcasControlador">
        <button ng-click="enviarFormBuscar()">Buscar</button>
        {{marcas}}
        </div>
        <script type="text/javascript" src="js/angular/angular.min.js"></script>
        <script type="text/javascript" src="app.js"></script>
    </body>
</html>