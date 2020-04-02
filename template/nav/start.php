<?php
$tr = Translate::getInstance();

use core\Engine; ?>
<!DOCTYPE html>
<html lang="<?=$tr->locale()?>" ng-app='root'>
<? include_once __DIR__ . "/head.php" ?>

<body ng-cloak=""
      class="home page-template page-template-page-visual-composer page-template-page-visual-composer-php page page-id-1705 woocommerce-no-js antialiased wpb-js-composer js-comp-ver-5.5.4 vc_responsive">

<a id="top"></a>
<a id="HeadTop"></a>
<div class="no-print" ng-controller="CommonController" ng-init="fetchVisitsData()"></div>
<div id="nasa-before-load" class="no-print">
    <div class="nasa-relative nasa-center">
        <div class="nasa-loader">
            <div class="nasa-line"></div>
            <div class="nasa-line"></div>
            <div class="nasa-line"></div>
            <div class="nasa-line"></div>
        </div>
    </div>
</div>

<header id="header" ng-controller="AuthBlockController" ng-cloak>
    <a class="logo" href="/"></a>
    <nav class="">
        <ul>
            <li ng-if="!data.user">
                <a
                        data-toggle="modal"
                        data-target="#AuthForm"
                ><i class="fa fa-user-circle" aria-hidden="true"></i></a>
            </li>
            <li ng-if="data.user">
                <a href="/my"
                   class="toMy text-uppercase"
                   style="font-size: 120%; clear: both;">
                    <div class="imageIcon"
                         ng-if="data.user.icon"
                         ng-style="{'background': 'transparent url('+data.user.icon+') no-repeat center center/contain'}"></div>
                    <div ng-if="!data.user.icon">{{data.user.name.charAt(0)}}</div>
                    &nbsp;
                </a>
            </li>
            <li>
                <a
                    href="/cart"
                ><i class="icon icon-basket" aria-hidden="true"></i></a>
            </li>
            <li>
                <a
                    href="/wishes"
                ><i class="icon icon-heart" aria-hidden="true"></i></a>
            </li>
            <li>
                <a href="#">
                    <div class="icon-lang"
                        ng-click="openEmptyForm('#localeModal')"
                        ng-style="{'margin':10, 'background': 'transparent url(/web/img/flag/<?=Engine::getInstance()->getLocale()?>.png) no-repeat center center/cover'}"
                    ></div>
                </a>
            </li>
        </ul>
    </nav>
    <div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div>
</header>


<div class="modal fade" id="localeModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body" style="display: flex;">

                <a class="imageIcon pointer"
                   href="?locale=et_EE"
                     ng-style="{'margin':10, 'background': 'transparent url(/web/img/flag/et_EE.png) no-repeat center center/cover'}"></a>
                <a class="imageIcon pointer"
                   href="?locale=en_US"
                   ng-style="{'margin':10, 'background': 'transparent url(/web/img/flag/en_US.png) no-repeat center center/cover'}"></a>
                <a class="imageIcon pointer"
                   href="?locale=ru_RU"
                     ng-style="{'margin':10, 'background': 'transparent url(/web/img/flag/ru_RU.png) no-repeat center center/cover'}"></a>
                <div class="imageIcon pointer"
                     data-dismiss="modal"
                     style="margin:10px 0 0 50px; text-align: center; line-height: 38px; font-weight: 700; color: #9c9c9c;">
                    X
                </div>
            </div>
        </div>
    </div>
</div>

<a id="start"></a>
<div id="header-content" class="site-header no-print">

</div>
<? include_once __DIR__ . "/auth.php" ?>

<div id="wrapper" class="fixNav-enabled">
    <div id="main-content" class="site-main light">