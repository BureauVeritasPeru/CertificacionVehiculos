<?php
require_once("base/Database.php");

class GlpAforoDoc extends Database
{

	public static function  getList(){
		$query = " 	SELECT *
       FROM glp_aforo_doc";
       return parent::GetCollection(parent::GetResult($query));
   }

   public static function  getListByCertificado($certificadoID, $orderBy=NULL){
    $query = "  SELECT *
    FROM glp_aforo_doc
    WHERE certificadoID ='$certificadoID'
    ORDER BY
    ".(($orderBy!=NULL)? $orderBy: "documentoID")."";
    return parent::GetCollection(parent::GetResult($query));
}

public static function  AddNew($oGlpAforoDoc){
        //Insert data to table
    $query = " 	INSERT INTO glp_aforo_doc(certificadoID, documentoID)
    VALUES('$oGlpAforoDoc->certificadoID','$oGlpAforoDoc->documentoID')";
    return parent::Execute($query);
}

public static function  DeletexCert($certificadoID){
    $query = "  DELETE FROM glp_aforo_doc 
    WHERE certificadoID ='$certificadoID'";
    return parent::Execute($query);
}
}
?>