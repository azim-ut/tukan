<? use core\exception\BadResultException;
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
include_once __DIR__ . "/nav/start.php";

?>
    <div ng-controller="AuthBlockController" ng-cloak class="nasa-single-product-scroll HeadContentPage">

        <div class="row">
            <div class="col-xs-1">
                &nbsp;
            </div>

            <div class="col-xs-3">
                <div class="list-group">
                    <a href="/cart" class="list-group-item">Корзина</a>
                    <a href="/orders" class="list-group-item">Мои заказы</a>
                    <a href="/addresses" class="list-group-item">Адреса доставки</a>
                </div>
                <div class="list-group">
                    <a href="/logout" class="list-group-item">Выйти</a>
                </div>
            </div>


            <div class="col-xs-7">
                Привет, <?=$user->name()?>!
            </div>

            <div class="col-xs-1">
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/nav/footer.php" ?>