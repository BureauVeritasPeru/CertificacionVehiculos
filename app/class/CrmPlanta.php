<?php
require_once("base/Database.php");

class CrmPlanta extends Database
{

	public static function  getItem($plantaID){
		$query = "SELECT * FROM crm_planta 
		WHERE
		plantaID='$plantaID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCodigo($codigoPlanta){
		$query = "SELECT * FROM crm_planta 
		WHERE
		codigoPlanta='$codigoPlanta'";
		return parent::GetObject(parent::GetResult($query));
	}


	public static function  getList(){
		$query = "SELECT * FROM crm_planta
		ORDER BY codigoPlanta, nombrePlanta";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging( ){
		$query ="SELECT plantaID, codigoPlanta , nombrePlanta, puertoPlanta, zonaPlanta, regionPlanta, state
		FROM crm_planta
		";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getWebList(){
		$query = "SELECT * FROM crm_planta
		ORDER BY codigoPlanta, nombrePlanta";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oPlanta){
		//Search the max Id
		$query = "SELECT MAX(plantaID) FROM crm_planta";
		$result = parent::GetResult($query);
		$oPlanta->plantaID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_planta(plantaID, codigoPlanta , nombrePlanta, puertoPlanta, zonaPlanta, regionPlanta, state)
		VALUES('$oPlanta->plantaID', '$oPlanta->codigoPlanta', '$oPlanta->nombrePlanta', '$oPlanta->puertoPlanta', '$oPlanta->zonaPlanta', '$oPlanta->regionPlanta', '$oPlanta->state')";
		return parent::Execute($query);
	}

	public static function  Update($oPlanta){
		//Update data to table
		$query = "UPDATE crm_planta SET 
		codigoPlanta	='$oPlanta->codigoPlanta',
		nombrePlanta	='$oPlanta->nombrePlanta',
		puertoPlanta	='$oPlanta->puertoPlanta',
		zonaPlanta		='$oPlanta->zonaPlanta',
		regionPlanta    ='$oPlanta->regionPlanta',
		state			='$oPlanta->state'
		WHERE 
		plantaID	=$oPlanta->plantaID";
		return parent::Execute($query);
	}

	public static function  Delete($oPlanta){
		$query = "DELETE FROM crm_planta WHERE plantaID='$oPlanta->plantaID'";
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