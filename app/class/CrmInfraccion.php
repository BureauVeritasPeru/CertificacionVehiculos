<?php
require_once("base/Database.php");

class CrmInfraccion extends Database
{

	public static function  getItem($infraccionID){
		$query = "SELECT * FROM crm_infraccion 
		WHERE
		infraccionID='$infraccionID'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCorre($chiID,$correlativo){
		$query = "SELECT * FROM crm_infraccion dc INNER JOIN crm_reporte_ocurrencia c ON  (dc.reporteOcurrenciaID = c.reporteOcurrenciaID)
		WHERE
		c.chiID='$chiID'
		AND dc.correlativo = '$correlativo'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getItemCHI($reporteOcurrenciaID,$correlativo){
		$query = "SELECT * FROM crm_infraccion 
		WHERE
		reporteOcurrenciaID='$reporteOcurrenciaID'
		AND correlativo='$correlativo'";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = "SELECT * FROM crm_infraccion
		ORDER BY codigoInfraccion";
		return parent::GetCollection(parent::GetResult($query));
	}


	public static function  getWebList(){
		$query = "SELECT * FROM crm_infraccion
		ORDER BY codigoInfraccion";
		return parent::GetCollection(parent::GetResult($query));
	}
	
	public static function  AddNew($oInfraccion){
		//Search the max Id
		$query = "SELECT MAX(infraccionID) FROM crm_infraccion";
		$result = parent::GetResult($query);
		$oInfraccion->infraccionID = parent::fetchScalar($result)+1;

		//Insert data to table
		$query = "INSERT INTO crm_infraccion(infraccionID,reporteOcurrenciaID,correlativo,codigoInfraccion,detalleInfraccion)
		VALUES('$oInfraccion->infraccionID','$oInfraccion->reporteOcurrenciaID','$oInfraccion->correlativo','$oInfraccion->codigoInfraccion','$oInfraccion->detalleInfraccion')";
		return parent::Execute($query);
		//echo $query;
	}

	public static function  Update($oInfraccion){
		//Update data to table
		$query = "UPDATE crm_infraccion as cd INNER JOIN crm_reporte_ocurrencia as c ON cd.reporteOcurrenciaID = c.reporteOcurrenciaID SET 
		codigoInfraccion				= '$oInfraccion->codigoInfraccion',
		detalleInfraccion				= '$oInfraccion->detalleInfraccion'
		WHERE 
		c.chiID	=$oInfraccion->chiID
		AND
		cd.correlativo = $oInfraccion->correlativo";
		return parent::Execute($query);
		//echo $query;

	}

	public static function  Delete($infraccionID){
		$query = "DELETE FROM crm_infraccion WHERE infraccionID='$infraccionID'";
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


		
		



	






























