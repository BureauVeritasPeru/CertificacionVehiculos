<?php
require_once("base/Database.php");

class GlpPrecertificado extends Database
{

	public static function  getItem($precertID){
		$query = "	SELECT *
   FROM glp_precertificado
   WHERE precertID='$precertID' ";
   return parent::GetObject(parent::GetResult($query));
 }

 public static function  getList(){
  $query = " 	SELECT *
  FROM glp_precertificado
  ORDER BY precertID";
  return parent::GetCollection(parent::GetResult($query));
}

public static function  AddNew($oGlpPrecert){
        //Search the max Id
  $query = " 	SELECT MAX(precertID) FROM glp_precertificado";
  $result = parent::GetResult($query);
  $oGlpPrecert->precertID = parent::fetchScalar($result)+1;
  $oGlpPrecert->varName    = $oGlpPrecert->precertID;
        //Insert data to table
  $query = " 	INSERT INTO glp_precertificado(precertID, tipocertID, placa, marcaID, modeloID, categoriaID, combustibleID, version, ano_fab, serie, vin, motor, cilindros, cilindrada, ejes, ruedas, asientos, pasajeros, largo, ancho, alto, pesoNeto, pesoBruto, cargaUtil, combustibleMod, pesoNetoMod, cargaUtilMod, fechaCreacion, usuCreacion)
  VALUES('$oGlpPrecert->precertID','$oGlpPrecert->tipocertID','$oGlpPrecert->placa', '$oGlpPrecert->marcaID', '$oGlpPrecert->modeloID', '$oGlpPrecert->categoriaID', '$oGlpPrecert->combustibleID', '$oGlpPrecert->version', '$oGlpPrecert->ano_fab', '$oGlpPrecert->serie', '$oGlpPrecert->vin', '$oGlpPrecert->motor', '$oGlpPrecert->cilindros', '$oGlpPrecert->cilindrada', '$oGlpPrecert->ejes', '$oGlpPrecert->ruedas', '$oGlpPrecert->asientos', '$oGlpPrecert->pasajeros', '$oGlpPrecert->largo', '$oGlpPrecert->ancho', '$oGlpPrecert->alto', '$oGlpPrecert->pesoNeto', '$oGlpPrecert->pesoBruto', '$oGlpPrecert->cargaUtil', '$oGlpPrecert->combustibleMod', '$oGlpPrecert->pesoNetoMod', '$oGlpPrecert->cargaUtilMod', '$oGlpPrecert->fechaCreacion', '$oGlpPrecert->usuCreacion')";
  return parent::Execute($query);
}

public static function  Update($oGlpPrecert){
        //Update data to table
  $query = " 	UPDATE glp_precertificado SET 
  tipocertID	='$oGlpPrecert->tipocertID',
  modeloID ='$oGlpPrecert->modeloID',
  categoriaID ='$oGlpPrecert->categoriaID',
  combustibleID ='$oGlpPrecert->combustibleID',
  version ='$oGlpPrecert->version',
  ano_fab ='$oGlpPrecert->ano_fab',
  serie ='$oGlpPrecert->serie',
  vin ='$oGlpPrecert->vin',
  motor ='$oGlpPrecert->motor',
  cilindros ='$oGlpPrecert->cilindros',
  cilindrada ='$oGlpPrecert->cilindrada',
  ejes ='$oGlpPrecert->ejes',
  ruedas ='$oGlpPrecert->ruedas',
  asientos ='$oGlpPrecert->asientos',
  pasajeros ='$oGlpPrecert->pasajeros',
  largo ='$oGlpPrecert->largo',
  ancho ='$oGlpPrecert->ancho',
  alto ='$oGlpPrecert->alto',
  pesoNeto ='$oGlpPrecert->pesoNeto',
  pesoBruto ='$oGlpPrecert->pesoBruto',
  cargaUtil ='$oGlpPrecert->cargaUtil',
  combustibleMod ='$oGlpPrecert->combustibleMod',
  pesoNetoMod ='$oGlpPrecert->pesoNetoMod',                            
  cargaUtilMod ='$oGlpPrecert->cargaUtilMod'
  WHERE precertID   =$oGlpPrecert->precertID";
  return parent::Execute($query);
        //echo $query;
}


public static function  Update3($oGlpPrecert){
        //Update data to table
  $query = "  UPDATE glp_precertificado SET 
  pesoNetoMod ='$oGlpPrecert->pesoNetoMod',                            
  cargaUtilMod ='$oGlpPrecert->cargaUtilMod'
  WHERE precertID   =$oGlpPrecert->precertID";
  return parent::Execute($query);
        //echo $query;
}

public static function  Delete($oGlpPrecert){
  $query = " 	DELETE FROM glp_precertificado 
  WHERE precertID ='$oGlpPrecert->precertID'";
  return parent::Execute($query);
}
}
?>