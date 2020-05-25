<?php
?>
<?

$ts = Translate::getInstance();
?>
<div class="container headPromoBoyGirls">
    <div class="row">
        <div class="col-sm-12 text-center"
             onclick="location.href='/catalog/girls';"
             style="margin: 5px 0; background: #ffffff url(/web/img/promo1/girls_clothes.jpg) no-repeat center center/cover; height:400px; display:block;">

            <button type="button"
                    class="btn btn-dark"
                    style="margin-top: 320px;"
                    onclick="location.href='/catalog/girls';">
                <?=$ts->get("GIRLS_CLOTHES")?>
            </button>
        </div>
        <div class="col-sm-12 text-center"
             onclick="location.href='/catalog/boys';"
             style="margin: 5px 0; background: #ffffff url(/web/img/promo1/boys_clothes.jpg) no-repeat center center/cover; height:400px;">
            <button type="button"
                    class="btn btn-dark"
                    style="margin-top: 320px;"
                    onclick="location.href='/catalog/boys';">
                <?=$ts->get('BOYS_CLOTHES')?>
            </button>
        </div>
    </div>
</div>