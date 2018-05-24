<?php
require_once("base/Database.php");

class CrmReporteOcurrencia extends Database
{

	public static function  getItem($reporteOcurrenciaID){
		$query = "SELECT * FROM crm_reporte_ocurrencia 
		WHERE
		reporteOcurrenciaID='$reporteOcurrenciaID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCHI($chiID,$correlativo){
		$query = "SELECT * FROM crm_reporte_ocurrencia 
		WHERE
		chiID='$chiID'
		AND correlativo='$correlativo'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList($chiID){
		$query = "SELECT * FROM crm_reporte_ocurrencia
		WHERE
		chiID='$chiID'
		ORDER BY numReporteOcurrencia";
		return parent::GetCollection(parent::GetResult($query));
	}


	public static function  getWebList(){
		$query = "SELECT * FROM crm_reporte_ocurrencia
		ORDER BY numReporteOcurrencia";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oReporteOcurrencia){
		//Search the max Id
		$query = "SELECT MAX(reporteOcurrenciaID) FROM crm_reporte_ocurrencia";
		$result = parent::GetResult($query);
		$oReporteOcurrencia->reporteOcurrenciaID = parent::fetchScalar($result)+1;

		//Insert data to table
		$query = "INSERT INTO crm_reporte_ocurrencia(reporteOcurrenciaID,chiID,correlativo,numReporteOcurrencia,actaDecomiso,tmDecomisado,subCodigoNumeroDecomiso,porcDecomisado,actaRetencionPago,infractor,inspectorID,nombreInspector)
		VALUES('$oReporteOcurrencia->reporteOcurrenciaID','$oReporteOcurrencia->chiID','$oReporteOcurrencia->correlativo','$oReporteOcurrencia->numReporteOcurrencia','$oReporteOcurrencia->actaDecomiso','$oReporteOcurrencia->tmDecomisado','$oReporteOcurrencia->subCodigoNumeroDecomiso','$oReporteOcurrencia->porcDecomisado','$oReporteOcurrencia->actaRetencionPago','$oReporteOcurrencia->infractor','$oReporteOcurrencia->inspectorID','$oReporteOcurrencia->nombreInspector')";
		return parent::Execute($query);
		//echo $query;
	}
	
	public static function  Update($oReporteOcurrencia){
		//Update data to table
		$query = "UPDATE crm_reporte_ocurrencia SET 
		numReporteOcurrencia			= '$oReporteOcurrencia->numReporteOcurrencia',
		actaDecomiso					= '$oReporteOcurrencia->actaDecomiso',
		tmDecomisado					= '$oReporteOcurrencia->tmDecomisado',
		subCodigoNumeroDecomiso			= '$oReporteOcurrencia->subCodigoNumeroDecomiso',
		porcDecomisado					= '$oReporteOcurrencia->porcDecomisado',
		actaRetencionPago				= '$oReporteOcurrencia->actaRetencionPago',
		infractor						= '$oReporteOcurrencia->infractor',
		inspectorID						= '$oReporteOcurrencia->inspectorID',
		nombreInspector					= '$oReporteOcurrencia->nombreInspector'
		WHERE 
		chiID	=$oReporteOcurrencia->chiID
		AND correlativo = $oReporteOcurrencia->correlativo";
		return parent::Execute($query);
	}


	public static function  Delete($reporteOcurrenciaID){
		$query = "DELETE FROM crm_reporte_ocurrencia WHERE reporteOcurrenciaID='$reporteOcurrenciaID'";
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






































