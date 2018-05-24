<?php
require_once("base/Database.php");

class UbgCountry extends Database
{
	public static function  getList(){
		$query = "SELECT * FROM ubg_country";
		$query .= " ORDER BY fullName";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function getWebList(){
		$query = "SELECT * FROM ubg_country
				WHERE active='1'
				ORDER BY countryName";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getItem($countryID){
		$query = "SELECT * FROM ubg_country WHERE countryID='$countryID'";
		return parent::GetObject(parent::GetResult($query));
	}
	
}

?>