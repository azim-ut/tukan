<?


$ts = Translate::getInstance();
?>
<link href="/web/css/promo2.css?t=<?=$version?>" rel="stylesheet" type="text/css"/>
<div style="">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 pointer" style="padding: 0;" onclick="location.href='/brands';">
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
        </div>
    </div>
</div>

