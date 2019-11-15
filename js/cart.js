angular.module('root')
    .service('CartService', function ($http, Data, CartFactory) {
        let fetched = false;
        angular.extend(this, {
            fetchIds: function () {
                if (!fetched) {
                    fetched = true;
                    CartFactory.ids().$promise.then(function (res) {
                        Data.cart.ids = res.data;
                        setTimeout(function(){fetched = false;}, 200);
                    })
                }
            }
        });
    })
    .controller("CartListController", function ($rootScope, $scope, $controller, $interval, $anchorScroll, CartService, CartFactory, PayFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            cart: null,
            msg: null,
            selectAddress: undefined,
            editAddress: undefined,
            toProduct: function (id) {
                location.href = "/product/" + id;
            },
            needNewAddress: function () {
                $scope.editAddress = undefined;
                $scope.selectAddress = undefined;
            },
            useAddress: function (ind) {
                $scope.editAddress = undefined;
                $scope.selectAddress = ind;
            },
            closeEditAddress: function () {
                $scope.editAddress = undefined;
                $scope.selectAddress = ind;
            },
            showAddressEditForm: function (row) {
                $scope.editAddress = angular.copy(row);
            },
            setAddress: function (id, text) {
                CartFactory.address({},{id: id, text: text}).$promise.then(function (res) {
                    $rootScope.$broadcast('updateCart', {});
                });
            },
            pay: function (cart) {
                PayFactory.init({},{}).$promise.then(function(res){
                    console.log(res);
                });
            },
            checkout: function (cart) {
                let address = null;
                if(cart.address.length && cart.address[$scope.selectAddress] !== undefined){
                    address = cart.address[$scope.selectAddress].data;
                }

                CartFactory.submit({},{address: address}).$promise.then(function (res) {
                    if (res.code === 401) {
                        $("#AuthForm").modal("show");
                    }
                    if (res.data) {
                        $scope.cart = res.data;
                        $("#CartCheckouted").modal("show");
                        //location.href = "/orders";
                    }
                    $scope.msg = res.msg;
                });
            }
        });

        $scope.$on("updateCart", function (event, args) {
            CartFactory.list().$promise.then(function (res) {
                $scope.cart = res.data;
                $scope.editAddress = undefined;
                if($scope.cart.address.length>0 && $scope.selectAddress === undefined){
                    $scope.selectAddress = 0;
                }
                if($scope.cart.address.length === 0){
                    $scope.selectAddress = undefined;
                }
            });
        });
        $rootScope.$broadcast('updateCart', {});
    })
    .directive('cartRow', function () {
        let now = new Date();
        return {
            restrict: "E",
            scope: {
                cart: "=",
                product: "="
            },
            controller: function ($rootScope, $scope, $controller, Data, $interval, $anchorScroll, WishFactory, CartFactory) {
                angular.extend(this, $controller("CommonController", {
                    $scope: $scope,
                    Data,
                    WishFactory,
                    CartFactory
                }));
                angular.extend($scope, {
                    del: function (post, size) {
                        CartFactory.del({}, {post: post, size: size}).$promise.then(function (res) {
                            $rootScope.$broadcast('updateCart', {});
                            $rootScope.$broadcast('updateCartIds', {});
                        })
                    }
                });
            },
            templateUrl: '/web/js/assets/cart-page-row.html?t=' + now.getTime()
        };
    })
    .directive('cartButton', function () {
        let now = new Date();
        return {
            restrict: "A",
            scope: {
                price: "@",
                product: "@"
            },
            controller: function ($scope, $controller, Data, $interval, $anchorScroll, CartService) {
                angular.extend(this, $controller("CommonController", {$scope: $scope, Data, CartService}));
                angular.extend($scope, {
                    toProduct: function (productId) {
                        location.href = "/product/" + productId;
                    }

                });

                // WishesService.fetchIds();
            },
            templateUrl: '/web/js/assets/cart-button.html?t=' + now.getTime()
        };
    });

$('.carousel').carousel({
    interval: 2000
})