angular.module('root')
    .controller("AuthBlockController", function ($scope, $controller, $interval, $anchorScroll, CoreFactory, ToastService, $httpParamSerializer) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            tab: 'login',
            resetPassword: function (email) {
                let params = $.param({email: email});
                return CoreFactory.resetPwd(params).$promise.then(function (res) {
                });
            },
            setTab: function (val) {
                $scope.tab = val;
            },
            goBack: function () {
                window.history.back();
            },
            register: function (name, email, pwd1, pwd2, terms) {
                let params = $.param({name: name, email: email, pwd1: pwd1, pwd2: pwd2, terms: 1});
                return CoreFactory.register(params).$promise.then(function (res) {
                    if (ToastService.check(res)) {
                        location.reload();
                    }
                });
            },
            logout: function () {
                return CoreFactory.logout().$promise.then(function (res) {
                    $scope.data.user = null;
                });
            },
            login: function (email, pwd, save) {
                return CoreFactory.login({}, {email: email, pass: pwd, save: save}).$promise.then(function (res) {
                    ToastService.check(res);
                    $scope.data.user = res.data.user;
                    location.reload();
                });
            },
            check: function () {
                return CoreFactory.check().$promise.then(function (res) {
                    $scope.data.user = null;
                    if (res.data) {
                        $scope.data.user = res.data;
                    }
                });
            },
            loginFB: function (more) {
                CoreFactory.fbLoginLink({more:more}).$promise.then(function (res) {
                    if (res.data) {
                        location.href = res.data;
                    }
                });
            }
        });
    });

function fbLogged(attr) {
    let $scope = angular.element('div[ng-controller="AuthBlockController"]').scope();
    console.log("fbLogged", attr);
    $scope.check();
}