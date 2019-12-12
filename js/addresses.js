angular.module('root')
    .controller("EditAddressController", function ($scope, $rootScope, $controller, $interval, $anchorScroll, CoreFactory, CountryFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            countries: [],
            regions:[],
            closeAllForms: function(){
                $scope.closeForm('#EditAddressForm');
                $scope.closeForm('#NewAddressForm');
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
                        $rootScope.$broadcast('addressesUpdated', res.data);
                        $scope.closeAllForms();
                    }
                });
            },
            getRegions: function (code) {
                CountryFactory.regions({code:code}).$promise.then(function (res) {
                    if (res.data) {
                        $scope.regions = res.data;
                    }
                });
            },
            fetchCountries: function () {
                CountryFactory.countries().$promise.then(function (res) {
                    if (res.data) {
                        $scope.countries = res.data;
                    }
                });
            },
            openEditForm: function (event, obj) {
                console.log(event, obj);
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
            openNewForm: function(){
                $scope.openForm('#NewAddressForm');
            }
        });
        $scope.fetchCountries();

        $scope.$on('closeAddressForm', $scope.closeAllForms);
        $scope.$on('editAddressForm', $scope.openEditForm);
        $scope.$on('newAddressForm', $scope.openNewForm);
        $scope.$on('addressesUpdated', $scope.onAddressUpdated);
    })
    .controller("AddressesBlockController", function ($scope, $rootScope, $controller, $interval, $anchorScroll, CoreFactory, CountryFactory) {
        angular.extend(this, $controller("CommonController", {$scope: $scope}));
        angular.extend($scope, {
            items: null,
            showAddressEditForm: function (row) {
                $scope.editAddress = angular.copy(row);
            },
            showAddressDelForm: function (id, name) {
                if(confirm("Удалить адрес: " + name + "?")){
                    $scope.delAddress(id);
                }
            },
            openEditForm: function (obj) {
                $rootScope.$broadcast('editAddressForm', obj);
            },
            openNewAddressForm: function () {
                $rootScope.$broadcast('newAddressForm', obj);
            },
            delAddress: function (id) {
                CoreFactory.addressDel({id:id}).$promise.then(function (res) {
                    if (res.data) {
                        $scope.$broadcast('addressesUpdated', {});
                    }
                });
            },
            onAddressUpdated: function(event, args){
                    CoreFactory.addresses().$promise.then(function (res) {
                        $scope.list = res.data;
                        $rootScope.$broadcast('closeAddressForm', $scope.onAddressUpdated);
                    });
            }
        });
        $scope.$on("addressesUpdated", $scope.onAddressUpdated);
        $scope.$broadcast('addressesUpdated', $scope.onAddressUpdated);
    });
