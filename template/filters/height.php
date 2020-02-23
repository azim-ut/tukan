<? use assets\services\TagsService;
use assets\services\WebCatalogService;
use core\Engine;
use core\manager\ParamsManager;
use core\service\TranslateService;

include_once __DIR__ . "/../nav/start.php" ?>

<?
$ts     = TagsService::getInstance();
$main   = Engine::getInstance();
$age    = ParamsManager::getParamDef("a", "4");
$gender = ParamsManager::getParamDef("g", TagsService::$GENDER_BOY);
$types  = $ts->getClothesTypeTags();


if(!$ts->isAgeExists($age, $gender) || !$ts->isValidGender($gender)){
    include_once "404.php";

    return;
}
$tr = TranslateService::getInstance();
$tags = $ts->getHeightTagsByAge($age, $gender);
array_push($tags, $gender);
$posts = WebCatalogService::getInstance()->getPosts('publish', $tags);
?>


    <div id="content" class="section-element desktop-margin-top-100 nasa-clear-both" ng-controller="MainPageController" ng-cloak>

        <div class="row filterPostsStore">
            <div class="col-sm-4 text-center">
                <ul style="display: inline-flex; margin: 0;">
                    <li class="gender {{row.slug}} {{row.on?'on':''}}"
                        ng-click="clickOnTag(row)"
                        ng-repeat="row in tags"
                        ng-if="row.group=='gender'">&nbsp;
                    </li>
                </ul>
            </div>
            <div class="col-sm-8">
                <div class="text-center" style="margin: 5px 0 10px;"><?=$tr->get("HEIGHT")?>: {{height|num}} см</div>
                <div class="slidecontainer">
                    <input type="range" min="1" max="100" value="50" class="slider" id="myRange" ng-model="heightP"
                           ng-change="setHeight()">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="nasa-col large-12 columns right">
                <div class="wpb_wrapper">

                    <div class="products woocommerce" ng-scroll="checkScroll">

                        <div class="inner-content">
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="row">
                                        <div ng-repeat="row in posts" class="col-sm-4">
                                            <product-preview id="row.id"
                                                             title="row.title"
                                                             img="row.img"
                                                             price="row.price"
                                                             fullprice="row.fullprice"></product-preview>
                                        </div>
                                        <div class="row text-center"
                                             ng-if="!posts.length && fetched && !data.process">
                                            <div class="subProduct"
                                                 style="width: 100%; height: 350px; background: transparent url(/web/img/empty_list_2.png) no-repeat center center/contain; border: none;">

                                            </div>
                                            <hr/>
                                            <br/>
                                            <br/>
                                            <div class="row" style="padding: 40px;">
                                                <div class="col-xs-5 text-center" style="padding: 20px 0;">
                                                    <i class="glyphicon glyphicon-phone"></i>&nbsp;<a
                                                            href="tel:+37258185225" style="font-size: 100%;">(372)
                                                        5818 5225</a>
                                                </div>
                                                <div class="col-xs-2 text-center" style="padding: 20px 0;">
                                                    |
                                                </div>
                                                <div class="col-xs-5" style="padding: 10px 0;">
                                                    <a href="//www.facebook.com/groups/1152263238270402/">
                                                        <button class="btn btn-circle btn-block facebook-button">
                                                            <i class="icon-social-facebook"></i>
                                                        </button>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="large-12 columns text-center margin-top-40 margin-bottom-20">
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

<? include_once __DIR__ . "/../nav/footer.php" ?>