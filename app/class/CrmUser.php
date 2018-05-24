<?php
require_once("base/Database.php");

class CrmUser extends Database
{

	public static function  getItem($userID){
		$query = "SELECT * FROM crm_user 
		WHERE
		userID='$userID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItem_Login($userName, $password){
		$query = "SELECT * FROM crm_user 
		WHERE 
		userName='$userName' AND password='$password' AND state = '1'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = "SELECT * FROM crm_user
		ORDER BY firstName, lastName";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListInspectores(){
		$query = "SELECT * FROM crm_user
		ORDER BY firstName, lastName";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging( ){
		$query ="SELECT userID, userName, password, firstName, lastName, email, state
		FROM crm_user
		";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getWebList(){
		$query = "SELECT userID, firstName, lastName FROM crm_user
		WHERE state = '1'
		ORDER BY firstName, lastName";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oUser){
		//Search the max Id
		$query = "SELECT MAX(userID) FROM crm_user";
		$result = parent::GetResult($query);
		$oUser->userID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_user(userID, userName, password, firstName, lastName, email, state,glp,gnv,consulta_glp,consulta_gnv,reportes)
		VALUES('$oUser->userID', '$oUser->userName', '$oUser->password', UPPER('$oUser->firstName'), UPPER('$oUser->lastName'), '$oUser->email', '$oUser->state','$oUser->glp','$oUser->gnv','$oUser->consulta_glp','$oUser->consulta_gnv','$oUser->reportes')";
		return parent::Execute($query);
	}

	public static function  Update($oUser){
		//Update data to table
		$query = "UPDATE crm_user SET 
		password	 ='$oUser->password',
		firstName	 =UPPER('$oUser->firstName'),
		lastName	 =UPPER('$oUser->lastName'),
		email		 ='$oUser->email',
		state		 ='$oUser->state',
		glp 		 ='$oUser->glp',
		gnv 		 ='$oUser->gnv',
		consulta_glp ='$oUser->consulta_glp',
		consulta_gnv ='$oUser->consulta_gnv',
		reportes     ='$oUser->reportes'
		WHERE 
		userID	=$oUser->userID";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Delete($oUser){
		$query = "DELETE FROM crm_user WHERE userID='$oUser->userID'";
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