<?php
require_once("base/Database.php");

class CrmFormField extends Database
{

	public static function  getItem($fieldID){
		$query = "SELECT fieldID, fieldName, alias, fieldType, options, active
				FROM crm_form_field
				WHERE fieldID='$fieldID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItem_Alias($alias){
		$query = "SELECT fieldID, fieldName, alias, fieldType, options, active
				FROM crm_form_field
				WHERE alias='$alias' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query ="SELECT fieldID, fieldName, alias, alias, alias, active
		FROM crm_form_field
		ORDER BY fieldID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query ="SELECT fieldID, fieldName, alias, fieldType, options, active
		FROM crm_form_field
		ORDER BY fieldID";
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_Active(){
		$query ="SELECT fieldID, fieldName, alias, fieldType, options, active
		FROM crm_form_field
		WHERE active='1'
		ORDER BY fieldID";
		return parent::GetCollection(parent::GetResult($query));
	}
	
}

?>