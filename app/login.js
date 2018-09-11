var app = angular.module('loginApp', ['ngMaterial']);
app.factory('tostadoService',function($mdToast){
  var tost = {};
  tost.tostado = function(texto,tipo){
    $mdToast.show(
        $mdToast.simple()
        .toastClass('md-toast-'+tipo)
        .textContent(texto)
        .position('bottom left')
        .hideDelay(3000)
        );
  };
  tost.closeToast = function(){
    $mdToast.hide();
  };
  return tost;
})
app.controller('registroCtrl', function($scope, $timeout, $q, $log, $http, $window,tostadoService) {
  $scope.registrar = function(){

    $http.post('../admin/api/registro/', $scope.registro).then( function(data){
        var result = data['data'];
        if(result.status=='success'){
          tostadoService.tostado(result.message,'success');
        }else{
          tostadoService.tostado(result.message,'error');
        }
    }).catch(function(resultado){
      //  deferred.reject(resultado);
    });

  };
})
app.controller('loginCtrl', function($scope, $timeout, $q, $log, $http, $window,tostadoService) {
    $scope.doLogin = function(usuario) {
        var deferred;
        deferred = $q.defer();
        $http.post('../admin/api/login/', usuario).then( function(data){
            var resul = data['data'];
            tostadoService.tostado(resul['message'], resul['status']);
            if(resul['status'] == 'success'){
              console.log("success Papi")
            }
            deferred.resolve(data);
        }).catch(function(resultado){
            deferred.reject(resultado);
        });
        return deferred.promise;
    };
});
$(document).ready(function() {
    init();
});
function init(){
    console.log("login.html");
}
