<?php

$orderNonce        = $_GET["order_reference"];
$last4Digits       = $_GET["cc_last_four_digits"];
$transactionResult = $_GET["transaction_result"];
$paymentState      = $_GET["payment_state"];

$res = EveryPayDto::getInstance()->callback($orderNonce, $last4Digits, $transactionResult, $paymentState);

echo $res;
