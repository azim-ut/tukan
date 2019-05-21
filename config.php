<?php
error_reporting(E_ALL);

ini_set("log_errors" , "1");
ini_set("error_log" , "errors.log");
date_default_timezone_set("Europe/Tallinn");

require_once(__DIR__."/services/BaseService.php");
require_once(__DIR__."/services/CatalogService.php");
require_once(__DIR__."/services/TagsService.php");
require_once(__DIR__."/services/PostService.php");
require_once(__DIR__."/services/PresetsService.php");
require_once(__DIR__."/services/WebCatalogService.php");
require_once(__DIR__."/services/WishService.php");
require_once(__DIR__."/services/CartService.php");
