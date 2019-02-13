<?php

use assets\services\TagsService;
use core\utils\SafeUtils;
use rest\src\RestBase;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 11/6/2018
 * Time: 9:19 AM
 */
class RestTags extends RestBase{
	protected static $instance= null;

	public function GET_active(){
		$this->out->data = TagsService::getInstance()->getActiveTags();
	}

	public function GET_all(){
		$this->out->data = TagsService::getInstance()->getAll();
	}

	public function GET_posts($postId){
		SafeUtils::checkNumbers($postId);
		$this->out->data = TagsService::getInstance()->getPostTags($postId);
	}

	public function GET_on($postId, $tagId){
		SafeUtils::checkNumbers($postId, $tagId);
		TagsService::getInstance()->addPostsTag($postId, $tagId);
	}

	public function GET_off($postId, $tagId){
		SafeUtils::checkNumbers($postId, $tagId);
		TagsService::getInstance()->delPostsTag($postId, $tagId);
	}
}