angular.module('root')
    .controller("MyCouponsController", function ($rootScope, $scope, $controller, $interval, $anchorScroll, MyCouponsFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            list: []
        });

        $scope.$on("updateList", function (event, args) {
            MyCouponsFactory.items().$promise.then(function (res) {
                $scope.list = res.data;
            });
        });
        $rootScope.$broadcast('updateList', {});
    })
    .factory('MyCouponsFactory', function ($resource) {
        return $resource('/shop/rest/coupons', null, {
            items: {
                method: 'GET',
                url: "/shop/rest/coupons/list",
                isArray: false,
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
            }
        });
    });
