<?php
require_once("base/Database.php");

class GnvCertificadoLog extends Database
{

	public static function  getItem($ID){
		$query = "	SELECT *
					FROM gnv_certificado_log
					WHERE ID='$ID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = " 	SELECT *
					FROM gnv_certificado_log
				   	ORDER BY ID";
		return parent::GetCollection(parent::GetResult($query));
	}

    public static function  AddNew($oGnvCertLog){
        //Search the max Id
        $query = " 	SELECT MAX(ID) FROM gnv_certificado_log";
        $result = parent::GetResult($query);
        $oGnvCertLog->ID = parent::fetchScalar($result)+1;
        $oGnvCertLog->varName    = $oGnvCertLog->ID;
        //Insert data to table
        $query = " 	INSERT INTO gnv_certificado_log(ID, certificadoID, placa, fechaCambio, oldFormato, newFormato, usuarioID, motivo)
                	VALUES('$oGnvCertLog->ID','$oGnvCertLog->certificadoID','$oGnvCertLog->placa', '$oGnvCertLog->fechaCambio', '$oGnvCertLog->oldFormato', '$oGnvCertLog->newFormato', '$oGnvCertLog->usuarioID', '$oGnvCertLog->motivo')";
        return parent::Execute($query);
    }
}
?>