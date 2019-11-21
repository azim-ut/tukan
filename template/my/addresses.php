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
?>
    <script type="text/javascript" src="/web/js/addresses.js?t=<?=$version?>"></script>
    <div ng-controller="AddressesBlockController" ng-cloak class="HeadContentPage">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    &nbsp;
                </div>

                <div class="col-sm-3 margin-bottom-15">
                    <?require_once "menu.php"?>
                </div>


                <div class="col-sm-7 padding-left-15" style="padding: 20px;">
                    <div class="container">
                        <div class="col-sm-4" ng-repeat="row in list">
                            {{row}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-1">
                </div>
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/../nav/footer.php" ?>