<?php
require_once(__DIR__."/config.php");

use assets\services\CatalogService;
use core\manager\ParamsManager;

$catalog = CatalogService::getInstance();

$id = ParamsManager::getParam("id");
if($id){
	echo $catalog->delImage($id);
}