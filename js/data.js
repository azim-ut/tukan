angular.module('root')
    .factory("Data", function () {
        angular.extend(this, {
            user: {},
            view: null,
            cart: {
                ids: [],
                list: []
            },
            wishes: {
                ids: [],
                list: []
            }
        });
        return this;
    });