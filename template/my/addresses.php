<? use core\exception\BadResultException;
use core\exception\NoUserException;
use core\manager\UserManager;
use core\service\CountriesService;

try{
    $user = UserManager::current();
    if(!$user){
        throw new NoUserException();
    }
}catch(NoUserException | BadResultException $e){
    header("Location: /");
    exit();
}
$countries = CountriesService::getInstance()->getCountries2();
include_once __DIR__ . "/../nav/start.php";
?>
    <script type="text/javascript" src="/web/js/addresses.js?t=<?=$version?>"></script>

    <div ng-controller="AddressesBlockController" ng-cloak class="HeadContentPage">
        <div class="container">
            <div class="row">

                <div class="col-sm-3 margin-bottom-15">
                    <? require_once "menu.php" ?>
                </div>

                <div class="col-sm-9">
                    <button type="button"
                            class="btn btn-success btn-lg"
                            ng-click="openForm('#NewAddressForm')">Добавить адрес
                    </button>
                    <hr/>
                    <div class="row">
                        <div class="container">
                            <div class="col-sm-4 addressUserRow" ng-repeat="row in list">
                                <i class="fa fa-user"></i> {{row.name}}<br/>
                                <i class="fa fa-map-marker"></i> {{row.address}}<br/>
                                {{row.town}}, {{row.region}}, {{row.zip}}<br/>
                                {{row.country}}<br/>
                                <br/>
                                <div ng-if="row.phone_code && row.phone_number">
                                    <i class="fa fa-mobile-phone"></i> +{{row.phone_code}} {{row.phone_number}}<br/>
                                </div>
                                <div ng-if="row.phone_code_2 && row.phone_number_2">
                                    <i class="fa fa-mobile-phone"></i> +{{row.phone_code_2}} {{row.phone_number_2}}<br/>
                                </div>
                                <br/>
                                <br/>
                                <div class="tools">
                                    <a ng-click="openEditForm(row)" class="pointer">Редактировать</a> |
                                    <a ng-click="showAddressDelForm(row.id, row.name)" class="pointer">Удалить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


<? include_once __DIR__ . "/../nav/footer.php" ?>