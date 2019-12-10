
<div ng-controller="EditAddressController">

    <div class="modal fade" tabindex="-1" role="dialog" id="EditAddressForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <form ng-submit="update(data.temp)">
                    <div class="modal-header">
                        <h5 class="modal-title">Редактировать адрес</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Имя
                                </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                           ng-model="data.temp.name"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Страна
                                </label>
                                <div class="col-sm-8">
                                    <select ng-options="option.name for option in countries track by option.code"
                                            ng-change="getRegions(data.temp.countryObj.code)"
                                            class="form-control form-control-sm"
                                            ng-model="data.temp.countryObj"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Край/Область/Регион:
                                </label>
                                <div class="col-sm-8">
                                    <select ng-options="option.name for option in regions track by option.id"
                                            class="form-control form-control-sm"
                                            ng-model="data.temp.regionObj"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Город
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" ng-model="data.temp.town"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Улица, дом, квартира
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" ng-model="data.temp.address"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    &nbsp;
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" ng-model="data.temp.address_2"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Почтовый индекс:
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" ng-model="data.temp.zip"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Телефон 1:
                                </label>
                                <div class="col-sm-2">
                                    <input type="text" ng-model="data.temp.phone_code"
                                           class="form-control form-control-sm"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" ng-model="data.temp.phone_number"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Телефон 2:
                                </label>
                                <div class="col-sm-2">
                                    <input type="text" ng-model="data.temp.phone_code_2"
                                           class="form-control form-control-sm"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" ng-model="data.temp.phone_number_2"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center btn-group btn-group-justified">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="NewAddressForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <form ng-submit="update(data.temp)">
                    <div class="modal-header">
                        <h5 class="modal-title">Новый адрес</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Имя
                                </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                           ng-model="data.temp.name"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Страна
                                </label>
                                <div class="col-sm-8">
                                    <select ng-options="option.name for option in countries track by option.code"
                                            ng-change="getRegions(data.temp.countryObj.code)"
                                            class="form-control form-control-sm"
                                            ng-model="data.temp.countryObj"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Край/Область/Регион:
                                </label>
                                <div class="col-sm-8">
                                    <select ng-options="option.name for option in regions track by option.id"
                                            class="form-control form-control-sm"
                                            ng-model="data.temp.regionObj"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Город
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" ng-model="data.temp.town"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Улица, дом, квартира
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" ng-model="data.temp.address"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    &nbsp;
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" ng-model="data.temp.address_2"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Почтовый индекс:
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" ng-model="data.temp.zip"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Телефон 1:
                                </label>
                                <div class="col-4 col-sm-2">
                                    <input type="text" ng-model="data.temp.phone_code"
                                           class="form-control form-control-sm"/>
                                </div>
                                <div class="col-8 col-sm-6">
                                    <input type="text" ng-model="data.temp.phone_number"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label text-right">
                                    Телефон 2:
                                </label>
                                <div class="col-4 col-sm-2">
                                    <input type="text" ng-model="data.temp.phone_code_2"
                                           class="form-control form-control-sm"/>
                                </div>
                                <div class="col-8 col-sm-6">
                                    <input type="text" ng-model="data.temp.phone_number_2"
                                           class="form-control form-control-sm"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center btn-group btn-group-justified">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>