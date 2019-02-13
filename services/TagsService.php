<?php

namespace assets\services;

use core\service\MySqlService;
use core\utils\SafeUtils;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 10/3/2018
 * Time: 10:40 PM
 */
class TagsService extends BaseService{

	protected static $instance = null;

	public static $GENDER_TYPE = "gender";
	public static $ITEM_TYPE = "item";
	public static $HEIGHT_TYPE = "height";
	public static $GENDER_BOY = "boy";
	public static $GENDER_GIRL = "girl";

	public static function getInstance(){
		if(!self::$instance){
			self::$instance      = new self();
			self::$instance->sql = MySqlService::getInstance();
		}

		return self::$instance;
	}

	private static $BOY_AGE_HEIGHTS = array(
	    "0/3m" => 62,
	    "3/6m" => 68,
	    "6/9m" => 74,
	    "12m" => 80,
	    "18m" => 86,
	    "2" => 93,
	    "4" => 104,
	    "6" => 116,
	    "8" => 128,
	    "10" => 140,
	    "12" => 153,
	    "14" => 164,
	    "16" => 176,
    );

	private static $GIRL_AGE_HEIGHTS = array(
	    "0/3m" => 62,
	    "3/6m" => 68,
	    "6/9m" => 74,
	    "12m" => 80,
	    "18m" => 86,
	    "2" => 93,
	    "4" => 104,
	    "6" => 116,
	    "8" => 128,
	    "10" => 140,
	    "12" => 152,
	    "14" => 164,
	    "16" => 170,
    );

	private static $TAGS = array(
		"girl" => "gender",
		"boy"  => "gender",

		"body"     => "item",
		"dress"     => "item",
		"sweater"   => "item",
		"t-short"   => "item",
		"pants"     => "item",
		"leggings"  => "item",
		"longsleav" => "item",
		"pujama"    => "item",
		"tunik"     => "item",
		"hoody"     => "item",
		"kofta"     => "item",
		"jeans"     => "item",
		"shorts"     => "item",
		"jacket"     => "item",
		"bathrobe"     => "item",
		"sleeps"     => "item",
        "skirt"     => "item",

		"56-62"   => "height",
		"62-68"   => "height",
		"68-74"   => "height",
		"80-86"   => "height",
		"86-92"   => "height",
		"92-104"  => "height",
		"104-116" => "height",
		"116-128" => "height",
		"128-140" => "height",
		"140-152" => "height",
		"152-164" => "height",
		"164-176" => "height",
		"176"     => "height",
	);

	public function getBoysAges(){
	    $res = array();
	    foreach(self::$BOY_AGE_HEIGHTS as $key=>$val){
	        $res[] = strval($key);
        }
	    return $res;
    }

	public function getHeightTagsByAge($age, $gender){
	    $res = array();

	    $heights = self::$BOY_AGE_HEIGHTS;
	    if($gender === self::$GENDER_GIRL){
            $heights = self::$GIRL_AGE_HEIGHTS;
        }

        $height = isset($heights[$age])?$heights[$age]:null;

	    if($height != null){
            $tags = $this->getTagsByType("height");
            foreach($tags as $tag){
                $temp = preg_split("#-#mi", $tag);
                $from = $to = SafeUtils::toInteger($temp[0]);
                if(sizeof($temp)>1){
                    $to = SafeUtils::toInteger($temp[1]);
                }
                if($from<=$height && $to>=$height){
                    $res[] = $tag;
                }

            }
        }
	    return $res;
    }

	public function pullTagsByType(&$tags, $type){
		$genderTags = $this->getTagsByType($type);
		$res        = array();
		foreach($tags as $i => $tag){
			if(in_array($tag, $genderTags)){
				$res[] = $tag;
				$ind = array_search($tag, $tags);
				array_splice($tags, $ind, 1);
				//unset($tags[$i]);
			}
		}

		return $res;
	}

	public function getTagsByType($type){
		return array_keys(self::$TAGS, $type);
	}

