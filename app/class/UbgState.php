<?php
require_once("base/Database.php");

class UbgState extends Database
{
    public static function  getList($countryID){
        $query = "SELECT * FROM ubg_state
            WHERE countryID='$countryID'
            ORDER BY fullName";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function getWebList($countryID){
        $query = "SELECT * FROM ubg_state
            WHERE active='1' AND countryID='$countryID'
            ORDER BY stateName";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getItem($stateID){
        $query = "SELECT * FROM ubg_state WHERE stateID='$stateID'";
        return parent::GetObject(parent::GetResult($query));
    }
}

?>