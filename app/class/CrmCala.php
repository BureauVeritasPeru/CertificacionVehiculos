<?php
require_once("base/Database.php");

class CrmCala extends Database
{

	public static function  getItem($calaID){
		$query = "SELECT * FROM crm_cala 
		WHERE
		calaID='$calaID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCHI($chiID){
		$query = "SELECT * FROM crm_cala 
		WHERE
		chiID='$chiID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = "SELECT * FROM crm_cala
		ORDER BY numReporteCala";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getListAll(){
		$query = "SELECT * FROM crm_cala
		ORDER BY numReporteCala";
		return parent::GetCollection(parent::GetResult($query));
	}



	public static function  getWebList(){
		$query = "SELECT * FROM crm_cala
		ORDER BY numReporteCala";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oCala){
		//Search the max Id
		$query = "SELECT MAX(calaID) FROM crm_cala";
		$result = parent::GetResult($query);
		$oCala->calaID = parent::fetchScalar($result)+1;

		//Insert data to table
		$query = "INSERT INTO crm_cala(calaID,chiID,numReporteCala,codigoFaenaWeb,fechaRegistro)
		VALUES('$oCala->calaID','$oCala->chiID','$oCala->numReporteCala','$oCala->codigoFaenaWeb',NOW())";
		return parent::Execute($query);
		//echo $query;
	}


	
	public static function  Update($oCala){
		//Update data to table
		$query = "UPDATE crm_cala SET 
		numReporteCala 		=			'$oCala->numReporteCala',
		codigoFaenaWeb 		=			'$oCala->codigoFaenaWeb'
		WHERE 
		chiID	=$oCala->chiID";
		return parent::Execute($query);
	}



	public static function  Delete($calaID){
		$query = "DELETE FROM crm_cala WHERE calaID='$calaID'";
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






































