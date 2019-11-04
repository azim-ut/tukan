angular.module('root')
    .controller("MainPageController", function ($scope, $cookies, $location, $controller, $anchorScroll, ViewFactory, $httpParamSerializer) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        let heightCookieName = "heightFilter";
        let genderCookieName = "genderFilter";

        angular.extend($scope, {
            lastFetchInterval: null,
            loadDisabled: true,
            fetched: false,
            useFilter: true,
            gender: $cookies.get(genderCookieName),
            height: $cookies.get(heightCookieName),
            post: 0,
            limit: 18,
            offset: 0,
            tagsOn: [],
            tags: [],
            wishes: [],
            posts: [],
            showFilterModal: function(){
                $("#CatalogFilterModal").modal("show");
            },
            updateFilter: function (heightVal, genderVal) {
                if (heightVal !== undefined) {
                    $cookies.put(heightCookieName, heightVal, {path: "/"});
                }
                if (genderVal !== undefined) {
                    $cookies.put(genderCookieName, genderVal, {path: "/"});
                }
                if (heightVal !== $scope.height || genderVal !== $scope.gender) {
                    $scope.resetPosts();
                }
                $("#CatalogFilterModal").modal("hide");
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
            backList: function () {
                let temp = $scope.offset;
                temp -= $scope.limit;
                console.log(temp);
                if (temp >= 0) {
                    $scope.resetPosts(temp);
                }
            },
            forwardList: function () {
                let temp = $scope.offset;
                temp += $scope.limit;
                console.log($scope.offset, temp);
                if (temp <= $scope.pages.length * $scope.limit) {
                    $scope.resetPosts(temp);
                }
            },
            resetPosts: function (offset) {
                if (!offset) {
                    offset = 0;
                }
                let tags = [];

                if ($scope.useFilter) {
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
                    $scope.offset = res.data.offset;
                    $scope.fetched = true;
                    $scope.gender = $scope.genderTemp = res.data.gender;
                    $scope.height = $scope.heightTemp = res.data.height;
                    if ($scope.heightTemp === 0) {
                        $scope.heightTemp = undefined;
                    }

                    let newHash = 'HeadTop';
                    if ($location.hash() !== newHash) {
                        $location.hash('HeadTop');
                    } else {
                        $anchorScroll();
                    }
                });
            },

        });
        $scope.resetPosts();

        function updateTags() {
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
    });