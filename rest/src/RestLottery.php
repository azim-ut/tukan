<?php

use assets\services\LotteryService;
use assets\services\PresetsService;
use core\exception\NoUserException;
use core\manager\ParamsManager;
use core\manager\UserManager;
use core\service\App;
use core\utils\SafeUtils;
use rest\src\RestBase;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 11/6/2018
 * Time: 9:19 AM
 */
class RestLottery extends RestBase{
    protected static $instance = null;
    private static $promo = 1;

    public function GET_speed($from){
        $this->out->data = pi() / (16 + rand());
    }

    public function GET_prizes(){
        $this->out->data = App::context()->param("prizes");
    }

    public function POST_won(){
        $service = LotteryService::getInstance();
        $ind = ParamsManager::getParamInt("ind");
        SafeUtils::checkNumbers($ind);
        $uid = UserManager::currentId();
        if(!$uid){
            throw new NoUserException();
        }
        $prize = $service->getWin($uid, self::$promo);
        if(!$prize){
            $prizes = App::context()->propArray("prizes");
            $discount = $service->parseDiscount($prizes[$ind]);
            $free = $service->parseFree($prizes[$ind]);
            $service->setWin($uid, self::$promo, $prizes[$ind], $discount, $free);
            $prize = $service->getWin($uid, self::$promo);
        }
        $this->out->data = $prize;
    }

    public function POST_add(){
        $text            = ParamsManager::getParam("text");
        $this->out->data = PresetsService::getInstance()->addPreset($text);
    }
}