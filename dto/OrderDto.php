<?php


class OrderDto extends RemoteBase{
    protected static $instance = null;

    /**
     * @return OrderDto
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get(){
        return self::getData("/shop/rest/order");
    }

    public function getNonce($nonce){
        return self::getData("/shop/rest/order/nonce/".$nonce);
    }
}