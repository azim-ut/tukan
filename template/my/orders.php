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
$tr = TranslateService::getInstance();
include_once __DIR__ . "/../nav/start.php";

?>
    <script type="text/javascript" src="/web/js/orders.js?t=<?=$version?>"></script>
    <div ng-controller="OrdersListController" ng-cloak class="HeadContentPage">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    &nbsp;
                </div>

                <div class="col-sm-3 margin-bottom-15">
                    <?require_once "menu.php"?>
                </div>


                <div class="col-sm-7">
                    <table class="table table-striped">
                        <tr ng-repeat="row in items">
                            <td width="1%">
                                <div style="width: 80px; height: 80px; border: #eaeaea 2px solid; background: #fff url('{{row.img}}') no-repeat center 0/cover"
                                ></div>
                            </td>
                            <td width="*">
                                {{row.post_title}} x {{row.cnt}}<br/>
                                <small>{{row.checkout*1000 | date:'dd MMMM yy'}}<br/>
                                <?=$tr->get("STATUS")?>:
                                <b ng-if="row.checkout === 0"><?=$tr->get("WAITING_FOR_PAYMENT")?></b>
                                <b ng-if="row.checkout && row.pack===0"><?=$tr->get("ORDERS_PACKAGING")?></b>
                                <b ng-if="row.pack && row.sent===0"><?=$tr->get("ORDER_SENT")?></b>
                                <b ng-if="row.sent && row.delivered===0"><?=$tr->get("ORDER_SENT")?></b>
                                <b ng-if="row.delivered && row.closed===0"><?=$tr->get("CONFIRM_DELIVERY")?></b>
                                <b ng-if="row.claim && row.closed === 0"><?=$tr->get("DISPUTE_RESOLUTION")?></b>
                                <b ng-if="row.closed">Заказ завершен</b>
                                </small>
                            </td>
                            <td width="1%" class="text-nowrap">
                                &euro; {{row.price}}<br/>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-sm-1">
                </div>
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/../nav/footer.php" ?>