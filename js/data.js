angular.module('root')
    .factory("Data", function () {
        angular.extend(this, {
            user: {},
            locale: document.documentElement.lang,
            view: null,
            cart: {
                ids: null,
                data: null
            },
            wishes: {
                ids: null,
                list: []
            }
        });
        return this;
    });