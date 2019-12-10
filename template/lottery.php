<?

use assets\services\CouponService;
use assets\services\LotteryService;
use core\manager\SessionManager;
use core\manager\UserManager;

?>
<? include_once __DIR__ . "/nav/start.php" ?>
<?
$prizes = CouponService::getInstance()->getUserCoupons(UserManager::currentId(), SessionManager::id(), LotteryService::firstLotteryName());

?>
<script src="/web/assets/fireworks.js"></script>
<link href="/web/css/lottery.css" rel="stylesheet" type="text/css"/>
<div class="HeadContentPage"
     style="background: transparent url(/web/img/christmas_1024x768.jpg) no-repeat center center/cover"
     ng-controller="LotteryController">


    <script src="//cdnjs.cloudflare.com/ajax/libs/p2.js/0.6.0/p2.min.js"></script>
    <div class="text-center container" style="position: relative;">
        <br/>
        <div id="wheel">
            <div ng-class="{'disabled':prize}">
                <canvas id="canvas" width="280" height="280"></canvas>
            </div>
        </div>
        <br/>
        <div class="align-center">
            <div class="spinBtn align-center" ng-click="spin()" ng-if="!prize">
                <button class="ttl shadow"><span>Крутить</span></button>
            </div>
        </div>

    </div>

    <div ng-if="prize" class="couponBlock">
        <h2>Ваш приз!</h2>
        <a href="/my/coupons" class="pointer">
            <coupon data="prize"></coupon>
        </a>
    </div>

    <div style="display: none;">
        <div id="prizes"><h1>Venues <input type="checkbox" class="checkAll" checked/></h1>
            <div id="name"></div>
            <h2>Types <input type="checkbox" class="checkAll" checked/></h2>
            <div id="types"></div>
        </div>
        <div id="filterToggle">. . .</div>
    </div>
    <div id="counter"></div>
    <script>
        var prizesNames = <?=json_encode(CouponService::getInstance()->getCoupons(LotteryService::firstLotteryName()))?>;

        var prize = '';
        <?
        if(sizeof($prizes)){?>
        prize = <?=json_encode($prizes[0])?>;
        <?}
        ?>
        var prizes = [];
        prizesNames.forEach(function (row) {
            prizes.push({name: row.name, type: row.grp})
        })
    </script>

    <div class="modal fade" tabindex="-1" role="dialog" id="ShowPrize">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span>Поздравляем!</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="form-group row" ng-if="data.user" style="padding: 0 20px;">
                            <coupon data="prize"></coupon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/web/js/lottery.js?t=<?=$version?>" type="text/javascript"></script>
</div>

<? include_once __DIR__ . "/nav/footer.php" ?>
