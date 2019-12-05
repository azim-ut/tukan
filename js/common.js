angular.module('root')
    .filter('num', function () {
        return function (input) {
            return parseInt(input, 10);
        };
    })
    .controller("CommonController", function ($scope, $location, Data, WishFactory, CartService) {
        angular.extend($scope, {
            data: Data,
            process: false,
            fetchVisitsData: function () {
                WishFactory.ids().$promise.then(function (res) {
                    $scope.data.wishes.ids = res.data
                });
                CartService.fetchIds();
            },
            toProduct: function (id) {
                location.href = "/product/" + id;
            },
            goBack: function () {
                window.history.back();
            },
            toggleWish: function (productId) {
                WishFactory.toggle({id: productId}).$promise.then(function (res) {
                    $scope.data.wishes.ids = res.data;
                });
            },
            openEmptyForm: function (form, ext) {
                $scope.data.temp = null;
                if (ext) {
                    $scope.data.temp = angular.copy(ext);
                }
                $(form).modal("show");
            },
            openForm: function (form, obj, ext) {
                $scope.data.temp = angular.copy(obj);
                if (ext) {
                    angular.extend($scope.data.temp, angular.copy(ext));
                }
                $(form).modal("show");
            },
            closeForm: function (form) {
                $(form).modal("hide");
                $scope.data.temp = null;
            },
            setTemp: function (obj) {
                $scope.data.temp = angular.copy(obj);
            }
        });
        $scope.$on("updateCartIds", function (event, args) {
            CartService.fetchIds();
        });
        $("#nasa-before-load").hide();
    })
    .directive('coupon', function () {
        let now = new Date();
        return {
            restrict: "E",
            scope: {
                data: "="
            },
            templateUrl: '/web/js/assets/coupon.html?t=' + now.getTime()
        };
    })
    .directive('couponmini', function () {
        let now = new Date();
        return {
            restrict: "E",
            scope: {
                data: "="
            },
            templateUrl: '/web/js/assets/coupon-mini.html?t=' + now.getTime()
        };
    })
    .directive('productPreview', function () {
        let now = new Date();
        return {
            restrict: "A",
            scope: {
                id: "=",
                title: "=",
                img: "=",
                price: "=",
                fullprice: "=",
            },
            controller: function ($scope, $controller, Data, $interval, $anchorScroll, WishFactory) {
                angular.extend(this, $controller("CommonController", {$scope: $scope, Data, WishFactory}));
                angular.extend($scope, {});
            },
            templateUrl: '/web/js/assets/product-preview.html?t=' + now.getTime()
        };
    });


$(function () {
    if ($("#heart-path").size()) {
        let bar = new ProgressBar.Path('#heart-path', {
            easing: 'easeInOut',
            duration: 1400
        });

        setInterval(function () {
            bar.set(0);
            bar.animate(1.0);
        }, 2000)
    }

});

function arraysIsMatch(arr1, arr2) {
    return arr1.length === arr2.length && arr1.sort().every(function (value, index) {
        return value === arr2.sort()[index]
    });
    ;
}

function findGetParameter(parameterName) {
    var result = undefined,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}