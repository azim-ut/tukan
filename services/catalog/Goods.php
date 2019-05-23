<?php


use core\service\MySqlService;

class Goods{

	private $id;
	private $date;
	private $content;
	private $title;
	private $name;
	private $img;
	private $price;
	private $fullPrice;
	private $height;

	/**
	 * @var Tag[]
	 */
	private $tags = array();
	/**
	 * @var Tag[]
	 */
	private $sizes = array();

	/**
	 * @var Tag[]
	 */
	private $clothes = array();


	public function __construct($args){
		if(is_int($args)){
			$this->initById($args);
		}
	}

	public function initById($postId){
		$sql = MySqlService::getInstance();
		$row = $sql->smart_select_row("SELECT * FROM wp_posts WHERE ID=%d and post_parent=0 AND post_type='product'", $postId);

		if($row){
			$this->id = $row->ID;
			$this->content = $row->post_content;
			$this->title = $row->post_title;
			$this->date = $row->post_date;
			$this->name = $row->post_name;

			$sub = $sql->smart_select_rows("SELECT * FROM wp_postmeta WHERE post_id=%d",  $postId);
			if($sub){
				foreach($sub as $r){
					switch($r->meta_key){
						case '_thumbnail_id':
                            $this->img = $r->meta_value;
							break;
						case '_price':
							$this->price = $r->meta_value*1;
							break;
						case '_height':
							$this->height = $r->meta_value??0*1;
							break;
						case '_fullprice':
							$this->fullPrice = $r->meta_value*1;
							break;
					}
				}
			}
			$this->initTags($postId);
		}
	}

	private function initTags($postId){
		$sql = MySqlService::getInstance();
		$tags      = $sql->smart_select_rows("
			SELECT 
				t.term_id,
				t.term_group,
				r.term_order,
				t.NAME as name,
				t.slug
			FROM wp_term_relationships AS r 
			INNER JOIN wp_terms AS t ON t.term_id=r.term_taxonomy_id
			WHERE object_id=%d
		", $postId);
		foreach($tags as $t){
			if($t->term_id){
				array_push($this->tags, $t->term_id * 1);
				switch($t->term_group){
					case 1:
						array_push($this->clothes, new Tag($t));
						break;
					case 2:
						array_push($this->sizes, new Tag($t));
						break;
				}
			}
		}
	}

	public function getSizesStr(){
		$list = array();
		foreach($this->sizes as $size){
			array_push($list, $size->getName());
		}
		return join(", ", $list);
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
	public function getDate(){
		return $this->date;
	}

	/**
	 * @return mixed
	 */
	public function getContent(){
		return $this->content;
	}

	/**
	 * @return mixed
	 */
	public function getTitle(){
		return $this->title;
	}

	/**
	 * @return mixed
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * @return mixed
	 */
	public function getImg(){
		return $this->img;
	}

	/**
	 * @return mixed
	 */
	public function getPrice(){
		return $this->price;
	}

	/**
	 * @return mixed
	 */
	public function getHeight(){
		return $this->height;
	}

	/**
	 * @return mixed
	 */
	public function getFullPrice(){
		return $this->fullPrice;
	}

}