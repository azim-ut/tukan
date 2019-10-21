<!DOCTYPE html>
<html lang="ru-RU" ng-app='root'>
<? include_once __DIR__ . "/head.php" ?>

<body ng-cloak=""
      class="home page-template page-template-page-visual-composer page-template-page-visual-composer-php page page-id-1705 woocommerce-no-js antialiased wpb-js-composer js-comp-ver-5.5.4 vc_responsive">
<div ng-controller="CommonController" ng-init="fetchVisitsData()" id="HeadTop"></div>
<div id="nasa-before-load">
    <div class="nasa-relative nasa-center">
        <div class="nasa-loader">
            <div class="nasa-line"></div>
            <div class="nasa-line"></div>
            <div class="nasa-line"></div>
            <div class="nasa-line"></div>
        </div>
    </div>
</div>

<div ng-controller="AuthBlockController" ng-cloak>
    <div id="MobileHeadMenu">
        <div class="userBtn pointer">
            <a data-enable="1"
               data-toggle="modal"
               ng-if="!data.user"
               data-target="#AuthForm">
                <span class="icon-user"></span>
            </a>
            <a href="/my"
               ng-if="data.user" style="margin-left: 15px; font-size: 200%; font-weight: bold;">
                {{data.user.name.charAt(0)}}
            </a>
        </div>
        <div class="cartHeadBtn pointer">
            <a href="/cart">
                <i class="icon-basket"></i>
                <div ng-show="data.cart.ids.length" class="subIconCount blue">{{data.cart.ids.length}}</div>
            </a>
        </div>
        <div class="wishHeadBtn pointer">
            <a href="/wishes">
                <i class="icon-heart"></i>
                <div ng-show="data.wishes.ids.length" class="subIconCount red">{{data.wishes.ids.length}}</div>
            </a>
        </div>
    </div>
    <nav class="navbar navbar-default navbar-fixed-top" style="background: #fff;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand pointer" href="/">
                    <div class="header_logo mainLogo" alt="www.Tukan.Store"></div>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="userBtn">
                        <a data-enable="1"
                           data-toggle="modal"
                           ng-if="!data.user"
                           data-target="#AuthForm">
                            <span class="icon-user"></span>
                        </a>

                        <a href="/my"
                           ng-if="data.user" style="margin-left: 15px; font-size: 200%; font-weight: bold;">
                            {{data.user.name.charAt(0)}}
                        </a>
                    </li>
                    <li class="cartHeadBtn"><a href="/cart">
                            <i class="icon-basket"></i>
                            <div ng-show="data.cart.ids.length" class="subIconCount blue">{{data.cart.ids.length}}</div>
                        </a>
                    </li>
                    <li class="wishHeadBtn"><a href="/wishes">
                            <i class="icon-heart"></i>
                            <div ng-show="data.wishes.ids.length" class="subIconCount red">{{data.wishes.ids.length}}
                            </div>
                        </a>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
            <div>
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
            </div>
        </div>
    </nav>
</div>
<a id="start"></a>
<div id="header-content" class="site-header" style="min-height: 51px;">

</div>
<? include_once __DIR__ . "/auth.php" ?>


<div id="wrapper" class="fixNav-enabled">

    <div id="main-content" class="site-main light">