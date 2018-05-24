<?php
require_once("base/Database.php");

class AdmEvent extends Database
{

	public static function  getItem($eventID){
		$query = "SELECT eventID, moduleID
				FROM adm_event
				WHERE eventID='$eventID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($moduleID){
		$query ="SELECT eventID, moduleID, eventName, command, regEvent
		FROM adm_event
		WHERE moduleID='$moduleID'";
		
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Profile($moduleID, $profileID){
		$query ="SELECT event.eventID, event.moduleID, event.eventName, event.command, event.regEvent, IFNULL(prof_event.profileID,-1) AS profileID
		FROM adm_event AS event
		LEFT OUTER JOIN adm_profile_event as prof_event
			ON prof_event.eventID = event.eventID AND
				prof_event.profileID='$profileID'
		WHERE moduleID='$moduleID'";
		
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  AddNew($oAdmEvent){
		//Insert data to table
		$query = "INSERT INTO adm_event(eventID, moduleID, eventName, command, regEvent)
				VALUES('$oAdmEvent->eventID', '$oAdmEvent->moduleID', '$oAdmEvent->eventName', '$oAdmEvent->command', '$oAdmEvent->regEvent')";
		return parent::Execute($query);
	}

	public static function  Update($oAdmEvent){
		//Update data to table
		$query = "UPDATE adm_event SET 
				eventName	='$oAdmEvent->eventName',
				command		='$oAdmEvent->command',
				regEvent	='$oAdmEvent->regEvent'
			WHERE eventID='$oAdmEvent->eventID'";
		return parent::Execute($query);
	}

	public static function  Delete($oAdmEvent){
		$query = "DELETE FROM adm_event WHERE eventID='$oAdmEvent->eventID'";
		parent::Execute($query);
	}
	
}

?>