<?php
require_once(__DIR__."/config.php");

use assets\services\CatalogService;
use core\manager\ParamsManager;

$catalog = CatalogService::getInstance();
$title = ParamsManager::getParam("title");
$price = ParamsManager::getParam("price");
$height = ParamsManager::getParam("height");
if($title != null){
	$id = $catalog->addItem($title, $height, $price);
	if($id){
		header("Location: edit.php?id=".$id);
		exit();
	}
}
require_once("nav/head.php");

?>

<div class="row">
	<div class="col-xs-12"><button type="button" onclick="location.href='/assets'" class="btn btn-block">Cancel</button></div>
</div>
<br/>
<div>
<form method="POST" enctype="multipart/form-data" action="/assets/new.php" id="NewItemForm">
	
	<div class="form-group row">
		<div class="col-xs-12">
			<input type="text" placeholder="Название" class="form-control" name="title">
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-xs-12">
			<button type="submit" class="btn btn-block">Create</button>
		</div>
	</div>
</form>
</div>