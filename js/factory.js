angular.module('root')
    .factory('ViewFactory', function ($resource) {
        return $resource('/web/rest', null, {
            tags: {
                method: 'GET',
                url: "/web/rest/tags/all",
                isArray: false
            },
            posts: {
                method: 'POST',
                url: "/web/rest/posts/list",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
            product: {
                method: 'GET',
                url: "/web/rest/posts/product/:id",
                isArray: false
            }
        })
    })
    .factory('OrdersFactory', function ($resource) {
        return $resource('/web/rest', null, {
            add: {
                method: 'GET',
                url: "/web/rest/order/add/:id",
                isArray: false
            },
            del: {
                method: 'GET',
                url: "/web/rest/order/del/:id",
                isArray: false
            },
            ids: {
                method: 'GET',
                url: "/web/rest/order/ids",
                isArray: false
            },
            list: {
                method: 'GET',
                url: "/web/rest/order/list",
                isArray: false
            }
        });
    })
    .factory('WishFactory', function ($resource) {
        return $resource('/web/rest', null, {
            add: {
                method: 'GET',
                url: "/web/rest/wish/add/:id",
                isArray: false
            },
            del: {
                method: 'GET',
                url: "/web/rest/wish/del/:id",
                isArray: false
            },
            ids: {
                method: 'GET',
                url: "/web/rest/wish/ids",
                isArray: false
            },
            list: {
                method: 'GET',
                url: "/web/rest/wish/list",
                isArray: false
            }
        });
    })
    .factory('CartFactory', function ($resource) {
        return $resource('/web/rest', null, {
            add: {
                method: 'GET',
                url: "/web/rest/cart/ids/add/:id",
                isArray: false
            },
            del: {
                method: 'GET',
                url: "/web/rest/cart/del/:id",
                isArray: false
            },
            idsDel: {
                method: 'GET',
                url: "/web/rest/cart/ids/del/:id",
                isArray: false
            },
            ids: {
                method: 'GET',
                url: "/web/rest/cart/ids",
                isArray: false
            },
            list: {
                method: 'GET',
                url: "/web/rest/cart/list",
                isArray: false
            },
            submit: {
                method: 'POST',
                url: "/web/rest/cart/submit",
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
                url: "/web/rest/auth/login",
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