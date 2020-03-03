angular.module('root')
    .controller("RingController", function ($scope, $rootScope, $controller, $timeout, RingFactory, CoreFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            items: null,
            searchText: null,
            bonus: {},
            places: [],
            init: function () {
                $scope.fetchGeneralBonus();
            },
            ring: function () {
                let audio = new Audio("../../web/audio/desk_bell_ring.mp3");
                audio.volume = 1;
                audio.play();
                RingFactory.ring().$promise.then(function (res) {
                    $scope.places = res.data;
                });

            },
            fetchGeneralBonus: function () {
                RingFactory.bonus().$promise.then(function (res) {
                    $scope.bonus = res.data;
                });
            },
            placesList: function () {
                ModernFactory.places().$promise.then(function (res) {
                    $scope.places = res.data;
                });
            },
            loginFB: function () {
                CoreFactory.fbStateLoginLink({state: "fb_ring"}).$promise.then(function (res) {
                    if (res.data) {
                        location.href = res.data;
                    }
                });
            }
        });
    })
    .factory('RingFactory', function ($resource) {
        return $resource('/shop/rest', null, {
            bonus: {
                method: 'GET',
                url: "/shop/rest/ring/bonus/general",
                isArray: false,
            },
            ring: {
                method: 'GET',
                url: "/shop/rest/ring",
                isArray: false,
            }
        })
    });