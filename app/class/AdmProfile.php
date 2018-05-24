<?php
require_once("base/Database.php");

class AdmProfile extends Database
{

	public static function  getItem($profileID){
		$query = "SELECT profileID, profileName, isDefault
				FROM adm_profile
				WHERE profileID='$profileID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query ="SELECT profileID, profileName, isDefault
		FROM adm_profile
		ORDER BY profileName";
		
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query ="SELECT profileID, profileName, isDefault
		FROM adm_profile ";
		if(self::$orderBy=="") self::$orderBy="profileName ASC";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  AddNew($oAdmProfile){
		//Search the max Id
		$query = "SELECT MAX(profileID) FROM adm_profile";
		$result = parent::GetResult($query);
		$oAdmProfile->profileID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO adm_profile(profileID, profileName, isDefault)
				VALUES('$oAdmProfile->profileID', '$oAdmProfile->profileName', '$oAdmProfile->isDefault')";
		if(parent::Execute($query)){
			foreach($oAdmProfile->events as $eventID){
				AdmProfileEvent::AddNew(new eAdmProfileEvent($oAdmProfile->profileID, $eventID));
			}
			return true;
		}
		else
			return false;
	}

	public static function  Update($oAdmProfile){
		//Update data to table
		$query = "UPDATE adm_profile SET 
				profileName	='$oAdmProfile->profileName',
				isDefault	='$oAdmProfile->isDefault'
			WHERE profileID='$oAdmProfile->profileID'";
		if(parent::Execute($query)){
			AdmProfileEvent::DeleteAll($oAdmProfile->profileID);
			foreach($oAdmProfile->events as $eventID){
				AdmProfileEvent::AddNew(new eAdmProfileEvent($oAdmProfile->profileID, $eventID));
			}
			return true;
		}
		else
			return false;
	}

	public static function  Delete($oAdmProfile){
		if(AdmProfileEvent::DeleteAll($oAdmProfile->profileID)){
			$query = "DELETE FROM adm_profile WHERE profileID='$oAdmProfile->profileID'";
			return parent::Execute($query);
		}
		else
			return false;
	}
	
}

?>