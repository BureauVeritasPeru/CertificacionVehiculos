<?php
require_once("base/Database.php");

class CmsLang extends Database
{

	public static function  getItem($langID){
		$query = "SELECT langID, langCode, langName, alias, isDefault, active
				FROM cms_lang
				WHERE langID='$langID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query ="SELECT langID, langCode, langName, alias, isDefault, active
		FROM cms_lang
		ORDER BY langID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query ="SELECT langID, langCode, langName, alias, isDefault, active
		FROM cms_lang
		";
		if(self::$orderBy=="") self::$orderBy="langID ASC";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_Active(){
		$query ="SELECT langID, langCode, langName, alias, isDefault, active
		FROM cms_lang
		WHERE active='1'
		ORDER BY langID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oLang){
		//Search the max Id
		$query = "SELECT MAX(langID) FROM cms_lang";
		$result = parent::GetResult($query);
		$oLang->langID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO cms_lang(langID, langCode, langName, alias, isDefault, active)
				VALUES('$oLang->langID', '$oLang->langCode', '$oLang->langName', '$oLang->alias', '$oLang->isDefault', '$oLang->active')";
		return parent::Execute($query);
	}

	public static function  Update($oLang){
		//Update data to table
		$query = "UPDATE cms_lang SET 
					langCode	='$oLang->langCode',
					langName	='$oLang->langName',
					alias 		='$oLang->alias',
					isDefault	='$oLang->isDefault',
					active		='$oLang->active'
				WHERE 
					langID	='$oLang->langID'";
		return parent::Execute($query);
	}

	public static function  Delete($oLang){
		$query = "DELETE FROM cms_lang 
				WHERE langID= '$oLang->langID' AND isDefault='0'";
		return parent::Execute($query);
	}
}?>