angular.module('root')
    .service('ProductService', function ($http, Data, $interval, ViewFactory, WishFactory) {
        let fetchTimer = null;
        angular.extend(this, {
            fetchData: function (productId) {
                ViewFactory.product({id: productId}).$promise.then(function (res) {
                    Data.view = res.data;
                });
            }
        });
    })
    .service('WishesService', function ($http, Data, WishFactory) {
        let fetched = false;
        angular.extend(this, {
            fetchList: function () {
                // if(!fetched){
                fetched = true;
                WishFactory.list().$promise.then(function (res) {
                    Data.wishes.list = res.data;
                });
                // }
            },
            fetchIds: function () {
                if (!fetched) {
                    fetched = true;
                    WishFactory.ids().$promise.then(function (res) {
                        Data.wishes.ids = res.data;
                    })
                }
            },
            remove: function (id) {
                fetched = false;
                WishFactory.del({id: id}).$promise.then(function (res) {
                    Data.wishes.ids = res.data;
                })
            },
            add: function (id) {
                fetched = false;
                WishFactory.add({id: id}).$promise.then(function (res) {
                    Data.wishes.ids = res.data;
                })
            }
        });
    })
    .service('AuthService', function ($http, Data, $interval, AuthFactory, ToastService) {
        angular.extend(this, {
            register: function (name, email, pwd1, pwd2, terms) {
                let params = $.param({name: name, email: email, pwd1: pwd1, pwd2: pwd2, terms: 1});
                return AuthFactory.register(params).$promise.then(function (res) {
                    if (ToastService.check(res)) {
                        location.reload();
                    }
                });
            },
            logout: function () {
                return AuthFactory.logout().$promise.then(function (res) {
                    Data.user = null;
                });
            },
            login: function (email, pwd, save) {
                let params = $.param({email: email, pass: pwd, save: save});
                return AuthFactory.login(params).$promise.then(function (res) {
                    ToastService.check(res);
                    Data.user = res.data.user;
                    location.reload();
                });
            },
            check: function () {
                return AuthFactory.check().$promise.then(function (res) {
                    Data.user = null;
                    if (res.data) {
                        Data.user = res.data;
                    }
                });
            }
        });
    })
    .service("ToastService", function () {
        this.isValid = function (res) {
            try {
                return this.check(res);
            } catch (e) {
                console.log(e.code);
            }
            return false;
        },
            this.check = function (data) {
                this.show(data.status, data.msg ? data.msg : data.info);

                if (data.code !== 200) {
                    throw data.code;
                }
                if (data.status === "Error") {
                    throw 500;
                }
                return true;
            },
            this.show = function (type, title, msg) {
                type = type.lowercase;
                if (toastr) {
                    toastr.options = {
                        closeButton: true,
                        positionClass: 'toast-top-left',
                        onclick: null,
                        showDuration: 1000,
                        hideDuration: 1000,
                        timeOut: 8000,
                        extendedTimeOut: 1000,
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut"
                    };
                    var $toast = null;
                    if (type === "success") {
                        $toast = toastr.success(msg, title);
                    } else if (type === "error") {
                        $toast = toastr.error(msg, title);
                    } else if (type === "warning") {
                        $toast = toastr.warning(msg, title);
                    } else {
                        $toast = toastr.info(msg, title);
                    }

                    var $toastlast = $toast;
                    $('#clearlasttoast').click(function () {
                        toastr.clear($toastlast);
                    });
                }
            }
    });