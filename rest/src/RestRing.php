<?php

use assets\services\RingService;
use core\manager\UserManager;
use rest\src\RestBase;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 11/6/2018
 * Time: 9:19 AM
 */
class RestRing extends RestBase{
    protected static $instance = null;

    public function GET(){
        $uid             = UserManager::currentId();
        RingService::getInstance()->post($uid);
        $this->out->data = $uid . " Ring!";
    }
}