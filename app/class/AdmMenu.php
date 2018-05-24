<?php

class AdmMenu extends Database
{

	public static function  getList(){
		$query = "SELECT menuID, parentMenuID, menuName, position, active, menuIcon
		FROM adm_menu
		ORDER BY menuID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_ParentMenu($parentID, $userMenu){
		$query = "
			SELECT menuID, parentMenuID, menuName, position, active, menuIcon
			FROM	adm_menu AS menu
			WHERE parentMenuID='$parentID' AND active=1 AND
					menuID IN (".$userMenu.")
			ORDER BY Position
		";
		//echo $query;
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Profile($parentID){
		$query = "
			SELECT menuID, parentMenuID, menuName, position, active, menuIcon
			FROM	adm_menu AS menu
			WHERE parentMenuID='$parentID' AND active=1
			ORDER BY Position
		";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_UserProfile($userModule){
		$query = "
			SELECT menuID, parentMenuID, menuName, position, active, menuIcon
			FROM	adm_menu AS menu
			WHERE active=1 AND
			( 
				menuID IN (SELECT menuID FROM adm_module WHERE moduleID IN (".$userModule.")) OR
				menuID IN (SELECT menu.parentMenuID FROM adm_menu as menu 
						INNER JOIN adm_module as module ON menu.menuID=module.menuID
						WHERE module.moduleID IN (".$userModule."))
			)
			ORDER BY Position
		";
		
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getItem($menuID){
		$query = "SELECT menuID, parentMenuID, menuName, position, active, menuIcon
		FROM adm_menu 
		WHERE menuID=$menuID";
		return parent::GetObject(parent::GetResult($query));
	}

}

?>