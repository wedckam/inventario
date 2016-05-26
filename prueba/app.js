var Marcas = angular.module('Marcas', []);
/*controladores para los estados*/
var buscarMarcas = angular.module('buscarMarcas', [
    'Marcas'
]);
Marcas.controller('buscarMarcasControlador', ['$scope', '$http',
    function ($scope, $http) {
        $scope.enviarFormBuscar = function () {
            formData = {"id": "1"};
            $http({
                method: 'GET',
                url: 'api/marcas',
                data: formData,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            }).then(function successCallback(response) {
               
            $scope.marcas=response.data;
            console.log(response);
            }, function errorCallback(data) {
                // called asynchronously if an error occurs
                // or server returns response with an error status.
            });
        };
}]);