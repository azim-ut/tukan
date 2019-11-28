<?

use assets\services\LotteryService;
use core\manager\UserManager;
use core\service\App;

?>
<? include_once __DIR__ . "/nav/start.php" ?>
<?
$prize = LotteryService::getInstance()->getWin(UserManager::currentId(), 1);
?>
<div class="HeadContentPage">
    <script src="//cdnjs.cloudflare.com/ajax/libs/p2.js/0.6.0/p2.min.js"></script>
    <div class="text-center container" style="position: relative;" ng-controller="LotteryController">
        <br/>
        <div id="wheel">
            <canvas id="canvas" width="330" height="330"></canvas>
        </div>
        <br/>
		<?
		if(!$prize){
			?>
            <button type="button"
                    ng-click="spin()"
                    class="btn btn-primary btn-block">Крутить
            </button>
			<?
		}
		?>
        <br/>
        <div ng-if="prize" id="PrizeBlock">
            {{prize}}
        </div>
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
        var prizesNames = <?=json_encode(App::context()->propArray("prizes"))?>;

        var prize = '';
		<?
		if($prize){?>
        prize = '<?=$prize->name?>';
		<?}
		?>
        var prizes = [];
        prizesNames.forEach(function (row) {
            prizes.push({name: row, type: "Discount"})
        })
    </script>
    <script src="/web/js/lottery.js?t=<?=$version?>" type="text/javascript"></script>
</div>

<? include_once __DIR__ . "/nav/footer.php" ?>
