<?php

use assets\services\CartService;
use assets\services\WishService;
use core\manager\SessionManager;
use core\manager\UserManager;
use core\rest\UserRest;

/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/21/2018
 * Time: 5:25 PM
 */
class AuthRest extends UserRest{

    public function POST_login(){
        parent::POST_login();
        $user = $this->userObject();
        CartService::getInstance()->mergeSidToUser(SessionManager::id(), $user->uid);
        WishService::getInstance()->mergeSidToUser(SessionManager::id(), $user->uid);
        $this->out->data->user = $this->userObject();
    }

    public function POST_new(){
        parent::POST_new();
        $user = $this->userObject();
        CartService::getInstance()->mergeSidToUser(SessionManager::id(), $user->uid);
        WishService::getInstance()->mergeSidToUser(SessionManager::id(), $user->uid);
        $this->out->data->user = $this->userObject();
    }

    public function GET_check(){
        $this->out->data->user = $this->userObject();
    }

    private function userObject(){
        $res          = new stdClass();
        $uid          = UserManager::currentId();
        $sid          = SessionManager::id();
        $res->uid     = $uid;
        $res->updated = time();
        if($uid){
            $res->current = UserManager::current();
        }

        return $res;
    }

    public function postLoginUser(){
        parent::postLoginUser();
        $uid = UserManager::currentId();
        $sid = SessionManager::id();
        WishService::getInstance()->mergeSidToUser($sid, $uid);
    }

}