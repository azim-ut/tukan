<?php

use assets\services\CatalogService;
use assets\services\PostService;
use assets\services\PresetsService;
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
class RestPreset extends RestBase{
	protected static $instance = null;

	public function GET_del($id){
		SafeUtils::checkNumbers($id);
		$this->out->data = PresetsService::getInstance()->delPreset($id);
	}

	public function GET_list(){
        $this->out->data = PresetsService::getInstance()->getList();
	}

	public function POST_edit(){
		$id = ParamsManager::getParamInt("id");
		$text = ParamsManager::getParam("text");
		$sort = ParamsManager::getParamInt("sort");
		$this->out->data = PresetsService::getInstance()->editPreset($id, $text, $sort);
	}

	public function POST_add(){
		$text = ParamsManager::getParam("text");
		$this->out->data = PresetsService::getInstance()->addPreset($text);
	}
}