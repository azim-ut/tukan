angular.module('root')
    .controller("WishesListController", function ($scope, $controller, $interval, $anchorScroll, WishesService) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            list: [],
            toProduct: function (id) {
                location.href = "/product/" + id;
            },
            removeFromList: function (id) {
                WishesService.remove(id);
            }
        });
        WishesService.fetchList();
    })
    .directive('wishButton', function () {
        let now = new Date();
        return {
            restrict: "E",
            scope: {
                product: "@"
            },
            controller: function ($scope, $controller, Data, $interval, $anchorScroll, WishesService) {
                angular.extend(this, $controller("CommonController", {$scope: $scope, Data, WishesService}));
                angular.extend($scope, {
                    toggleWish: function (productId) {
                        productId *= 1;
                        if (Data.wishes.ids.indexOf(productId) >= 0) {
                            WishesService.remove(productId);
                        } else {
                            WishesService.add(productId);
                        }
                    }

                });

                // WishesService.fetchIds();
            },
            templateUrl: '/template/js/assets/wish-button.html?t=' + now.getTime()
        };
    })
;
