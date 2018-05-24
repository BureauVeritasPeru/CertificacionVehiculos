<?php
require_once("base/Database.php");

class CrmClienteSP extends Database
{

	public static function  getItem($clienteID){
		$query = "SELECT * FROM crm_cliente_sp 
		WHERE
		clienteID='$clienteID'";
		return parent::GetObject(parent::GetResult($query));
	}


	public static function  getList(){
		$query = "SELECT * FROM crm_cliente_sp
		ORDER BY name";
		return parent::GetCollection(parent::GetResult($query));
	}

	

	public static function  getWebList(){
		$query = "SELECT * FROM crm_cliente_sp
		ORDER BY direccionSP";
		return parent::GetCollection(parent::GetResult($query));
	}


	public static function  AddNew($oClienteSP){
		//Search the max Id
		$query = "SELECT MAX(clienteID) FROM crm_cliente_sp";
		$result = parent::GetResult($query);
		$oClienteSP->clienteID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_cliente_sp(clienteID,direccionSP,emailSP,celularSP,fechaRegistro)
		VALUES('$oClienteSP->clienteID', '$oClienteSP->direccionSP', '$oClienteSP->emailSP', '$oClienteSP->celularSP', NOW())";
		return parent::Execute($query);
	}

	public static function  Update($oClienteSP){
		//Update data to table
		$query = "UPDATE crm_cliente_sp SET
		direccionSP		='$oClienteSP->direccionSP',
		emailSP			='$oClienteSP->emailSP',
		celularSP		='$oClienteSP->celularSP'
		WHERE 
		clienteID	=$oClienteSP->clienteID";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Delete($oClienteSP){
		$query = "DELETE FROM crm_cliente_sp WHERE clienteID='$oClienteSP->clienteID'";
		return parent::Execute($query);
	}

	public static function  getState($state){
		switch($state){
			case 1: 	return "Activo"; break;
			case 0: 	return "Inactivo"; break;
		}
		return "";
	}


}
?> 