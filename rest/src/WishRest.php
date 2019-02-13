<?php

use assets\services\WishService;
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
class WishRest extends RestBase{

    public function GET_list(){
        $uid = UserManager::currentId();
        if($uid){
            $this->out->data = WishService::getInstance()->usersList($uid);
        }else{
            $sid             = SessionManager::id();
            $this->out->data = WishService::getInstance()->sessionsList($sid);
        }
    }

    public function GET_ids(){
        try{
            $uid             = UserManager::currentId();
            $sid             = SessionManager::id();
            $this->out->data = WishService::getInstance()->ids($sid, $uid);
        }catch(Exception $e){
        }
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