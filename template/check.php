<?

use assets\services\OrderService;
use core\Engine;
use core\manager\UserManager;


$orderService = OrderService::getInstance();
$nonce        = Engine::getDir(1);
$id           = $orderService->hasOrderNonce($nonce, UserManager::currentId());
$order        = null;

if($id){
    $order = new Order($id);
}
include_once __DIR__ . "/nav/start.php";

if($order){
    ?>
    <div class="nasa-single-product-scroll HeadContentPage"
         style="padding-right: 20px; padding-left: 20px; background: linear-gradient(#e5e8ed, #a1b3c1);">

        <div class="row">
            <div class="col-sm-4">
                &nbsp;
            </div>


            <div class="col-sm-4">
                <div class="text-center addressBlock gb_Rd_sm">
                    <b>TukanStore OU</b>
                    <h3 class="thin-font" style="padding: 20px 0;">Спасибо за покупку!</h3>
                    <h4 class="text-left">Ваш заказ: </h4>
                    <table class="table">
                        <?
                        foreach($order->items() as $row){
                            ?>
                            <tr>
                                <td class="text-left"><?=$row->title()?>&nbsp;x&nbsp;<?=$row->count()?></td>
                                <td width="1%" class="text-nowrap">&euro; <?=$row->price() * $row->count()?></td>
                            </tr>
                            <?
                        }
                        ?>
                        <tr>
                            <th class="text-left"><i class="fa fa-tshirt"></i> x <?=$order->totalCount?></th>
                            <th class="text-nowrap">&euro; <?=$order->totalPrice?></th>
                            </th>
                        </tr>
                        <tr>
                            <td style="border: none;" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-left" style="border: none;">
                                Адрес доставки:
                            </th>
                        </tr>
                        <tr>
                            <td class="text-left" style="border: none;" colspan="2"><?=$order->address?></td>
                        </tr>
                    </table>

                    <br/>
                    <div class="thin-font">Заказ можно отслеживать в вашем кабинете.</div>
                    <br/>
                    <a href="/my">
                        <button type="button" class="btn btn-outline-info btn-block"><i
                                    class="fa fa-user-circle"></i>&nbsp;
                            Мой кабинет
                        </button>
                    </a>
                </div>
            </div>
            <div class="col-xs-4">
                &nbsp;
            </div>
        </div>


    </div>
    <?
}
?>
<? include_once __DIR__ . "/nav/footer.php" ?>