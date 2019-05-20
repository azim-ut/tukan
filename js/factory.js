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
    .factory('AuthFactory', function ($resource) {
        return $resource('/web/rest', null, {
            register: {
                method: 'POST',
                url: "/web/rest/auth/new",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
            login: {
                method: 'POST',
                url: "/core/rest/user/login",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
            update: {
                method: 'GET',
                url: "/web/rest/auth/check",
                isArray: false
            },
            resetPassword: {
                method: 'GET',
                url: "/web/rest/auth/resetPwd",
                isArray: false
            },
            logout: {
                method: 'GET',
                url: "/web/rest/auth/logout",
                isArray: false
            }
        })
    });