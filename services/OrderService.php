<?php
/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/21/2018
 * Time: 7:21 PM
 */

namespace assets\services;


use core\service\MySqlService;
use Order;

class OrderService extends BaseService{

    /**
     * @var OrderService
     */
    protected static $instance = null;

    /**
     * @return OrderService
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
        }

        return self::$instance;
    }

    public function getList($uid){
        $items = $this->sql->smart_select_rows("SELECT id FROM cart WHERE uid=%d AND (orders=1 OR done=1) ORDER BY id DESC", $uid);
        $list  = [];
        foreach($items as $row){
            $order = new Order($row->id);
            array_push($list, $order);
        }

        return $list;
    }

    /**
     * @param $uid
     *
     * @return array
     */
    function ids($uid){
        $ids   = array();
        $items = $this->sql->smart_select_rows("SELECT id FROM cart WHERE uid=%d AND orders=1", $uid);
        foreach($items as $row){
            $ids[] = intval($row->id);
        }

        return $ids;
    }
}