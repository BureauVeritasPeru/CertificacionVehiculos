<?php
require_once("base/Database.php");

class CrmPrecioTaller extends Database
{

	public static function  getItem($precioID){
		$query = "	SELECT *
					FROM crm_precio_taller
					WHERE precioID='$precioID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = " 	SELECT *
					FROM crm_precio_taller
				   	ORDER BY precioID";
		return parent::GetCollection(parent::GetResult($query));
	}

	public static function  getList_Paging(){
		$query = "	SELECT *
					FROM crm_precio_taller";
		if(self::$orderBy=="") self::$orderBy="precioID";

		return parent::GetCollection(parent::GetResultPaging($query));
	}

    public static function  getListByTaller($tallerID, $orderBy=NULL){
        $query = "	SELECT *
            		FROM crm_precio_taller
               		WHERE tallerID ='$tallerID'
            		ORDER BY
                	".(($orderBy!=NULL)? $orderBy: "precioID")."";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  getWebListByTaller($tallerID){
        $query = "  SELECT precioID,tipoServicio
                    FROM crm_precio_taller
                    WHERE tallerID ='$tallerID'
                    ORDER BY tipoServicio";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  AddNew($oPrecioTaller){
        //Search the max Id
        $query = " 	SELECT MAX(precioID) FROM crm_precio_taller";
        $result = parent::GetResult($query);
        $oPrecioTaller->precioID = parent::fetchScalar($result)+1;
        //$oPrecioTaller->varName    = $oPrecioTaller->precioID;
        //Insert data to table
        $query = " 	INSERT INTO crm_precio_taller(precioID, tallerID, tipoServicio, tipoCertificado, costo,fechaRegistro)
                	VALUES('$oPrecioTaller->precioID','$oPrecioTaller->tallerID','$oPrecioTaller->tipoServicio', '$oPrecioTaller->tipoCertificado', '$oPrecioTaller->costo',NOW())";
        return parent::Execute($query);
    }

    public static function  Update($oPrecioTaller){
        //Update data to table
        $query = " 	UPDATE crm_precio_taller SET 
                            tipoServicio	='$oPrecioTaller->tipoServicio',
                            tipoCertificado   ='$oPrecioTaller->tipoCertificado',
                            costo    ='$oPrecioTaller->costo'
                	WHERE precioID   =$oPrecioTaller->precioID";
        return parent::Execute($query);
                    //echo $query;
    }

    public static function  Delete($oPrecioTaller){
        $query = " 	DELETE FROM crm_precio_taller 
                	WHERE precioID ='$oPrecioTaller->precioID'";
        parent::Execute($query);
    }
    
    public static function  DeleteByTaller($tallerID){
        $query = " 	DELETE FROM crm_precio_taller 
                	WHERE tallerID ='$tallerID'";
        parent::Execute($query);
    }
}
?>