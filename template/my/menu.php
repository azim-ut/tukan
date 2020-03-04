<?php

use core\Engine;

$page = Engine::getDir(1);
$ts = Translate::getInstance();
?>

<div class="list-group">
    <a href="/my" class="<?=($page == null ? 'active' : '')?> list-group-item"><?=$ts->get("SUMMARY")?></a>
    <a href="/my/coupons" class="<?=($page == 'coupons' ? 'active' : '')?> list-group-item"><?=$ts->get("COUPONS")?></a>
    <a href="/my/orders" class="<?=($page === 'orders' ? 'active' : '')?> list-group-item"><?=$ts->get("ORDERS")?></a>
    <a href="/my/addresses" class="<?=($page === 'addresses' ? 'active' : '')?>  list-group-item"><?=$ts->get("DELIVERY_ADDRESS")?></a>
</div>
<div class="list-group">
    <a href="/logout" class="list-group-item"><?=$ts->get("EXIT")?></a>
</div>
