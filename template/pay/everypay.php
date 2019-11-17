<?php

use core\manager\UserManager;
use core\service\App;
use core\utils\ServerUtils;

$cart = new Cart(UserManager::currentId());
$ePay = EveryPayService::getInstance();

$ePay->init(App::context()->param("everypay.api.username"), App::context()->param("everypay.api.secret"), ['transaction_type' => 'charge']);
$data = $ePay->getFields([
    "account_id" => 'EUR3D1',
    "amount" => $cart->totalPrice,
    "billing_address" => $cart->address,
    "delivery_address" => $cart->address,
    "order_reference" => $cart->id,
    "callback_url" => "https://" . App::context()->getDomain() . "/shop/card/callback.php",
    "customer_url" => "https://" . App::context()->getDomain() . "/sold?id=".$cart->id,
    "skin_name" => App::context()->param("everypay.skin.name"),
    "user_ip" => ServerUtils::getIP(),
    "hmac_fields" => "account_id"
], 'ru');

?>

<iframe id="iframe-payment-container" name="iframe-payment-container" width="400"
        height="400" sandbox="allow-top-navigation allow-forms allow-popups allow-scripts allow-same-origin"></iframe>
<form action="https://igw-demo.every-pay.com/transactions" id="iframe_form" method="post"
      style="display: none" target="iframe-payment-container">
    <?
    foreach($data as $key => $val){
        ?>
        <input name="<?=$key?>" value="<?=$val?>">
        <?
    }
    ?>
</form>

<script>
    window.onload = function () {
        document.getElementById("iframe_form").submit();
    }
</script>