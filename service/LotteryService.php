<?php

namespace assets\services;

use Cassandra\Exception\AlreadyExistsException;
use CatalogFilter;
use core\service\MySqlService;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 10/3/2018
 * Time: 10:40 PM
 */
class LotteryService extends BaseRestService{

	protected static $instance = null;

    /**
     * @return LotteryService
     */
	public static function getInstance(){
		if(!self::$instance){
			self::$instance      = new self();
			self::$instance->sql = MySqlService::getInstance();
		}

		return self::$instance;
	}

	public function setWin($uid, $promo, $name, $discount, $free){
	    return $this->sql->smart_query("INSERT INTO lottery(uid,name,discount,free,promo,datetime) VALUES(%d,%s,%d,%d,%s,%d)", $uid, $name, $discount, $free, $promo, time());
    }

	public function parseDiscount($name){
	    preg_match_all("#([^%]+\d)+%#", $name, $res);
	    return ($res[1][0]??0)*1;
    }

	public function parseFree($name){
	    if(preg_match("#\+1%#", $name)){
	        return 1;
        }
	    return 0;
    }

	public function getWin($uid, $promo){
	    $exists = $this->sql->smart_select_row("SELECT *  FROM lottery WHERE uid=%d AND promo=%s", $uid, $promo);
	    return $exists;
    }

}