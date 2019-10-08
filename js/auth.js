angular.module('root')
    .controller("AuthBlockController", function ($scope, $controller, $interval, $anchorScroll, AuthService, AuthFactory, ToastService, $httpParamSerializer) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            tab: 'login',
            logout: AuthService.logout,
            resetPassword: function (email) {
                let params = $.param({email: email});
                return AuthFactory.resetPwd(params).$promise.then(function (res) {
                });
            },
            login: AuthService.login,
            register: AuthService.register,
            setTab: function (val) {
                $scope.tab = val;
            },
            goBack: function () {
                window.history.back();
            },
            check: function () {
                AuthService.check();
            }
        });
    });