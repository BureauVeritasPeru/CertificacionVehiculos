<?php
require_once("base/Database.php");

class AdmUser extends Database
{

    public static function  getItem($userID){
        $query = "
        SELECT adm.userID,  adm.firstName, adm.lastName, adm.userName, adm.password, adm.email, adm.profileID, adm.state, adm.isDefault, prof.profileName
            FROM adm_user as adm
        INNER JOIN adm_profile AS prof
            ON adm.profileID=prof.profileID
        WHERE 
            adm.userID='$userID' ";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getItem_Login($userName, $password){
        $query = "
        SELECT adm.userID,  adm.firstName, adm.lastName, adm.userName, adm.password, adm.email, adm.profileID, adm.state, adm.state, adm.isDefault, prof.profileName
            FROM adm_user as adm
        INNER JOIN adm_profile AS prof
            ON adm.profileID=prof.profileID
        WHERE
            adm.userName='".addslashes($userName)."' 
            AND adm.password='".addslashes($password)."' 
            AND state='1'";
        return parent::GetObject(parent::GetResult($query));
    }

    public static function  getList(){
        $list=new Collection();
        $query ="
        SELECT adm.userID, adm.firstName, adm.lastName, adm.userName, adm.password, adm.email, adm.profileID, adm.state, adm.state, adm.isDefault, prof.profileName
            FROM adm_user AS adm
        INNER JOIN adm_profile AS prof
            ON adm.profileID=prof.profileID
        ";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getListInspector(){
        $list=new Collection();
        $query ="
        SELECT adm.userID, adm.firstName, adm.lastName
            FROM adm_user AS adm
        WHERE adm.profileID = '4'
        AND adm.state = '1'
        ";

        return parent::GetCollection(parent::GetResult($query));
    }


    public static function  getList_Profile($profileID ){
        $list=new Collection();
        $query ="
        SELECT adm.userID, adm.firstName, adm.lastName, adm.userName, adm.password, adm.email, adm.profileID, adm.state, adm.state, adm.isDefault, prof.profileName
            FROM adm_user AS adm
        INNER JOIN adm_profile AS prof
            ON adm.profileID=prof.profileID
        WHERE adm.profileID='$profileID'
        ";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Notify($formID, $contactID){
        $list=new Collection();
        $query ="
        SELECT adm.userID, adm.firstName, adm.lastName, adm.userName, adm.password, adm.email, adm.profileID, adm.state, adm.state, adm.isDefault, prof.profileName
            FROM adm_user AS adm
        INNER JOIN adm_profile AS prof
            ON adm.profileID=prof.profileID
        WHERE
            adm.userID NOT IN (SELECT userID FROM crm_form_notify WHERE formID='$formID' AND contactID='$contactID')
        ";

        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getList_Paging(){
        $query ="SELECT adm.userID, adm.firstName, adm.lastName, adm.userName, adm.password, adm.email, adm.profileID, adm.state, adm.state, adm.isDefault, prof.profileName
        FROM adm_user AS adm
        INNER JOIN adm_profile AS prof
            ON adm.profileID=prof.profileID
        ";

        return parent::GetCollection(parent::GetResultPaging($query));
    }

    public static function  AddNew($oAdmUser){
        //Search the max Id
        $query = "SELECT MAX(userID) FROM adm_user";
        $result = parent::GetResult($query);
        $oAdmUser->userID = parent::fetchScalar($result)+1;
        //Insert data to table
        $query = "INSERT INTO adm_user(userID, firstName, lastName, userName, password, email, profileID, state)
                        VALUES('$oAdmUser->userID', '$oAdmUser->firstName', '$oAdmUser->lastName', '$oAdmUser->userName', '$oAdmUser->password', '$oAdmUser->email', '$oAdmUser->profileID', '$oAdmUser->state')";
        return parent::Execute($query);
    }

    public static function  Update($oAdmUser){
        //Update data to table
        $query = "UPDATE adm_user SET 
                        firstName	='$oAdmUser->firstName', 
                        lastName	='$oAdmUser->lastName', 
                        userName	='$oAdmUser->userName',
                        password	='$oAdmUser->password', 
                        email		='$oAdmUser->email', 
                        profileID	='$oAdmUser->profileID',
                        state		='$oAdmUser->state'
                WHERE userID='$oAdmUser->userID'";
        return parent::Execute($query);
    }

    public static function  Delete($oAdmUser){
        $query = "DELETE FROM adm_user WHERE userID='$oAdmUser->userID'";
        return parent::Execute($query);
    }

    public static function  getState($state){
        switch($state){
            case 1: 	return "Activo"; break;
            case 2: 	return "Bloqueado"; break;
            case 0: 	return "Inactivo"; break;
        }
        return "";
    }

}

?>