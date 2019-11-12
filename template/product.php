<? use assets\services\WebCatalogService;
use core\Engine;
use core\utils\SafeUtils;
use core\utils\StringUtils;

include_once __DIR__ . "/nav/start.php" ?>

<?
$dirs = Engine::getInstance()->getDirs(1);
$id   = 0;

if(sizeof($dirs) && SafeUtils::toInteger($dirs[0], 0)){
    $id = $dirs[0] * 1;
}

if(!$id){
    ?>
    <script>location.href = "/404";</script>
    <?
}
$post = new CatalogItem($id);

$filter = new CatalogFilter();
$filter->sizes($post->enabledSizes());
$filter->gender($post->gender);
$filter->exclude($post->id);
$more = WebCatalogService::getInstance()->getPosts($filter, [], 0, 15);

$brandSrc = null;
switch($post->brand){
    case 'Original Marines':
        $brandSrc = "marines1_2.png";
        break;
    case 'To Be Too':
        $brandSrc = "to_be_too.png";
        break;
    case 'Y-Clu':
        $brandSrc = "y_clu_img.png";
        break;
    case 'Street Gang':
        $brandSrc = "street-gang.png";
        break;
    case 'Gaialuna':
        $brandSrc = "gaialuna-logo.png";
        break;
    case 'Ronnie Kay':
        $brandSrc = "ronnie-kay_logo-2.png";
        break;
}

$heights = $post->enabledHeights();
?>
    <div ng-controller="ProductController" class="container">
        <div class="margin-bottom-50 HeadContentPage container"
             data-num_main="2"
             data-num_thumb="4"
             data-speed="300">
            <div class="row ProductInfo">

                <div class="col-12 col-sm-5 columns product-gallery">

                    <div class="images">
                        <more-button product="<?=$id?>"></more-button>
                        <ul id="imageGallery">
                            <?
                            foreach($post->images as $image){
                                ?>
                                <li data-thumb="<?=$image->path?>"
                                    data-src="<?=$image->path?>">
                                    <div class="imageProductBlock"
                                         style="background: transparent url(<?=$image->path?>) no-repeat center center/contain;"

                                    ></div>
                                </li>
                                <?
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-7 product-info">

                    <div class="ProductLabel">

                        <table class="margin-bottom-0">
                            <tr>
                                <td>

                                    <h1 class="productTitle"><?=ucfirst($post->title())?></h1>
                                    <div>
                                        <b>EAN:</b> <?=$post->barcode?>
                                    </div>
                                    <div>
                                        <b>ID:</b> <?=$post->id?><br/>
                                    </div>
                                </td>
                                <td>
                                    <div class="amount text-right" style="font-size: 200%;">
                                        <b style="padding-right: 5px;">€</b><?=$post->price()?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table class="margin-bottom-0">
                            <tr>
                                <td>

                                    <? if(sizeof($heights)){ ?>
                                        <div>
                                            <b>Рост:</b>
                                            <ul class="heightList">
                                                <? foreach($post->enabledHeights() as $item){ ?>
                                                    <li ng-class="{'pointer':true, 'on': size==='<?=$item->size?>'}"
                                                        ng-click="toggleSize('<?=$item->size?>')"><?=$item->height?></li>
                                                <? } ?>
                                            </ul>
                                        </div>
                                    <? } ?>
                                </td>
                                <td class="text-right">
                                    <? if($post->gender === 3 || $post->gender === 1){ ?>
                                        <div style="height: 45px; width: 40px; float: right; background: transparent url('/web/img/boy_girl.png') no-repeat center 0px;"></div>
                                    <? } ?>
                                    <? if($post->gender === 3 || $post->gender === 2){ ?>
                                        <div style="height: 45px; width: 40px; float: right; background: transparent url('/web/img/boy_girl.png') no-repeat center -55px;"></div>
                                    <? } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <? if($brandSrc != null){ ?>
                                        <img src="/web/img/brands/<?=$brandSrc?>"/>
                                    <? } ?>
                                </td>
                            </tr>
                        </table>

                        <div class="btnRows" role="group">
                            <div class="error" ng-if="needSize" style="padding: 5px;">
                                <span ng-if="needSize === true">Пожалуйста, выберите рост</span>&nbsp;
                            </div>
                            <div class="btn-group btn-group-justified btn-block">
                                <button type="button"
                                        ng-if="false"
                                        class="btn btn-lg btn-danger btn-secondary">Купить сейчас
                                </button>
                                <button type="button" class="btn btn-lg btn-default btn-outline-secondary"
                                        ng-click="goBack()">
                                    <i class="icon-arrow-left"></i></button>
                                <button type="button" ng-click="toCart(<?=$id?>, size, <?=$post->gender?>)"
                                        class="btn btn-lg btn-warning btn-secondary">В корзину
                                </button>
                                <button type="button" class="btn btn-lg btn-outline-secondary"
                                        ng-click="toggleProductWish(<?=$id?>)">
                                        <span ng-if="wished"><i
                                                    class="fa fa-heart text-danger"></i> {{totalWished}}</span>
                                    <span ng-if="!wished"><i class="fa fa-heart-o"></i> <span
                                                ng-if="totalWished>0">{{totalWished}}</span></span></button>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="container">
                        <div class="row margin-top-30" style="overflow: hidden;">
                            <p>
                                Вы смотрите <?=mb_strtolower($post->title())?>
                                <? switch($post->gender){
                                    case 1:
                                        echo "для мальчиков.";
                                        break;
                                    case 2:
                                        echo "для девочек.";
                                        break;
                                    default:
                                        echo "для детей.";
                                        break;
                                } ?>
                                Данная модель доступна в размерах (см): <?=$post->enabledHeightsString()?>. С этим
                                товаром часто смотрят:
                            </p>
                            <div>
                                <? foreach($more as $i => $item){ ?>
                                    <div style="float: left;" class="text-center">
                                        <a href="/product/<?=$item->id?>">
                                            <div style="
                                                    background: transparent url(<?=$item->img?>) no-repeat center center/contain;
                                                    border: #c3cc36 1px solid; margin: 4px; padding: 5px;
                                                    width: 100px; height: 100px;"></div>
                                            <b><?=StringUtils::crop2($item->title, 16)?></b>
                                            <br/>&euro; <?=$item->price?>
                                        </a>
                                    </div>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="ItemAddedToCart">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3 margin-bottom-20 text-center">
                            <i class="glyphicon glyphicon-ok-circle" style="color: #c3cc36; font-size: 200%;"></i>
                            <br/>
                            <b>Товар добавлен к корзину</b>
                        </div>
                        <div class="col-sm-9 margin-bottom-20">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" ng-click="closeAdvices()">Перейти к
                                    сайту
                                </button>
                                <a href="/cart" class="btn btn-danger">Перейти в корзину</a>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <b>Вместе с этим часто покупают:</b>
                    <div class="row overflow" style="height: 140px;">
                        <div style="float: left;" class="text-center" ng-repeat="row in more">
                            <a href="/product/{{row.id}}">
                                <div style="
                                                background: transparent url({{row.img}}) no-repeat center center/contain;
                                                border: #c3cc36 1px solid; margin: 4px; padding: 5px;
                                                width: 100px; height: 100px;"></div>
                                <b>{{row.title}}</b>
                                <br/>&euro; {{row.price}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(function () {
            $('#imageGallery').lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                thumbItem: 9,
                slideMargin: 0,
                enableDrag: false,
                currentPagerPosition: 'left'
            });
        });
    </script>

<? include_once __DIR__ . "/nav/footer.php" ?>