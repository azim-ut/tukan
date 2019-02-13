angular.module('root')
    .controller("PresetsController", function ($scope, $httpParamSerializer, AdminPresetsFactory) {
        new ClipboardJS('.btn');
        angular.extend($scope, {
            list: [],
            edit: null,
            showEditForm: function (row) {
                $scope.edit = angular.copy(row);
                $("#EditPresetForm").modal("show");
            },
            removePreset: function (row) {
                if (confirm("Удалить пресет: " + row.text)) {
                    AdminPresetsFactory.delPreset({id:row.id}).$promise.then(function(res){
                        $scope.fetchList();
                    });
                }
            },
            fetchList: function () {
                AdminPresetsFactory.getList().$promise.then(function (res) {
                    $scope.list = res.data;
                });
            },
            editPreset: function (id, text, sort) {
                var obj = {id: id, text: text, sort: sort};
                var p = $httpParamSerializer(obj);
                AdminPresetsFactory.editPreset(p).$promise.then(function (res) {
                    $scope.fetchList();
                    $("#EditPresetForm").modal("hide");
                });
            },
            createPreset: function (text) {
                var obj = {text: text};
                var p = $httpParamSerializer(obj);
                AdminPresetsFactory.addPreset(p).$promise.then(function (res) {
                    $scope.fetchList();
                    $("#NewPresetForm").modal("hide");
                });
            },
            delPreset: function (id) {
                AdminPresetsFactory.delPreset(id).$promise.then(function (res) {
                    $scope.fetchList();
                });
            }
        });
    });