angular.module('root')
    .controller("AuthBlockController", function ($scope, $controller, $interval, $anchorScroll, AuthService, Data, ViewFactory, $httpParamSerializer) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            tab: 'login',
            logout: AuthService.logout,
            resetPassword: AuthService.resetPassword,
            login: function(email, pwd, save){
                AuthService.login(email, pwd, save, function(){
                    $("#AuthForm").modal("hide");
                });
            },
            register: AuthService.register,
            setTab: function (val) {
                $scope.tab = val;
            },
            goBack:function () {
                window.history.back();
            },
            check: function () {
                AuthService.update();
            }
    });
    });