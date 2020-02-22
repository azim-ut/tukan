<?

use assets\services\WebCatalogService;
use core\service\TranslateService;

$ts = TranslateService::getInstance();
$filter = new CatalogFilter();
$filter->sales(true);
$filter->orders("p.sale", "desc");
$list = WebCatalogService::getInstance()->getPosts($filter, [], 0, 9);
if(sizeof($list) % 2 === 0){
    array_pop($list);
}

?>
<div class="container headPromoBoyGirls" style="border-top: #fff 2px solid;">
    <div class="row" style="border-top: #000 2px solid;border-bottom: #000 2px solid;">
        <div class="col-6 text-center"
             style="background: #ffffff url(/web/img/red_bg.jpg) no-repeat center top/cover; color: #fff; position: relative;">
            <div style="display: inline-block; vertical-align: middle; position: relative; top: 7%;">
                <div style="font-size: 200%; text-transform: uppercase;"><?=$ts->get("SALE")?></div>
                <div style="font-size: 100%; color: #fff; text-transform: uppercase;"><?=$ts->get("UNTIL_ONLY")?> 31/01/2020</div>
                <div style="font-size: 400%; text-transform: uppercase; transform: rotate(-15deg);">50%</div>
                <div style="font-size: 110%; text-transform: uppercase;">Mustakivi keskus</div>
                <div style="font-size: 110%; text-transform: uppercase;">Mahtra 1, 2 <?=$ts->get("FLOOR")?></div>
            </div>
        </div>
        <?
        foreach($list as $i => $row){
            $cls = "";
            if($i % 2 === 0){
                $cls = "lastInRow";
            }
            ?>
            <div class="col-6 text-center sales <?=$cls?>">
                <div class="photo"
                     onclick="location.href='/product/<?=$row->id?>';"
                     style="background-image: url(<?=$row->img?>);">&nbsp;
                </div>
                <div class="info">-<?=$row->sale?>%</div>
                <div class="price"><del>&nbsp;&euro; <?=$row->price?>&nbsp;</del></div>
                <div class="new_price">&euro; <?=$row->new_price?></div>
            </div>
            <?
        }
        ?>
    </div>
</div>