angular.module('root')
    .controller("HeightPageController", function ($scope, $cookies, $controller, $anchorScroll, ViewFactory, $httpParamSerializer) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));

        angular.extend($scope, {
            lastFetchInterval: null,
            loadDisabled: true,
            fetched: false,
            post: 0,
            offset: 0,
            heightP: 50,
            height: 0,
            tagsOn: [],
            tags: [],
            wishes: [],
            posts: [],
            updateHeight: function () {
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
            firstLoad: function () {
                if ($scope.data.process) {
                    return;
                }
                $scope.data.process = true;
                ViewFactory.tags().$promise.then(function (res) {
                    $scope.data.process = false;
                    $scope.post = 0;
                    $scope.tags = res.data;
                    $scope.offset = 0;
                    let obj = {'tags[]': [], offset: 0, limit: 12};
                    let p = $httpParamSerializer(obj);
                    $scope.data.process = true;
                    ViewFactory.posts(p).$promise.then(function (res) {
                        $scope.data.process = false;
                        $scope.posts = res.data.list;
                        $scope.page = res.data.page;
                        $scope.total = res.data.total;
                        $scope.fetched = true;
                    });
                });
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
            resetPosts: function () {

                let tags = [];
                let gender = null;
                console.log(111);
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

                if (!arraysIsMatch(tags, $scope.tags)) {
                    $scope.posts = [];
                }

                let obj = {'tags[]': tags, offset: $scope.posts.length, limit: 12};
                let p = $httpParamSerializer(obj);
                $scope.data.process = true;
                ViewFactory.posts(p).$promise.then(function (res) {
                    $scope.data.process = false;
                    $scope.posts = res.data;
                    $scope.fetched = true;
                });
            }
        });
        $scope.firstLoad();
    });