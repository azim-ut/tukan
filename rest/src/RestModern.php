<?php

use assets\services\ModernService;
use rest\src\RestBase;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 11/6/2018
 * Time: 9:19 AM
 */
class RestModern extends RestBase{
    protected static $instance = null;

    public function GET_places(){
        $this->out->data = ModernService::getInstance()->getPlaces();
    }
}