<?php
require_once("base/Database.php");

class CrmDetalleCala extends Database
{

	public static function  getItem($calaID){
		$query = "SELECT * FROM crm_detalle_cala 
		WHERE
		calaID='$calaID'";
		return parent::GetObject(parent::GetResult($query));
	}


	public static function  getItemCorre($chiID,$correlativo){
		$query = "SELECT * FROM crm_detalle_cala dc INNER JOIN crm_cala c ON  (dc.calaID = c.calaID)
		WHERE
		c.chiID='$chiID'
		AND dc.correlativo = '$correlativo'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCHI($chiID){
		$query = "SELECT dc.* FROM crm_detalle_cala dc INNER JOIN crm_cala c ON  (dc.calaID = c.calaID)
		WHERE
		c.chiID='$chiID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($chiID){
		$query = "SELECT * FROM crm_detalle_cala dc
		INNER JOIN crm_cala c ON  (dc.calaID = c.calaID)
		WHERE
		c.chiID='$chiID'
		ORDER BY c.calaID,dc.correlativo";
		return parent::GetCollection(parent::GetResult($query));
	}



	public static function  getWebList(){
		$query = "SELECT * FROM crm_detalle_cala
		ORDER BY calaID,correlativo";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oDetalleCala){
		//Search the max Id
		$query = "SELECT MAX(detalleCalaID) FROM crm_detalle_cala";
		$result = parent::GetResult($query);
		$oDetalleCala->detalleCalaID = parent::fetchScalar($result)+1;

		//Insert data to table
		$query = "INSERT INTO crm_detalle_cala(detalleCalaID,calaID,correlativo,latitud,minLat,segLat,longitud,minLong,segLong,fechaCala,horaCala,tmDeclaradas,juveniles,porcJuveniles,especie,porcEspecie)
		VALUES('$oDetalleCala->detalleCalaID','$oDetalleCala->calaID','$oDetalleCala->correlativo','$oDetalleCala->latitud','$oDetalleCala->minLat','$oDetalleCala->segLat','$oDetalleCala->longitud','$oDetalleCala->minLong','$oDetalleCala->segLong','$oDetalleCala->fechaCala','$oDetalleCala->horaCala','$oDetalleCala->tmDeclaradas','$oDetalleCala->juveniles','$oDetalleCala->porcJuveniles','$oDetalleCala->especie','$oDetalleCala->porcEspecie')";
		return parent::Execute($query);
		//echo $query;
	}


	public static function  Update($oDetalleCala){
		//Update data to table
		$query = "UPDATE crm_detalle_Cala as cd INNER JOIN crm_cala as c ON cd.calaID = c.calaID SET 
		cd.latitud     			=    '$oDetalleCala->latitud',
		cd.minLat     			=    '$oDetalleCala->minLat',
		cd.segLat     			=    '$oDetalleCala->segLat',
		cd.longitud     		=    '$oDetalleCala->longitud',
		cd.minLong     			=    '$oDetalleCala->minLong',
		cd.segLong     			=    '$oDetalleCala->segLong',
		cd.fechaCala     		=    '$oDetalleCala->fechaCala',
		cd.horaCala     		=    '$oDetalleCala->horaCala',
		cd.tmDeclaradas     	=    '$oDetalleCala->tmDeclaradas',
		cd.juveniles     		=    '$oDetalleCala->juveniles',
		cd.porcJuveniles     	=    '$oDetalleCala->porcJuveniles',
		cd.especie     			=    '$oDetalleCala->especie',
		cd.porcEspecie     		=    '$oDetalleCala->porcEspecie'
		WHERE 
		c.chiID	=$oDetalleCala->chiID
		AND
		cd.correlativo = $oDetalleCala->correlativo";
		return parent::Execute($query);
		//echo $query;

	}




	public static function  Delete($calaID){
		$query = "DELETE FROM crm_detalle_cala WHERE calaID='$calaID'";
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






































