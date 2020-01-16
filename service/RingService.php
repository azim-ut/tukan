<?php

namespace assets\services;

use core\service\MySqlService;
use core\utils\DateUtils;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 10/3/2018
 * Time: 10:40 PM
 */
class RingService extends BaseRestService{

    protected static $instance = null;

    /**
     * @return RingService
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
        }

        return self::$instance;
    }

    public function post($uid){
        $sql = MySqlService::getInstance();
        $dt  = DateUtils::tmToSqlDateTime(time());

        return $sql->smart_query("INSERT INTO user_ring(uid, dt) VALUES(%d, %s)", $uid, $dt);
    }

}