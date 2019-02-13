<? use assets\services\CatalogService;
use assets\services\PostService;
use assets\services\WebCatalogService;
use core\Engine;
use core\utils\SafeUtils;
use core\utils\StringUtils;

include_once __DIR__ . "/nav/start.php" ?>

<?
$dirs = Engine::getInstance()->getDirs(1);
$id   = 0;

if(sizeof($dirs) && SafeUtils::toInteger($dirs[0], 0)){
    $id = $dirs[0];
}

if(!$id){
    ?>
    <script>location.href = "/404";</script>
    <?
}
$post   = PostService::getInstance()->getProduct($id);
$images = CatalogService::getInstance()->getPostsImages($id);
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
                                foreach($images as $image){
                                    ?>
                                    <li data-thumb="<?=$image->s?>"
                                        data-src="<?=$image->src?>">
                                        <div style="background: url(<?=$image->m?>) no-repeat center center/contain; width: 100%; height: 500px;"

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
                                class="product_title entry-title"><?=$post->title?></h1>

                        <div>
                            Размеры: <?=$post->sizes?>
                        </div>

                        <p class="price">
                            <span>
                                <s style="font-size: 90%; font-weight: 100; color: #888;">&nbsp;€ <?=$post->fullprice?>
                                    &nbsp;</s>
                            </span>

                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">€</span><?=$post->price?>
                            </span>
                        </p>
                        <hr class="nasa-single-hr">
                        <div class="woocommerce-product-details__short-description">
                            <p>
                                &nbsp<?=$post->content?>
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
        <div class="row">
            <?
            $snipets = array();
            $sub     = array();
            if(StringUtils::isContain($post->cls, "t-short")){
                $snipets[] = "Футболка с модным современным принтом станет любимой вещью каждого ребенка. Высокое качество материала позволит носить ее как на спортивные секции, так и на прогулки в теплую солнечную прогулку. Мы предоставляем удобную возможность купить детскую одежду высокого качества, не выходя из дома. Для того, чтобы заказать детскую одежду от известного итальянского бренда, достаточно просто оформить заявку на нашем сайте. И уже сосем скоро можно будет порадовать своего ребенка новой стильной вещью в его гардеробе.";
                $sub       = WebCatalogService::getInstance()->getPosts('publish', array("t-short"));
            }
            if(StringUtils::isContain($post->cls, "dress")){
                $snipets[] = "Платье непременно должно присутствовать в гардеробе каждой маленькой модницы. Эта вещь станет незаменимой как для теплых летних дней, так и для посещения детского сада, школы или внеучебных кружков. Каждый заботливый родитель старается купить детскую одежду для своего чада исключительно высочайшего качества, в которой он будет чувствовать себя комфортно и удобно в любой ситуации. На данной странице Вы всегда можете заказать детскую одежду от популярного итальянского бренда, которая несомненно порадует каждого высоким качеством материала. Интересное яркое платье станет любимой вещью девочки в любом возрасте, которую она будет носить с большим удовольствием.";
                $sub       = WebCatalogService::getInstance()->getPosts('publish', array("dress"));
            }
            if(StringUtils::isContain($post->cls, "pujama")){
                $snipets[] = "Невозможно себе представить гардероб ребенка, в котором бы не присутствовало теплой уютной пижамы. Данная вещь необходима для спокойного комфортного сна в детском садике, гостях или дома. Теперь для того, чтобы купить детскую одежду высокого качества, Вам не придется тратить время и силы на долгие утомительные походы по многочисленным магазинам города. Мы предлагаем каждому заказать детскую одежду по привлекательным ценам уже сейчас. Пижама от известного итальянского бренда станет любимой вещью Вашего маленького непоседы, которую он каждый раз будет одевать с большим удовольствием, вспоминая о родительской любви и заботе.";
                $sub       = WebCatalogService::getInstance()->getPosts('publish', array("pujama"));
            }
            if(StringUtils::isContain($post->cls, "sweater")){
                $snipets[] = "В гардеробе каждого ребенка обязательно должна присутствовать такая вещь, как свитер. Он станет незаменимой вещью для прогулок в прохладные летние вечера, в ранний осенне - весенний период, а также в качестве поддевки под верхнюю зимнюю одежду. Мы предлагаем купить детскую одежду высокого качества, в которой удобно посещать школьные занятия, детский сад или любые другие кружки и секции. Свитер от популярного итальянского бренда несомненно порадует подростка своим модным принтом, а взрослые могут быть уверены, что их ребенку комфортно и тепло. Мы предлагаем каждому заказать детскую одежду высокого качества уже сейчас по весьма приемлемым ценам.";
                $sub       = WebCatalogService::getInstance()->getPosts('publish', array("sweater"));
            }
            if(StringUtils::isContain($post->cls, "leggings")){
                $snipets[] = "Лосины являются неотъемлемой вещью в гардеробе каждой девочки. Каждый родитель для своего ребенка старается купить детскую одежду высокого качества, в которой он будет чувствовать себя удобно и комфортно даже на протяжении длительного ношения. Лосины отлично сочетаются с туниками, футболками и свитерами как для повседневной носки, так и для посещения любого праздничного торжества. Здесь каждый желающий может заказать детскую одежду и вещи известного итальянского бренда на самых выгодных условиях, которые несомненно порадуют своих владельцев высоким качеством материала и долговечностью в эксплуатации.";
                $sub       = WebCatalogService::getInstance()->getPosts('publish', array("leggings"));
            }

            foreach($snipets as $snipet){
                ?>
                <div class="col-sm-8">
                    <div class="motivation">
                        <p><?=$snipet?></p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="subProductList">
                    <?
                    foreach($sub as $item){
                        if($item->id == $id){
                            continue;
                        }
                        ?>
                        <a href="/product/<?=$item->id?>">
                            <div class="subProduct" style="background-image: url(<?=$item->s?>);"></div>
                        </a>
                        <?
                    }
                    ?>
                    </div>
                </div>
                <?
            }

            ?>
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
    <div>

        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">

                <div class="sharethis-inline-reaction-buttons"></div>
            </div>
            <div class="col-sm-4"></div>

        </div>
    </div>

<? include_once __DIR__ . "/nav/footer.php" ?>