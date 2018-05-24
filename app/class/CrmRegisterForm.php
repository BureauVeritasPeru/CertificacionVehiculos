<?php
require_once("base/Database.php");

class CrmRegisterForm extends Database
{

	public static function  getItem($registerID){
            $query = "
                SELECT *
                FROM crm_register_form
                WHERE registerID='$registerID' ";
            return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
            $query ="
            SELECT *
            FROM crm_register_form
            ORDER BY registerID DESC";

            return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging($formID, $txtsearch){
            $query ="
            SELECT *
            FROM crm_register_form
            WHERE
                formID='$formID' AND 
                CONCAT(name, '%', lastname, surname, '%', email) LIKE CONCAT('%', REPLACE('$txtsearch', ' ', '%'), '%')
            ";
            if(self::$orderBy=="") self::$orderBy="registerDate DESC";

            return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_Export($formID, $contactID, $txtsearch){
            $query ="
            SELECT *
            FROM crm_register_form
            WHERE
                formID='$formID' AND 
                contactID='$contactID' AND
                CONCAT(name, '%', lastname, surname, '%', email) LIKE CONCAT('%', REPLACE('$txtsearch', ' ', '%'), '%')
            ";
            $query .=" ORDER BY ".(self::$orderBy!=""? self::$orderBy: "registerDate DESC");

            return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getList_Active(){
            $query ="
            SELECT *
            FROM crm_register_form
            WHERE state='1'
            ORDER BY registerID DESC";

            return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oRegForm){
            //Search the max Id
            $sql = "SELECT IFNULL(MAX(registerID), 0) FROM crm_register_form";
            $result = parent::GetResult($sql);
            $oRegForm->registerID =parent::fetchScalar($result)+1;

            //Insert data into the table
            $query = "INSERT INTO crm_register_form(registerID, formID, name, lastname, surname, phone, countryID, city, district, address, email, contactID, comment, state, registerDate, reviewDate)
                              VALUES ('$oRegForm->registerID', '$oRegForm->formID', '$oRegForm->name',  '$oRegForm->lastname', '$oRegForm->surname', '$oRegForm->phone', '$oRegForm->countryID', '$oRegForm->city', '$oRegForm->district', '$oRegForm->address', '$oRegForm->email', '$oRegForm->contactID', '$oRegForm->comment', '$oRegForm->state',NOW(), NOW())";
            //die($query);
            return parent::Execute($query);
	}

	public static function  Update_State($oRegForm){
            $query = "
            UPDATE crm_register_form
            SET state='$oRegForm->state'
            WHERE registerID='$oRegForm->registerID'";

            return parent::Execute($query);
	}

	public static function  Delete($oRegForm){
            $query = "
            DELETE FROM crm_register_form
            WHERE registerID='$oRegForm->registerID'";

            return parent::Execute($query);
	}
	
	public static function getState($state){
            switch($state){
                case 1:
                        return "Revisado"; break;
                case 2:
                        return "Pendiente"; break;
                case 0:
                        return "Inactivo"; break;
            }
	}
	
}

?>