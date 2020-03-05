<?php


class Catalog extends RemoteBase{
    protected static $instance = null;

    /**
     * @return Catalog
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function item($id){
        return self::src(HOST . "shop/rest/catalog/id/".$id);
    }

    public function more($id){
        return self::src(HOST . "shop/rest/catalog/more/".$id);
    }
}