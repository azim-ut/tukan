angular.module('root')
    .controller("AdminIndexController", function ($scope, $httpParamSerializer, AdminPostFactory, AdminTagsFactory) {
        angular.extend($scope, {
            status: 'publish',
            post:0,
            postTags:[],
            posts:[],
            tags:[],
            changeFilteStatus: function (val) {
                $scope.status = val;
                $scope.fetchPosts();
            },
            togglePublish: function (post) {
                let call = null;
                switch(post.status){
                    case "publish":
                        call = AdminPostFactory.draftPost;
                        break;
                    case "draft":
                        call = AdminPostFactory.publishPost;
                        break;
                }
                if(call != null){
                    call({post:post.id}).$promise.then(function (res) {
                        $scope.fetchPosts();
                    });
                }
            },
            fetchData: function () {
                AdminTagsFactory.allTags().$promise.then(function(res){
                    $scope.tags = res.data;
                    $scope.fetchPosts();
                });
            },
            checkDel: function (ttl, id) {
                if (window.confirm("Удалить: " + ttl)) {
                    AdminPostFactory.delPost({'post':id}).$promise.then(function(res){
                        $scope.fetchPosts();
                    });
                }
            },
            fetchPosts: function () {
                var tags = [];
                $scope.tags.forEach(function(row){
                    if(row.on){
                        tags.push(row.slug);
                    }
                });
                var obj = {status: $scope.status, 'tags[]':tags, offset: 0, limit: 1000};
                var p = $httpParamSerializer(obj);
                AdminPostFactory.searchPosts(p).$promise.then(function(res){
                    $scope.posts = res.data;
                });
            },
            toggleTag: function(tag){
                if(tag.on){
                    tag.on = false;
                }else{
                    tag.on = true;
                }
                $scope.fetchPosts();
            }
        });
    });