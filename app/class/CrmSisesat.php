<?php
require_once("base/Database.php");

class CrmSisesat extends Database
{

	public static function  getItem($sisesatID){
		$query = "SELECT * FROM crm_sisesat 
		WHERE
			sisesatID='$sisesatID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = "SELECT * FROM crm_sisesat
		ORDER BY tipoSisesat, fechaRegistro";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query ="SELECT sisesatID, chataID , tipoSisesat, horaSisesat, operatividadSisesat, contestadoSisesat, fechaRegistro,fechaActualizacion
		FROM crm_sisesat
		";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getWebList(){
		$query = "SELECT * FROM crm_sisesat
		ORDER BY tipoSisesat, fechaRegistro";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebListChata($chataID){
		$query = "SELECT * FROM crm_sisesat
		WHERE chataID ='$chataID'
		ORDER BY sisesatID ASC";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oSisesat){
		//Search the max Id
		$query = "SELECT MAX(sisesatID) FROM crm_sisesat";
		$result = parent::GetResult($query);
		$oSisesat->sisesatID = parent::fetchScalar($result)+1;

		$query = "SELECT MAX(chataID) FROM crm_chata";
		$result = parent::GetResult($query);
		$oSisesat->chataID = parent::fetchScalar($result);


		//Insert data to table
		$query = "INSERT INTO crm_sisesat(sisesatID, chataID , tipoSisesat, horaSisesat, operatividadSisesat, contestadoSisesat, fechaRegistro,fechaActualizacion)
				VALUES('$oSisesat->sisesatID', '$oSisesat->chataID', '$oSisesat->tipoSisesat', '$oSisesat->horaSisesat', '$oSisesat->operatividadSisesat', '$oSisesat->contestadoSisesat',NOW(),NOW())";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update($oSisesat){
		//Update data to table
		$query = "UPDATE crm_sisesat SET 
					tipoSisesat				='$oSisesat->tipoSisesat',
					horaSisesat				='$oSisesat->horaSisesat',
					operatividadSisesat		='$oSisesat->operatividadSisesat',
					contestadoSisesat		='$oSisesat->contestadoSisesat',
					fechaActualizacion    	= NOW()
				
				WHERE 
					sisesatID	=$oSisesat->sisesatID";
		return parent::Execute($query);
	}

	public static function  Delete($chataID){
		$query = "DELETE FROM crm_sisesat WHERE chataID='$chataID'";
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