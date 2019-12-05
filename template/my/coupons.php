<? use assets\services\CouponService;
use assets\services\LotteryService;
use core\exception\BadResultException;
use core\exception\NoUserException;
use core\manager\UserManager;

try{
    $user = UserManager::current();
    if(!$user){
        throw new NoUserException();
    }
}catch(NoUserException | BadResultException $e){
    header("Location: /");
    exit();
}
include_once __DIR__ . "/../nav/start.php";
$list = CouponService::getInstance()->getUserCoupons(UserManager::currentId(), LotteryService::firstLotteryName());

?>
    <div ng-cloak class="HeadContentPage">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    &nbsp;
                </div>

                <div class="col-sm-3 margin-bottom-15">
                    <? require_once "menu.php" ?>
                </div>


                <div class="col-sm-7 padding-left-15" style="padding: 20px;">
                    <?
                    foreach($list as $row){
                    ?>

                        <div class="col-12">
                            <div class="mt-element-ribbon bg-grey-steel shadow-sm couponTicket" style="border: #ccc 1px solid;">
                                <div class="ribbon ribbon-right ribbon-shadow ribbon-border-dash ribbon-round ribbon-color-danger uppercase">
                                    <?=$row->name?>
                                </div>
                                <p class="ribbon-content text-right">
                                    <?=$row->details?>
                                    <br/>
                                    <small><?=date("d M Y", $row->added)?></small>
                                </p>
                            </div>
                        </div>
                        <?
                        }
                        ?>

                </div>

                <div class="col-sm-1">
                </div>
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/../nav/footer.php" ?>