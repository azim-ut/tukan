angular.module('root')
    .controller("ModernLandingController", function ($scope, $rootScope, $controller, $timeout, ModernFactory, CoreFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            items: null,
            searchText: null,
            places: [],
            init: function () {
                $scope.placesList();
            },
            searchPlace: function () {
                let x = "AAABBBCCC";
                x.match(/(AAA|CCC)/);
                return 1;
            },
            placesList: function () {
                ModernFactory.places().$promise.then(function (res) {
                    $scope.places = res.data;
                });
            },
            loginFB: function () {
                CoreFactory.fbLoginLink().$promise.then(function (res) {
                    if (res.data) {
                        location.href = res.data;
                    }
                });
            }
        });

        $scope.$on("prizeWon", function (event, data) {
            $timeout(function () {
                $scope.prize = $scope.temp;
            }, 2000);
        });
    })
    .factory('ModernFactory', function ($resource) {
        return $resource('/web/rest', null, {
            places: {
                method: 'GET',
                url: "/web/rest/modern/places",
                isArray: false,
            }
        })
    });