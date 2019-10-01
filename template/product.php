<? use assets\services\CatalogService;
use assets\services\PostService;
use core\Engine;
use core\utils\SafeUtils;

include_once __DIR__ . "/nav/start.php" ?>

<?
$dirs = Engine::getInstance()->getDirs(1);
$id   = 0;

if(sizeof($dirs) && SafeUtils::toInteger($dirs[0], 0)){
    $id = $dirs[0]*1;
}

if(!$id){
    ?>
    <script>location.href = "/404";</script>
    <?
}
$post   = new CatalogItem($id);
?>

    <div class="large-12 columns nasa-single-product-scroll nasa-single-product-2-columns" data-num_main="2"
         ng-controller="ProductController" data-num_thumb="4" data-speed="300" ng-init="fetchProduct(<?=$id?>)">

        <div class="row">
            <div class="large-8 small-12 columns product-gallery rtl-right">
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
                                        <div style="background: #fff url(<?=$image->path?>) no-repeat center center/contain; width: 100%; height: 500px;"

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
            <div class="large-4 small-12 columns product-info rtl-left">
                <div class="nasa-product-info-wrap">
                    <div class="nasa-product-info-scroll" style="margin-top: 0px; overflow-y: inherit;"><h1
                                class="product_title entry-title"><?=$post->title()?></h1>
                        <div>
                            Размеры: <?=implode(", ", $post->enabledSizes())?>
                        </div>

                        <p class="price">
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">€</span><?=$post->price()?>
                            </span>
                        </p>
                        <hr class="nasa-single-hr">
                        <div class="woocommerce-product-details__short-description">
                            <p>
                                &nbsp<?=$post->content()?>
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
                    <fb:login-button
                            scope="public_profile,email"
                            onlogin="checkLoginState();">
                    </fb:login-button>
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