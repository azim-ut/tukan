<?php
/**
 * Created by PhpStorm.
 * User: 94201
 * Date: 11/14/2018
 * Time: 10:58 AM
 */

namespace assets\services;


use rest\src\RestBase;
use core\service\MySqlService;

class PresetsService extends BaseService{

	protected static $instance = null;

	public static function getInstance(){
		if(!self::$instance){
			self::$instance      = new self();
			self::$instance->sql = MySqlService::getInstance();
		}

		return self::$instance;
	}

	public function addPreset($text, $sort = 0){
        return $this->sql->smart_query("INSERT INTO preset(text,sort) VALUES(%s,%d)", $text, $sort);
	}

	public function editPreset($id, $text, $sort){
        return $this->sql->smart_query("UPDATE preset SET text=%s, sort=%d WHERE id = %d", $text, $sort, $id);
	}

	public function delPreset($id){
        return $this->sql->smart_query("DELETE FROM preset WHERE id = %d", $id);
	}

	public function getList(){
        $rows = $this->sql->smart_select_rows("SELECT id, text, sort FROM preset ORDER BY SORT");
        foreach($rows as $i=>$row){
            $row->id = intval($row->id);
            $row->sort = intval($row->sort);
        }
        return $rows;
	}

}