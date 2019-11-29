<!DOCTYPE html>
<html lang="ru-RU" ng-app='root'>
<? include_once __DIR__ . "/head.php" ?>

<body ng-cloak=""
      class="home page-template page-template-page-visual-composer page-template-page-visual-composer-php page page-id-1705 woocommerce-no-js antialiased wpb-js-composer js-comp-ver-5.5.4 vc_responsive">

<a id="top"></a>
<div class="no-print" ng-controller="CommonController" ng-init="fetchVisitsData()" id="HeadTop"></div>
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

<div ng-controller="AuthBlockController" ng-cloak class="head no-print gb_Rd">

    <table width="100%">
        <tr>
            <td width="1%">
                <a href="/">
                    <div class="header_logo mainLogo"></div>
                </a>
            </td>
            <td align="right">
                <ul style="display: inline-block; width: 160px; margin-top: 5px;">
                    <li class="userBtn text-center" style="width: 40px;">
                        <a data-toggle="modal"
                           ng-if="!data.user"
                           data-target="#AuthForm">
                            <span class="fa fa-user-circle"></span>
                        </a>
                        <a href="/my"
                           class="toMy text-uppercase"
                           ng-if="data.user" style="font-size: 120%; font-weight: bold; line-height: 20px;display: contents;">
                            <div class="imageIcon"
                                 ng-if="data.user.icon"
                                 ng-style="{'background': 'transparent url('+data.user.icon+') no-repeat center center/contain'}"></div>
                            <div ng-if="!data.user.icon">{{data.user.name.charAt(0)}}</div>
                        </a>
                    </li>
                    <li class="cartHeadBtn text-center"><a href="/cart">
                            <i class="icon icon-basket"></i>
                            <div ng-show="data.cart.ids.length" class="subIconCount blue">{{data.cart.ids.length}}</div>
                        </a>
                    </li>
                    <li class="wishHeadBtn text-center"><a href="/wishes">
                            <i class="icon icon-heart"></i>
                            <div ng-show="data.wishes.ids.length" class="subIconCount red">{{data.wishes.ids.length}}
                            </div>
                        </a>
                    </li>
                </ul>
                <div ng-if="data.user.current">
                    <div class="text-right">
                        <div id="AuthBlock">
                            <ul>
                                <li class="menu-item color">
                                    <span class="icon-user"></span>
                                    <span class="nasa-login-title">{{data.user.name}}</span>
                                </li>
                                <li class="menu-item color" ng-if="data.user">
                                    <a href="/wishes">
                                        <span class="icon-heart"></span> Мой список
                                        <span ng-if="data.user.wishes.length>"
                                              style="font-weight: 700;">({{data.user.wishes.length}})</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </td>
        </tr>
    </table>

</div>
<a id="start"></a>
<div id="header-content" class="site-header no-print">

</div>
<? include_once __DIR__ . "/auth.php" ?>


<div id="wrapper" class="fixNav-enabled">

    <div id="main-content" class="site-main light">