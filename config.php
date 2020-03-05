<?php
error_reporting(E_ALL);

ini_set("log_errors" , "1");
ini_set("error_log" , "errors.log");
date_default_timezone_set("Europe/Tallinn");

require_once(__DIR__ . "/dto/Properties.php");
require_once(__DIR__ . "/dto/Catalog.php");
require_once(__DIR__ . "/dto/Translate.php");