<?php


class UserDto extends RemoteBase{
    protected static $instance = null;

    /**
     * @return UserDto
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get(){
	    return self::getData( "/core/rest/user/check");
    }

    public function admin(){
	    return self::getData( "/core/rest/user/admin");
    }

    public function logout(){
	    return self::getData( "/core/rest/user/logout");
    }
}