<?
use core\service\App;

$version = time();
$tr = Translate::getInstance();
?>
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="//gmpg.org/xfn/11"/>
	<link rel="pingback" href="https://tukan.store/xmlrpc.php"/>
    <link rel="shortcut icon" href="/web/img/icon_only.ico" type="image/x-icon">

    <title><?=$tr->get("HEAD_TITLE");?></title>
    <meta name="description" content="<?=$tr->get("HEAD_DESCRIPTION");?>">
    <meta name="keywords" content="<?=$tr->get("HEAD_KEYWORDS");?>">
    <meta name="author" content="<?=$tr->get("HEAD_AUTHOR");?>">

    <script type="text/javascript" src="/web/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/web/assets/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/web/assets/js/jquery-migrate.min.js"></script>

    <link href="/web/assets/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/web/assets/bootstrap-4.3.1/js/bootstrap.min.js"></script>

	<link href="/web/assets/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/web/assets/bootstrap-toastr/toastr.min.js"></script>


	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="/web/assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>
	<link href="/web/assets/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>

	<link rel='dns-prefetch' href='//fonts.googleapis.com'/>
	<link rel='dns-prefetch' href='//s.w.org'/>
	<link rel="alternate" type="application/rss+xml" title="tukan.store &raquo; Feed"
	      href="https://tukan.store/feed/"/>
<!--	<link rel='stylesheet' id='elessi-style-css' href='/web/template/style.css?ver=--><?//=$version?><!--' media='all'/>-->


    <link type="text/css" rel="stylesheet" href="/web/assets/lightslider-master/src/css/lightslider.css" />
    <script src="/web/assets/lightslider-master/src/js/lightslider.js"></script>

	<script type="text/javascript" src="/web/assets/ng/angular.min.js"></script>
	<script type="text/javascript" src="/web/assets/ng/angular-cookies.min.js"></script>
	<script type="text/javascript" src="/web/assets/ng/angular-route.min.js"></script>
	<script type="text/javascript" src="/web/assets/ng/angular-resource.min.js"></script>
	<script type='text/javascript' src='/web/assets/js/ng-infinite-scroll.min.js'></script>

	<script type='text/javascript' src='/web/assets/progressbar.js-master/dist/progressbar.min.js'></script>

	<script type="text/javascript">
        var app = angular.module("root", ['infinite-scroll', 'ngRoute', 'ngResource', 'ngCookies']);
    </script>

	<link rel="stylesheet" type="text/css" href="/web/css/main.css?t=<?=$version?>"/>
	<link rel="stylesheet" type="text/css" href="/web/css/checklist.css?t=<?=$version?>"/>
    <script type="text/javascript" src="/web/js/service.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/common.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/data.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/factory.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/main.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/auth.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/product.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/wishes.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/cart.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/modern.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/translate_controller.js?t=<?=$version?>"></script>
	<script type="text/javascript" src="/web/js/controller/sales_promo.js"></script>


    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5bf306b3d329fa00111f74c2' async='async'></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v4.0&appId=<?=Properties::getInstance()->getFacebookAuthAppID()?>&autoLogAppEvents=1"></script>

</head>