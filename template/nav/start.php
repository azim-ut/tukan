<!DOCTYPE html>
<html lang="ru-RU" ng-app='root'>
<? include_once __DIR__ . "/head.php" ?>

<body ng-cloak="" class="home page-template page-template-page-visual-composer page-template-page-visual-composer-php page page-id-1705 woocommerce-no-js antialiased wpb-js-composer js-comp-ver-5.5.4 vc_responsive">

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
            <a class="navbar-brand pointer" href="/#start"
               style="background: transparent url(/web/img/logo.jpg) no-repeat center center/contain">
                <div style="width: 100px;"
                     class="header_logo" alt="www.Tukan.Store"></div>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/"><i class="icon-home"></i></a></li>
                <li><a href="/help"><i class="icon-question"></i></a></li>
                <li><a href="/wishes"><i class="icon-heart"></i>
                        <span ng-if="data.wishes.length" style="font-weight: 700;">({{data.wishes.length}})</span>
                    </a>
                </li>
                <li>
                    <a data-enable="1"
                       data-toggle="modal"
                       data-target="#AuthForm">
                        <span class="icon-login"></span>
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
        <div ng-controller="AuthBlockController" ng-cloak>
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
                                    <span ng-if="data.wishes.length"
                                          style="font-weight: 700;">({{data.wishes.length}})</span>
                                </a>
                            </li>
                            <li class="menu-item color"
                                ng-click="logout()"
                                ng-if="data.user" style="margin-left: 15px;">
                                <span class="icon-logout"></span>
                                <span class="nasa-login-title">Выход</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>

<a id="start"></a>
<div id="header-content" class="site-header" style="min-height: 60px;">

</div>
<? include_once __DIR__ . "/auth.php" ?>


<div id="wrapper" class="fixNav-enabled">

    <div id="main-content" class="site-main light">