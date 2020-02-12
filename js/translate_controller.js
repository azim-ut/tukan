angular.module('root')
    .controller("TranslateController", function ($scope, $rootScope, $controller, $timeout, ModernFactory, CoreFactory) {
        angular.extend($scope, {
            list: [],
            init: function () {
                $scope.placesList();
            },
            searchPlace: function () {
                let x = "AAABBBCCC";
                x.match(/(AAA|CCC)/);
                return 1;
            },
            getAll: function () {
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
    .factory('TranslateFactory', function ($resource) {
        return $resource('/web/rest', null, {
            update: {
                method: 'POST',
                url: "/core/rest/translate/update",
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                isArray: false,
            },
            create: {
                method: 'POST',
                url: "/core/rest/translate/create",
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                isArray: false,
            },
            remove: {
                method: 'GET',
                url: "/core/rest/translate/remove/:id",
                isArray: false,
            },
            all: {
                method: 'GET',
                url: "/core/rest/translate/all",
                isArray: false,
            },
        })
    });