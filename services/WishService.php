<?php
/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/21/2018
 * Time: 7:21 PM
 */

namespace assets\services;


use core\service\MySqlService;
use core\utils\StringUtils;

class WishService extends BaseService{

    /**
     * @var WishService
     */
    protected static $instance = null;

    /**
     * @return WishService
     */
    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
        }

        return self::$instance;
    }

    public function mergeSidToUser($sid, $uid){
        return $this->sql->smart_query("UPDATE wishes SET uid=%d WHERE sid=%s", $uid, $sid);
    }

    public function addItem($sid, $uid, $postId){
        $uid = $uid ?? 0;

        return $this->sql->smart_query("REPLACE wishes(sid, uid,postid,tm) VALUES(%s, %d,%d,%d)", $sid, $uid, $postId, time());
    }

    public function delItem($sid, $uid, $postId){
        $uid = intval($uid) ?? 0;
        return $this->sql->smart_query("DELETE FROM wishes WHERE ((%d>0 AND uid=%d) OR (%d=0 AND sid=%s)) AND postid=%d", $uid, $uid, $uid, $sid, $postId);
    }

    public function usersList($uid){
        $rows = $this->sql->smart_select_rows("
        SELECT 
            p.ID as id,
            p.post_name as name,
            p.post_title as title,
            price.meta_value as price,
            IFNULL(b.meta_value, 0) as fullprice,
            img.post_name as img,
            GROUP_CONCAT(h.meta_value SEPARATOR ' ') as height 
        FROM wishes as w
        INNER JOIN wp_posts as p ON p.ID=w.postid  
        INNER JOIN wp_postmeta as pm ON pm.post_id=p.ID AND pm.meta_key='_thumbnail_id' AND pm.post_id=p.ID
        INNER JOIN wp_posts as img ON img.ID=pm.meta_value
        INNER JOIN wp_postmeta as price ON price.post_id=p.ID AND price.meta_key='_price'
        INNER JOIN wp_postmeta as h ON h.post_id=p.ID AND h.meta_key='_height'
        LEFT JOIN wp_postmeta as b ON b.post_id=p.ID AND b.meta_key='_fullprice'
        WHERE w.uid=%d GROUP BY p.ID ORDER BY w.tm DESC", $uid);


        foreach($rows as $row){
            $row->id = intval($row->id);
            $row->price = floatval($row->price);
            $row->fullprice = floatval($row->fullprice);
            if(!$row->fullprice){
                $row->fullprice = $row->price * 2;
            }
            if(StringUtils::stringIsNotEmpty($row->img)){
                $tmp = $row->img;
                $row->img = "/wp-content/uploads/auto/" . $tmp . "_800x800.jpg";
                $row->s   = "/wp-content/uploads/auto/" . $tmp . "_200x200.jpg";
            }
        }

        return $rows;
    }

    public function sessionsList($sid){
        $rows = $this->sql->smart_select_rows("
        SELECT 
          p.ID as id,
          p.post_name as name,
          p.post_title as title,
          price.meta_value as price,
          IFNULL(b.meta_value, 0) as fullprice,
          img.post_name as img,
           GROUP_CONCAT(h.meta_value SEPARATOR ' ') as height 
        FROM wishes as w
        INNER JOIN wp_posts as p ON p.ID=w.postid  
        INNER JOIN wp_postmeta as pm ON pm.post_id=p.ID AND pm.meta_key='_thumbnail_id' AND pm.post_id=p.ID
        INNER JOIN wp_posts as img ON img.ID=pm.meta_value
        INNER JOIN wp_postmeta as price ON price.post_id=p.ID AND price.meta_key='_price'
        INNER JOIN wp_postmeta as h ON h.post_id=p.ID AND h.meta_key='_height'
        LEFT JOIN wp_postmeta as b ON b.post_id=p.ID AND b.meta_key='_fullprice'
        WHERE w.sid=%s GROUP BY p.ID ORDER BY w.tm DESC", $sid);

        foreach($rows as $row){
            $row->id = intval($row->id);
            $row->price = floatval($row->price);
            $row->fullprice = floatval($row->fullprice);
            if(!$row->fullprice){
                $row->fullprice = $row->price * 2;
            }
            if(StringUtils::stringIsNotEmpty($row->img)){
                $tmp = $row->img;
                $row->img = "/wp-content/uploads/auto/" . $tmp . "_800x800.jpg";
                $row->s   = "/wp-content/uploads/auto/" . $tmp . "_200x200.jpg";
            }
        }

        return $rows;
    }

    public function ids($sid, $uid){
        $uid  = $uid ?? 0;
        $rows = $this->sql->smart_select_rows("SELECT postid as id FROM wishes WHERE ((%d>0 AND uid=%d) OR (%d=0 AND sid=%s))", $uid, $uid, $uid, $sid);
        $ids = array();
        foreach($rows as $row){
            $ids[] = intval($row->id);
        }

        return $ids;
    }
}