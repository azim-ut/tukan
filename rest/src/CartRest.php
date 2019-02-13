<?php

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

    public function GET_cart(){
        $sid = SessionManager::id();
        $this->out->data = null;
    }

    public function POST_submit(){
        $address = ParamsManager::getParam("address");
        $details = ParamsManager::getParam("details");
    }

    public function GET_delivery_list(){

    }

    public function POST_delivery_set(){

    }

    public function POST_item_add(){
        $id = ParamsManager::getParamInt("id");
        $count = ParamsManager::getParamInt("count", 1);
        $user = UserManager::current();
        $this->out->data = null;
    }

    public function DELETE_item_del($id){
        $sid = SessionManager::id();
        $user = UserManager::current();
        $this->out->data = null;
    }

    public function POST_item_inc(){
        $id = ParamsManager::getParamInt("id");
        $user = UserManager::current();
        $this->out->data = null;
    }

    public function POST_item_dec(){
        $id = ParamsManager::getParamInt("id");
        $user = UserManager::current();
        $this->out->data = null;
    }
}