<?php
require_once("base/Database.php");

class CmsTermino extends Database
{

	public static function  getItem($terminoID){
		$query = "SELECT * FROM cms_termino 
		WHERE terminoID='$terminoID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($groupID){
		$query = "SELECT * FROM cms_termino
		WHERE groupID='$groupID'
		ORDER BY terminoID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oTermino){
		//Search the max Id
		$query = "SELECT MAX(terminoID) FROM cms_termino";
		$result = parent::GetResult($query);
		$oTermino->terminoID = parent::fetchScalar($result)+1;
		$oTermino->varName	 = $oTermino->terminoID;
		//Insert data to table
		$query = "INSERT INTO cms_termino(terminoID, groupID, alias, varName, inputType)
				VALUES('$oTermino->terminoID', '$oTermino->groupID', '$oTermino->alias', '$oTermino->varName', '$oTermino->inputType')";
		return parent::Execute($query);
	}

	public static function  Update($oTermino){
		//Update data to table
		$query = "UPDATE cms_termino SET 
					alias		='$oTermino->alias'
				WHERE 
					terminoID	=$oTermino->terminoID";
		return parent::Execute($query);
	}

	public static function  Delete($oTermino){
		$query = "DELETE FROM cms_termino 
				WHERE terminoID ='$oTermino->terminoID'";
		parent::Execute($query);
	}
	
}

?>