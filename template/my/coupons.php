<? use assets\services\CouponService;
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
$list = CouponService::getInstance()->getCoupons(UserManager::currentId());

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
                            <div class="mt-element-ribbon bg-grey-steel">
                                <div class="ribbon ribbon-right ribbon-shadow ribbon-border-dash ribbon-round ribbon-color-danger uppercase">
                                    <?=$row->name?>
                                </div>
                                <p class="ribbon-content text-right">
                                    <small><?=date("d M Y", $row->datetime)?></small>
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