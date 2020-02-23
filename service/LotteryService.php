<?php

namespace assets\services;

use core\service\MySqlService;
use core\service\TranslateService;
use Coupon;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 10/3/2018
 * Time: 10:40 PM
 */
class LotteryService extends BaseRestService{

    public static function firstLotteryName(){
        return "FirstLottery";
    }

    protected static $instance = null;

    /**
     * @return LotteryService
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
            self::$instance->translate = TranslateService::getInstance();
        }

        return self::$instance;
    }

    /**
     * @param $promo
     *
     * @return Coupon
     * @throws \Exception
     */
    public function randomCoupon($promo){
        $list = CouponService::getInstance()->getCoupons($promo);
        $ind = random_int(0, sizeof($list)-1);
        $res = $list[$ind];
        $res->index = $ind;
        return $res;
    }

    public function setWin($uid, $couponId){
        $exp = time() + 60*60*24*31;//+month
        return CouponService::getInstance()->addCoupon($uid, $couponId, $exp);
    }

    public function parseFree($name){
        if(preg_match("#\+1%#", $name)){
            return 1;
        }

        return 0;
    }

    public function getCoupon($uid, $promo){
        return CouponService::getInstance()->getUserCoupons($uid, $promo);
    }

}