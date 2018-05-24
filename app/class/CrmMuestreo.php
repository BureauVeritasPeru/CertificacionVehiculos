<?php
require_once("base/Database.php");

class CrmMuestreo extends Database
{

	public static function  getItem($muestreoID){
		$query = "SELECT * FROM crm_muestreo 
		WHERE
		muestreoID='$muestreoID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCHI($chiID){
		$query = "SELECT * FROM crm_muestreo 
		WHERE
		chiID='$chiID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = "SELECT * FROM crm_muestreo
		ORDER BY numeroActaMuestreo";
		return parent::GetCollection(parent::GetResult($query));
	}

	// public static function  getList_Paging( ){
	// 	$query ="SELECT muestreoID,chiID,plantaID,nombrePlanta, puertoPlanta, zonaPlanta, numeroActaDesembarque, pescaDeclarada, cierrePuerto,inspectorID,nombreInspector,obsInusual,fechaRegistro
	// 	FROM crm_muestreo";

	// 	return parent::GetCollection(parent::GetResultPaging($query));
	// }

	public static function  getWebList(){
		$query = "SELECT * FROM crm_muestreo
		ORDER BY numeroActaMuestreo";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oMuestreo){
		//Search the max Id
		$query = "SELECT MAX(muestreoID) FROM crm_muestreo";
		$result = parent::GetResult($query);
		$oMuestreo->muestreoID = parent::fetchScalar($result)+1;

		//Insert data to table
		$query = "INSERT INTO crm_muestreo(muestreoID,chiID,nroParteMuestreo,especie1ID,porcEspecie1,especie2ID,porcEspecie2,especie3ID,porcEspecie3,especie4ID,porcEspecie4,especie5ID,porcEspecie5,reporteCala,estadio,zonaPesca,inspectorID,nombreInspector,numeroActaMuestreo,frecuencia8,frecuencia8_5,frecuencia9,frecuencia9_5,frecuencia10,frecuencia10_5,frecuencia11,frecuencia11_5,frecuencia12,frecuencia12_5,frecuencia13,frecuencia13_5,frecuencia14,frecuencia14_5,frecuencia15,frecuencia15_5,frecuencia16,frecuencia16_5,frecuencia17,frecuencia17_5,frecuencia18,totalEjemplares,moda,frecuencia,porcJuveniles,observaciones,obsInusual,fechaRegistro,pregunta11,pregunta12)
		VALUES('$oMuestreo->muestreoID','$oMuestreo->chiID','$oMuestreo->nroParteMuestreo','$oMuestreo->especie1ID','$oMuestreo->porcEspecie1','$oMuestreo->especie2ID','$oMuestreo->porcEspecie2','$oMuestreo->especie3ID','$oMuestreo->porcEspecie3','$oMuestreo->especie4ID','$oMuestreo->porcEspecie4','$oMuestreo->especie5ID','$oMuestreo->porcEspecie5','$oMuestreo->reporteCala','$oMuestreo->estadio','$oMuestreo->zonaPesca','$oMuestreo->inspectorID','$oMuestreo->nombreInspector','$oMuestreo->numeroActaMuestreo','$oMuestreo->frecuencia8','$oMuestreo->frecuencia8_5','$oMuestreo->frecuencia9','$oMuestreo->frecuencia9_5','$oMuestreo->frecuencia10','$oMuestreo->frecuencia10_5','$oMuestreo->frecuencia11','$oMuestreo->frecuencia11_5','$oMuestreo->frecuencia12','$oMuestreo->frecuencia12_5','$oMuestreo->frecuencia13','$oMuestreo->frecuencia13_5','$oMuestreo->frecuencia14','$oMuestreo->frecuencia14_5','$oMuestreo->frecuencia15','$oMuestreo->frecuencia15_5','$oMuestreo->frecuencia16','$oMuestreo->frecuencia16_5','$oMuestreo->frecuencia17','$oMuestreo->frecuencia17_5','$oMuestreo->frecuencia18','$oMuestreo->totalEjemplares','$oMuestreo->moda','$oMuestreo->frecuencia','$oMuestreo->porcJuveniles','$oMuestreo->observaciones','$oMuestreo->obsInusual',NOW(),'$oMuestreo->pregunta11','$oMuestreo->pregunta12')";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update($oMuestreo){
		//Update data to table
		$query = "UPDATE crm_muestreo SET 
		nroParteMuestreo	=	'$oMuestreo->nroParteMuestreo',
		especie1ID			=	'$oMuestreo->especie1ID',
		porcEspecie1		=	'$oMuestreo->porcEspecie1',
		especie2ID			=	'$oMuestreo->especie2ID',
		porcEspecie2		=	'$oMuestreo->porcEspecie2',
		especie3ID			=	'$oMuestreo->especie3ID',
		porcEspecie3		=	'$oMuestreo->porcEspecie3',
		especie4ID			=	'$oMuestreo->especie4ID',
		porcEspecie4		=	'$oMuestreo->porcEspecie4',
		especie5ID			=	'$oMuestreo->especie5ID',
		porcEspecie5		=	'$oMuestreo->porcEspecie5',
		reporteCala			=	'$oMuestreo->reporteCala',
		estadio				=	'$oMuestreo->estadio',
		zonaPesca			=	'$oMuestreo->zonaPesca',
		inspectorID			=	'$oMuestreo->inspectorID',
		nombreInspector		=	'$oMuestreo->nombreInspector',
		numeroActaMuestreo	=	'$oMuestreo->numeroActaMuestreo',
		frecuencia8			=	'$oMuestreo->frecuencia8',
		frecuencia8_5		=	'$oMuestreo->frecuencia8_5',
		frecuencia9			=	'$oMuestreo->frecuencia9',
		frecuencia9_5		=	'$oMuestreo->frecuencia9_5',
		frecuencia10		=	'$oMuestreo->frecuencia10',
		frecuencia10_5		=	'$oMuestreo->frecuencia10_5',
		frecuencia11		=	'$oMuestreo->frecuencia11',
		frecuencia11_5		=	'$oMuestreo->frecuencia11_5',
		frecuencia12		=	'$oMuestreo->frecuencia12',
		frecuencia12_5		=	'$oMuestreo->frecuencia12_5',
		frecuencia13		=	'$oMuestreo->frecuencia13',
		frecuencia13_5		=	'$oMuestreo->frecuencia13_5',
		frecuencia14		=	'$oMuestreo->frecuencia14',
		frecuencia14_5		=	'$oMuestreo->frecuencia14_5',
		frecuencia15		=	'$oMuestreo->frecuencia15',
		frecuencia15_5		=	'$oMuestreo->frecuencia15_5',
		frecuencia16		=	'$oMuestreo->frecuencia16',
		frecuencia16_5		=	'$oMuestreo->frecuencia16_5',
		frecuencia17		=	'$oMuestreo->frecuencia17',
		frecuencia17_5		=	'$oMuestreo->frecuencia17_5',
		frecuencia18		=	'$oMuestreo->frecuencia18',
		totalEjemplares		=	'$oMuestreo->totalEjemplares',
		moda				=	'$oMuestreo->moda',
		frecuencia			=	'$oMuestreo->frecuencia',
		porcJuveniles		=	'$oMuestreo->porcJuveniles',
		observaciones		=	'$oMuestreo->observaciones',
		obsInusual			=	'$oMuestreo->obsInusual',
		pregunta11			=	'$oMuestreo->pregunta11',
		pregunta12			=	'$oMuestreo->pregunta12'

		WHERE 
		chiID	=$oMuestreo->chiID";
		return parent::Execute($query);
	}

	public static function  Delete($muestreoID){
		$query = "DELETE FROM crm_muestreo WHERE muestreoID='$muestreoID'";
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






































