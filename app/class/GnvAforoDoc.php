<?php
require_once("base/Database.php");

class GnvAforoDoc extends Database
{

	public static function  getList(){
		$query = " 	SELECT *
     FROM gnv_aforo_doc";
     return parent::GetCollection(parent::GetResult($query));
 }

 public static function  getListByCertificado($certificadoID, $orderBy=NULL){
    $query = "  SELECT *
    FROM gnv_aforo_doc
    WHERE certificadoID ='$certificadoID'
    ORDER BY
    ".(($orderBy!=NULL)? $orderBy: "documentoID")."";
    return parent::GetCollection(parent::GetResult($query));
}

public static function  AddNew($oGnvAforoDoc){
        //Insert data to table
    $query = " 	INSERT INTO gnv_aforo_doc(certificadoID, documentoID)
    VALUES('$oGnvAforoDoc->certificadoID','$oGnvAforoDoc->documentoID')";
    return parent::Execute($query);
    //echo $query;
}

public static function  DeletexCert($certificadoID){
    $query = "  DELETE FROM gnv_aforo_doc 
    WHERE certificadoID ='$certificadoID'";
    return parent::Execute($query);
}
}
?>