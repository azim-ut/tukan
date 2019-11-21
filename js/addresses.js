angular.module('root')
    .controller("AddressesBlockController", function ($scope, $controller, $interval, $anchorScroll, CoreFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            items: null,
            update: function(address){
                CoreFactory.address(address).$promise.then(function (res) {
                    if(res.data){
                        $scope.$broadcast('updateAddressesList', {});
                    }
                });
            }
        });

        $scope.$on("updateAddressesList", function (event, args) {
            CoreFactory.addresses().$promise.then(function (res) {
                $scope.list = res.data;
            });
        });
        $scope.$broadcast('updateAddressesList', {});
    });
