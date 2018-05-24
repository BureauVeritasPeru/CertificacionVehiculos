<?php
require_once("base/Database.php");

class GlpCompInst extends Database
{

	public static function  getItem($compInsID){
		$query = "	SELECT *
   FROM glp_comp_inst
   WHERE compInsID='$compInsID' ";
   return parent::GetObject(parent::GetResult($query));
 }

 public static function  getList(){
  $query = " 	SELECT *
  FROM glp_comp_inst
  ORDER BY compInsID";
  return parent::GetCollection(parent::GetResult($query));
}

public static function  getListByCertificado($certificadoID, $orderBy=NULL){
  $query = "  SELECT *
  FROM glp_comp_inst
  WHERE certificadoID ='$certificadoID'
  ORDER BY
  ".(($orderBy!=NULL)? $orderBy: "compInsID")."";
  return parent::GetCollection(parent::GetResult($query));
}

public static function  AddNew($oGlpComIns){
        //Search the max Id
  $query = " 	SELECT MAX(compInsID) FROM glp_comp_inst";
  $result = parent::GetResult($query);
  $oGlpComIns->compInsID = parent::fetchScalar($result)+1;
  $oGlpComIns->varName    = $oGlpComIns->compInsID;
        //Insert data to table
  $query = " 	INSERT INTO glp_comp_inst(compInsID, certificadoID, tipoCompID, marca, modelo, serie, capacidad, mes_fab, ano_fab)
  VALUES('$oGlpComIns->compInsID','$oGlpComIns->certificadoID','$oGlpComIns->tipoCompID', '$oGlpComIns->marca', '$oGlpComIns->modelo', '$oGlpComIns->serie', '$oGlpComIns->capacidad', '$oGlpComIns->mes_fab', '$oGlpComIns->ano_fab')";
  return parent::Execute($query);
  //echo $query;
}

public static function  Delete($oGlpComIns){
  $query = " 	DELETE FROM glp_comp_inst 
  WHERE compInsID ='$oGlpComIns->compInsID'";
  return parent::Execute($query);
}

public static function  DeletexCert($certificadoID){
  $query = "  DELETE FROM glp_comp_inst 
  WHERE certificadoID ='$certificadoID'";
  return parent::Execute($query);
}
}
?>