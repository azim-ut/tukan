angular.module('root')
    .factory("Data", function () {
        angular.extend(this, {
            user: {},
            view: null,
            wishes: {
                ids: [],
                list: []
            }
        });
        return this;
    });