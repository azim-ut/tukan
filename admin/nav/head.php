<?

use core\exception\NoUserException;
use core\manager\UserManager;

$version = "?t=" . time();
try{
    $user = UserManager::current();
    if(!$user){
        throw new NoUserException();
    }
    if($user->getId() != 3 && $user->getId() != 4){
        echo "Sorry, no access";
        exit();
    }
}catch(NoUserException $e){
    echo "Вы не авторизованы. <a href='/'>Tukan.store</a>";
    exit();
}
?>
<!DOCTYPE html>
<html ng-app='root'>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tukan Store</title>


    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="/assets/js/clipboard.min.js"></script>

    <script type="text/javascript" src="/assets/global/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="/assets/global/ng/angular.min.js"></script>
    <script type="text/javascript" src="/assets/global/ng/angular-cookies.min.js"></script>
    <script type="text/javascript" src="/assets/global/ng/angular-route.min.js"></script>
    <script type="text/javascript" src="/assets/global/ng/angular-resource.min.js"></script>


	<link rel="stylesheet" type="text/css" media="all" href="/assets/global/bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="/assets/global/bootstrap/css/bootstrap-theme.min.css   "/>
    <link href="/assets/css/main.css<?= $version ?>" rel="stylesheet"/>

    <script type="text/javascript">angular.module("root", ['ngRoute','ngResource','ngCookies']);</script>
	
	<script src="/assets/js/script.js<?= $version ?>"></script>
    <script src="/assets/admin/factory.js<?= $version ?>"></script>
    <script src="/assets/admin/index.js<?= $version ?>"></script>
    <script src="/assets/admin/edit.js<?= $version ?>"></script>
    <script src="/assets/admin/presets.js<?= $version ?>"></script>

</head>
<body>