<?php
require_once("base/Database.php");

class CrmTolva extends Database
{

	public static function  getItem($tolvaID){
		$query = "SELECT * FROM crm_tolva 
		WHERE
		tolvaID='$tolvaID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCHI($chiID){
		$query = "SELECT * FROM crm_tolva 
		WHERE
		chiID='$chiID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getActa($acta){
		$query = "SELECT * FROM crm_tolva 
		WHERE
		numActaInspeccion='$acta'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getActaxID($ID){
		$query = "SELECT * FROM crm_tolva 
		WHERE
		ChiID='$ID'";
		return parent::GetObject(parent::GetResult($query));
	}
	
	public static function  getList(){
		$query = "SELECT * FROM crm_tolva
		ORDER BY numActaInspeccion,nombreEmbarcacion";
		return parent::GetCollection(parent::GetResult($query));
	}

	// public static function  getList_Paging( ){
	// 	$query ="SELECT tolvaID,chiID,plantaID,nombrePlanta, puertoPlanta, zonaPlanta, numeroActaDesembarque, pescaDeclarada, cierrePuerto,inspectorID,nombreInspector,obsInusual,fechaRegistro
	// 	FROM crm_tolva";

	// 	return parent::GetCollection(parent::GetResultPaging($query));
	// }

	public static function  getWebList(){
		$query = "SELECT * FROM crm_tolva
		ORDER BY numActaInspeccion,nombreEmbarcacion";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oTolva){
		//Search the max Id
		$query = "SELECT MAX(tolvaID) FROM crm_tolva";
		$result = parent::GetResult($query);
		$oTolva->tolvaID = parent::fetchScalar($result)+1;

		//Insert data to table
		$query = "INSERT INTO crm_tolva(tolvaID,chiID,numActaInspeccion,embarcacionID,nombreEmbarcacion,tmDescargado,capacidadBodega,excesoBodega,porcentajeExceso,ro,fechaInicial,horaInicio,fechaFinal,horaTermino,nroReportePesaje,nroTolva,inspectorID,nombreInspector,pruebaPesaje,conforme,numReportePesaje,horaReportePesaje,obsInusual,fechaRegistro,pregunta6,pregunta7,pregunta8,pregunta9,pregunta10)
		VALUES('$oTolva->tolvaID','$oTolva->chiID','$oTolva->numActaInspeccion','$oTolva->embarcacionID','$oTolva->nombreEmbarcacion','$oTolva->tmDescargado','$oTolva->capacidadBodega','$oTolva->excesoBodega','$oTolva->porcentajeExceso','$oTolva->ro','$oTolva->fechaInicial','$oTolva->horaInicio','$oTolva->fechaFinal','$oTolva->horaTermino','$oTolva->nroReportePesaje','$oTolva->nroTolva','$oTolva->inspectorID','$oTolva->nombreInspector','$oTolva->pruebaPesaje','$oTolva->conforme','$oTolva->numReportePesaje','$oTolva->horaReportePesaje','$oTolva->obsInusual', NOW(),'$oTolva->pregunta6','$oTolva->pregunta7','$oTolva->pregunta8','$oTolva->pregunta9','$oTolva->pregunta10')";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update($oTolva){
		//Update data to table
		$query = "UPDATE crm_tolva SET 
		numActaInspeccion	= '$oTolva->numActaInspeccion',
		embarcacionID		= '$oTolva->embarcacionID',
		nombreEmbarcacion	= '$oTolva->nombreEmbarcacion',
		tmDescargado		= '$oTolva->tmDescargado',
		capacidadBodega		= '$oTolva->capacidadBodega',
		excesoBodega		= '$oTolva->excesoBodega',
		porcentajeExceso	= '$oTolva->porcentajeExceso',
		ro					= '$oTolva->ro',
		fechaInicial		= '$oTolva->fechaInicial',
		horaInicio			= '$oTolva->horaInicio',
		fechaFinal			= '$oTolva->fechaFinal',
		horaTermino			= '$oTolva->horaTermino',
		nroReportePesaje	= '$oTolva->nroReportePesaje',
		nroTolva			= '$oTolva->nroTolva',
		inspectorID			= '$oTolva->inspectorID',
		nombreInspector		= '$oTolva->nombreInspector',
		pruebaPesaje		= '$oTolva->pruebaPesaje',
		conforme			= '$oTolva->conforme',
		numReportePesaje	= '$oTolva->numReportePesaje',
		horaReportePesaje	= '$oTolva->horaReportePesaje',
		obsInusual			= '$oTolva->obsInusual',
		pregunta6    		= '$oTolva->pregunta6',
		pregunta7			= '$oTolva->pregunta7',
		pregunta8			= '$oTolva->pregunta8',
		pregunta9		    = '$oTolva->pregunta9',
		pregunta10    	    = '$oTolva->pregunta10'
		WHERE 
		chiID	=$oTolva->chiID";
		return parent::Execute($query);
	}

	public static function  Delete($tolvaID){
		$query = "DELETE FROM crm_tolva WHERE tolvaID='$tolvaID'";
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

