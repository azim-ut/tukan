<?php


class CartItem{
	private $id;
	private $cart;
	private $post;
	private $count;
	private $price;

	/**
	 * CartItem constructor.
	 *
	 * @param $args
	 */
	public function __construct($args){
		if(is_array($args)){
			$this->initByArray($args);
		}
	}

	private function initByArray($arr){
		$this->id = $arr["id"] ?? 0;
		if($this->id){
			$this->cart  = $arr["cart"];
			$this->post  = $arr["post"];
			$this->count = $arr["count"];
			$this->price = $arr["price"];
		}
	}

	public function getId(){
		return $this->id;
	}

	public function getCart(){
		return $this->cart;
	}

	public function getPost(){
		return $this->post;
	}

	public function getCount(){
		return $this->count;
	}

	public function getPrice(){
		return $this->price;
	}



}