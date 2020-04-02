<?php


class CartDto extends RemoteBase{
    protected static $instance = null;

    /**
     * @return CartDto
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($uid){
        return self::getData("/shop/rest/cart/user/" . $uid);
    }
}