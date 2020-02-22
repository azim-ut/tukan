<? use assets\services\OrderService;
use core\exception\BadResultException;
use core\exception\NoUserException;
use core\manager\UserManager;
use core\service\TranslateService;
use core\utils\StringUtils;

try{
    $user = UserManager::current();
    if(!$user){
        throw new NoUserException();
    }
}catch(NoUserException | BadResultException $e){
    header("Location: /");
    exit();
}

$ts = TranslateService::getInstance();
include_once __DIR__ . "/../nav/start.php";
$list = OrderService::getInstance()->orders($user->getId());
$total = sizeof($list);
$checkouted = 0;
$pack = 0;
$sent = 0;
$claim = 0;
$delivered = 0;
foreach($list as $row){
    if($row->checkout){
        $checkouted++;
    }
    if($row->pack){
        $pack++;
    }
    if($row->sent){
        $sent++;
    }
    if($row->claim){
        $claim++;
    }
}
?>
    <div ng-controller="AuthBlockController" ng-cloak class="HeadContentPage">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    &nbsp;
                </div>

                <div class="col-sm-3 margin-bottom-15">
                    <?require_once "menu.php"?>
                </div>


                <div class="col-sm-7 padding-left-15" style="padding: 20px;">
                    <div class="MyBarHead">
                        <img src="<?=$user->icon()?>">
                        <div class="name"><?=$ts->get("HELLO")?>, <?=$user->name()?>!</div>
                    </div>

                    <div class="row grid2 margin-top-15">
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$total?></div>
                            <?=$ts->get("ALL_ORDERS")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$checkouted?></div>
                            <?=$ts->get("ORDERS_PROCESSING")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$pack?></div>
                            <?=$ts->get("ORDERS_PACKAGING")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$sent?></div>
                            <?=$ts->get("ORDER_SENT")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$delivered?></div>
                            <?=$ts->get("ORDER_DELIVERED")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$claim?></div>
                            <?=$ts->get("OPEN_DISPUTES")?>
                        </div>
                    </div>

                </div>

                <div class="col-sm-1">
                </div>
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/../nav/footer.php" ?>