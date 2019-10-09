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
         style="margin-top: 40px;"
         ng-controller="ProductController"
         data-num_thumb="4"
         data-speed="300">

        <div class="row">
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
                                        <div style="background: transparent url(<?=$image->path?>) no-repeat center center/contain; width: 100%; height: 500px;"

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
                        <table>
                            <tr>
                                <td>
                                    <h1 class="product_title entry-title"><?=ucfirst($post->title())?></h1>
                                </td>
                                <td>
                                    <div style="line-height: 20px; padding-left: 10px; text-align: right;">
                                        <b>ID:</b> <?=$post->id?><br/>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div class="ProductLabel">
                            <table>
                                <tr>
                                    <td>
                                        <div class="amount">
                                            <b style="padding-right: 5px;">€</b><?=$post->price()?>
                                        </div>
                                        <div class="ean">
                                            <b>EAN:</b> <?=$post->barcode?>
                                        </div>
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
										<? if($post->gender === 3 || $post->gender === 1){ ?>
                                            <div style="height: 45px; width: 40px; float: left; background: transparent url('/web/img/boy_girl.png') no-repeat center 0px;"></div>
										<? } ?>
										<? if($post->gender === 3 || $post->gender === 2){ ?>
                                            <div style="height: 45px; width: 40px; float: left; background: transparent url('/web/img/boy_girl.png') no-repeat center -55px;"></div>
										<? } ?>
                                    </td>
                                    <td style="width: 200px;">
										<? if($brandSrc != null){ ?>
                                            <img src="/web/img/brands/<?=$brandSrc?>"/>
										<? } ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="error">
                                <span ng-if="needSize === true">Пожалуйста, выберите рост</span>&nbsp;
                            </div>
                            <button ng-if="false" type="button" class="btn btn-danger">Купить сейчас</button>
                            <button type="button" ng-click="toCart(<?=$id?>, size)" class="btn btn-warning">В корзину
                            </button>
                            <button type="button" class="btn btn-default" ng-click="toggleProductWish(<?=$id?>)">
                                <span ng-if="wished"><i class="glyphicon glyphicon-heart text-danger"></i> {{totalWished}}</span>
                                <span ng-if="!wished"><i
                                            class="glyphicon glyphicon-heart-empty"></i> {{totalWished}}</span>
                            </button>
                        </div>
                        <hr class="nasa-single-hr">
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
                        <button class="btn btn-lg btn-danger btn-block"
                                ng-if="data.wishes.indexOf(data.view.id)<0"
                                ng-click="addWish(data.view.id)">
                            <i class="icon-heart"></i> Добавить
                        </button>

                        <button class="btn btn-lg btn-info btn-block"
                                ng-if="data.wishes.indexOf(data.view.id)>=0"
                                ng-click="delWish(data.view.id)">
                            <i class="icon-heart"></i> Убрать
                        </button>

                        <hr class="nasa-single-hr">
                        <div class="nasa-single-share">
                            <div class="sharethis-inline-share-buttons"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
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