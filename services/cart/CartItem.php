<?php


class CartItem{
	public $id;
	private $cart;
	private $post;
	public $title;
	public $img;
	public $count;
	public $price;

	/**
	 * CartItem constructor.
	 *
	 * @param $args
	 */
	public function __construct($args){
		if(is_object($args)){
			$this->initByObject($args);
		}
	}

	private function initByObject($obj){
		$this->id = $obj->post ?? 0;
		if($this->id){
			$this->cart  = $obj->cart * 1;
			$this->post  = $obj->post * 1;
			$this->title = $obj->title;
			$this->img   = $obj->img * 1;
			$this->count = $obj->count * 1;
			$this->price = $obj->price * 1;
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