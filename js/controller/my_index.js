angular.module('root')
    .controller("MySummaryController", function ($rootScope, $scope, $controller, $interval, $anchorScroll, MySummaryFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            summary: {}
        });

        $scope.$on("updateSummary", function (event, args) {
            MySummaryFactory.items().$promise.then(function (res) {
                $scope.summary = res.data;
            });
        });
        $rootScope.$broadcast('updateSummary', {});
    })
    .factory('MySummaryFactory', function ($resource) {
        return $resource('/shop/order/summary', null, {
            items: {
                method: 'GET',
                url: "/shop/rest/order/summary",
                isArray: false,
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
            }
        });
    });
