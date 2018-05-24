<?php
require_once("base/Database.php");

class CrmTaller extends Database
{

	public static function  getItem($tallerID){
		$query = "SELECT * FROM crm_taller 
		WHERE
		tallerID='$tallerID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemValidado($tallerID){
		$query = "SELECT * FROM crm_taller 
		WHERE
		tallerID='$tallerID'
		AND
		valid  = 1";
		return parent::GetObject(parent::GetResult($query));
	}
	
	public static function  getList(){
		$query = "SELECT * FROM crm_taller
		ORDER BY razonSocial";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListByTaller($tallerID){
		$query = "SELECT * FROM crm_taller
		WHERE tallerID='$tallerID'
		ORDER BY razonSocial";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query ="
		SELECT t.tallerID, t.ruc, t.razonSocial, t.per, t.costo, t.userID, CONCAT(a.firstName,' ',a.lastName) AS nomCompleto, t.fechaCreacion, t.glpAut, t.gnvAut, t.estado , t.valid
		FROM crm_taller t INNER JOIN crm_user a
		ON t.userID = a.userID
		";
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getWebList(){
		$query = "SELECT * FROM crm_taller
		WHERE estado = 1
		ORDER BY razonSocial";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebListGLP(){
		$query = "SELECT tallerID, razonSocial FROM crm_taller
		WHERE  estado = 1 /* AND glpAut = 1*/
		ORDER BY razonSocial";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebListGNV(){
		$query = "SELECT tallerID, razonSocial FROM crm_taller
		WHERE  estado = 1 /* AND gnvAut = 1*/
		ORDER BY razonSocial";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oTaller){
		//Search the max Id
		$query = "SELECT MAX(tallerID) FROM crm_taller";
		$result = parent::GetResult($query);
		$oTaller->tallerID = parent::fetchScalar($result)+1;

		//Insert data to table
		$query = "INSERT INTO crm_taller(tallerID,ruc,razonSocial,per,userID,fechaCreacion,glpAut,gnvAut,estado,valid)
		VALUES('$oTaller->tallerID','$oTaller->ruc','$oTaller->razonSocial','$oTaller->per','$oTaller->userID','$oTaller->fechaCreacion','$oTaller->glpAut','$oTaller->gnvAut','$oTaller->estado','$oTaller->valid')";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update($oTaller){
		//Update data to table
		$query = "UPDATE crm_taller SET 
		ruc				= '$oTaller->ruc',
		razonSocial		= '$oTaller->razonSocial',
		per				= '$oTaller->per',
		userID			= '$oTaller->userID',
		fechaCreacion	= '$oTaller->fechaCreacion',
		glpAut			= '$oTaller->glpAut',
		gnvAut			= '$oTaller->gnvAut',
		estado			= '$oTaller->estado',
		valid			= '$oTaller->valid'
		WHERE 
		tallerID		=$oTaller->tallerID";
		return parent::Execute($query);
	}

	public static function  Delete($oTaller){
		$query = "DELETE FROM crm_taller WHERE tallerID='$oTaller->tallerID'";
		
		if(parent::Execute($query)){
			CrmContacto::DeleteByTaller($oTaller->tallerID);
			return CrmSede::DeleteByTaller($oTaller->tallerID);
		}
		else
			return false;
	}

	public static function  getState($state){
		switch($state){
			case 1: 	return "Activo"; break;
			case 0: 	return "Inactivo"; break;
		}
		return "";
	}

	public static function  getYesNo($yesno){
		switch($yesno){
			case 1: 	return "Si"; break;
			case 0: 	return "No"; break;
		}
		return "";
	}
}
?>