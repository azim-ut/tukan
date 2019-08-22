<?php

use core\service\MySqlService;

class Order{
    public $id;
    private $uid;
    private $sid;
    public $address;
    public $items = array();
    public $sum = 0;
    public $ordered = 0;
    public $updated = 0;
    public $finished = 0;

    public function __construct($args){
        $this->initById($args);
    }

    private function initById($id){
        $sql   = MySqlService::getInstance();
        $query = sprintf("SELECT * FROM cart WHERE id=%d AND orders=1", $sql->smart($id));
        $this->dbQuery($query);
    }

    private function dbQuery($query){
        $sql = MySqlService::getInstance();
        $row = $sql->select_row($query);
        if($row){
            $this->id      = $row->id * 1;
            $this->uid     = $row->uid * 1;
            $this->sid     = $row->sid;
            $this->address = $row->address;
            $this->ordered  = $row->ordered;
            $this->updated  = $row->updated;
            $this->finished = $row->finished;
        }
        $this->fetchItems();
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
        $sql->smart_query("UPDATE cart SET address=%s WHERE id=%d", $address, $this->getId());
        $this->address = $address;
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