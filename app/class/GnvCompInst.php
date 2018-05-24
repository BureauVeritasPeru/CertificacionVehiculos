<?php
require_once("base/Database.php");

class GnvCompInst extends Database
{

	public static function  getItem($compInsID){
		$query = "	SELECT *
					FROM gnv_comp_inst
					WHERE compInsID='$compInsID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = " 	SELECT *
					FROM gnv_comp_inst
				   	ORDER BY compInsID";
		return parent::GetCollection(parent::GetResult($query));
	}

    public static function  getListByCertificado($certificadoID, $orderBy=NULL){
        $query = "  SELECT *
                    FROM gnv_comp_inst
                    WHERE certificadoID ='$certificadoID'
                    ORDER BY
                    ".(($orderBy!=NULL)? $orderBy: "compInsID")."";
        return parent::GetCollection(parent::GetResult($query));
    }

    public static function  AddNew($oGnvComIns){
        //Search the max Id
        $query = " 	SELECT MAX(compInsID) FROM gnv_comp_inst";
        $result = parent::GetResult($query);
        $oGnvComIns->compInsID = parent::fetchScalar($result)+1;
        $oGnvComIns->varName    = $oGnvComIns->compInsID;
        //Insert data to table
        $query = " 	INSERT INTO gnv_comp_inst(compInsID, certificadoID, tipoCompID, marca, modelo, serie, capacidad, mes_fab, ano_fab)
                	VALUES('$oGnvComIns->compInsID','$oGnvComIns->certificadoID','$oGnvComIns->tipoCompID', '$oGnvComIns->marca', '$oGnvComIns->modelo', '$oGnvComIns->serie', '$oGnvComIns->capacidad', '$oGnvComIns->mes_fab', '$oGnvComIns->ano_fab')";
        return parent::Execute($query);
    }

    public static function  Delete($oGnvComIns){
        $query = " 	DELETE FROM gnv_comp_inst 
                	WHERE compInsID ='$oGnvComIns->compInsID'";
        return parent::Execute($query);
    }

    public static function  DeletexCert($certificadoID){
        $query = "  DELETE FROM gnv_comp_inst 
                    WHERE certificadoID ='$certificadoID'";
        return parent::Execute($query);
    }
}
?>