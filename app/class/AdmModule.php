<?php

class AdmModule extends Database
{

	public static function  getList(){
		$query = "SELECT moduleID, menuID, moduleName, alias, moduleForm, moduleParams, position, active, moduleIcon
		FROM adm_module
		ORDER BY Position";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query = "SELECT moduleID, menuID, moduleName, alias, moduleForm, moduleParams, position, active, moduleIcon
		FROM adm_module
		ORDER BY Position";
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_UserModule($menuID, $userModule){
		$query = "
			SELECT moduleID, menuID, moduleName, alias, moduleForm, moduleParams, position, active, moduleIcon
			FROM	adm_module
			WHERE menuID='$menuID' AND active=1 AND 
				moduleID IN (".$userModule.")
			ORDER BY Position
		";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Profile($menuID){
		$query = "
			SELECT moduleID, menuID, moduleName, alias, moduleForm, moduleParams, position, active, moduleIcon
			FROM	adm_module
			WHERE menuID='$menuID' AND active=1
			ORDER BY Position
		";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  getItem($moduleID){
		$query = "SELECT moduleID, menuID, moduleName, alias, moduleForm, moduleParams, position, active, moduleIcon
		FROM adm_module 
		WHERE moduleID=$moduleID";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  AddNew($moduleName, $active){
		//Search the max Id
		$query = "SELECT MAX(moduleID) FROM adm_module";
		$result = parent::GetResult($query);
		parent::$NewID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO adm_module(moduleID, moduleName, active)
				VALUES('parent::NewID', '$moduleName', '$active')";
		return parent::Execute($query);
	}

	public static function  Update($moduleID, $moduleName, $active){
		//Update data to table
		$query = "UPDATE adm_module SET 
					moduleName='$moduleName',
					active='$active'
				WHERE 
					moduleID=$moduleID";
		return parent::Execute($query);
	}

	public static function  Delete($kID){
		$query = "DELETE FROM adm_module 
				WHERE moduleID='$kID'";
		parent::Execute($query);
	}

}

?>