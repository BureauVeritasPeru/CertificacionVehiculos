<?php
require_once("base/Database.php");

class CmsMediaGroup extends Database
{

	public static function  getItem($groupID){
		$query = "SELECT groupID, groupName, alias, typeID, basePath, active
				FROM cms_media_group
				WHERE groupID='$groupID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItem_Alias($alias){
		$query = "SELECT groupID, groupName, alias, typeID, basePath, active
				FROM cms_media_group
				WHERE alias='$alias' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query ="SELECT groupID, groupName, alias, typeID, basePath, active
		FROM cms_media_group
		ORDER BY groupID";
		return parent::GetCollection(parent::GetResult($query));
	}
	
}

?>