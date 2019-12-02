<?

use assets\services\CouponService;
use assets\services\LotteryService;
use core\manager\UserManager;

?>
<? include_once __DIR__ . "/nav/start.php" ?>
<?
$prizes = CouponService::getInstance()->getUserCoupons(UserManager::currentId(), LotteryService::firstLotteryName());

?>
<div class="HeadContentPage">
    <script src="//cdnjs.cloudflare.com/ajax/libs/p2.js/0.6.0/p2.min.js"></script>
    <div class="text-center container" style="position: relative;" ng-controller="LotteryController">
        <br/>
        <div id="wheel">
            <canvas id="canvas" width="280" height="280"></canvas>
        </div>
        <br/>
        <button type="button"
                ng-click="spin()"
                class="btn btn-primary btn-block">Крутить
        </button>
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
        var prizesNames = <?=json_encode(CouponService::getInstance()->getCoupons("FirstLottery"))?>;

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
    <script src="/web/js/lottery.js?t=<?=$version?>" type="text/javascript"></script>
</div>

<? include_once __DIR__ . "/nav/footer.php" ?>
