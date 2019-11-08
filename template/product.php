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
<div ng-controller="ProductController">
    <div class="large-12 columns margin-bottom-50 nasa-single-product-scroll nasa-single-product-2-columns HeadContentPage"
         data-num_main="2"
         data-num_thumb="4"
         data-speed="300">
        <div class="row ProductInfo">

            <div class="large-5 small-12 columns product-gallery rtl-right">

                <div class="images">
                    <div class="row">
                        <div class="large-12 columns">
                            <more-button product="<?=$id?>"></more-button>
                            <ul id="imageGallery">
                                <?
                                foreach($post->images as $image){
                                    ?>
                                    <li data-thumb="/<?=$image->path?>"
                                        data-src="/<?=$image->path?>">
                                        <div class="imageProductBlock" style="background: transparent url(/<?=$image->path?>) no-repeat center center/contain;"

                                        ></div>
                                    </li>
                                    <?
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="large-7 small-12 columns product-info rtl-left">
                <div class="nasa-product-info-wrap">
                    <div class="nasa-product-info-scroll" style="margin-top: 0px; overflow-y: inherit;">
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
                                <div class="btn-group btn-group-justified">
                                    <div class="btn-group" ng-if="false">
                                        <button type="button" class="btn btn-lg btn-danger">Купить сейчас</button>
                                    </div>
                                    <div class="btn-group" style="width: 2px;">
                                        <button type="button" class="btn btn-lg btn-default" ng-click="goBack()">
                                            <i class="icon-arrow-left"></i>
                                        </button>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" ng-click="toCart(<?=$id?>, size, <?=$post->gender?>)"
                                                class="btn btn-lg btn-warning">В корзину
                                        </button>
                                    </div>
                                    <div class="btn-group" style="width: 2px;">
                                        <button type="button" class="btn btn-lg btn-default"
                                                ng-click="toggleProductWish(<?=$id?>)">
                                            <span ng-if="wished"><i class="glyphicon glyphicon-heart text-danger"></i> {{totalWished}}</span>
                                            <span ng-if="!wished"><i class="glyphicon glyphicon-heart-empty"></i> <span
                                                        ng-if="totalWished>0">{{totalWished}}</span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row margin-top-30" style="overflow: hidden;">
                            <div>
                                <h5>С этим товаром часто смотрят:</h5>
                                <br/>
                            </div>
                            <?foreach($more as $item){?>
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
                            <?}?>
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
                    <table width="100%">
                        <tr>
                            <td width="1%" class="text-center">
                                <div style="
                                        background: transparent url(<?=$post->images[0]->path?>) no-repeat center center/contain;
                                        border: #c3cc36 1px solid; margin: 4px; padding: 5px;
                                        width: 100px; height: 100px;"></div>
                                <?=$post->post_title?><br/>
                                &euro; <?=$post->price?><br/>
                                <b>Товар добавлен к корзину</b>
                            </td>
                            <td style="width: 5px;padding: 10px 25px;">
                                <div style="border-left: #9cc2cb 1px solid; height: 150px;">&nbsp;</div>
                            </td>
                            <td>
                                <div class="row">
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
                                <hr/>
                                <div>
                                    <button type="button" class="btn btn-default" ng-click="closeAdvices()">Перейти к сайту</button>
                                    <a href="/cart"><button type="button" class="btn btn-danger">Перейти в корзину</button></a>
                                </div>
                            </td>
                        </tr>
                    </table>
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