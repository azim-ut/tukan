angular.module('root')
    .controller("SalesPromoController", function ($rootScope, $scope, $controller, $interval, $anchorScroll, SalesPromoFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            items: []
        });

        $scope.$on("updateSalesPromoList", function (event, args) {
            SalesPromoFactory.items({limit:8}).$promise.then(function (res) {
                $scope.items = res.data;
            });
        });
        $rootScope.$broadcast('updateSalesPromoList', {});
    })
    .factory('SalesPromoFactory', function ($resource) {
        return $resource('/shop/rest/sales', null, {
            items: {
                method: 'GET',
                url: "/shop/rest/sales/list/:limit",
                isArray: false,
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
            }
        });
    });
