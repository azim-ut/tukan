<?php

namespace assets\services;
use core\service\MySqlService;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 9/22/2018
 * Time: 9:36 PM
 */

class BaseService{
	/**
	 * @var $sql MySqlService
	 */
	public $sql;
	public $logger;

    protected static $instance = null;

    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
        }

        return self::$instance;
    }

	public function log($msg){
		error_log(PHP_EOL.$msg.PHP_EOL, 3, ERROR_LOG_FILE);
	}

	public function logException(Exception $e){
		$this->log("[Code: ".$e->getCode()." #".$e->getLine()." ".$e->getFile()."] ".$e->getMessage()." ".PHP_EOL);
	}
}