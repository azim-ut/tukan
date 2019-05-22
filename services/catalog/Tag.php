<?php


class Tag{
	private $id;
	private $slug;
	private $name;

	/**
	 * Tag constructor.
	 *
	 * @param $args
	 */
	public function __construct($args){
		if(is_object($args)){
			$this->initByObj($args);
		}
	}

	private function initByObj($obj){
		$this->id   = $obj->term_id * 1;
		$this->slug = $obj->slug;
		$this->name = $obj->name;
	}

	/**
	 * @return mixed
	 */
	public function getId(){
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getSlug(){
		return $this->slug;
	}

	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->name;
	}


}