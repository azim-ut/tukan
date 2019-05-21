<?php
/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/21/2018
 * Time: 7:21 PM
 */

namespace assets\services;


use core\manager\SessionManager;
use core\manager\UserManager;
use core\service\MySqlService;
use core\utils\SafeUtils;

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

	public function ids($sid, $uid){
		$uid  = $uid ?? 0;
		$rows = $this->sql->smart_select_rows(
			"SELECT i.post_id AS id
			FROM cart AS c
			LEFT JOIN cart_items AS i ON i.cart_id=c.id
			WHERE (c.sid=%s OR c.uid=%d) AND c.processing=0", $sid, $uid
		);
		$ids  = array();
		foreach($rows as $row){
			$ids[] = intval($row->id);
		}

		return $ids;
	}
}