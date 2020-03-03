<?

use core\service\TranslateService;

$version = time();

$tr = TranslateService::getInstance();
?>
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="//gmpg.org/xfn/11"/>
	<link rel="pingback" href="https://tukan.store/xmlrpc.php"/>
    
    <title><?=$tr->get("HEAD_TITLE");?></title>
    <meta name="description" content="<?=$tr->get("HEAD_DESCRIPTION");?>">
    <meta name="keywords" content="<?=$tr->get("HEAD_KEYWORDS");?>">
    <meta name="author" content="<?=$tr->get("HEAD_AUTHOR");?>">

    <script type="text/javascript" src="/web/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/web/assets/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="/web/assets/js/jquery-migrate.min.js"></script>
    <link rel="shortcut icon" href="icon/favicon.ico"/>


    <link href="/web/assets/bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/web/assets/bootstrap-4.3.1/js/bootstrap.min.js"></script>

	<link href="/web/assets/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="/web/assets/bootstrap-toastr/toastr.min.js"></script>


	<link href="/web/assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>
	<link href="/web/assets/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
</head>