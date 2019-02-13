<?php
require_once(__DIR__."/config.php");

use assets\services\CatalogService;
use core\manager\ParamsManager;

$catalog = CatalogService::getInstance();

$id = ParamsManager::getParam("id");
$postId = ParamsManager::getParam("postId");
if($id && $postId){
	echo $catalog->mainImageItem($postId, $id);
}else{
	echo "No data";
}