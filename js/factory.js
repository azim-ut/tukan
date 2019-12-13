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
            },
            advices: {
                method: 'POST',
                url: "/shop/rest/posts/advices",
                params: {
                    id: '@id',
                    size: '@size',
                    gender: '@gender'
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
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
    .factory('PayFactory', function ($resource) {
        return $resource('/shop/rest', null, {
            init: {
                method: 'POST',
                url: "/shop/rest/ep/init",
                isArray: false,
                headers: {'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
            }
        });
    })
    .factory('CartFactory', function ($resource) {
        return $resource('/shop/rest', null, {
            couponNext: {
                method: 'POST',
                url: "/shop/rest/cart/coupon/next",
                isArray: false
            },
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
            cart: {
                method: 'GET',
                url: "/shop/rest/cart/cart",
                isArray: false
            },
            skip_coupon: {
                method: 'GET',
                url: "/shop/rest/cart/skip/coupon",
                isArray: false
            },
            try: {
                method: 'GET',
                url: "/shop/rest/cart/try",
                isArray: false
            },
            address: {
                method: 'POST',
                url: "/shop/rest/cart/address",
                params: {
                    id: '@id'
                },
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            }
        });
    })
    .factory('CountryFactory', function ($resource) {
        return $resource('/core/rest', null, {
            countries: {
                method: 'GET',
                url: "/core/rest/countries",
                isArray: false,
            },
            regions: {
                method: 'GET',
                url: "/core/rest/countries/regions/:code",
                isArray: false,
            }
        })
    })
    .factory('CoreFactory', function ($resource) {
        return $resource('/core/rest', null, {
            addresses: {
                method: 'GET',
                url: "/core/rest/user/addresses",
                isArray: false,
            },
            addressDel: {
                method: 'DELETE',
                url: "/core/rest/user/address/:id",
                isArray: false,
            },
            address: {
                method: 'POST',
                url: "/core/rest/user/address",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
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
            },
            fbLoginLink: {
                method: 'GET',
                url: "/core/rest/facebook/login/:more",
                isArray: false
            }
        })
    });