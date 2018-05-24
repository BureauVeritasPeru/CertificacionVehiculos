<?php
require_once("base/Database.php");

class CrmFacturacion extends Database
{

	public static function  getItem($facturacionID){
		$query = "	SELECT *
		FROM crm_facturacion
		WHERE facturacionID='$facturacionID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = " 	SELECT *
		FROM crm_facturacion
		ORDER BY facturacionID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query = "	SELECT *
		FROM crm_facturacion";
		if(self::$orderBy=="") self::$orderBy="facturacionID";

			return parent::GetCollection(parent::GetResultPaging($query));
		}

		public static function  getFacturasGral($fechaIni,$fechaFin,$tallerID){
			$query = "
			SELECT f.facturacionID, f.fechaRegistro, f.fechaInicio, f.fechaFin, t.tallerID, t.razonSocial
			FROM crm_facturacion f INNER JOIN crm_taller t
			ON f.tallerID = t.tallerID
			WHERE (f.fechaRegistro BETWEEN '".$fechaIni."' AND '".$fechaFin."')";

			if($tallerID!='0'){$query.= " AND f.tallerID = '".$tallerID."'";}
			$query .= "ORDER BY 2 DESC";
			return parent::GetCollection(parent::GetResult($query));
		//echo $query;
		}

		public static function  AddNew($oFacturacion){
        //Search the max Id
			$query = " 	SELECT MAX(facturacionID) FROM crm_facturacion";
			$result = parent::GetResult($query);
			$oFacturacion->facturacionID = parent::fetchScalar($result)+1;
        //$oFacturacion->varName    = $oFacturacion->oFacturacion;
        //Insert data to table
			$query = " 	INSERT INTO crm_facturacion(facturacionID, fechaRegistro, fechaInicio, fechaFin, tallerID)
			VALUES('$oFacturacion->facturacionID','$oFacturacion->fechaRegistro','$oFacturacion->fechaInicio','$oFacturacion->fechaFin','$oFacturacion->tallerID')";
			return parent::Execute($query);
		}
		public static function UpdateCosto($Codigo,$costoTotal){
    	//Update data to table
			$query = "UPDATE crm_facturacion  SET 
			costoTotal	= '$costoTotal'
			WHERE 
			facturacionID=$Codigo";
			return parent::Execute($query);
		//echo $query;

		}
		public static function  Delete($oFacturacion){
			$query = " 	DELETE FROM crm_facturacion 
			WHERE facturacionID ='$oFacturacion->facturacionID'";
			parent::Execute($query);
		}
	}
	?>