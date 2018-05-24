<?php
require_once("base/Database.php");

class CrmChi extends Database
{

	public static function  getItem($chiID){
		$query = "SELECT * FROM crm_chi 
		WHERE
			chiID='$chiID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = "SELECT * FROM crm_chi
		ORDER BY fechaRegistro,localID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging($localID,$nombrePlanta,$startDate,$endDate){
		$query ="SELECT chi.chiID,chi.localID,cha.nombrePlanta,cha.puertoPlanta,cha.zonaPlanta,chi.fechaRegistro,pendiente
		FROM crm_chi chi inner join crm_chata cha on (chi.chiID = cha.chiID)
        WHERE 1=1";
		if ($localID!='')
			$query .= " AND chi.localID = '$localID'";
		if ($nombrePlanta!='')
			$query .= " AND cha.nombrePlanta LIKE '%$nombrePlanta%'";
		if (($startDate!='') && ($endDate!=''))
			$query .= " AND (chi.fechaRegistro BETWEEN '$startDate' AND '$endDate 23:59:59')";
		return parent::GetCollection(parent::GetResultPaging($query));
		//echo $query;
	}

	public static function  getWebList(){
		$query = "SELECT * FROM crm_chi
		ORDER BY fechaRegistro,localID";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oChi){
		//Search the max Id
		$query = "SELECT MAX(chiID) FROM crm_chi";
		$result = parent::GetResult($query);
		$oChi->chiID = parent::fetchScalar($result)+1;
		//Insert data to table
		$query = "INSERT INTO crm_chi(chiID,userID,localID,fechaRegistro,fechaActualizacion,estado,pendiente)
				VALUES('$oChi->chiID', '$oChi->userID', '$oChi->localID',NOW(),NOW(), '$oChi->estado', '$oChi->pendiente')";
		return parent::Execute($query);
	}

	public static function  Update($oChi){
		//Update data to table
		$query = "UPDATE crm_chi SET 
					fechaActualizacion	 = NOW(),
					localID			     ='$oChi->localID'
				WHERE 
					chiID	=$oChi->chiID";
		return parent::Execute($query);
	}

	public static function  Delete($ChiID){
		$query = "DELETE FROM crm_chi WHERE chiID='$ChiID'";
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