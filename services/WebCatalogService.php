<?php

namespace assets\services;

use core\service\MySqlService;
use core\utils\StringUtils;
use stdClass;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 11/4/2018
 * Time: 1:54 PM
 */
class WebCatalogService extends BaseService{
    private static $mainPhotos = null;

    protected static $instance = null;

    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
        }

        return self::$instance;
    }

    public function getTags(){
        $rows = $this->sql->select_rows("SELECT term_taxonomy_id, term_order FROM wp_term_relationships");
        $tags = array();
        foreach($rows as $row){
            $tags[] = $row;
        }

        return $tags;
    }

    public function getTotalPosts($publish = 'publish', $tags = array(), $offset = 0, $limit = 16){
    }

    public function getPostsTotal($publish = 'publish', $tags = array()){
        $query = $this->preparePostsQuery($publish, $tags);
        return sizeof($this->sql->select_rows($query));
    }


    public function getPosts($publish = 'publish', $tags = array(), $offset = 0, $limit = 16){
        $query = $this->preparePostsQuery($publish, $tags);
        $rows  = $this->sql->select_rows(sprintf($query . " LIMIT %d,%d", $offset, $limit));
        $res   = array();
        foreach($rows as $row){
            $obj          = new stdClass();
            $obj->id      = intval($row->ID);
            $obj->title   = $row->post_title;
            $obj->content = $row->post_content;
            $obj->status  = $row->post_status;
            $obj->name    = $row->post_name;
            $obj->post    = intval($row->post ?? 0);
            $obj->price   = floatval($row->price);
            $obj->count   = intval($row->count ?? 0);
            $obj->tags    = $row->tags ?? null;
            $obj->tags    = null;

            $obj->fullprice = $obj->price * 2;

            if(StringUtils::stringIsNotEmpty($row->img)){
                $obj->img = "/wp-content/uploads/auto/" . $row->img . "_800x800.jpg";
                $obj->s   = "/wp-content/uploads/auto/" . $row->img . "_200x200.jpg";
            }
            $res[] = $obj;
        }

        return $res;
    }

    private function preparePostsQuery($publish = 'publish', $tags = array()){
        if(sizeof($tags)){
            $tempTags   = $tags;
            $genderTags = TagsService::getInstance()->pullTagsByType($tempTags, TagsService::$GENDER_TYPE);
            $itemTags   = TagsService::getInstance()->pullTagsByType($tempTags, TagsService::$ITEM_TYPE);
            $heightTags = TagsService::getInstance()->pullTagsByType($tempTags, TagsService::$HEIGHT_TYPE);

            $pipes = array();
            if(sizeof($genderTags)){
                $pipes[] = $genderTags;
            }

            if(sizeof($itemTags)){
                $pipes[] = $itemTags;
            }

            if(sizeof($heightTags)){
                $pipes[] = $heightTags;
            }

            $ids = array();
            foreach($pipes as $pipe){
                if(sizeof($ids)){
                    $rows = $this->sql->smart_select_rows("
					SELECT t.slug as slug, tr.object_id AS post_id
					FROM wp_terms AS t
					INNER JOIN wp_term_relationships as tr ON tr.term_taxonomy_id=t.term_id
					WHERE tr.object_id IN (" . implode(",", $ids) . ") AND t.slug IN ('" . implode("','", $pipe) . "')");
                }else{
                    $rows = $this->sql->smart_select_rows("
					SELECT t.slug as slug, tr.object_id AS post_id
					FROM wp_terms AS t
					INNER JOIN wp_term_relationships as tr ON tr.term_taxonomy_id=t.term_id
					WHERE t.slug IN ('" . implode("','", $pipe) . "')");
                }
                $ids = array();
                foreach($rows as $row){
                    $ids[] = $row->post_id;
                }
            }
            if(!sizeof($ids)){
                return "SELECT * FROM wp_posts WHERE false";
            }

            $query = sprintf("SELECT  
					p.*,
					m1.meta_value as price, 
					m2.meta_value as stock, 
					m.meta_value as img,
					GROUP_CONCAT(t.name SEPARATOR ', ') as tags 
			FROM wp_posts as p
			INNER JOIN wp_postmeta as m ON m.post_id=p.ID AND m.meta_key='_thumbnail_id' AND m.meta_value<>''
			INNER JOIN wp_postmeta as m1 ON m1.post_id=p.ID AND m1.meta_key='_price'
			INNER JOIN wp_postmeta as m2 ON m2.post_id=p.ID AND m2.meta_key='_stock'
			INNER JOIN wp_term_relationships tr ON tr.object_id=p.ID
			INNER JOIN wp_terms as t ON t.term_id=tr.term_taxonomy_id 
			WHERE
				p.ID IN (" . implode(",", $ids) . ")
				AND p.post_status=%s 
				AND p.post_type='product' 
			GROUP BY p.ID   
			ORDER BY p.post_date DESC
			", $this->sql->smart($publish));
        }else{
            $query = sprintf("SELECT 
					p.*,
					m1.meta_value as price, 
					m2.meta_value as stock,
					m.meta_value as img,
					GROUP_CONCAT(t.name SEPARATOR ', ') as tags
			FROM wp_posts as p
			LEFT JOIN wp_postmeta as m ON m.post_id=p.ID AND m.meta_key='_thumbnail_id' AND m.meta_value<>''
			LEFT JOIN wp_postmeta as m1 ON m1.post_id=p.ID AND m1.meta_key='_price'
			LEFT JOIN wp_postmeta as m2 ON m2.post_id=p.ID AND m2.meta_key='_stock'
			LEFT JOIN wp_term_relationships tr ON tr.object_id=p.ID
			LEFT JOIN wp_terms as t ON t.term_id=tr.term_taxonomy_id
			WHERE p.post_status=%s AND p.post_type='product' 
			GROUP BY p.ID
			ORDER BY p.post_date DESC",
                $this->sql->smart($publish));
        }

        return $query;
    }

    public function getPost($postId){
        $row            = $this->sql->select_row(sprintf("SELECT * FROM wp_posts WHERE ID=%d", $this->sql->smart($postId)));
        $row->mainImage = $this->getMainImage($postId);

        return $row;
    }

    public function getMainImage($postId){
        if(self::$mainPhotos == null){
            $this->fetchMainImages();
        }

        return self::$mainPhotos[ $postId ] ?? "/wp-content/plugins/woocommerce/assets/images/placeholder.png";
    }

    private function fetchMainImages(){
        $query = sprintf("
				SELECT 
					p.ID as post_id,
					img.ID as image_post_id, 
					m.meta_value as img 
                FROM wp_posts as p
				INNER JOIN wp_postmeta as m ON m.post_id=p.ID AND m.meta_key='_thumbnail_id' AND m.meta_value<>'' AND m.meta_value IS NOT NULL");
        $rows  = $this->sql->select_rows($query);
        foreach($rows as $row){
            $src                               = "/wp-content/uploads/auto/" . $row->img . "_800x800.jpg";
            self::$mainPhotos[ $row->post_id ] = $src;
        }
    }
}