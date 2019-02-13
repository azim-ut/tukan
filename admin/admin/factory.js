angular.module('root')
    .factory('AdminTagsFactory', function ($resource) {
        return $resource('/assets/rest', null, {
            allTags: {
                method: 'GET',
                url: "/assets/rest/tags/all",
                isArray: false
            },
            postTags: {
                method: 'GET',
                url: "/assets/rest/tags/posts/:post",
                isArray: false
            },
            on: {
                method: 'GET',
                url: "/assets/rest/tags/on/:post/:tag",
                isArray: false
            },
            off: {
                method: 'GET',
                url: "/assets/rest/tags/off/:post/:tag",
                isArray: false
            }
        })
    })
    .factory('AdminPostFactory', function ($resource) {
        return $resource('/assets/rest', null, {
            searchPosts: {
                method: 'POST',
                url: "/assets/rest/posts/list",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
            delPost: {
                method: 'GET',
                url: "/assets/rest/posts/del/:post",
                isArray: false
            },
            publishPost: {
                method: 'GET',
                url: "/assets/rest/posts/publish/:post",
                isArray: false
            },
            draftPost: {
                method: 'GET',
                url: "/assets/rest/posts/draft/:post",
                isArray: false
            }
        })
    })
    .factory('AdminPresetsFactory', function ($resource) {
        return $resource('/assets/rest', null, {
            getList: {
                method: 'GET',
                url: "/assets/rest/preset/list",
                isArray: false
            },
            delPreset: {
                method: 'GET',
                url: "/assets/rest/preset/del/:id",
                isArray: false
            },
            editPreset: {
                method: 'POST',
                url: "/assets/rest/preset/edit",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            },
            addPreset: {
                method: 'POST',
                url: "/assets/rest/preset/add",
                isArray: false,
                headers: {"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"}
            }
        })
    });