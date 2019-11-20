<?php

use core\Engine;

$page = Engine::getDir(1);
?>

<div class="list-group">
    <a href="/my" class="<?=($page == null ? 'active' : '')?> list-group-item">Сводка</a>
    <a href="/my/orders" class="<?=($page === 'orders' ? 'active' : '')?> list-group-item">Мои заказы</a>
    <a href="/my/addresses" class="<?=($page === 'addresses' ? 'active' : '')?>  list-group-item">Адреса доставки</a>
</div>
<div class="list-group">
    <a href="/logout" class="list-group-item">Выйти</a>
</div>
