<? use core\Engine;
use core\utils\SafeUtils;

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

    <div class="large-12 columns nasa-single-product-scroll nasa-single-product-2-columns"
         data-num_main="2"
         ng-controller="ProductController"
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
                                    <li data-thumb="<?=$image->path?>"
                                        data-src="<?=$image->path?>">
                                        <div class="imageProductBlock" style="background: transparent url(<?=$image->path?>) no-repeat center center/contain;"

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
                                    <td>
                                        <? if($post->gender === 3 || $post->gender === 1){ ?>
                                            <div style="height: 45px; width: 40px; float: left; background: transparent url('/web/img/boy_girl.png') no-repeat center 0px;"></div>
                                        <? } ?>
                                        <? if($post->gender === 3 || $post->gender === 2){ ?>
                                            <div style="height: 45px; width: 40px; float: left; background: transparent url('/web/img/boy_girl.png') no-repeat center -55px;"></div>
                                        <? } ?>
                                    </td>
                                    <td width="30%">
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
                                        <button type="button" ng-click="toCart(<?=$id?>, size)"
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

                        <div class="woocommerce-product-details__short-description">
                            <p>
                                &nbsp<?=$post->content()?>
                            <table class="table table-striped" style="background: #fff; border: #ccc 2px solid;">
                                <?
                                foreach($post->contains() as $materialRow){
                                    foreach($materialRow as $material => $percents){
                                        ?>
                                        <tr>
                                            <td><?=$material?></td>
                                            <td><?=$percents?>%</td>
                                        </tr>
                                        <?
                                    }
                                }
                                ?>
                            </table>
                            </p>
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

<? include_once __DIR__ . "/nav/footer_empty.php" ?>