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
    <div ng-controller="AuthBlockController" ng-cloak class="nasa-single-product-scroll">

        <div class="row">
            <div class="col-xs-1">
                &nbsp;
            </div>

            <div class="col-xs-3">
                &nbsp;
                <div class="list-group">
                    <a ng-click="logout()" class="list-group-item">Logout</a>
                </div>
            </div>


            <div class="col-xs-7 margin-bottom-30">
                <?=$user->name()?>
            </div>

            <div class="col-xs-1">
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/nav/footer.php" ?>