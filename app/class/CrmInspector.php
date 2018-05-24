<?php
require_once("base/Database.php");

class CrmInspector extends Database
{

	public static function  getItem($inspectorID){
		$query = "SELECT * FROM crm_inspector 
		WHERE
			inspectorID='$inspectorID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCodigo($codigoInspector){
		$query = "SELECT * FROM crm_inspector 
		WHERE
			codigoInspector='$codigoInspector'";
		return parent::GetObject(parent::GetResult($query));
	}


	public static function  getList(){
		$query = "SELECT * FROM crm_inspector
		ORDER BY codigoInspector, nombreInspector";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging( ){
		$query ="SELECT  inspectorID,codigoInspector,apellidoPaterno,apellidoMaterno,nombreInspector,nroDocumento,nombreCompletoInspector,fechaRegistro,fechaActualizado,state
		FROM crm_inspector
		";
		
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getWebList(){
		$query = "SELECT * FROM crm_inspector
		ORDER BY codigoInspector, nombreInspector";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oInspector){
		//Search the max Id
		$query = "SELECT MAX(inspectorID) FROM crm_inspector";
		$result = parent::GetResult($query);
		$oInspector->inspectorID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_inspector(inspectorID,codigoInspector,apellidoPaterno,apellidoMaterno,nombreInspector,nroDocumento,nombreCompletoInspector,fechaRegistro,fechaActualizado,state)
				VALUES('$oInspector->inspectorID', '$oInspector->codigoInspector', '$oInspector->apellidoPaterno', '$oInspector->apellidoMaterno', '$oInspector->nombreInspector', '$oInspector->nroDocumento', '$oInspector->nombreCompletoInspector', NOW(), NOW(), '$oInspector->state')";
		return parent::Execute($query);
	}

	public static function  Update($oInspector){
		//Update data to table
		$query = "UPDATE crm_inspector SET 
					codigoInspector				='$oInspector->codigoInspector',
					apellidoPaterno				='$oInspector->apellidoPaterno',
					apellidoMaterno				='$oInspector->apellidoMaterno',
					nombreInspector				='$oInspector->nombreInspector',
					nroDocumento    			='$oInspector->nroDocumento',
					nombreCompletoInspector    	='$oInspector->nombreCompletoInspector',
					fechaActualizado    		= NOW(),
					state						='$oInspector->state'
				WHERE 
					inspectorID	=$oInspector->inspectorID";
		return parent::Execute($query);
	}

	public static function  Delete($oInspector){
		$query = "DELETE FROM crm_inspector WHERE inspectorID='$oInspector->inspectorID'";
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