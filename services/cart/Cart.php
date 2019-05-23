<?php

use core\manager\SessionManager;
use core\manager\UserManager;
use core\service\MySqlService;

class Cart{
	public $id;
	private $uid;
	private $sid;
	public $address;
	public $details;
	public $shipping;
	public $items = array();
	public $sum = 0;

	private $status;

	public function __construct($args){
		if(is_int($args)){
			$this->initById($args);
		}else if(is_array($args) && array_key_exists('sid', $args)){
			$this->sid = $args['sid'];
			$this->initBySid($this->sid);
		}else if(is_array($args) && array_key_exists('uid', $args)){
			$this->uid = $args['uid'];
			$this->initByUid($this->uid);
		}
		if(!$this->id){
			$this->create();
		}
		$this->fetchItems();
	}

	private function create(){
		if(!$this->sid){
			$this->sid = SessionManager::id();
		}
		$this->uid = UserManager::getUserIdBySessionId($this->sid);
		$sql       = MySqlService::getInstance();
		$res       = $sql->smart_query("INSERT INTO cart(sid, uid, address, details, shipping) VALUES(%s, %d, %s, %s, %s)",
			$this->sid, $this->uid, $this->address, $this->details, $this->shipping
		);
		if($res){
			$this->initByUid($sql->last_id());
		}
	}

	private function initById($id){
		$sql   = MySqlService::getInstance();
		$query = sprintf("SELECT * FROM cart as c WHERE c.id=%d AND c.status='PREPARE'", $sql->smart($id));
		$this->dbQuery($query);
	}

	private function initBySid($sid){
		$sql   = MySqlService::getInstance();
		$query = sprintf("SELECT * FROM cart as c WHERE c.sid=%s AND c.status='PREPARE'", $sql->smart($sid));
		$this->dbQuery($query);
	}

	private function initByUid($uid){
		$sql   = MySqlService::getInstance();
		$query = sprintf("SELECT * FROM cart as c WHERE c.uid=%d AND c.status='PREPARE'", $sql->smart($uid));
		$this->dbQuery($query);
	}

	private function dbQuery($query){
		$sql = MySqlService::getInstance();
		$row = $sql->select_row($query);
		if($row){
			$this->id       = $row->id * 1;
			$this->uid      = $row->uid * 1;
			$this->sid      = $row->sid;
			$this->address  = $row->address;
			$this->details  = $row->details;
			$this->shipping = $row->shipping;
			$this->status   = $row->status;
		}
	}

	public function fetchItems(){
		$sql         = MySqlService::getInstance();
		$rows        = $sql->smart_select_rows("SELECT * FROM cart_items WHERE cart=%d", $this->id);
		$this->items = array();
		foreach($rows as $r){
			$item      = new CartItem($r);
			$this->sum += $item->getPrice() * $item->getCount();
			array_push($this->items, $item);
		}
	}

	public function getId(){
		return $this->id;
	}

	public function getUid(){
		return $this->uid;
	}

	public function getSid(){
		return $this->sid;
	}

	public function getAddress(){
		return $this->address;
	}

	public function getDetails(){
		return $this->details;
	}

	public function getShipping(){
		return $this->shipping;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getCartItem($post){
		$res = null;
		foreach($this->getItems() as $item){
			if($item->getId() === $post){
				$res = $item;
			}
		}

		return $res;
	}

	public function removeItem($post){
		$sql = MySqlService::getInstance();
		$sql->smart_query("DELETE FROM cart_items WHERE id=%d AND post=%d", $this->getId(), $post);
	}

	/**
	 * @return CartItem[]
	 */
	public function getItems():array{
		return $this->items;
	}
}