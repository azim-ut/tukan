angular.module('root')
    .controller("TranslateController", function ($scope, $rootScope, $controller, $timeout, ToastService, TranslateFactory, CoreFactory) {
        angular.extend($scope, {
            list: [],
            pattern: undefined,
            create: function (key) {
                TranslateFactory.create({}, $.param({key: key})).$promise.then(function (res) {
                    $scope.list = res.data;
                });
            },
            update: function (id, en_US, ru_RU, et_EE) {
                TranslateFactory.update({}, $.param({id: id, en_US:en_US, ru_RU:ru_RU, et_EE:et_EE})).$promise.then(function (res) {
                    $scope.list = res.data;
                });
            },
            copyToClipboard: function (event) {
                let text = $(event.currentTarget).find("b").text();
                let $temp = $("<input>");
                $("body").append($temp);
                $temp.val(text).select();
                document.execCommand("copy");
                $temp.remove();
                ToastService.info("Copied the text: " + text);
            },
            delete: function (id, code) {
                if(confirm("A you sure? Delete the \"" + code + "\" ?"))
                TranslateFactory.delete({id: id}).$promise.then(function (res) {
                    $scope.list = res.data;
                });
            },
            searchPlace: function () {
                let x = "AAABBBCCC";
                x.match(/(AAA|CCC)/);
                return 1;
            },
            getAll: function () {
                TranslateFactory.all().$promise.then(function (res) {
                    console.log(res.data);
                    $scope.list = res.data;
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
            delete: {
                method: 'DELETE',
                url: "/core/rest/translate/item/:id",
                isArray: false,
            },
            all: {
                method: 'GET',
                url: "/core/rest/translate/all",
                isArray: false,
            },
        })
    });