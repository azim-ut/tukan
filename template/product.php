<? use core\Engine;

include_once __DIR__ . "/nav/start.php" ?>

<?
$dirs = Engine::getInstance()->getDirs(1);
$id   = 0;

if(sizeof($dirs)){
    $id = intval($dirs[0]) * 1;
}

if(!$id){
    ?>
    <script>location.href = "/404";</script>
    <?
	exit();
}
$tr = Translate::getInstance();

$post = Catalog::getInstance()->item($id);
if(!$post){
	?>
    <script>location.href = "/";</script>
	<?
    exit();
}
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

$more = Catalog::getInstance()->more($id);

$heights = $post->enabledHeightsList;
?>
    <div ng-controller="ProductController" class="container">
        <div class="margin-bottom-50 HeadContentPage container"
             data-num_main="2"
             data-num_thumb="4"
             data-speed="300">
            <div class="row ProductInfo">

                <div id="exzoom" class="col-12 col-sm-5 columns product-gallery exzoom">

                    <div id="exzoom-dn" style="display: none"><div class="images exzoom_img_box">
                        <more-button product="<?=$id?>"></more-button>
                        <ul class="exzoom_img_ul">
                            <?
                            foreach($post->images as $image){
                                ?>
                                <li>
                                    <img src="<?=$image->path?>" alt="">
                                </li>
                                <?
                            }
                            ?>
                        </ul>
                    </div></div>
                    <div id="exzoom-dn-nav" style="display: none"><div class="exzoom_nav"></div></div>

                </div>


                <div class="col-12 col-sm-7 product-info">

                    <div class="ProductLabel">

                        <table class="margin-bottom-0" width="100%">
                            <tr>
                                <td>

                                    <h1 class="productTitle"><?=ucfirst($post->post_title)?>
                                        <?
                                        if($post->sale){
                                            ?>
                                            <span class="sale">-<?=$post->sale?>%</span>
                                            <?
                                        }
                                        ?>
                                    </h1>
                                    <div>
                                        <span class="thin-font">EAN:</span> <?=$post->barcode?>
                                    </div>
                                    <div>
                                        <span class="thin-font">ID:</span> <?=$post->id?><br/>
                                    </div>
                                </td>
                                <td>
                                    <?
                                    if($post->sale){
                                        ?>
                                        <div class="amount thin-font text-right" style="font-size: 150%; color: #ccc;">
                                            <del><span class="thin-font" style="padding-right: 5px;">€</span><?=$post->price?></del>
                                        </div>
                                        <div class="amount thin-font text-right" style="font-size: 200%;">
                                            <span class="thin-font" style="padding-right: 5px;">€</span><?=$post->new_price?>
                                        </div>
                                        <?
                                    }else{
                                        ?>
                                        <div class="amount thin-font text-right" style="font-size: 200%;">
                                            <span class="thin-font" style="padding-right: 5px;">€</span><?=$post->price?>
                                        </div>
                                        <?
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <table class="margin-bottom-0" width="100%;">
                            <tr>
                                <td>
                                    <? if(sizeof($heights)){ ?>
                                        <div>
                                            <span class="thin-font"><?=$tr->get("HEIGHT")?>:</span>
                                            <ul class="heightList">
                                                <? foreach($heights as $item){ ?>
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
                                        <div style="width: 100%; height: 100px; background: transparent url(/web/img/brands/<?=$brandSrc?>) no-repeat center center/contain"
                                             &nbsp;
                                        </div>
                                    <? } ?>
                                </td>
                            </tr>
                        </table>

                        <div class="btnRows" role="group">
                            <div class="error" ng-if="needSize" style="padding: 5px;">
                                <span ng-if="needSize === true"><?=$tr->get("CHOOSE_HEIGHT")?></span>&nbsp;
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
                                        class="btn btn-lg btn-warning btn-secondary"><?=$tr->get("ADD_TO_CART")?>
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
                                <?=$tr->get("YOU_LOOKING")?> <?=mb_strtolower($post->post_title)?>
                                <? switch($post->gender){
                                    case 1:
                                        echo $tr->get("FOR_BOYS").".";
                                        break;
                                    case 2:
                                        echo $tr->get("FOR_GIRLS").".";
                                        break;
                                    default:
                                        echo $tr->get("FOR_CHILDREN").".";
                                        break;
                                } ?>
                                <?=$tr->get("MODEL_AVAILABLE_SIZES")?>: <?=$post->enabledHeightsStr?>. <?=$tr->get('THIS_PRODUCT_OTHEN_VIEWED')?>:
                            </p>
                            <div>
                                <? foreach($more as $i => $item){ ?>
                                    <div style="float: left;" class="text-center">
                                        <a href="/product/<?=$item->id?>">
                                            <div style="
                                                    background: transparent url(<?=$item->img?>) no-repeat center center/contain;
                                                    border: #c3cc36 1px solid; margin: 4px; padding: 5px;
                                                    width: 100px; height: 100px;"></div>
                                            <span class="thin-font"><?=$item->title?></span>
                                            <?
                                            if(!$item->new_price){
                                                ?><br/>&euro; <?=$item->price?><?
                                            }else{
                                                ?>
                                                <br/>
                                                <div style="display: inline-flex; clear: both;">
                                                        <small style="text-decoration: line-through; color: #838383;">&nbsp;&euro; <?=$item->price?></small>
                                                        <div style="    background: #ff0000;
                                                    color: #fff;
                                                    padding: 5px 6px;
                                                    font-size: 12px;
                                                    border-radius: 6px;
                                                    transform: rotate(-10deg);
                                                    margin-top: -10px;
                                                    margin-left: 6px;
                                                }">&euro; <?=$item->new_price?></div>
                                                </div>
                                                <?
                                            }
                                            ?>
                                        </a>
                                    </div>
                                <? } ?>
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
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4 margin-bottom-20 text-center">
                                    <i class="fa fa-check" style="color: #c3cc36; font-size: 200%;"></i>
                                    <br/>
                                    <div class="thin-font"><?=$tr->get("ADDED_TO_CART")?></div>
                                    <br/>
                                </div>
                                <div class="col-sm-4 margin-bottom-20">
                                        <button type="button" class="btn btn-outline-success btn-block" ng-click="closeAdvices()">
                                            <?=$tr->get("GO_TO_SITE")?>
                                        </button>
                                    <br/>
                                </div>
                                <div class="col-sm-4 margin-bottom-20">
                                    <a href="/cart" class="btn btn-success btn-block"><?=$tr->get("GO_TO_CART")?></a>
                                    <br/>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <span class="thin-font"><?=$tr->get("THIS_PRODUCT_OTHEN_VIEWED")?>:</span>
                        <div class="container" style="display: contents;">
                            <div class="row overflow" style="height: 140px;">

                                <div style="float: left;" class="text-center" ng-repeat="row in more">
                                    <a href="/product/{{row.id}}">
                                        <div style="
                                                    background: transparent url({{row.img}}) no-repeat center center/contain;
                                                    border: #c3cc36 1px solid; margin: 4px; padding: 5px;
                                                    width: 100px; height: 100px;"></div>
                                        <span class="thin-font">{{row.title}}</span>
                                        <br/>&euro; {{row.price}}
                                        <br/>&euro; {{row.new_price}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/web/js/exzoom.js"></script>
<? include_once __DIR__ . "/nav/footer.php" ?>