<?php

use core\manager\UserManager;
use core\service\App;
use core\utils\ServerUtils;

$cart = new Cart(UserManager::currentId());
$ePay = EveryPayService::getInstance();
$endpoint = App::context()->param("everypay.api.endpoint");
$ePay->init(App::context()->param("everypay.api.username"), App::context()->param("everypay.api.secret"), ['transaction_type' => 'charge']);
$data = $ePay->getFields([
    "account_id" => 'EUR3D1',
    "amount" => $cart->totalPrice,
    "billing_address" => $cart->addr,
    "delivery_address" => $cart->addr,
    "order_reference" => $cart->nonce,
    "callback_url" => "https://" . App::context()->getDomain() . "/callback/everypay",
    "customer_url" => "https://" . App::context()->getDomain() . "/check?id=".$cart->nonce,
    "skin_name" => App::context()->param("everypay.skin.name"),
    "user_ip" => ServerUtils::getIP(),
    "hmac_fields" => "account_id"
], 'ru');

?>

<iframe id="iframe-payment-container" name="iframe-payment-container" width="400"
        height="400" sandbox="allow-top-navigation allow-forms allow-popups allow-scripts allow-same-origin"></iframe>
<form action="<?=$endpoint?>" id="iframe_form" method="post"
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