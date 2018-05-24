<?php
require_once("base/Database.php");

class Ubigeo extends Database
{
	public static function  getCountry_List($maxRows=0){
		$sql = "SELECT * FROM ubg_country";
		$sql .= " ORDER BY fullName";
		return parent::GetResult($sql);
	}

	public static function  getCountry_WebList($maxRows=0){
		$sql = "SELECT * FROM ubg_country
				WHERE state=1
				ORDER BY fullName";
		return parent::GetResult($sql);
	}

	public static function  getCountry_Item($countryID){
		$sql = "SELECT * FROM ubg_country WHERE countryID='$countryID'";
		return parent::GetResult($sql);
	}
	
	public static function  getstate_List($countryID, $maxRows=0){
		$sql = "SELECT * FROM ubg_state
				WHERE countryID='$countryID'";
		$sql .= " ORDER BY fullName";
		return parent::GetResult($sql);
	}

	public static function  getstate_Item($stateID){
		$sql = "SELECT * FROM ubg_state WHERE stateID='$stateID'";
		return parent::GetResult($sql);
	}
}

?>