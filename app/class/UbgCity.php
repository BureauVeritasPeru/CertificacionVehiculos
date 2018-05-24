<?php
require_once("base/Database.php");

class UbgCity extends Database
{
    public static function  getList($stateID){
        $query = "SELECT * FROM ubg_city
            WHERE stateID='$stateID'
            ORDER BY fullName";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function getWebList($stateID){
        $query = "SELECT * FROM ubg_city
            WHERE active='1' AND stateID='$stateID'
            ORDER BY cityName";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getItem($cityID){
        $query = "SELECT * FROM ubg_city WHERE cityID='$cityID'";
        return parent::GetObject(parent::GetResult($query));
    }
}

?>