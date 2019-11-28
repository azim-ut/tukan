<? use assets\services\OrderService;
use core\exception\BadResultException;
use core\exception\NoUserException;
use core\manager\UserManager;
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
                        <div class="name">Привет, <?=$user->name()?>!</div>
                    </div>

                    <div class="row grid2 margin-top-15">
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$total?></div>
                            Все заказы
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$checkouted?></div>
                            Обработка заказа
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$pack?></div>
                            Упаковка
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$sent?></div>
                            Заказ отправлен
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$delivered?></div>
                            Достлен
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt"><?=$claim?></div>
                            Открытые спорты
                        </div>
                    </div>

                </div>

                <div class="col-sm-1">
                </div>
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/../nav/footer.php" ?>