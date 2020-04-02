<?php


class EveryPayDto extends RemoteBase{
	protected static $instance = null;

	/**
	 * @return EveryPayDto
	 */
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function endPoint(){
		return self::getData("/shop/rest/ep/endpoint");
	}

	public function getInitData(){
		return self::getData("/shop/rest/ep/init");
	}

	public function callback($orderNonce, $last4Digits, $transactionResult, $paymentState){
		return self::getData("/shop/rest/ep/callback/" . $orderNonce . "/" . $last4Digits . "/" . $transactionResult . "/" . $paymentState);
	}
}