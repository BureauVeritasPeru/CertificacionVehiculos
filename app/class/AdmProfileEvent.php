<?php
require_once("base/Database.php");

class AdmProfileEvent extends Database
{

	public static function  getItem($profileID, $eventID){
		$query = "SELECT profileID, eventID
				FROM adm_profile_event
				WHERE
					profileID='$profileID' AND 
					eventID='$eventID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList_UserProfile($profileID){
		if($profileID==1 || $profileID==2){
                    $query = "
                            SELECT '$profileID' AS profileID, event.eventID, event.moduleID, event.command, event.regEvent
                            FROM	adm_event AS event";
		}
		else
                    $query = "
                            SELECT prof_event.profileID, prof_event.eventID, event.moduleID, event.command, event.regEvent
                            FROM	adm_event AS event
                            INNER JOIN adm_profile_event prof_event
                                    ON event.eventID=prof_event.eventID
                            WHERE (prof_event.profileID='$profileID')
                            GROUP BY prof_event.profileID, prof_event.eventID, event.moduleID, event.command
                    ";
		//echo $query;
                
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList($profileID){
		$query ="SELECT profileID, eventID
		FROM adm_profile_event
		WHERE
			profileID='$profileID'";
		
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oAdmProfileEvent){
		//Insert data to table
		$query = "INSERT INTO adm_profile_event(profileID, eventID)
				VALUES('$oAdmProfileEvent->profileID', '$oAdmProfileEvent->eventID')";
		return parent::Execute($query);
	}

	public static function  Update($oAdmProfileEvent){
		//Update data to table
		$query = "UPDATE adm_profile_event SET 
				eventID	='$oAdmProfileEvent->eventID'
			WHERE profileID='$oAdmProfileEvent->profileID'";
		return parent::Execute($query);
	}

	public static function  DeleteAll($profileID){
		$query = "DELETE FROM adm_profile_event WHERE profileID='$profileID'";
		return parent::Execute($query);
	}
	
}

?>