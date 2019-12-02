<?php

namespace assets\services;

use core\service\MySqlService;
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
        }

        return self::$instance;
    }

    public function setWin($uid, $promo, $name, $discount, $free){
        $coupon           = new Coupon();
        $coupon->uid      = $uid;
        $coupon->promo    = $promo;
        $coupon->name     = $name;
        $coupon->discount = $discount;
        $coupon->free     = $free;
        $coupon->datetime = time();

        return CouponService::getInstance()->addCoupon($coupon);
    }

    public function parseDiscount($name){
        preg_match_all("#([^%]+\d)+%#", $name, $res);

        return ($res[1][0] ?? 0) * 1;
    }

    public function parseFree($name){
        if(preg_match("#\+1%#", $name)){
            return 1;
        }

        return 0;
    }

    public function getWin($uid, $promo){
        return CouponService::getInstance()->getCoupon($uid, $promo);
    }

}