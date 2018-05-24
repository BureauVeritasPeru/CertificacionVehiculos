<?php
require_once("base/Database.php");

class CmsTerminoGroup extends Database
{

	public static function  getItem($groupID){
		$query = "SELECT * FROM cms_termino_group 
		WHERE groupID='$groupID'";
		return parent::GetObject(parent::GetResult($query));
	}
	
	public static function  getList(){
		$query = "SELECT * FROM cms_termino_group
		ORDER BY groupID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebList(){
		$query = "SELECT * FROM cms_termino_group
		WHERE active=1
		ORDER BY groupID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oGroup){
		//Search the max Id
		$query = "SELECT MAX(groupID) FROM cms_termino_group";
		$result = parent::GetResult($query);
		$oGroup->groupID= parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO cms_termino_group(groupID, groupName, active)
				VALUES('$oGroup->groupID', '$oGroup->groupName', '$oGroup->active')";
		return parent::Execute($query);
	}

	public static function  Update($oGroup){
		//Update data to table
		$query = "UPDATE cms_termino_group SET 
					groupName='$groupName',
					active='$active'
				WHERE 
					groupID=$groupID";
		return parent::Execute($query);
	}
	
	public static function  Delete($oGroup){
		$query = "DELETE FROM cms_termino_group 
				WHERE groupID ='$oGroup->groupID'";
		parent::Execute($query);
	}

}

?>