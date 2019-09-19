<?php
/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/21/2018
 * Time: 7:21 PM
 */

namespace assets\services;


use Cart;
use core\manager\SessionManager;
use core\service\MySqlService;
use Goods;

class CartService extends BaseService{

    /**
     * @var CartService
     */
    protected static $instance = null;

    /**
     * @return CartService
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
        }

        return self::$instance;
    }

    public function getCart(){
        return new Cart(["sid" => SessionManager::id()]);
    }


    public function mergeSidToUser($sid, $uid){
        $this->sql->smart_query("UPDATE cart SET uid=%d WHERE sid=%s AND uid=0", $uid, $sid);
    }

    public function setSidToUser($sid){
        $row = $this->sql->smart_select_row("SELECT uid FROM user_session WHERE sess=%s ORDER BY exp DESC LIMIT 1", $sid);
        if($row){
            $this->sql->smart_query("UPDATE cart SET uid=%d WHERE sid=%s", $row->uid, $sid);
        }
    }

    public function submitCart($cartID){
        $this->sql->smart_query("UPDATE cart SET orders=1, cart=0, ordered=%d WHERE id=%d", time(), $cartID);
        $this->markCartUpdated($cartID);
    }

    /**
     * @param $cart Cart
     * @param $postId int
     */
    public function addItem($cart, $postId){
        $item = new Goods($postId);
        if($item){
            $this->sql->smart_query("REPLACE cart_items(cart, post, count, title, img, price) VALUES(%d,%d,1,%s,%s,%01.4f)", $cart->getId(), $postId, $item->getTitle(), $item->getImg(), $item->getPrice());
            $this->markCartUpdated($cart->getId());
        }
        $cart->fetchItems();
    }

    /**
     * @param $cart Cart
     * @param $postId int
     */
    public function delItem($cart, $postId){
        $this->sql->smart_query("DELETE FROM order_post WHERE id=%d AND post=%d", $cart->getId(), $postId);
        $this->markCartUpdated($cart->getId());
        $cart->fetchItems();
    }

    /**
     * @param $cart Cart
     *
     * @return array
     */
    function ids($cart){
        $ids   = array();
        $items = $cart->getItems();
        foreach($items as $row){
            $ids[] = intval($row->getPost());
        }

        return $ids;
    }

    /**
     * @param $cartID int
     */
    private function markCartUpdated($cartID){
        $this->sql->smart_query("UPDATE cart SET updated=%d WHERE id=%d", time(), $cartID);

    }
}