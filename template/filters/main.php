<? use assets\services\TagsService;
use assets\services\WebCatalogService;
use core\Engine;
use core\manager\ParamsManager;
use core\service\App;

include_once __DIR__ . "/../nav/start.php" ?>

<?
$ts     = TagsService::getInstance();
$main   = Engine::getInstance();
$age    = ParamsManager::getParamDef("a", "4");
$gender = ParamsManager::getParamDef("g", TagsService::$GENDER_BOY);
$types  = $ts->getClothesTypeTags();


if(!$ts->isAgeExists($age, $gender) || !$ts->isValidGender($gender)){
    include_once __DIR__."/../404.php";

    return;
}
$tags = $ts->getHeightTagsByAge($age, $gender);
array_push($tags, $gender);
$posts = WebCatalogService::getInstance()->getPosts('publish', $tags);

?>


    <div id="content" class="section-element desktop-margin-top-100 nasa-clear-both" ng-controller="MainPageController"
         ng-cloak>
        <div class="row" ng-if="false">
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Рост:</span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-4 text-center">
                    <ul style="display: inline-flex; margin: 0;">
                        <li class="gender boy {{row.on?'on':''}}" ng-click="setGender('boy')"
                            ng-if="row.group=='gender'">&nbsp;
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
        <div class="row">
            <div class="nasa-col large-12 columns right">
                <div class="wpb_wrapper">

                    <div class="products woocommerce">

                        <div class="inner-content">
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="row">
                                        <div ng-repeat="row in posts" class="col-sm-2">
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
    </div>

<? include_once __DIR__ . "/../nav/footer.php" ?>