angular.module('root')
    .controller("WishesListController", function ($scope, $controller, $interval, $anchorScroll, WishesService) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            list: [],
            toProduct: function (id) {
                location.href = "/product/" + id;
            }
        });

        WishFactory.list().$promise.then(function (res) {
            $scope.data.wishes.list = res.data;
        });
    })
    .directive('wishButton', function () {
        let now = new Date();
        return {
            restrict: "E",
            scope: {
                product: "@"
            },
            controller: function ($scope, $controller, Data, $interval, $anchorScroll, WishFactory) {
                angular.extend(this, $controller("CommonController", {$scope: $scope, Data, WishFactory}));
            },
            templateUrl: '/web/js/assets/wish-button.html?t=' + now.getTime()
        };
    })
;
