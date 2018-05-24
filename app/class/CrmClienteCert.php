<?php
require_once("base/Database.php");

class CrmClienteCert extends Database
{

	public static function  getItem($clienteCertID){
		$query = "SELECT * FROM crm_cliente_cert 
		WHERE
		clienteCertID='$clienteCertID'";
		return parent::GetObject(parent::GetResult($query));
	}


	public static function  getList($clienteID){
		$query = "SELECT c.clienteID,c.name,c.lastname,c.numDoc,c.phone,c.celular FROM crm_cliente_cert cc INNER JOIN  crm_cliente c ON (cc.clienteID = c.clienteID ) where cc.precertID='$clienteID'
		ORDER BY precertID";
		return parent::GetCollection(parent::GetResult($query));
		//echo $query;
	}

	

	public static function  getWebList(){
		$query = "SELECT * FROM crm_cliente_cert 
		ORDER BY precertID";
		return parent::GetCollection(parent::GetResult($query));
	}


	public static function  AddNew($oClienteCert){
		//Search the max Id
		$query = "SELECT MAX(clienteCertID) FROM crm_cliente_cert";
		$result = parent::GetResult($query);
		$oClienteCert->clienteCertID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_cliente_cert(clienteCertID,precertID,clienteID,fechaRegistro)
		VALUES('$oClienteCert->clienteCertID', '$oClienteCert->precertID', '$oClienteCert->clienteID', NOW())";
		return parent::Execute($query);
		// echo $query;
	}

	public static function  Update($oClienteCert){
		//Update data to table
		$query = "UPDATE crm_cliente_cert SET
		precertID		='$oClienteCert->precertID',
		clienteID	    ='$oClienteCert->clienteID'
		WHERE 
		clienteCertID	=$oClienteCert->clienteCertID";
		return parent::Execute($query);
	}

	public static function  Delete($oClienteCert){
		$query = "DELETE FROM crm_cliente_cert WHERE clienteCertID='$oClienteCert->clienteCertID'";
		return parent::Execute($query);
	}

	public static function  Remove($nID,$preID){
		$query = "DELETE FROM crm_cliente_cert WHERE clienteID='$nID' AND precertID='$preID'";
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