<?php


class Properties extends RemoteBase{
    protected static $instance = null;
    private $facebookID = null;
    private $data = [];

    /**
     * @return Properties
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getFacebookAuthAppID(){
        if(!$this->facebookID){
            $this->facebookID = self::src( "/core/rest/property/fb/app/id");
        }
        return $this->facebookID;
    }

    public function prop($name){
        if(!isset($this->data[$name])){
            $this->data[$name] = self::src( "/core/rest/property/prop/string/".$name);
        }
        return $this->data[$name];
    }

    public function getBrands(){
        if(!isset($this->data["brands"])){
	        $this->data["brands"] = self::src( "/core/rest/property/prop/array/brands");
        }
        return $this->data["brands"];
    }
}