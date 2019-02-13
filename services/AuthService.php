<?php
/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/14/2018
 * Time: 10:58 AM
 */

namespace assets\services;


use rest\src\RestBase;
use core\service\MySqlService;

class AuthService extends BaseService{

	protected static $instance = null;

	public static function getInstance(){
		if(!self::$instance){
			self::$instance      = new self();
			self::$instance->sql = MySqlService::getInstance();
		}

		return self::$instance;
	}

	public function checkUser(){
	}

}