angular.module('root')
    .controller("AddressesBlockController", function ($scope, $controller, $interval, $anchorScroll, CoreFactory, CountryFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            items: null,
            countries: [],
            regions:[],
            fetchCountries: function () {
                CountryFactory.countries().$promise.then(function (res) {
                    if (res.data) {
                        $scope.countries = res.data;
                    }
                });
            },
            openEditForm: function (obj) {
                $scope.countries.forEach(function(val){
                    if(val.name === obj.country){
                        obj.countryObj = val;
                    }
                });
                if(obj.countryObj){
                    CountryFactory.regions({code:obj.countryObj.code}).$promise.then(function (res) {
                        if (res.data) {
                            $scope.regions = res.data;
                            $scope.regions.forEach(function(val){
                                if(val.name === obj.region){
                                    obj.regionObj = val;
                                }
                            });
                            $scope.openForm('#EditAddressForm', obj)
                        }
                    });
                }else{
                    $scope.openForm('#EditAddressForm', obj)
                }
            },
            getRegions: function (code) {
                CountryFactory.regions({code:code}).$promise.then(function (res) {
                    if (res.data) {
                        $scope.regions = res.data;
                    }
                });
            },
            showAddressEditForm: function (row) {
                $scope.editAddress = angular.copy(row);
            },
            showAddressDelForm: function (id, name) {
                if(confirm("Удалить адрес: " + name + "?")){
                    $scope.delAddress(id);
                }
            },
            delAddress: function (id) {
                CoreFactory.addressDel({id:id}).$promise.then(function (res) {
                    if (res.data) {
                        $scope.$broadcast('updateAddressesList', {});
                    }
                });
            },
            update: function (address) {
                if(address.id === undefined){
                    address.id = 0;
                }
                if(address.countryObj){
                    address.country = address.countryObj.name;
                }
                if(address.regionObj){
                    address.region = address.regionObj.name;
                }
                let params = $.param(address);
                CoreFactory.address(params).$promise.then(function (res) {
                    if (res.data) {
                        $scope.$broadcast('updateAddressesList', {});
                    }
                });
            }
        });
        $scope.fetchCountries();
        $scope.$on("updateAddressesList", function (event, args) {
            CoreFactory.addresses().$promise.then(function (res) {
                $scope.list = res.data;
                $scope.closeForm('#NewAddressForm');
                $scope.closeForm('#EditAddressForm');
            });
        });
        $scope.$broadcast('updateAddressesList', {});
    });
