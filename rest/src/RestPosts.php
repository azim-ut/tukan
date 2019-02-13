<?php

use assets\services\CatalogService;
use assets\services\PostService;
use assets\services\TagsService;
use assets\services\WebCatalogService;
use core\manager\ParamsManager;
use core\utils\SafeUtils;
use rest\src\RestBase;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 11/6/2018
 * Time: 9:19 AM
 */
class RestPosts extends RestBase{
	protected static $instance = null;

	public function GET_product($postId){
		SafeUtils::checkNumbers($postId);
		$product = new stdClass();
        $product->id = $postId;
		$this->out->data = $product;
	}

	public function GET_del($post){
		SafeUtils::checkNumbers($post);
		$this->out->data = CatalogService::getInstance()->delItem($post);
	}

	public function POST_list(){
		$status = ParamsManager::getParamDef("status", "publish");
		$tags = ParamsManager::getParamDef("tags", array());
		$offset   = ParamsManager::getParam("offset");
		$limit    = ParamsManager::getParam("limit");


		SafeUtils::checkNumbers($offset, $limit);
		$tags = TagsService::getInstance()->filterTags($tags);
		$this->out->tags = $tags;
		$total = WebCatalogService::getInstance()->getPostsTotal($status, $tags);
		$this->out->data->total = $total;
		$this->out->data->offset = intval($offset);
		$pages = array();

		for($i=0; $i<$total/$limit; $i++){
		    if($i == $offset/$limit){
                array_push($pages, 1);
            }else{
                array_push($pages, 0);
            }
        }
		$this->out->data->pages = $pages;
		$this->out->data->list = WebCatalogService::getInstance()->getPosts($status, $tags, $offset, $limit);
	}

	public function GET_publish($postId){
		SafeUtils::checkNumbers($postId);
		$this->out->data = PostService::getInstance()->publish($postId);
	}

	public function GET_draft($postId){
		SafeUtils::checkNumbers($postId);
		$this->out->data = PostService::getInstance()->draft($postId);
	}
}