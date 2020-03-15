<?php


class CouponDto extends RemoteBase{
    protected static $instance = null;
    private $facebookID = null;
    private $data = [];

    /**
     * @return CouponDto
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function myLotteryPrizes(){
	    return self::getData( "/shop/rest/lottery/my/prizes");
    }

    public function lotteryCoupons(){
	    return self::getData( "/shop/rest/lottery/coupons/FirstLottery");
    }
}