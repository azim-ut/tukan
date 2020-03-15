<?php


use core\Engine;

class Translate extends RemoteBase{
    protected static $instance = null;
    private static $cache = [];
    private static $locale = "en_US";

    /**
     * @return Translate
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
            self::updateCache(Engine::getInstance()->getLocale());
        }

        return self::$instance;
    }

    public function get($code){
        return self::$cache->$code ?? $code;
    }

    public function locale(){
        return self::$locale;
    }

    public static function updateCache($locale){
        $obj            = self::getData("/core/rest/translate/translates/".$locale);
        if($obj){
            self::$cache  = $obj->list ?? [];
            self::$locale = $obj->lang ?? "en_US";
        }
    }

}