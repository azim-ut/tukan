angular.module('root')
    .service('OrdersService', function ($http, Data, OrdersFactory) {
        let fetched = false;
        angular.extend(this, {
            fetch: function () {
                OrdersFactory.list().$promise.then(function (res) {
                    Data.orders = res.data;
                });
            },
            fetchIds: function () {
                if(!fetched) {
                    fetched = true;
                    OrdersFactory.ids().$promise.then(function (res) {
                        Data.order_ids = res.data;
                    })
                }
            }
        });
    })
    .controller("OrdersListController", function ($scope, $controller, $interval, $anchorScroll, OrdersService, OrdersFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            list: [],
            msg: null,
            fetch: OrdersService.fetch,
            toProduct: function (id) {
                location.href = "/product/" + id;
            },
            submit: function () {
                let params = $.param({address: $scope.data.cart.address});
                OrdersFactory.submit(params).$promise.then(function (res) {
                    if(res.code === 401){
                        $("#AuthForm").modal("show");
                    }
                    $scope.msg = res.msg;
                });
            }
        });
        OrdersService.fetch();
    })
    .directive('orderRow', function () {
        let now = new Date();
        return {
            restrict: "E",
            scope: {
                order: "="
            },
            controller: function ($scope, $controller, Data, $interval, $anchorScroll, WishesService, OrdersFactory) {
                angular.extend(this, $controller("CommonController", {$scope: $scope, Data, WishesService, OrdersFactory}));
                angular.extend($scope, {

                });
            },
            templateUrl: '/web/js/assets/order-page-row.html?t=' + now.getTime()
        };
    });