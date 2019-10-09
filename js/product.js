angular.module('root')
    .controller("ProductController", function ($scope, $controller, $interval, $anchorScroll, ViewFactory, WishFactory, CartFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            wished: false,
            size: null,
            needSize: false,
            toggleSize: function (size) {
                $scope.needSize = false;
                if($scope.size !== size){
                    $scope.size = size;
                }else{
                    $scope.size = null;
                }
            },
            toggleProductWish: function (productId) {
                WishFactory.toggle({id:productId}).$promise.then(function(res){
                    $scope.data.wishes.ids = res.data;
                    $scope.fetchProduct(productId);
                });
            },
            toCart: function (id, size) {
                if(size === null){
                    $scope.needSize = true;
                    return;
                }

                CartFactory.add(null, {post: id, size:size}).$promise.then(function (res) {
                    $scope.data.cart.ids = res.data;
                })
            },
            fetchProduct: function (id) {
                WishFactory.total({post:id}).$promise.then(function(res){
                    $scope.totalWished = res.data;
                    $scope.wished = false;
                    if($scope.data.wishes.ids.includes(id)){
                        $scope.wished = true;
                    }
                });
            }
        });

    });
