<?php
require_once("base/Database.php");

class CmsMediaType extends Database
{

	public static function  getItem($typeID){
		$query = "SELECT typeID, typeName, allowed, active
				FROM cms_media_type
				WHERE typeID='$typeID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItem_Alias($allowed){
		$query = "SELECT typeID, typeName, allowed, active
				FROM cms_media_type
				WHERE allowed='$allowed' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query ="SELECT typeID, typeName, allowed, active
		FROM cms_media_type
		ORDER BY typeID";
		return parent::GetCollection(parent::GetResult($query));
	}
	
}

?>