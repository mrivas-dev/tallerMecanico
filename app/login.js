var app = angular.module('loginApp', ['ngMaterial']);
app.controller('registroCtrl', function($scope, $mdToast, $timeout, $q, $log, $http, $window) {});
app.controller('loginCtrl', function($scope, $mdToast, $timeout, $q, $log, $http, $window) {
    $scope.doLogin = function(usuario) {
        var deferred;
        deferred = $q.defer();
        $http.post('../admin/api/login/', usuario).then( function(data){
            var resul = data['data'];
            $scope.tostado(resul['message'], resul['status']);
            if(resul['status'] == 'success'){
              console.log("success Papi")
            }
            deferred.resolve(data);
        }).catch(function(resultado){
            deferred.reject(resultado);
        });
        return deferred.promise;
    };
    $scope.closeToast = function() {
        $mdToast.hide();
    };
    $scope.tostado = function(texto,tipo) {
        $mdToast.show(
            $mdToast.simple()
            .toastClass('md-toast-'+tipo)
            .textContent(texto)
            .position('bottom left')
            .hideDelay(3000)
            );
    };
});
$(document).ready(function() {
    init();
});
function init(){
    console.log("login.html");
}
