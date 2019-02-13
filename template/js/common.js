angular.module('root')
    .filter('num', function() {
        return function(input) {
            return parseInt(input, 10);
        };
    })
    .controller("CommonController", function ($scope, $location, Data, WishesService) {
        angular.extend($scope, {
            data: Data,
            process: false
        });
        $("#nasa-before-load").hide();
        WishesService.fetchIds();
    })
    .directive('productPreview', function () {
        let now = new Date();
        return {
            restrict: "E",
            scope: {
                id: "=",
                title: "=",
                img: "=",
                price: "=",
                fullprice: "=",
            },
            controller: function ($scope, $controller, Data, $interval, $anchorScroll, WishesService) {
                angular.extend(this, $controller("CommonController", {$scope: $scope, Data, WishesService}));
                angular.extend($scope, {});
            },
            templateUrl: '/template/js/assets/product-preview.html?t=' + now.getTime()
        };
    })
    .directive('moreButton', function () {
        let now = new Date();
        return {
            restrict: "E",
            scope: {
                product: "@"
            },
            controller: function ($scope, $controller, Data, $interval, $anchorScroll, WishesService) {
                angular.extend(this, $controller("CommonController", {$scope: $scope, Data, WishesService}));
                angular.extend($scope, {
                    on: function () {
                        return Data.user.current.a;
                    },
                    toMore: function () {
                        if (Data.user.current.a) {
                            location.href = "/assets/edit.php?id=" + $scope.product
                        }
                    }
                });
            },
            templateUrl: '/template/js/assets/more-button.html?t=' + now.getTime()
        };
    });


$(function(){
    if($("#heart-path").size()){
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

function arraysIsMatch(arr1, arr2){
    return arr1.length === arr2.length && arr1.sort().every(function(value, index) { return value === arr2.sort()[index]});;
}