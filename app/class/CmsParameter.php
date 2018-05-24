<?php
require_once("base/Database.php");

class CmsParameter extends Database
{

	public static function  getItem($parameterID){
		$query = "SELECT * FROM cms_parameter 
		WHERE parameterID='$parameterID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($groupID){
		$query = "SELECT * FROM cms_parameter
		WHERE groupID='$groupID'
		ORDER BY parameterID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oParameter){
		//Search the max Id
		$query = "SELECT MAX(parameterID) FROM cms_parameter";
		$result = parent::GetResult($query);
		$oParameter->parameterID = parent::fetchScalar($result)+1;
		$oParameter->position	 = $oParameter->parameterID;
		//Insert data to table
		$query = "INSERT INTO cms_parameter(parameterID, parentParameterID, groupID, alias, position)
				VALUES('$oParameter->parameterID', '$oParameter->parentParameterID', '$oParameter->groupID', '$oParameter->alias', '$oParameter->position')";
		return parent::Execute($query);
	}

	public static function  Update($oParameter){
		//Update data to table
		$query = "UPDATE cms_parameter SET 
					alias		='$oParameter->alias'
				WHERE 
					parameterID	=$oParameter->parameterID";
		return parent::Execute($query);
	}

	public static function  Delete($oParameter){
		$query = "DELETE FROM cms_parameter 
				WHERE parameterID ='$oParameter->parameterID'";
		parent::Execute($query);
	}
	
	public static function  getmoduleID($groupID){
		switch($groupID){
			case 1: $moduleID=15;break;
			case 2: $moduleID=16;break;
			case 3: $moduleID=17;break;
			default:$moduleID=0;break;
		}
		return $moduleID;
	}

}

?>