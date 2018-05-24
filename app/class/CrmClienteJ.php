<?php
require_once("base/Database.php");

class CrmClienteJ extends Database
{

	public static function  getItem($clienteID){
		$query = "SELECT * FROM crm_cliente_J 
		WHERE
		clienteID='$clienteID'";
		return parent::GetObject(parent::GetResult($query));
	}


	public static function  getList(){
		$query = "SELECT * FROM crm_cliente_J
		ORDER BY razonSocial";
		return parent::GetCollection(parent::GetResult($query));
	}

	

	public static function  getWebList(){
		$query = "SELECT * FROM crm_cliente_J
		ORDER BY razonSocial";
		return parent::GetCollection(parent::GetResult($query));
	}


	public static function  AddNew($oClienteJ){
		//Search the max Id
		$query = "SELECT MAX(clienteID) FROM crm_cliente_J";
		$result = parent::GetResult($query);
		$oClienteJ->clienteID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_cliente_J(clienteID,razonSocial,ruc,representanteLegal,telefono,direccion,emai,fechaRegistro)
		VALUES('$oClienteJ->clienteID', '$oClienteJ->razonSocial', '$oClienteJ->ruc', '$oClienteJ->representanteLegal', '$oClienteJ->telefono', '$oClienteJ->direccion', '$oClienteJ->email', NOW())";
		return parent::Execute($query);
	}

	public static function  Update($oClienteJ){
		//Update data to table
		$query = "UPDATE crm_cliente_J SET
		razonSocial				='$oClienteJ->razonSocial',
		ruc						='$oClienteJ->ruc',
		representanteLegal		='$oClienteJ->representanteLegal',
		direccion				='$oClienteJ->direccion',
		email					='$oClienteJ->email'
		WHERE clienteID			=$oClienteJ->clienteID";
		return parent::Execute($query);
	}

	public static function  Delete($oClienteJ){
		$query = "DELETE FROM crm_cliente_J WHERE clienteID='$oClienteJ->clienteID'";
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