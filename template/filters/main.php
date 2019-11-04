<? use assets\services\TagsService;
use assets\services\WebCatalogService;
use core\Engine;
use core\manager\ParamsManager;

include_once __DIR__ . "/../nav/start.php" ?>

<?
$ts     = TagsService::getInstance();
$main   = Engine::getInstance();
$age    = ParamsManager::getParamDef("a", "4");
$gender = ParamsManager::getParamDef("g", TagsService::$GENDER_BOY);
$types  = $ts->getClothesTypeTags();


if(!$ts->isAgeExists($age, $gender) || !$ts->isValidGender($gender)){
	include_once __DIR__ . "/../404.php";

	return;
}
$tags = $ts->getHeightTagsByAge($age, $gender);
array_push($tags, $gender);
$filter = new CatalogFilter();
$posts  = WebCatalogService::getInstance()->getPosts($filter, $tags);
?>


    <div id="content" class="section-element desktop-margin-top-100 nasa-clear-both" ng-controller="MainPageController"
         ng-cloak>
    <? require "main_filters.php"?>
    <div class="row" style="border-top: #b9c5c2 1px solid; border-left: #b9c5c2 1px solid;">
        <div class="nasa-col large-12 columns right">
            <div class="wpb_wrapper">

                <div class="products woocommerce">

                    <div class="inner-content">
                        <div class="row">
                            <div class="large-12 columns">

                                <div class="row">
                                    <div ng-repeat="row in posts" class="col-sm-2 col-xs-6" style="padding: 0px;">
                                        <product-preview id="row.id"
                                                         title="row.title"
                                                         img="row.img"
                                                         price="row.price"
                                                         fullprice="row.price"></product-preview>
                                    </div>

                                    <div class="row text-center"
                                         style="background: #fff;"
                                         ng-if="!posts.length && fetched && !data.process">
                                        <div class="subProduct"
                                             style="width: 100%; height: 350px; background: transparent url(/web/img/empty_list_2.png) no-repeat center center/contain; border: none;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <? require "main_filters.php"?>

    <div class="modal fade" tabindex="-1" id="CatalogFilterModal" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <form ng-submit="updateFilter(heightTemp, genderTemp)">
                <div class="modal-content" style="padding: 10px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Фильтр:</h4>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Рост</span>
                            <input type="text" class="form-control"
                                   ng-model="heightTemp"
                                   placeholder="Укажите рост ребенка"
                                   aria-describedby="basic-addon1">
                            <span class="input-group-addon" id="basic-addon1">cm</span>
                        </div>
                        <div class="row margin-top-30 margin-bottom-30">
                            <select ng-model="genderTemp" class="form-control">
                                <option ng-selected="genderTemp===2">Для девочек</option>
                                <option ng-selected="genderTemp===1">Для мальчиков</option>
                                <option ng-selected="genderTemp===3 || genderTemp==0">Для мальчиков и девочек
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Применить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

<? include_once __DIR__ . "/../nav/footer.php" ?>