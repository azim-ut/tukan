<?php


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
            $obj            = self::src("core/rest/translate/translates");
            self::$cache    = $obj->list;
            self::$locale   = $obj->lang;
        }

        return self::$instance;
    }

    public function get($code){
        return self::$cache->$code ?? $code;
    }

    public function locale(){
        return self::$locale;
    }

}