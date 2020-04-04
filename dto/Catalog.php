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
        $res = self::getData("/shop/rest/catalog/id/" . $id);
	    $res->post_title = Translate::getInstance()->get($res->post_title);
        return $res;
    }

    public function more($id){
        $res = self::getData("/shop/rest/catalog/more/" . $id);
        foreach($res as $row){
        	$row->title = Translate::getInstance()->get($row->title);
        }
        return $res;
    }
}