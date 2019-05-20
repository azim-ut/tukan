<? use assets\services\TagsService;
use assets\services\WebCatalogService;
use core\Engine;
use core\manager\ParamsManager;

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
$tags = $ts->getHeightTagsByAge($age, $gender);

$height = $tags[0] ?? 0;
array_push($tags, $gender);

$posts = WebCatalogService::getInstance()->getPosts('publish', $tags);
?>

    <div class="row" style="margin-top: 20px; margin-bottom: 20px; border-radius: 15px; padding: 10px 0 0;">
        <div class="col-xs-6">
            <a href="/filters/height">
                <button type="button" class="btn btn-block btn-warning">По росту</button>
            </a>
        </div>
        <div class="col-xs-6">
            <a href="/filters/age">
                <button type="button" class="btn btn-block btn-default" >По возрасту</button>
            </a>
        </div>
        <hr class="line3"/>
    </div>

    <div class="row" style="margin-top: 50px;">
        <div class="row filterPostsStore">
            <div class="col-sm-4 text-center">
                <ul style="display: inline-flex; margin: 0;">
                    <a href="?a=<?=$age?>&g=boy">
                        <div class="gender boy pull-left <?=$gender === "boy" ? "on" : ""?>"></div>
                    </a>
                    <a href="?a=<?=$age?>&g=girl">
                        <div class="gender girl pull-right <?=$gender === "girl" ? "on" : ""?>"></div>
                    </a>
                </ul>
            </div>
            <div class="col-sm-8 motivation text-center">
                <?
                $ages = $ts->getBoysAges();
                foreach($ages as $i => $val){
                    $cls      = "btn-default";
                    $fontSize = "150%";
                    if($age === $val){
                        $cls = "btn-warning";
                    }
                    if(strlen($val) > 2){
                        $fontSize = "110%";
                    }
                    ?>
                    <a href="?a=<?=$val?>&g=<?=$gender?>"
                       style="margin: 2px; font-size: <?=$fontSize?>; width: 48px; text-align: center; padding: 5px; line-height: 35px;"
                       class="btn <?=$cls?> btn-lg btn-circle text-center btn-icon-only">
                        <?=$val?>
                    </a>
                    <?
                }
                ?>
            </div>
        </div>


        <div class="col-md-12">
            <div class="row">
                <?
                if(sizeof($posts)){
                    ?>
                    <div class="col-sm-3">
                        <div class="subProduct text-center">
                            <button style="border: none;" class="gender <?=$gender?>"></button>
                            <hr/>
                            Возраст:
                            <span style="font-size: 100%;"><?=$age?></span>
                            <br/>
                            <br/>
                            <span>Рост:</span>
                            <br/>
                            <span style="font-size: 100%;"><?=$height?>cm</span>
                        </div>
                    </div>
                    <?
                    foreach($posts as $item){

                        ?>
                        <div class="col-sm-3">
                            <product-preview id="<?=$item->id?>"
                                             style="height: 200px;"
                                             title="'<?=$item->title?>'"
                                             price="<?=$item->price?>"
                                             img="'<?=$item->img?>'"
                                             fullprice="<?=$item->fullprice?>"></product-preview>
                        </div>
                        <?
                    }
                }else{
                    ?>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="btn btn-lg btn-icon-only btn-default btn-bold btn-circle"
                                 style="width: 70px; height: 70px; line-height: 50px; font-size: 210%;">
                                <i class="icon-heart"></i>
                            </div>
                        </div>
                        <div class="col-xs-9 text-center" style="padding-top: 15px;">
                            <strong style="font-size: 110%; text-transform: uppercase;">Кликните, на сердечко</strong>
                            <br/>чтобы мы закупили вещи на этот возраст!
                        </div>
                    </div>
                    <div class="subProduct"
                         style="width: 100%; height: 350px; background: transparent url(/web/img/empty_list_2.png) no-repeat center center/contain; border: none;">

                    </div>
                    <?
                }
                ?>

            </div>
        </div>
    </div>
    </div>

<? include_once __DIR__ . "/../nav/footer.php" ?>