angular.module('root')
    .service('CartService', function ($http, Data, CartFactory) {
        let fetched = false;
        angular.extend(this, {
            fetch: function () {
                // if(!fetched){
                fetched = true;
                CartFactory.list().$promise.then(function (res) {
                    Data.cart = res.data;
                });
                // }
            },
            fetchIds: function () {
                if(!fetched) {
                    fetched = true;
                    CartFactory.ids().$promise.then(function (res) {
                        Data.cart_ids = res.data;
                    })
                }
            },
            remove: function (id) {
                fetched = false;
                CartFactory.del({id: id}).$promise.then(function (res) {
                    Data.cart_ids = res.data;
                })
            },
            add: function (id) {
                fetched = false;
                CartFactory.add({id: id}).$promise.then(function (res) {
                    Data.cart_ids = res.data;
                })
            }
        });
    })
    .controller("CartListController", function ($scope, $controller, $interval, $anchorScroll, CartService) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            list: [],
            toProduct: function (id) {
                location.href = "/product/" + id;
            },
            removeFromList: function (id) {
                CartService.remove(id);
            }
        });
        CartService.fetch();
    })
    .directive('cartButton', function () {
        let now = new Date();
        return {
            restrict: "E",
            scope: {
                product: "@"
            },
            controller: function ($scope, $controller, Data, $interval, $anchorScroll, CartService) {
                angular.extend(this, $controller("CommonController", {$scope: $scope, Data, CartService}));
                angular.extend($scope, {
                    toggleCart: function (productId) {
                        productId *= 1;
                        if (Data.cart_ids.indexOf(productId) >= 0) {
                            CartService.remove(productId);
                        } else {
                            CartService.add(productId);
                        }
                    }

                });

                // WishesService.fetchIds();
            },
            templateUrl: '/web/js/assets/cart-button.html?t=' + now.getTime()
        };
    });