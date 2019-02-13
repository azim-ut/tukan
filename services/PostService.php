<?php

namespace assets\services;

use core\service\MySqlService;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 10/3/2018
 * Time: 10:40 PM
 */
class PostService extends BaseService{

    protected static $instance = null;

    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
        }

        return self::$instance;
    }

    public function getProduct($postId){
        $res         = $this->sql->smart_select_row("
	    SELECT 
	        p.ID as id, 
	        p.post_name as name, 
	        p.post_title as title,
	        p.post_content as content,
	        price.meta_value as price, 
	        img.post_name as img, 
	        GROUP_CONCAT(t.slug SEPARATOR ',') as cls,
	        GROUP_CONCAT(CONCAT(st.name,' cm') SEPARATOR ', ') as sizes
        FROM wp_posts as p 
        INNER JOIN wp_postmeta as pm ON pm.post_id=p.ID AND pm.meta_key='_thumbnail_id' AND pm.post_id=p.ID
        INNER JOIN wp_posts as img ON img.ID=pm.meta_value
        INNER JOIN wp_postmeta as price ON price.post_id=p.ID AND price.meta_key='_price'
        INNER JOIN wp_term_relationships as tr ON tr.object_id=p.ID
        INNER JOIN wp_terms as t ON t.term_group=1 AND tr.term_taxonomy_id=t.term_id
        INNER JOIN wp_term_relationships as sz ON sz.object_id=p.ID
        INNER JOIN wp_terms as st ON st.term_group=2 AND sz.term_taxonomy_id=st.term_id
        WHERE p.ID=%d
        GROUP BY p.ID
        ", $postId);
        $res->price  = floatval($res->price);
        $res->fullprice = $res->price * 2;

        return $res;
    }

    public function publish($postId){
        return $this->sql->smart_query("UPDATE wp_posts SET post_status='publish' WHERE ID=%d", $postId);
    }

    public function draft($postId){
        return $this->sql->smart_query("UPDATE wp_posts SET post_status='draft' WHERE ID=%d", $postId);
    }

}