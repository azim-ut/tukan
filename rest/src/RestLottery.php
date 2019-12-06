<?php

use assets\services\CouponService;
use assets\services\LotteryService;
use assets\services\PresetsService;
use core\exception\NoUserException;
use core\manager\ParamsManager;
use core\manager\SessionManager;
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

    public function GET_speed($from){
        $this->out->data = pi() / (16 + rand());
    }

    public function GET_spin(){
        $service = LotteryService::getInstance();
        $uid = UserManager::currentId();
        $group = "FirstLottery";
        $coupon = $service->randomCoupon($group);
        $exists = $service->getCoupon($uid, SessionManager::id(), LotteryService::firstLotteryName());
        if(!$exists){
//            $service->setWin($uid, SessionManager::id(), $coupon->id);
        }
        $this->out->data = $coupon;
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
        $prize = $service->getCoupon($uid, SessionManager::id(), LotteryService::firstLotteryName());
        if(!$prize){
            $couponId = 0;
            $service->setWin($uid, $couponId);
            $prize = $service->getCoupon($uid, SessionManager::id(), LotteryService::firstLotteryName());
        }
        $this->out->data = $prize;
    }

    public function POST_add(){
        $text            = ParamsManager::getParam("text");
        $this->out->data = PresetsService::getInstance()->addPreset($text);
    }
}