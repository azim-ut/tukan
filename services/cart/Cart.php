<?php

use core\manager\SessionManager;
use core\manager\UserManager;
use core\service\MySqlService;

class Cart{
    public $id;
    private $uid;
    private $sid;
    public $address;
    public $items = array();
    public $sum = 0;
    public $ordered = 0;
    public $updated = 0;
    public $finished = 0;
    private $sql;

    public function __construct($args){
	    $this->sql = MySqlService::getInstance();
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
        $res       = $sql->smart_query("INSERT INTO orders(sid, uid, address, cart) VALUES(%s, %d, %s, %d)",
            $this->sid, $this->uid, $this->address, time()
        );
        if($res){
            $this->initByUid($sql->last_id());
        }
    }

    private function initById($id){
        $sql   = MySqlService::getInstance();
        $query = sprintf("SELECT * FROM orders WHERE id=%d AND cart>0", $this->sql->smart($id));
        $this->dbQuery($query);
    }

    private function initBySid($sid){
        $sql   = MySqlService::getInstance();
        $query = sprintf("SELECT * FROM orders WHERE sid=%s AND cart>0", $this->sql->smart($sid));
        $this->dbQuery($query);
    }

    private function initByUid($uid){
        $query = sprintf("SELECT * FROM orders WHERE uid=%d AND cart>0", $this->sql->smart($uid));
        $this->dbQuery($query);
    }

    private function dbQuery($query){
        $row = $sql->select_row($query);
        if($row){
            $this->id       = $row->id * 1;
            $this->uid      = $row->uid * 1;
            $this->sid      = $row->sid;
            $this->address  = $row->address;
            $this->ordered  = $row->ordered;
            $this->updated  = $row->updated;
            $this->finished = $row->finished;
        }
    }

    public function fetchItems(){
        $sql         = MySqlService::getInstance();
        $rows        = $sql->smart_select_rows("SELECT * FROM order_post WHERE id=%d", $this->id);
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

    public function getCartItem($post){
        $res = null;
        foreach($this->getItems() as $item){
            if($item->getId() === $post){
                $res = $item;
            }
        }

        return $res;
    }

    public function setAddress($address){
        $sql = MySqlService::getInstance();
        $sql->smart_query("UPDATE orders SET address=%s WHERE id=%d", $address, $this->getId());
        $this->address = $address;
    }

    public function removeItem($post){
        $sql = MySqlService::getInstance();
        $sql->smart_query("DELETE FROM order_post WHERE id=%d AND post=%d", $this->getId(), $post);
    }

    /**
     * @return CartItem[]
     */
    public function getItems():array{
        return $this->items;
    }
}