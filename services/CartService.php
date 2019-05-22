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
		return $this->sql->smart_query("UPDATE cart SET uid=%d WHERE sid=%s", $uid, $sid);
	}

	public function setSidToUser($sid){
		$row = $this->sql->smart_select_row("SELECT uid FROM user_session WHERE sess=%s ORDER BY exp DESC LIMIT 1", $sid);
		if($row){
			$this->sql->smart_query("UPDATE cart SET uid=%d WHERE sid=%s", $row->uid, $sid);
		}
	}

	/**
	 * @param $cart Cart
	 * @param $postId int
	 */
	public function addItem($cart, $postId){
		$item = $cart->getCartItem($postId);
		if($item){
			$this->sql->smart_query("REPLACE cart_items(cart, post, count, price) VALUES(%d,%d,%d,%d,%01.4f)", $cart->getId(), $item->getPost(), 0);
		}
	}

	/**
	 * @param $cart Cart
	 * @param $postId int
	 */
	public function delItem($cart, $postId){
		$item = $cart->getCartItem($postId);
		if($item){
			$this->sql->smart_query("DELETE FROM cart_items WHERE id=%d AND postid=%d", $cart->getId(), $item->getPost());
		}
	}

	/**
	 * @param $cart Cart
	 *
	 * @return array
	 */
	function ids($cart){
		$ids = array();
		foreach($cart->getItems() as $row){
			$ids[] = intval($row->getId());
		}

		return $ids;
	}
}