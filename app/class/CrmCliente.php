<?php
require_once("base/Database.php");

class CrmCliente extends Database
{

	public static function  getItem($clienteID){
		$query = "SELECT * FROM crm_cliente 
		WHERE
		clienteID='$clienteID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemDNI($dni){
		$query = "SELECT * FROM crm_cliente 
		WHERE
		dni='$dni'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = "SELECT * FROM crm_cliente
		ORDER BY name";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query ="SELECT clienteID, numDoc, name , lastname, phone, address, state
		FROM crm_cliente";		
		return parent::GetCollection(parent::GetResultPaging($query));
	}

	public static function  getWebList(){
		$query = "SELECT * FROM crm_cliente
		WHERE state = 1
		ORDER BY name";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getWebListSearch($txtsearch, $orderBy=NULL){
		$query = "	SELECT * FROM crm_cliente
		WHERE CONCAT(name, '%', lastname, '%', numDoc) LIKE CONCAT('%', REPLACE('$txtsearch', ' ', '%'), '%')
		ORDER BY
		".(($orderBy!=NULL)? $orderBy: "name")."";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oCliente){
		//Search the max Id
		$query = "SELECT MAX(clienteID) FROM crm_cliente";
		$result = parent::GetResult($query);
		$oCliente->clienteID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_cliente(clienteID, name, lastname, tipoDoc, numDoc, fecNac, sexo, departamento, provincia, distrito, address, phone, celular, state)
		VALUES('$oCliente->clienteID', UPPER('$oCliente->name'), UPPER('$oCliente->lastname'), '$oCliente->tipoDoc', '$oCliente->numDoc', '$oCliente->fecNac', '$oCliente->sexo', '$oCliente->departamento', '$oCliente->provincia', '$oCliente->distrito', UPPER('$oCliente->address'), '$oCliente->phone', '$oCliente->celular', '$oCliente->state')";
		return parent::Execute($query);
	}

	public static function  Update($oCliente){
		//Update data to table
		$query = "UPDATE crm_cliente SET
		name		=UPPER('$oCliente->name'),
		lastname	=UPPER('$oCliente->lastname'),
		fecNac		='$oCliente->fecNac',
		sexo		='$oCliente->sexo',
		departamento='$oCliente->departamento',
		provincia	='$oCliente->provincia',
		distrito	='$oCliente->distrito',
		address    	=UPPER('$oCliente->address'),
		phone    	='$oCliente->phone',
		celular    	='$oCliente->celular',
		state		='$oCliente->state'
		WHERE 
		clienteID	=$oCliente->clienteID";
		return parent::Execute($query);
	}

	public static function  Delete($oCliente){
		$query = "DELETE FROM crm_cliente WHERE clienteID='$oCliente->clienteID'";
		return parent::Execute($query);
	}

	public static function  getState($state){
		switch($state){
			case 1: 	return "Activo"; break;
			case 0: 	return "Inactivo"; break;
		}
		return "";
	}

	public static function  getSexo($sexo){
		switch($state){
			case 1: 	return "Femenino"; break;
			case 0: 	return "Masculino"; break;
		}
		return "";
	}
}
?>