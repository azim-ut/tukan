angular.module('root')
    .controller("MainPageController", function ($scope, $cookies, $location, $controller, $anchorScroll, ViewFactory, $httpParamSerializer) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        let heightCookieName = "heightFilter";
        let genderCookieName = "genderFilter";
        let brandCookieName = "brandFilter";

        angular.extend($scope, {
            lastFetchInterval: null,
            loadDisabled: true,
            fetched: false,
            useFilter: true,
            gender: $cookies.get(genderCookieName),
            height: $cookies.get(heightCookieName),
            brand: $cookies.get(brandCookieName),
            post: 0,
            limit: 20,
            offset: 0,
            tagsOn: [],
            tags: [],
            wishes: [],
            posts: [],
            showFilterModal: function () {
                $("#CatalogFilterModal").modal("show");
            },
            updateFilter: function (heightVal, genderVal, brandVal) {
                if(heightVal === undefined || genderVal === undefined || brandVal === undefined){
                    return;
                }
                $cookies.put(heightCookieName, heightVal, {path: "/"});
                $cookies.put(genderCookieName, genderVal, {path: "/"});
                $cookies.put(brandCookieName, brandVal, {path: "/"});
                if (heightVal !== $scope.height || genderVal !== $scope.gender || brandVal !== $scope.brand) {
                    $scope.gender = genderVal;
                    $scope.height = heightVal;
                    $scope.brand = brandVal;
                    $scope.resetPosts();
                }
            },
            showChristmasPromo: function (row) {
                console.log(row);
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
            extendList: function () {
                if(!$scope.data.process){
                    $scope.extendPosts($scope.posts.length);
                }
            },
            extendPosts: function (offset) {
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
                    $scope.posts = $scope.posts.concat(res.data.list);
                    $scope.offset = res.data.offset;
                    $scope.fetched = true;
                    $scope.gender = $scope.genderTemp = res.data.gender;
                    $scope.height = $scope.heightTemp = res.data.height;
                    $scope.brand = $scope.brandTemp = res.data.brand;
                    console.log($scope.posts);
                });
            },
            resetPosts: function (offset) {
                if (!offset) {
                    offset = 0;
                }
                let tags = [];

                if ($scope.useFilter) {
                    tags = updateTags();
                }
                let obj = {'tags[]': tags, gender: $scope.gender, brand: $scope.brand, height: $scope.height, offset: offset, limit: $scope.limit};
                let p = $httpParamSerializer(obj);
                $scope.data.process = true;
                ViewFactory.posts(p).$promise.then(function (res) {
                    $scope.pages = res.data.pages;
                    $scope.total = res.data.total;
                    $scope.posts = res.data.list;
                    $scope.offset = res.data.offset;
                    $scope.fetched = true;
                    $scope.gender = $scope.genderTemp = res.data.gender;
                    $scope.height = $scope.heightTemp = res.data.height;
                    $scope.brand = $scope.brandTemp = res.data.brand;

                    let newHash = 'HeadTop';
                    if ($location.hash() !== newHash) {
                        // $location.hash('HeadTop');
                    } else {
                        //$anchorScroll();
                    }
                    $scope.data.process = false;
                });
            },

        });
        let startBrand = findGetParameter('brand');
        if(startBrand){
            $scope.brand = startBrand;
        }
        let startGender = findGetParameter('gender');
        if(startGender){
            $scope.height = $scope.heightTemp = 0;
            $scope.brand = $scope.brandTemp = 0;
            $scope.gender = startGender;
        }
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

$(function(){
    setMinHeight();
});
function setMinHeight(){
    console.log(window.innerHeight);
    $(".HeadContentPage").css("min-height", (3*window.innerHeight)/4+"px");
}
window.onresize = function(){
    setMinHeight();
};