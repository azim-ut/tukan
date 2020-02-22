<?
use core\service\TranslateService;

$ts = TranslateService::getInstance();
?>
<link href="/web/css/promo2.css?t=<?=$version?>" rel="stylesheet" type="text/css"/>
<div style="">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 pointer" style="padding: 0;" onclick="location.href='/brands';">
                <div class="card shadow-sm brandsContent">
                    <video autoplay muted loop id="vid">
                        <source src="/web/video/MVI_4856-commercial_HD.mp4" type="video/mp4">
                    </video>

                    <!-- Optional: some overlay text to describe the video -->
                    <div class="content">
                        <h1><?=$ts->get("BRANDS_IN_OUR_STORE")?></h1>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-sm-6 pointer"
                 onclick="location.href='/lottery';"
                 style="background: #ffffff url(/web/img/lottery.jpg) no-repeat center center/cover; position: relative; height: 400px;">
                <div style="display: inline-block;
                        vertical-align: middle;
                        position: absolute;
                        left: 0;
                        background: #fff;
                        top: 30%;">
                    <div class="text-left"
                         style="font-size: 200%;
                            padding: 10px 15px;
                            text-transform: uppercase;
                            color: #333;"><?=$ts->get("LOTTERY_OF_DISCOUNTS")?></div>
                    <div class="text-left position-absolute"
                         style="font-size: 110%;
                            background: #333;
                            left: 0;
                            padding: 15px 15px;
                            color: #eaeaea;
                            font-weight: 400;">
                        <?=$ts->get("NEED_BIGGER_DISCOUNT")?><br/>
                        <?=$ts->get("WIN_WIN_LOTTERY_TITLE")?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

