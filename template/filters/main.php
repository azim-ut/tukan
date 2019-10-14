<? use assets\services\TagsService;
use assets\services\WebCatalogService;
use core\Engine;
use core\manager\ParamsManager;
use core\service\App;
use core\utils\ArrayUtils;

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
$filter  = new CatalogFilter();
$posts   = WebCatalogService::getInstance()->getPosts($filter, $tags);
?>


    <div id="content" class="section-element desktop-margin-top-100 nasa-clear-both" ng-controller="MainPageController"
         ng-cloak>

        <div class="row" ng-if="true" id="CatalogFilter" data-toggle="modal" data-target="#CatalogFilterModal">
            <div class="col-xs-1"></div>
            <div class="col-xs-5" style="border-right: #ccc 1px solid;">
                <div class="height tool">
                    <span ng-if="!height">Рост: -</span>
                    <span ng-if="height"><span class="toolsTtl">Рост: </span>{{height}}cm</span>
                </div>
            </div>
            <div class="col-xs-5">
                <div ng-if="gender===1" class="gender boy tool"></div>
                <div ng-if="gender===2" class="gender girl tool"></div>
                <div ng-if="gender===3 || gender==0" class="gender girl_boy tool"></div>
            </div>
            <div class="col-xs-1"></div>
        </div>
        <div class="row">
            <div class="nasa-col large-12 columns right">
                <div class="wpb_wrapper">

                    <div class="products woocommerce">

                        <div class="inner-content">
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="row">
                                        <div ng-repeat="row in posts" class="col-sm-2 col-xs-6" style="padding: 5px;">
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

                                    <div class="row">
                                        <div class="col-sm-4">&nbsp;</div>
                                        <div class="col-sm-4 text-center">
                                            <ul class="pagination" style="display: inline-block;">
                                                <li ng-class="{'active':row == 1}"
                                                    ng-click="resetPosts($index*limit)"
                                                    ng-repeat="row in pages track by $index">
                                                    <span class="bold">{{$index+1}}</span>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="col-sm-4">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
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
                                <div class="col-xs-4 genderBlock pointer" ng-click="genderTemp = 1">
                                    <div ng-class="{'gender boy tool':1, 'on': genderTemp === 1}"></div>
                                </div>
                                <div class="col-xs-4 genderBlock pointer" ng-click="genderTemp = 2">
                                    <div ng-class="{'gender girl tool':1, 'on':genderTemp === 2}"></div>
                                </div>
                                <div class="col-xs-4 genderBlock pointer" ng-click="genderTemp = 0">
                                    <div ng-class="{'gender girl_boy tool':1,'on':(genderTemp === 3 || genderTemp === 0)}"></div>
                                </div>
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