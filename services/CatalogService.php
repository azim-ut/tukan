<?php

namespace assets\services;

use core\service\MySqlService;
use core\utils\DateUtils;
use core\utils\StringUtils;
use Goods;
use stdClass;

/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 10/3/2018
 * Time: 10:40 PM
 */
class CatalogService extends BaseService{

    protected static $instance = null;

    public static function getInstance(){
        if(!self::$instance){
            self::$instance      = new self();
            self::$instance->sql = MySqlService::getInstance();
        }

        return self::$instance;
    }

    public function getList($tags = array(), $limit = 50, $page = 5){
        $q       = sprintf("SELECT * FROM wp_posts WHERE post_type='product' ORDER BY ID DESC");
        $rows    = $this->sql->select_rows($q);
        $res     = array();
        $postIds = array();
        foreach($rows as $row){
            $res[ $row->ID * 1 ] = $row;
            $row->tags           = array();
            $postIds[]           = $row->ID * 1;
        }
        $images = $this->sql->smart_select_rows("SELECT m.post_id as post_id, p.post_name as img
		FROM wp_postmeta as m
		INNER JOIN wp_posts as p ON p.ID=m.meta_value
		WHERE m.meta_key='_thumbnail_id' AND m.meta_value<>'' AND m.post_id IN (" . implode(",", $postIds) . ")");
        foreach($images as $row){
            $res[ $row->post_id * 1 ]->img = "http://tukan.store/wp-content/uploads/auto/" . $row->img . "_200x200.jpg";
        }

        $tags = $this->sql->smart_select_rows("SELECT * FROM wp_term_relationships WHERE object_id IN (" . implode(",", $postIds) . ")");
        foreach($tags as $row){
            $res[ $row->object_id * 1 ]->tags[] = $row->term_taxonomy_id * 1;
        }

        return $res;
    }

    public function getListByType($tags = array(), $limit = 50, $page = 5){
        $q       = sprintf("SELECT * FROM wp_posts WHERE post_type='product' ORDER BY ID DESC");
        $rows    = $this->sql->select_rows($q);
        $res     = array();
        $postIds = array();
        foreach($rows as $row){
            $res[ $row->ID * 1 ] = $row;
            $row->tags           = array();
            $postIds[]           = $row->ID * 1;
        }
        $images = $this->sql->smart_select_rows("SELECT m.post_id as post_id, p.post_name as img
		FROM wp_postmeta as m
		INNER JOIN wp_posts as p ON p.ID=m.meta_value
		WHERE m.meta_key='_thumbnail_id' AND m.meta_value<>'' AND m.post_id IN (" . implode(",", $postIds) . ")");
        foreach($images as $row){
            $res[ $row->post_id * 1 ]->img = "http://tukan.store/wp-content/uploads/auto/" . $row->img . "_200x200.jpg";
        }

        $tags = $this->sql->smart_select_rows("SELECT * FROM wp_term_relationships WHERE object_id IN (" . implode(",", $postIds) . ")");
        foreach($tags as $row){
            $res[ $row->object_id * 1 ]->tags[] = $row->term_taxonomy_id * 1;
        }

        return $res;
    }

    public function editItem($postId, $title, $height = 0, $price = 0, $content = "", $tags = array()){
        $this->sql->smart_query("UPDATE wp_postmeta SET meta_value=%s WHERE post_id=%d AND meta_key=%s", $price, $postId, '_regular_price');
        $this->sql->smart_query("UPDATE wp_postmeta SET meta_value=%s WHERE post_id=%d AND meta_key=%s", $price, $postId, '_price');
        $this->sql->smart_query("UPDATE wp_postmeta SET meta_value=%s WHERE post_id=%d AND meta_key=%s", $height, $postId, '_height');
        $this->sql->smart_query("UPDATE wp_posts SET post_title=%s, post_content=%s WHERE ID=%d", $title, $content, $postId);

        return true;

    }

    public function delItem($postId){
        $this->sql->smart_query("DELETE FROM wp_posts WHERE ID=%d", $postId);
        $this->sql->smart_query("DELETE FROM wp_postmeta WHERE post_id=%d", $postId);
        $this->sql->smart_query("DELETE FROM wp_term_relationships WHERE object_id=%d", $postId);
    }

    public function getItem($postId){
        return new Goods($postId);

    }

    public function addItemImage($postId, $dir, $file, $ext, $file800x800, $file200x200){

        $now                 = DateUtils::tmToSqlDateTime(time());
        $postContent         = "";
        $postExcerpt         = "";
        $postStatus          = "publish";
        $commentStatus       = "closed";
        $postName            = StringUtils::cyrillicToLatin($file, true);
        $toPing              = "";
        $pinged              = "";
        $postParent          = $postId;
        $postContentFiltered = "";
        $postType            = "attachment";
        $postMimeType        = "image/jpeg";
        $title               = $file;
        $guid                = "http://tukan.store/wp-content/uploads/" . $dir . "/" . $file . "." . $ext;
        $q                   = sprintf("INSERT INTO wp_posts(post_author,post_date,post_date_gmt, post_content, post_title, post_excerpt, post_name, to_ping, pinged, post_modified,post_modified_gmt, post_parent,guid,post_content_filtered,post_type, post_mime_type) VALUES(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%d,%s,%s,%s,%s)",
            1,
            $this->sql->smart($now),
            $this->sql->smart($now),
            $this->sql->smart($postContent),
            $this->sql->smart($title),
            $this->sql->smart($postExcerpt),
            $this->sql->smart($postName),
            $this->sql->smart($toPing),
            $this->sql->smart($pinged),
            $this->sql->smart($now),
            $this->sql->smart($now),
            $this->sql->smart($postParent),
            $this->sql->smart($guid),
            $this->sql->smart($postContentFiltered),
            $this->sql->smart($postType),
            $this->sql->smart($postMimeType)
        );
        $this->sql->query($q);
        $itemId = $this->sql->last_id();
        $meta   = $this->getImageMetaData($dir, $file, $ext, $file800x800, $file200x200);
        $this->sql->smart_query("INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES(%d,%s,%s)", $itemId, '_wp_attached_file', $dir . "/" . $file . "." . $ext);
        $this->sql->smart_query("INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES(%d,%s,%s)", $itemId, '_wp_attachment_metadata', $meta);
        $this->addImageToPost($postId, $itemId);

        return $itemId;
    }

    private function addImageToPost($postId, $imagePostId){
        $row = $this->sql->select_row("SELECT meta_value FROM wp_postmeta WHERE post_id=" . $postId . " AND meta_key='_product_image_gallery'");
        $ids = array();
        if($row){
            $tmp = mb_split(",", $row->meta_value);
            foreach($tmp as $r){
                $id = trim($r);
                if($imagePostId == $id){
                    return;
                }
                $ids[] = $id;
            }
            $ids[] = $imagePostId;
        }
        $q = "UPDATE wp_postmeta SET meta_value='" . implode(",", $ids) . "' WHERE post_id=" . $postId . " AND meta_key='_product_image_gallery'";
        $this->sql->query($q);
    }

    public function getPostsImages($postId, $w = 800, $h = 800){
        $res  = array();
        $q    = "SELECT meta_value FROM wp_postmeta WHERE post_id=" . $postId . " AND (meta_key='_product_image_gallery' OR meta_key='_thumbnail_id')";
        $rows = $this->sql->select_rows($q);

        $ids = array();
        foreach($rows as $row){
            $tmp = explode(",", $row->meta_value);
            foreach($tmp as $r){
                $id = trim($r);
                if(StringUtils::stringIsNotEmpty($id) && !in_array($id, $ids)){
                    $ids[] = $id;
                }
            }
        }

        foreach($ids as $id){
            $obj        = new stdClass();
            $obj->id    = $id;
            $obj->s     = "/wp-content/uploads/auto/" . $id . "_200x200.jpg";
            $obj->m     = "/wp-content/uploads/auto/" . $id . "_800x800.jpg";
            $obj->src   = "/wp-content/uploads/auto/" . $id . ".jpg";
            $res[ $id ] = $obj;
        }

        return $res;
    }


    public function delImage($postId){
        try{
            $this->sql->smart_query("UPDATE wp_postmeta SET meta_key='' WHERE  meta_key='_thumbnail_id' AND meta_value=%s", $postId);
            $rows = $this->sql->smart_select_rows("SELECT * FROM wp_postmeta WHERE meta_key='_product_image_gallery' AND meta_value LIKE '%%%s%%'", $postId);
            foreach($rows as $r){
                $r->meta_value = str_replace($postId, "", $r->meta_value);
                $r->meta_value = str_replace(",,", ",", $r->meta_value);
                $this->sql->smart_query("UPDATE wp_postmeta SET meta_value=%s WHERE meta_key='_product_image_gallery' AND meta_id=%d", $r->meta_value, $r->meta_id);
            }
            $post = $this->getItem($postId);
            if($post){
                unlink('../wp-content/uploads/auto/' . $post->post_name . ".jpg");
                $this->sql->smart_query("DELETE FROM wp_posts WHERE  ID=%d", $postId);
                $this->sql->smart_query("DELETE FROM wp_postmeta WHERE post_id=%d", $postId);
            }
        }catch(Exception $e){
            return $e->getMessage();
        }

        return "Ok";
    }

    public function mainImageItem($postId, $imagePostId){
        $oldImg = null;
        $row    = $this->sql->select_row("SELECT meta_value as val FROM wp_postmeta WHERE meta_key='_thumbnail_id' AND post_id=" . $postId);
        if($row && StringUtils::isNumber($row->val)){
            $oldImg = $row->val;
        }

        $this->sql->smart_query("DELETE FROM wp_postmeta WHERE meta_key='_thumbnail_id' AND post_id=%d", $postId);
        $this->sql->smart_query("INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES(%d,'_thumbnail_id', %s)", $postId, $imagePostId);
        $row = $this->sql->select_row("SELECT meta_value as val, meta_id FROM wp_postmeta WHERE meta_key='_product_image_gallery' AND post_id=" . $postId);
        $q   = sprintf("SELECT meta_value as val, meta_id FROM wp_postmeta WHERE meta_key='_product_image_gallery' AND post_id=%d", $this->sql->smart($postId));
        $this->sql->select_row($q);
        if($row){
            $images = array();
            if($oldImg != null){
                $images[] = $oldImg;
            }
            $temp = explode(",", $row->val);

            foreach($temp as $t){
                $t = trim($t);
                if(StringUtils::isNumber($t) && !in_array($t, $images) && $t != $imagePostId){
                    $images[] = $t;
                }
            }
            $this->sql->smart_query("UPDATE wp_postmeta SET meta_value=%s WHERE meta_key='_product_image_gallery' AND meta_id=%d", implode(",", $images), $row->meta_id);
        }

        return "Ok";
    }

    private function getImageMetaData($dir, $file, $ext, $file800x800, $file200x200){
        $sizeSource = getimagesize("../wp-content/uploads/" . $dir . "/" . $file . "." . $ext);
        $size800    = getimagesize("../wp-content/uploads/" . $dir . "/" . $file800x800 . "." . $ext);
        $size200    = getimagesize("../wp-content/uploads/" . $dir . "/" . $file200x200 . "." . $ext);

        $temp = array(
            'width'      => $sizeSource[0],
            'height'     => $sizeSource[1],
            'dir'        => $dir,
            'file'       => $dir . "/" . $file . "." . $ext,
            'sizes'      => array(
                'thumbnail'   => array(
                    'file'      => $file200x200 . "." . $ext,
                    'dir'       => $dir,
                    'width'     => $size200[0],
                    'height'    => $size200[1],
                    'mime-type' => 'image/jpeg'
                ),
                'nasa-large'  => array(
                    'file'      => $file800x800 . "." . $ext,
                    'dir'       => $dir,
                    'width'     => $size800[0],
                    'height'    => $size800[1],
                    'mime-type' => 'image/jpeg'
                ),
                'nasa-medium' => array(
                    'file'      => $file800x800 . "." . $ext,
                    'dir'       => $dir,
                    'width'     => $size800[0],
                    'height'    => $size800[1],
                    'mime-type' => 'image/jpeg'
                ),
                'large'       => array(
                    'file'      => $file800x800 . "." . $ext,
                    'dir'       => $dir,
                    'width'     => $size800[0],
                    'height'    => $size800[1],
                    'mime-type' => 'image/jpeg'
                )
            ),
            'image_meta' => array
            (
                'aperture'          => 0,
                'credit'            => '',
                'camera'            => '',
                'caption'           => '',
                'created_timestamp' => 0,
                'copyright'         => '',
                'focal_length'      => 0,
                'iso'               => 0,
                'shutter_speed'     => 0,
                'title'             => '',
                'orientation'       => 0,
                'keywords'          => array()
            )
        );

        return serialize($temp);
    }

    public function addItem($title, $height = 0, $price = 0, $tags = array()){
        if(!StringUtils::stringIsNotEmpty($title)){
            return;
        }
        $now                 = DateUtils::tmToSqlDateTime(time());
        $postContent         = "";
        $postExcerpt         = "";
        $postStatus          = "publish";
        $commentStatus       = "closed";
        $postName            = StringUtils::cyrillicToLatin($title, true);
        $toPing              = "";
        $pinged              = "";
        $postContentFiltered = "";
        $postType            = "product";
        $guid                = "http://tukan.store/?post_type=product&#038;p=5";
        $guid                = "";
        $q                   = sprintf("INSERT INTO wp_posts(post_author,post_date,post_date_gmt, post_content, post_title, post_excerpt, post_name, to_ping, pinged, post_modified,post_modified_gmt, post_content_filtered,post_type) VALUES(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
            1,
            $this->sql->smart($now),
            $this->sql->smart($now),
            $this->sql->smart($postContent),
            $this->sql->smart($title),
            $this->sql->smart($postExcerpt),
            $this->sql->smart($postName),
            $this->sql->smart($toPing),
            $this->sql->smart($pinged),
            $this->sql->smart($now),
            $this->sql->smart($now),
            $this->sql->smart($postContentFiltered),
            $this->sql->smart($postType)
        );
        $this->sql->query($q);
        $itemId = $this->sql->last_id();

        $this->sql->smart_query("UPDATE wp_posts SET post_name=%d WHERE ID=%d", $itemId, $itemId);

        $meta   = array(
            '_regular_price'         => $price,
            '_price'                 => $price,
            '_stock_status'          => 'instock',
            '_stock'                 => '1',
            '_height'                => $height,
            '_thumbnail_id'          => '',
            '_wpas_done_all'         => '1',
            '_vc_post_settings'      => 'a:1:{s:10:"vc_grid_id";a:0:{}}',
            '_wc_review_count'       => '1',
            '_wc_rating_count'       => 'a:1:{i:5;i:1;}',
            '_wc_average_rating'     => '5.00',
            '_sale_price_dates_from' => time(),
            '_sale_price_dates_to'   => '0',
            '_tax_status'            => 'taxable',
            '_tax_class'             => '',
            '_manage_stock'          => 'yes',
            '_backorders'            => 'no',
            '_sold_individually'     => 'no',
            '_weight'                => '',
            '_length'                => '',
            '_width'                 => '',
            '_upsell_ids'            => 'a:0:{}',
            '_crosssell_ids'         => 'a:0:{}',
            '_purchase_note'         => '',
            '_default_attributes'    => 'a:0:{}',
            '_virtual'               => 'no',
            '_downloadable'          => 'no',
            '_product_image_gallery' => '',
            '_download_limit'        => '-1',
            '_download_expiry'       => '-1',
            '_product_version'       => '3.3.5',
            'slide_template'         => 'default',
            'total_sales'            => '0',
            '_sku'                   => ''
        );
        $values = array();
        foreach($meta as $key => $val){
            $values[] = sprintf("(%d,%s,%s)", $this->sql->smart($itemId), $this->sql->smart($key), $this->sql->smart($val));
        }
        $this->sql->query("INSERT INTO wp_postmeta(post_id,meta_key,meta_value) VALUES" . implode(",", $values));

        return $itemId;
    }

}