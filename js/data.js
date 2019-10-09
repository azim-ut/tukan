angular.module('root')
    .factory("Data", function () {
        angular.extend(this, {
            user: {},
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