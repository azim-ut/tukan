<?php


class CountriesDto extends RemoteBase{
	protected static $instance = null;
	/**
	 * @return CountriesDto
	 */
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function list(){
		return self::getData("/core/rest/countries");
	}
}