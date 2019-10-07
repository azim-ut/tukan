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
            add: {
                method: 'GET',
                url: "/shop/rest/wish/add/:id",
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
                url: "/shop/rest/cart/add/:id",
                isArray: false
            },
            del: {
                method: 'GET',
                url: "/shop/rest/cart/del/:id",
                isArray: false
            },
            idsDel: {
                method: 'GET',
                url: "/shop/rest/cart/ids/del/:id",
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
                url: "/shop/rest/auth/login",
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