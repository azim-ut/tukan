<?php

use assets\services\CartService;
use assets\services\WishService;
use core\manager\ParamsManager;
use core\manager\SessionManager;
use core\manager\UserManager;
use core\utils\SafeUtils;
use rest\src\RestBase;

/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/21/2018
 * Time: 5:25 PM
 */

class CartRest extends RestBase{

	public function GET_ids(){
		$uid             = UserManager::currentId();
		$sid             = SessionManager::id();
		$this->out->data = CartService::getInstance()->ids($sid, $uid);
	}

    public function GET_cart(){
        $sid = SessionManager::id();
        $this->out->data = null;
    }

    public function POST_submit(){
        $address = ParamsManager::getParam("address");
        $details = ParamsManager::getParam("details");
    }

	public function GET_add($postId){
		SafeUtils::checkNumbers($postId);
		$uid = UserManager::currentId();
		$sid = SessionManager::id();
		WishService::getInstance()->addItem($sid, $uid, $postId);
		$this->out->data = WishService::getInstance()->ids($sid, $uid);
	}

	public function GET_del($postId){
		SafeUtils::checkNumbers($postId);
		$uid = UserManager::currentId();
		$sid = SessionManager::id();
		WishService::getInstance()->delItem($sid, $uid, $postId);
		$this->out->data = WishService::getInstance()->ids($sid, $uid);
	}
}