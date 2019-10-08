angular.module('root')
    .factory("Data", function () {
        angular.extend(this, {
            user: {},
            view: null,
            cart: {
                ids: null,
                list: []
            },
            wishes: {
                ids: null,
                list: []
            }
        });
        return this;
    });