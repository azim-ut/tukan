angular.module('root')
    .controller("RingController", function ($scope, $rootScope, $controller, $timeout, RingFactory, CoreFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            items: null,
            searchText: null,
            places: [],
            init: function () {
            },
            ring: function () {
                let audio = new Audio("../../web/audio/desk_bell_ring.mp3");
                audio.volume = 1;
                audio.play();
                RingFactory.ring().$promise.then(function (res) {
                    $scope.places = res.data;
                });

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
    })
    .factory('RingFactory', function ($resource) {
        return $resource('/web/rest', null, {
            places: {
                method: 'GET',
                url: "/web/rest/modern/places",
                isArray: false,
            }
        })
    });