<?php
require_once(__DIR__."/config.php");

use assets\services\CatalogService;
use assets\services\TagsService;
use core\manager\ParamsManager;
use core\manager\FileManager;

require_once("nav/head.php");
$catalog = CatalogService::getInstance();
$tagsService = TagsService::getInstance();

$upated = false;
$id = ParamsManager::getParam("id");

$title = ParamsManager::getParam("title");
$height = ParamsManager::getParam("height");
$price = ParamsManager::getParam("price");
$content = ParamsManager::getParam("content");
try{
	if(sizeof($_FILES) && sizeof($_FILES["photos"])){
		
		for($i=0; $i<sizeof($_FILES["photos"]["tmp_name"]); $i++){
			
			$type = $_FILES["photos"]["type"][$i];
			
			if($type != "image/jpeg" && $type != "image/jpg"){
				continue;
			}
			$temp = $_FILES["photos"]["tmp_name"][$i];
			$hash = $id."_".md5($temp . time());
			$file = "../wp-content/uploads/auto/".$hash.".jpg";
			if(FileManager::loadFile($temp, $file)){
				$file800x800 = $hash."_800x800";
				$file200x200 = $hash."_200x200";
				if(FileManager::resizeJpg($file, "../wp-content/uploads/auto/".$file800x800.".jpg", 800, 800) && FileManager::resizeJpg($file, "../wp-content/uploads/auto/".$file200x200.".jpg", 200, 200)){
					$catalog->addItemImage($id, "auto", $hash, "jpg", $file800x800, $file200x200);
				}
			}
		}
	}
}catch(Exception $e){
	var_dump($e);
}


if($title && $id*1){
	$upated = $catalog->editItem($id, $title, $height, $price, $content);
	?>
    <script>location.href="edit.php?id=<?=$id?>";</script>
    <?
	exit();	
}



$row = $catalog->getItem($id);
$images = $catalog->getPostsImages($id, 200, 200);
?>




<script>
(function() {
var imagePostId = 0;
var imageSrc = null;
$('#fileup').click(function() {
   $('#files').click();
});

});

function showImageForm(id, src){
	$('#EditImage').modal('show');
	imagePostId = id;
	imageSrc = src;
}
function popupImage(){
	if(imageSrc){
		window.open(imageSrc, "_blank");
	}
}

function delImage(){
	if(confirm("Удалить изображение?")){
		$.get( "/assets/del_image.php?id=" + imagePostId, function( data ) {
			if(data == "Ok"){
				location.reload();
				return;
			}
			alert(data);
		});
	}
}

function mainImage(postId){
	if(confirm("Сделать основным?")){
		$.get( "/assets/main_image.php?id=" + imagePostId + "&postId=" + postId, function( data ) {
			location.reload();
		});
	}
}

function upload(){
	$("#EditItemForm").submit();
}
</script>
<div ng-controller="EditController" ng-init="fetchList(<?=$row->ID?>);">
    <div class="row">
        <div class="col-xs-6"><button type="button" onclick="location.href='/assets'" class="btn btn-primary btn-block">Home</button></div>
        <div class="col-xs-6"><a href="/product/<?=$row->post_name?>" target="_self"><button class="btn btn-block btn-info"><i class="glyphicon glyphicon-link"></i></button></a></div>
    </div>
    <br/>
    <?
    if($row){
    ?>
    <div>

    <div class="modal fade" tabindex="-1" role="dialog" id="EditImage">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Image</h4>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-xs-4">
                    <button class="btn btn-block btn-danger" onclick="delImage()"><i class="glyphicon glyphicon-trash"></i></button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-block btn-info" onclick="mainImage(<?=$row->ID?>)"><i class="glyphicon glyphicon-star"></i></button>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-block btn-info" onclick="popupImage()"><i class="glyphicon glyphicon-new-window"></i></button>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <form method="POST" enctype="multipart/form-data" action="/assets/edit.php?id=<?=$id?>" id="EditItemForm">
        <div class="form-group row">
            <div class="col-xs-3">
                    <button type="button" class="btn btn-primary btn-block" onclick="this.form.files.click()">
                        <i class="glyphicon glyphicon-camera"></i>
                    </button>
            </div>
            <div class="col-xs-3">
                    &nbsp;
            </div>
            <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-euro"></i></span>
                <input type="number" class="form-control" value="<?=$row->price?>" name="price">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-12">
                <input type="text" placeholder="Название" class="form-control" name="title" value="<?=$row->post_title?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-12" id="ImageResponse"></div>
            <div class="col-xs-12" style="overflow: hidden;">
                <?
                    foreach($images as $obj){
                        $color = "#eaeaea";
                        if($obj->id == $row->img){
                            $color = "#000";
                        }
                        ?>
                        <div style="float: left; padding: 5px; border: <?=$color?> 1px solid; margin: 2px;" onclick="showImageForm(<?=$obj->id?>, '<?=$obj->src?>')">
                            <img src="<?=$obj->m?>" height="150"/>
                        </div>
                        <?
                    }
                ?>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-12">
                Теги:
            </div>
            <div class="col-xs-12">
                <span ng-repeat="row in tags track by $index"
                      style="margin: 2px 5px 0 0;">
                    <button type="button"
                            ng-class="{'btn btn-xs':1, 'btn-success':row.post, 'btn-default':!row.post}"
                            ng-click="toggleTag(post, row.id, row.post)">
                        {{row.name}}
                    </button>
                    <span ng-if="[1,18].indexOf($index)>=0">&nbsp;&nbsp;|||&nbsp;</span>
                </span>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-12">
                Теги:
            </div>
            <div class="col-xs-12">
                <textarea class="form-control" rows="3" name="content"><?=$row->post_content?></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </div>
        </div>
        <input type="file" id="files" name="photos[]" style="visibility: hidden;" multiple onchange="upload()">
    </form>
    </div>
    <?}?>
</div>
