<?

use assets\services\OrderService;
use core\manager\ParamsManager;
use core\manager\UserManager;

?>
<?
include_once __DIR__ . "/nav/start.php";

$orderService = OrderService::getInstance();
$id           = ParamsManager::getParam("id");
$list         = $orderService->list(UserManager::currentId());
$order        = null;
if(in_array($id, $list)){
    $order = new Order($id);
}
if($order){
    ?>
    <div class="nasa-single-product-scroll HeadContentPage"
         style="padding-right: 20px; padding-left: 20px; background: linear-gradient(#e5e8ed, #a1b3c1);">

        <div class="row">
            <div class="col-sm-2">
                &nbsp;
            </div>


            <div class="col-sm-8">
                <div class="text-center">
                    <b>TukanStore OU</b>
                    <table class="table">
                        <?
                        foreach($order as $row){
                            ?>
                            <tr>
                                <td class="text-left"><?=$row->title()?>&nbsp;x&nbsp;<?=$row->count?></td>
                                <td width="1%" class="text-nowrap">&euro; <?=$row->price() * $row->count?></td>
                            </tr>
                            <?
                        }
                        ?>
                        <tr>
                            <th class="text-left"><i class="fa fa-tshirt"></i> x <?=$order->totalCount?></th>
                            <th class="text-nowrap">&euro; <?=$order->totalPrice?></th>
                            </th>
                        </tr>
                    </table>
                    <div class="thin-font">Спасибо за покупку!</div>
                    <br/>
                    <div class="thin-font">Заказ можно отслеживать в вашем кабинете.</div>
                    <br/>
                    <a href="/my">
                        <button type="button" class="btn btn-outline-info btn-block"><i
                                    class="fa fa-user-circle"></i>&nbsp;
                            Мой кабинет
                        </button>
                    </a>
                    <br/>
                </div>
            </div>
            <div class="col-xs-2">
                &nbsp;
            </div>
        </div>


    </div>
    <?
}
?>
<? include_once __DIR__ . "/nav/footer.php" ?>