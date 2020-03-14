<?php


class UserDto extends RemoteBase{
    protected static $instance = null;
    private $facebookID = null;
    private $data = [];

    /**
     * @return UserDto
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function logout(){
	    return self::src( "/core/user/logout");
    }
}