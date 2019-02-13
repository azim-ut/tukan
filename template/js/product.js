angular.module('root')
    .controller("ProductController", function ($scope, $controller, $interval, $anchorScroll, ProductService, WishesService) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            addWish: function (postId) {
                WishesService.add(postId);
            },
            delWish: function (postId) {
                WishesService.remove(postId);
            },
            fetchProduct: function (id) {
                ProductService.fetchData(id);
            }
        });
    });
