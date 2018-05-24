<?php
require_once("base/Database.php");

class CmsSection extends Database
{

    public static function getItem($sectionID){
            $query = "SELECT sectionID, parentSectionID, sectionName, position, isEditable
                            FROM cms_section
                            WHERE sectionID='$sectionID'";
            return parent::GetObject(parent::GetResult($query));
    }

    public static function getList(){
            $query ="SELECT sectionID, parentSectionID, sectionName, position, isEditable
                            FROM cms_section";
            return parent::GetCollection(parent::GetResult($query));
    }

}

?>