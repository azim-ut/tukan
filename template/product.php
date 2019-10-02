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


?>

    <div class="large-12 columns nasa-single-product-scroll nasa-single-product-2-columns" data-num_main="2"
         ng-controller="ProductController" data-num_thumb="4" data-speed="300" ng-init="fetchProduct(<?=$id?>)">

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

                                    <h1 class="product_title entry-title"><?=$post->title()?></h1>
                                </td>
                                <td>
                                    <div style="line-height: 20px; padding-left: 10px; text-align: right;">
                                        <b>ID:</b> <?=$post->id?><br/>
                                        <b>Размеры:</b> <?=implode(", ", $post->enabledSizes())?>
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <p class="price">
                            <span class="amount">
                                <span style="padding-right: 5px;">€</span><?=$post->price()?>
                            </span>
                        </p>
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