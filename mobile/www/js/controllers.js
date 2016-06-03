angular.module('starter.controllers', [])

.controller('HomeCtrl', function($scope, $http, $ionicLoading, CONFIG) {
    $http({method: 'GET', url: CONFIG.apiBaseUrl + '/v1/emprestimos'}).
        success(function(data, status, headers, config) {
        var emprestimos = data;

        // Gambiarra pro javascript entender que 1 == true
        for(var i = 0; i < emprestimos.length; i++)
        {
            if(emprestimos[i].devolvido == 1) {
              emprestimos[i].devolvido = true;
            }
        }

        $scope.emprestimos = emprestimos;
    }).
    error(function(data, status, headers, config) {
        $scope.response = data;
    });

    $scope.changeStatus = function(item) {
        $ionicLoading.show({
            template: 'Carregando...'
          });

        console.log(item);

          $http({
            method: 'POST',
            url: CONFIG.apiBaseUrl + '/v1/emprestimos/baixa',
            data: {
                id: item.id,
                status: item.devolvido
            },
            cache: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
          }).success(function(data, status, respondeHeaders, config) {

            $ionicLoading.hide();
          }).error(function(data, status, headers, config) {
            console.log('erro');

            $ionicLoading.hide();
          });
    }
})

.controller('SobreCtrl', function($scope) {
  $scope.settings = {
    enableFriends: true
  };
});
