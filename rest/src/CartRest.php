<?php

use assets\services\CartService;
use core\exception\NoUserException;
use core\exception\WrongParamException;
use core\manager\ParamsManager;
use core\manager\SessionManager;
use core\manager\UserManager;
use core\utils\SafeUtils;
use core\utils\StringUtils;
use rest\src\RestBase;

/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/21/2018
 * Time: 5:25 PM
 */
class CartRest extends RestBase{

    public function GET_ids(){
        $cart            = $this->getCart();
        $this->out->data = CartService::getInstance()->ids($cart);
    }

    public function GET_cart(){
        $this->out->data = $this->getCart();
    }

    public function GET_list(){
        $this->out->data = $this->getCart();
    }

    public function POST_submit(){
        $address = ParamsManager::getParam("address");
        if(!UserManager::current()){
            throw new NoUserException("Please login to send the order.");
        }
        $cart = $this->getCart();
        if(StringUtils::isEmpty($address)){
            throw new WrongParamException("Please add the address and a phone to delivery. " . $address);
        }
        $cart->setAddress($address);
        CartService::getInstance()->submitCart($cart->id);
    }

    public function POST_add($postId){
        SafeUtils::checkNumbers($postId);
        $cart = $this->getCart();
        CartService::getInstance()->addItem($cart, $postId * 1);
        $this->out->data = CartService::getInstance()->ids($cart);
    }

    public function GET_ids_del($postId){
        SafeUtils::checkNumbers($postId);
        $cart = $this->getCart();
        CartService::getInstance()->delItem($cart, $postId * 1);
        $this->out->data = CartService::getInstance()->ids($cart);
    }

    public function GET_del($postId){
        SafeUtils::checkNumbers($postId);
        $cart = $this->getCart();
        CartService::getInstance()->delItem($cart, $postId * 1);
        $this->out->data = $this->getCart();
    }

    private function getCart(){
        $uid = UserManager::currentId();
        $sid = SessionManager::id();
        if($uid){
            $cart = new Cart(["uid" => $uid]);
        }else{
            $cart = new Cart(["sid" => $sid]);
        }

        return $cart;
    }
}