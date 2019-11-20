<?php

use core\manager\ParamsManager;
use core\service\App;
use core\service\MySqlService;

$sql  = MySqlService::getInstance();
$ePay = EveryPayService::getInstance();

$order_nonce       = ParamsManager::getParam("order_reference");
$last4Digits       = ParamsManager::getParam("cc_last_four_digits");
$transactionResult = ParamsManager::getParam("transaction_result");
$paymentState      = ParamsManager::getParam("payment_state");
$ePay->init(App::context()->param("everypay.api.username"), App::context()->param("everypay.api.secret"), ['transaction_type' => 'charge']);

$order = new Order(["nonce" => $order_nonce]);
if(!$order->checkout && $transactionResult === 'completed' && $paymentState === 'settled'){
    $order->checkout = time();
    $order->save();
    EveryPayService::getInstance()->logSuccess();
}else{
    EveryPayService::getInstance()->logError();
}
echo "OK";
