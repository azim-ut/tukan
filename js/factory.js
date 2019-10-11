angular.module('root')
    .factory('ViewFactory', function ($resource) {
        return $resource('/shop/rest', null, {
            tags: {
                method: 'GET',
                url: "/shop/rest/tags/all",
                isArray: false
            },
            posts: {
                method: 'POST',
                url: "/shop/rest/posts/list",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
            product: {
                method: 'GET',
                url: "/shop/rest/posts/product/:id",
                isArray: false
            }
        })
    })
    .factory('OrdersFactory', function ($resource) {
        return $resource('/shop/rest', null, {
            add: {
                method: 'GET',
                url: "/shop/rest/order/add/:id",
                isArray: false
            },
            del: {
                method: 'GET',
                url: "/shop/rest/order/del/:id",
                isArray: false
            },
            ids: {
                method: 'GET',
                url: "/shop/rest/order/ids",
                isArray: false
            },
            list: {
                method: 'GET',
                url: "/shop/rest/order/list",
                isArray: false
            }
        });
    })
    .factory('WishFactory', function ($resource) {
        return $resource('/shop/rest', null, {
            toggle: {
                method: 'GET',
                url: "/shop/rest/wish/toggle/:id",
                isArray: false
            },
            add: {
                method: 'GET',
                url: "/shop/rest/wish/add/:id",
                isArray: false
            },
            total: {
                method: 'GET',
                url: "/shop/rest/wish/total/:post",
                isArray: false
            },
            del: {
                method: 'GET',
                url: "/shop/rest/wish/del/:id",
                isArray: false
            },
            ids: {
                method: 'GET',
                url: "/shop/rest/wish/ids",
                isArray: false
            },
            list: {
                method: 'GET',
                url: "/shop/rest/wish/list",
                isArray: false
            }
        });
    })
    .factory('CartFactory', function ($resource) {
        return $resource('/shop/rest', null, {
            add: {
                method: 'POST',
                url: "/shop/rest/cart/add",
                params: {
                    post: '@post',
                    size: '@size'
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                isArray: false
            },
            del: {
                method: 'POST',
                url: "/shop/rest/cart/del",
                params: {
                    post: '@post',
                    size: '@size'
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                isArray: false
            },
            ids: {
                method: 'GET',
                url: "/shop/rest/cart/ids",
                isArray: false
            },
            list: {
                method: 'GET',
                url: "/shop/rest/cart/list",
                isArray: false
            },
            submit: {
                method: 'POST',
                url: "/shop/rest/cart/submit",
                params: {
                    address: '@address'
                },
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            }
        });
    })
    .factory('AuthFactory', function ($resource) {
        return $resource('/core/rest', null, {
            register: {
                method: 'POST',
                url: "/core/rest/user/new",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
            login: {
                method: 'POST',
                url: "/core/rest/user/login",
                params: {
                    email: '@email',
                    pass: '@pass',
                    save: '@save'
                },
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
            check: {
                method: 'GET',
                url: "/core/rest/user/check",
                isArray: false
            },
            resetPwd: {
                method: 'POST',
                url: "/core/rest/user/reset/pwd",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
            logout: {
                method: 'GET',
                url: "/core/rest/user/logout",
                isArray: false
            }
        })
    });