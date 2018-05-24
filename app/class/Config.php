<?php
require_once("base/Database.php");

class Config extends Database
{

	public static function  getItem($configID){
		$query = "SELECT * FROM config 
		WHERE configID='$configID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemVar($varName){
		$query = "SELECT * FROM config 
		WHERE varName='$varName'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = "SELECT * FROM config
		WHERE editable=1
		ORDER BY configID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebList(){
		$query = "SELECT * FROM config
		ORDER BY configID";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  Update($oConfig){
		//Update data to table
		$query = "UPDATE config SET 
					value		='$oConfig->value'
				WHERE 
					configID	=$oConfig->configID";
		return parent::Execute($query);
	}

}

?>