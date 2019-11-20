angular.module('root')
    .controller("OrdersListController", function ($rootScope, $scope, $controller, $interval, $anchorScroll, OrdersFactory, CoreFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            items: null
        });

        $scope.$on("updateOrdersList", function (event, args) {
            OrdersFactory.items().$promise.then(function (res) {
                $scope.items = res.data;
            });
        });
        $rootScope.$broadcast('updateOrdersList', {});
    })
    .factory('OrdersFactory', function ($resource) {
        return $resource('/shop/rest/order_rep', null, {
            items: {
                method: 'GET',
                url: "/shop/rest/order_rep/items",
                isArray: false,
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
            }
        });
    });
