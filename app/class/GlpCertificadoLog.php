<?php
require_once("base/Database.php");

class GlpCertificadoLog extends Database
{

	public static function  getItem($ID){
		$query = "	SELECT *
					FROM glp_certificado_log
					WHERE ID='$ID' ";
		return parent::GetObject(parent::GetResult($query));
	}

	public static function  getList(){
		$query = " 	SELECT *
					FROM glp_certificado_log
				   	ORDER BY ID";
		return parent::GetCollection(parent::GetResult($query));
	}

    public static function  AddNew($oGlpCertLog){
        //Search the max Id
        $query = " 	SELECT MAX(ID) FROM glp_certificado_log";
        $result = parent::GetResult($query);
        $oGlpCertLog->ID = parent::fetchScalar($result)+1;
        $oGlpCertLog->varName    = $oGlpCertLog->ID;
        //Insert data to table
        $query = " 	INSERT INTO glp_certificado_log(ID, certificadoID, placa, fechaCambio, oldFormato, newFormato, usuarioID, motivo)
                	VALUES('$oGlpCertLog->ID','$oGlpCertLog->certificadoID','$oGlpCertLog->placa', '$oGlpCertLog->fechaCambio', '$oGlpCertLog->oldFormato', '$oGlpCertLog->newFormato', '$oGlpCertLog->usuarioID', '$oGlpCertLog->motivo')";
        return parent::Execute($query);
    }
}
?>