	public function isValidGender($gender){
	    return $gender === self::$GENDER_BOY || $gender === self::$GENDER_GIRL;
    }

	public function isAgeExists($age, $gender){
	    if(strlen($age)>5){
            return false;
        }
	    switch($gender){
            case self::$GENDER_GIRL:
                return isset(self::$GIRL_AGE_HEIGHTS[$age]);
                break;
            case self::$GENDER_BOY:
                return isset(self::$BOY_AGE_HEIGHTS[$age]);
                break;
        }
		return false;
	}

	public function getClothesTypeTags(){
		return array_keys(self::$TAGS, "item");
	}

	public function filterTags($slugs = array()){
		$res = array();
		foreach($slugs as $slug){
			if(key_exists($slug, self::$TAGS)){
				array_push($res, $slug);
			}
		}

		return $res;
	}

	public function getAll(){
		$rows = $this->sql->select_rows("SELECT t.name as name, t.slug as slug FROM wp_terms as t ORDER BY t.name");
		$res  = array();
		foreach($rows as $r){
			if(!array_key_exists($r->slug, self::$TAGS)){
				continue;
			}
			$ind = array_search($r->slug, array_keys(self::$TAGS));
			if($ind >= 0){
				$r->group    = self::$TAGS[ $r->slug ];
                if($r->group == "height"){
                    $tmp = preg_split("#\-#", $r->slug);
                    $r->from = intval($tmp[0]);
                    $r->to = intval($tmp[sizeof($tmp)-1]);
                }
				$res[] = $r;
			}
		}
		ksort($res);

		return $res;
	}

	public function getActiveTags(){
		$rows = $this->sql->select_rows("SELECT t.name as name, t.slug as slug FROM wp_terms as t
			INNER JOIN wp_term_relationships as tr ON tr.term_taxonomy_id=t.term_id
			INNER JOIN wp_posts as p ON p.ID=tr.object_id AND p.post_status='publish'
			WHERE p.ID>0
			GROUP BY t.slug ORDER BY t.name");
		$res  = array();
		foreach($rows as $r){
			if(!array_key_exists($r->slug, self::$TAGS)){
				continue;
			}
			$ind = array_search($r->slug, array_keys(self::$TAGS));
			if($ind >= 0){
				$r->group = self::$TAGS[ $r->slug ];

				if($r->group == "height"){
				    $tmp = preg_split("#\-#", $r->slug);
				    $r->from = intval($tmp[0]);
				    $r->to = intval($tmp[sizeof($tmp)-1]);
                }

				$res[]    = $r;
			}
		}
		ksort($res);

		return $res;
	}

	public function getPostTags($post){
		$rows = $this->sql->smart_select_rows("SELECT
			t.term_id as id,
			t.name as name,
			t.slug as slug,
			t.term_group as term_group,
			IFNULL(tr.object_id, 0) as post
		FROM wp_terms as t
		LEFT JOIN wp_term_relationships as tr ON tr.object_id=%d AND tr.term_taxonomy_id=t.term_id", $post);
		$res  = array();
		foreach($rows as $r){
			if(!array_key_exists($r->slug, self::$TAGS)){
				continue;
			}
			$ind = array_search($r->slug, array_keys(self::$TAGS));
			if($ind >= 0){
				$r->group    = self::$TAGS[ $r->slug ];
				$r->post     = intval($r->post??0);
				$res[ $ind ] = $r;
			}
		}
		ksort($res);

		return $res;
	}

	public function delPostsTag($postID, $tagID){
		return $this->sql->smart_query("DELETE FROM wp_term_relationships WHERE object_id=%d AND term_taxonomy_id=%d", $postID, $tagID);
	}

	public function addPostsTag($postID, $tagID){
		$this->delPostsTag($postID, $tagID);

		return $this->sql->smart_query("INSERT INTO wp_term_relationships(object_id, term_taxonomy_id) VALUES(%d,%d)", $postID, $tagID);
	}
}