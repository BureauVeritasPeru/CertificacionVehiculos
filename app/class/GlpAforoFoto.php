<?php
require_once("base/Database.php");

class GlpAforoFoto extends Database
{

	public static function  getList(){
		$query = " 	SELECT *
   FROM glp_aforo_foto";
   return parent::GetCollection(parent::GetResult($query));
 }

 public static function  getListByCertificado($certificadoID, $orderBy=NULL){
  $query = "  SELECT *
  FROM glp_aforo_foto
  WHERE certificadoID ='$certificadoID'
  ORDER BY
  ".(($orderBy!=NULL)? $orderBy: "fotoID")."";
  return parent::GetCollection(parent::GetResult($query));
}

public static function  AddNew($oGlpAforoFoto){
        //Insert data to table
  $query = " 	INSERT INTO glp_aforo_foto(certificadoID, fotoID)
  VALUES('$oGlpAforoFoto->certificadoID','$oGlpAforoFoto->fotoID')";
  return parent::Execute($query);
  //echo $query;
}

public static function  DeletexCert($certificadoID){
  $query = "  DELETE FROM glp_aforo_foto 
  WHERE certificadoID ='$certificadoID'";
  return parent::Execute($query);
}
}
?>