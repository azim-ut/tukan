angular.module('root')
    .service('CartService', function ($http, Data, CartFactory) {
        let fetched = false;
        angular.extend(this, {
            fetchIds: function () {
                if (!fetched) {
                    fetched = true;
                    CartFactory.ids().$promise.then(function (res) {
                        Data.cart.ids = res.data;
                        setTimeout(function () {
                            fetched = false;
                        }, 200);
                    })
                }
            }
        });
    })
    .controller("CartListController", function ($rootScope, $scope, $controller, $interval, $anchorScroll, CartService, CartFactory, $window) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            cart: null,
            msg: null,
            pay: {},
            selectedAddress: 0,
            selectAddress: undefined,
            editAddress: undefined,
            toProduct: function (id) {
                location.href = "/product/" + id;
            },
            showNewAddressForm: function () {
                $rootScope.$broadcast('newAddressForm', $scope.onAddressUpdated);
            },
            useAddress: function (id) {
                $scope.selectedAddress = id;
                CartFactory.address({}, {id: $scope.selectedAddress}).$promise.then(function (res) {
                    $rootScope.$broadcast('updateCart');
                });
            },
            showAddressEditForm: function (row) {
                $rootScope.$broadcast('editAddressForm', row);
            },
            initPay: function (t) {
                $("#PayForm").modal("show");
                document.cartSubmit.submit();
            },
            checkout: function (cart) {
                CartFactory.submit({}, {address: cart.address}).$promise.then(function (res) {
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
            },
            updateCartData: function () {
                CartFactory.cart().$promise.then(function (res) {
                    $scope.cart = res.data;
                    $scope.editAddress = undefined;
                    if ($scope.cart.addresses.length > 0 && $scope.selectAddress === undefined) {
                        $scope.selectAddress = 0;
                    }
                    if ($scope.cart.addresses.length === 0) {
                        $scope.selectAddress = undefined;
                    }
                });
            }
        });
        window.addEventListener('message', function (event) {
            if (event.origin !== "https://igw-demo.every-pay.com" && event.origin !== "https://pay.every-pay.eu") {
                return;
            }
            let message = JSON.parse(event.data);
            if (message.transaction_result === "completed") {
                console.log(333, data);
                $rootScope.$broadcast('updateCart', {});
            }
        }, false);

        $scope.$on("addressesUpdated", function (data) {
            $scope.useAddress($scope.selectedAddress);
        });
        $scope.$on("updateCart", $scope.updateCartData);
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
});
