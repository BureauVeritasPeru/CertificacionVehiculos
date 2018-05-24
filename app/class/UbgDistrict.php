<?php
require_once("base/Database.php");

class UbgDistrict extends Database
{
    public static function  getList($cityID){
        $query = "SELECT * FROM ubg_district
            WHERE cityID='$cityID'
            ORDER BY fullName";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function getWebList($cityID){
        $query = "SELECT * FROM ubg_district
            WHERE active='1' AND cityID='$cityID'
            ORDER BY districtName";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getItem($districtID){
        $query = "SELECT * FROM ubg_district WHERE districtID='$districtID'";
        return parent::GetObject(parent::GetResult($query));
    }
}

?>