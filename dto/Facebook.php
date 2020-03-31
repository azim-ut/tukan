<?php


use core\Engine;

class Facebook extends RemoteBase{
    protected static $instance = null;

    /**
     * @return Facebook
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function loginPath(){
        return self::getData("/core/rest/facebookAuth/login/path/" . Engine::getInstance()->sessionId());
    }

    public function login($code, $stake, $token, $tokenType, $expiresIn){
        $params = [];
        $params[] = "code=".$code;
        $params[] = "stake=".$stake;
        $params[] = "token=".$token;
        $params[] = "tokenType=".$tokenType;
        $params[] = "expiresIn=".$expiresIn;
        return self::getData("/core/rest/facebookAuth/login?" . join("&", $params));
    }

    public function log($path, $content, $line){
        return self::getData("/shop/rest/catalog/more/" . $id);
    }
}