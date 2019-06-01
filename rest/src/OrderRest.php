<?php

use assets\services\OrderService;
use core\manager\UserManager;
use rest\src\RestBase;

/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/21/2018
 * Time: 5:25 PM
 */
class OrderRest extends RestBase{

    public function GET_ids(){
        $this->out->data = OrderService::getInstance()->ids(UserManager::currentId());
    }

    public function GET_list(){
        $this->out->data = OrderService::getInstance()->getList(UserManager::currentId());
    }

    private function getOrder($id){
        if($uid){
            $cart = new Cart($id);
        }else{
            $cart = new Cart(["sid" => $sid]);
        }

        return $cart;
    }
}