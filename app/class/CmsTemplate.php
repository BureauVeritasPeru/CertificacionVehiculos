<?php
require_once("base/Database.php");

class CmsTemplate extends Database
{
	public static function getItem($templateID){
		$oItem=null;
		$query = "SELECT templateID, alias, templateName, imgIcon, admSource, webSource, comments, active
				FROM cms_template
				WHERE templateID='$templateID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	function getList(){
		$query ="SELECT templateID, alias, templateName, imgIcon, admSource, webSource, comments, active
		FROM cms_template";
		return parent::GetCollection(parent::GetResult($query));
	}

	
}

?>