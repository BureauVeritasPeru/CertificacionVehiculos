<?php
require_once("base/Database.php");

class CrmFacturacionDet extends Database
{

	public static function  getItem($facturacionDetID){
		$query = "	SELECT *
					FROM crm_facturacion_det
					WHERE facturacionDetID='$facturacionDetID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = " 	SELECT *
					FROM crm_facturacion_det
				   	ORDER BY facturacionDetID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query = "	SELECT *
					FROM crm_facturacion_det";
		if(self::$orderBy=="") self::$orderBy="facturacionDetID";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

    public static function  getListByFactura($facturacionID, $orderBy=NULL){
        $query = "	SELECT *
            		FROM crm_facturacion_det
               		WHERE facturacionID ='$facturacionID'
            		ORDER BY
                	".(($orderBy!=NULL)? $orderBy: "facturacionID")."";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  AddNew($oFacturacionDet){
        //Search the max Id
        $query = " 	SELECT MAX(facturacionDetID) FROM crm_facturacion_det";
        $result = parent::GetResult($query);
        $oFacturacionDet->facturacionDetID = parent::fetchScalar($result)+1;
        //$oFacturacionDet->varName    = $oFacturacionDet->facturacionDetID;
        //Insert data to table
        $query = " 	INSERT INTO crm_facturacion_det(facturacionDetID, facturacionID, tipoServicio, tipoCertificadoID, certificadoID, fechaEmision, placa, vin, motor, estado, costo)
                	VALUES('$oFacturacionDet->facturacionDetID','$oFacturacionDet->facturacionID','$oFacturacionDet->tipoServicio','$oFacturacionDet->tipoCertificadoID','$oFacturacionDet->certificadoID','$oFacturacionDet->fechaEmision', '$oFacturacionDet->placa', '$oFacturacionDet->vin', '$oFacturacionDet->motor', '$oFacturacionDet->estado', '$oFacturacionDet->costo')";
        return parent::Execute($query);
        echo $query;
    }

    public static function  Delete($oFacturacionDet){
        $query = " 	DELETE FROM crm_facturacion_det 
                	WHERE facturacionDetID ='$oFacturacionDet->facturacionDetID'";
        parent::Execute($query);
    }
    
    public static function  DeleteByFactura($facturacionID){
        $query = " 	DELETE FROM crm_facturacion_det 
                	WHERE facturacionID ='$facturacionID'";
        parent::Execute($query);
    }
}
?>