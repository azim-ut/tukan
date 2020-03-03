<? use assets\services\TagsService;
use assets\services\WebCatalogService;
use core\Engine;
use core\manager\ParamsManager;
use core\service\TranslateService;

include_once __DIR__ . "/../nav/start.php" ?>

<?
$ts     = TagsService::getInstance();
$age    = ParamsManager::getParamDef("a", "4");
$gender = ParamsManager::getParamDef("g", TagsService::$GENDER_BOY);
$types  = $ts->getClothesTypeTags();


if(!$ts->isAgeExists($age, $gender) || !$ts->isValidGender($gender)){
	include_once __DIR__ . "/../404.php";

	return;
}
$tr = TranslateService::getInstance();
$tags = $ts->getHeightTagsByAge($age, $gender);
$brand = ParamsManager::getParam("brand");
$gender = ParamsManager::getParam("gender");

if(Engine::getDir(0) === 'girls'){
    $gender = 2;
}else if(Engine::getDir(0) === 'boys'){
    $gender = 1;
}


array_push($tags, $gender);
$filter = new CatalogFilter();
if($brand){
    $filter->brand($brand);
}
if($gender){
    $filter->gender($gender);
}
$posts  = WebCatalogService::getInstance()->getPosts($filter, $tags);
?>


    <div id="content" ng-controller="MainPageController" ng-cloak>
		<? require "main_filters.php" ?>
        <div class="margin-bottom-20 overflow">
            <product-preview style="height: 200px;"
                             ng-repeat="row in posts track by $index"
                             product="row"
                             index="$index"></product-preview>



            <div class="row text-center"
                 style="background: #fff;"
                 ng-if="!posts.length && fetched && !data.process">
                <div class="subProduct"
                     style="width: 100%; height: 350px; background: transparent url(/web/img/empty_list_2.png) no-repeat center center/contain; border: none;">
                </div>
            </div>
        </div>

        <button class="btn btn-danger btn-block margin-bottom-20 margin-top-10"
                ng-if="total > posts.length"
                ng-click="extendList()">
            <i class="glyphicon glyphicon-plus"></i> Еще {{total - posts.length}}
        </button>

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
                                <span class="input-group-addon" id="basic-addon1"><?=$tr->get("HEIGHT")?></span>
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