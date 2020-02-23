<?php

namespace assets\services;

use core\service\MySqlService;
use core\service\TranslateService;
use stdClass;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 10/3/2018
 * Time: 10:40 PM
 */
class ModernService extends BaseRestService{

    protected static $instance = null;

    /**
     * @return ModernService
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
            self::$instance->translate = TranslateService::getInstance();
        }

        return self::$instance;
    }

    public function getPlaces(){
        $xml    = simplexml_load_file(__DIR__ . "/../itella_post/places.xml");
        $json   = json_encode($xml);
        $places = json_decode($json, false);
        $res    = [];
        foreach($places->place as $place){
            $obj       = new stdClass();
            $obj->city = $place->city;
            $obj->addr = $place->address;
            $obj->name = $place->name;
            $obj->search = $obj->city . $obj->name;
            $res[]     = $obj;
        }
        usort($res, function($a, $b){
            return strcmp($a->city . $a->addr . $a->name, $b->city . $b->addr . $b->name);
        });

        return $res;
    }

}