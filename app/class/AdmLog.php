<?php
require_once("base/Database.php");

class AdmLog extends Database
{

    public static function  getItem($logDate, $eventID, $userID){
        $query ="SELECT l.*, u.userName, e.eventName
            FROM adm_log AS l
        INNER JOIN adm_user AS u
            ON u.userID=l.userID
        INNER JOIN adm_event AS e
            ON e.eventID=l.eventID
        WHERE 
            l.logDate='$logDate' AND
            l.eventID='$eventID' AND
            l.userID='$userID'
        ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList($userName, $startDate, $endDate){
        $query ="SELECT l.*, u.userName, e.eventName
            FROM adm_log AS l
        INNER JOIN adm_user AS u
            ON u.userID=l.userID
        INNER JOIN adm_event AS e
            ON e.eventID=l.eventID
        WHERE 
            u.userName LIKE '%$userName%' AND
            l.logDate BETWEEN '$startDate' AND '$endDate'
        ";
        if(self::$orderBy=="") self::$orderBy="l.logDate DESC";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging($userName, $startDate, $endDate){
        $query ="SELECT l.*, u.userName, e.eventName
            FROM adm_log AS l
        INNER JOIN adm_user AS u
            ON u.userID=l.userID
        INNER JOIN adm_event AS e
            ON e.eventID=l.eventID
        WHERE 
            u.userName LIKE '%$userName%' AND
            l.logDate BETWEEN '$startDate' AND '$endDate'
        ";
        if(self::$orderBy=="") self::$orderBy="l.logDate DESC";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  AddNew($oAdmLog){
        //Insert data to table
        $query = "INSERT INTO adm_log(eventID, logDate, userID, comment, object)
                    VALUES('$oAdmLog->eventID', NOW(), '$oAdmLog->userID', '$oAdmLog->comment', '$oAdmLog->object')";
        return parent::Execute($query);
    }

    public static function  Delete($oAdmLog){
        $query = "DELETE FROM adm_log WHERE eventID='$oAdmLog->eventID' AND logDate='$oAdmLog->logDate' AND userID='$oAdmLog->userID'";
        return parent::Execute($query);
    }
	
}

?>