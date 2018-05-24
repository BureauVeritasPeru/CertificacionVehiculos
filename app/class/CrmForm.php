<?php
require_once("base/Database.php");

class CrmForm extends Database
{

	public static function  getItem($formID){
		$query = "SELECT *
				FROM crm_form
				WHERE formID='$formID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query ="SELECT *
		FROM crm_form
		ORDER BY formID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query ="SELECT *
		FROM crm_form
		ORDER BY formID";
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_Active(){
		$query ="SELECT *
		FROM crm_form
		WHERE active='1'
		ORDER BY formID";
		return parent::GetCollection(parent::GetResult($query));
	}
	
}

?>