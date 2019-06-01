angular.module('root')
    .controller("MainPageController", function ($scope, $cookies, $controller, $anchorScroll, ViewFactory, $httpParamSerializer) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));

        angular.extend($scope, {
            lastFetchInterval: null,
            loadDisabled: true,
            fetched: false,
            useFilter: true,
            post: 0,
            limit: 27,
            heightP: $cookies.get("heightP"),
            height: 0,
            offset: 0,
            tagsOn: [],
            tags: [],
            wishes: [],
            posts: [],
            updateHeight: function () {
                $cookies.put("heightP", $scope.heightP);
                $scope.height = (120 / 100) * $scope.heightP + 56;
                $scope.tags.forEach(function (tag) {
                    if (tag.from && tag.to && tag.group === 'height') {
                        tag.on = false;
                        if (tag.from <= $scope.height && tag.to >= $scope.height) {
                            tag.on = true;
                        }
                    }
                });
            },
            toggleFilterAccess: function(){
                $scope.useFilter = $scope.useFilter?false:true;
                $scope.fetchList();
            },
            setHeight: function () {
                $scope.updateHeight();
                if ($scope.lastFetchInterval != null) {
                    clearTimeout($scope.lastFetchInterval);
                }
                $scope.lastFetchInterval = setTimeout($scope.resetPosts, 250);
            },
            fetchList: function (post) {
                if ($scope.data.process) {
                    return;
                }
                $scope.data.process = true;
                ViewFactory.tags().$promise.then(function (res) {
                    $scope.data.process = false;
                    $scope.post = post;
                    $scope.tags = res.data;
                    $scope.offset = 0;
                    $scope.setHeight();
                });
            },
            clickOnTag: function (tag) {
                $scope.tags.forEach(function (row) {
                    if (row.group === 'gender') {
                        row.on = false;
                    }
                });
                tag.on = true;
                $scope.resetPosts();
            },
            resetPosts: function (offset) {
                if(!offset){
                    offset = 0;
                }
                let tags = [];

                if($scope.useFilter){
                    tags = updateTags();
                }

                let obj = {'tags[]': tags, offset: offset, limit: $scope.limit};
                let p = $httpParamSerializer(obj);
                $scope.data.process = true;
                ViewFactory.posts(p).$promise.then(function (res) {
                    $scope.data.process = false;
                    $scope.pages = res.data.pages;
                    $scope.total = res.data.total;
                    $scope.posts = res.data.list;
                    $scope.fetched = true;
                });
            },

        });
        function updateTags(){
            let tags = [];
            let gender = null;

            $scope.tags.forEach(function (row) {
                if (row.on && row.group === 'gender') {
                    gender = row;
                }
            });

            if (!gender) {
                for (let i = 0; i < $scope.tags.length; i++) {
                    let row = $scope.tags[i];
                    if (row.group === 'gender') {
                        row.on = true;
                        break;
                    }
                }
            }

            if ($scope.tags) {
                $scope.tags.forEach(function (row) {
                    if (row.on) {
                        tags.push(row.slug);
                        $scope.tagsOn.push(row.slug);
                    }
                });
            }
            return tags;
        }
        $scope.fetchList();
    });