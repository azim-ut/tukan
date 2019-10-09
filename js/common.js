angular.module('root')
    .filter('num', function() {
        return function(input) {
            return parseInt(input, 10);
        };
    })
    .controller("CommonController", function ($scope, $location, Data, WishFactory, CartService) {
        angular.extend($scope, {
            data: Data,
            process: false,
            fetchVisitsData: function(){
                WishFactory.ids().$promise.then(function(res){$scope.data.wishes.ids = res.data});
                CartService.fetchIds();
            },
            toggleWish: function (productId) {
                WishFactory.toggle({id:productId}).$promise.then(function(res){
                    $scope.data.wishes.ids = res.data;
                });
            }
        });
        $scope.$on("updateCartIds", function (event, args) {
            CartService.fetchIds();
        });
        $("#nasa-before-load").hide();
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
            controller: function ($scope, $controller, Data, $interval, $anchorScroll, WishFactory) {
                angular.extend(this, $controller("CommonController", {$scope: $scope, Data, WishFactory}));
                angular.extend($scope, {});
            },
            templateUrl: '/web/js/assets/product-preview.html?t=' + now.getTime()
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