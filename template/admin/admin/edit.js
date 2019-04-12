angular.module('root')
    .controller("EditController", function ($scope, AdminPostFactory, AdminTagsFactory) {
        angular.extend($scope, {
            post:0,
            postTags:[],
            tags:[],
            fetchList: function (post) {
                var params = {post: post};
                AdminTagsFactory.postTags(params).$promise.then(function(res){
                    $scope.post = post;
                    $scope.tags = res.data;
                });
            },
            toggleTag: function(post, tag, stat){
                // var params = $.param({post: post, tag:row.tag});
                var params = {post: post, tag:tag};
                var factoryInstance;
                if(!stat){
                    factoryInstance = AdminTagsFactory.on(params);
                }else{
                    factoryInstance = AdminTagsFactory.off(params);
                }
                factoryInstance.$promise.then(function(res){
                    $scope.fetchList($scope.post);
                });
            }
        });
    });