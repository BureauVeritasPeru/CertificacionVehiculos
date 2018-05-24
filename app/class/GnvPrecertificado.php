<?php
require_once("base/Database.php");

class GnvPrecertificado extends Database
{

	public static function  getItem($precertID){
		$query = "	SELECT *
     FROM gnv_precertificado
     WHERE precertID='$precertID' ";
     return parent::GetObject(parent::GetResult($query));
 }

 public static function  getList(){
  $query = " 	SELECT *
  FROM gnv_precertificado
  ORDER BY precertID";
  return parent::GetCollection(parent::GetResult($query));
}

public static function  AddNew($oGnvPrecert){
        //Search the max Id
    $query = " 	SELECT MAX(precertID) FROM gnv_precertificado";
    $result = parent::GetResult($query);
    $oGnvPrecert->precertID = parent::fetchScalar($result)+1;
    $oGnvPrecert->varName    = $oGnvPrecert->precertID;
        //Insert data to table
    $query = " 	INSERT INTO gnv_precertificado(precertID, tipocertID, placa, marcaID, modeloID, categoriaID, combustibleID, colorID, version, ano_fab, serie, vin, motor, cilindros, cilindrada, ejes, ruedas, asientos, pasajeros, largo, ancho, alto, pesoNeto, pesoBruto, combustibleMod, pesoNetoMod,cargaUtil,cargaUtilMod, fechaCreacion, usuCreacion)
    VALUES('$oGnvPrecert->precertID','$oGnvPrecert->tipocertID','$oGnvPrecert->placa', '$oGnvPrecert->marcaID', '$oGnvPrecert->modeloID', '$oGnvPrecert->categoriaID', '$oGnvPrecert->combustibleID', '$oGnvPrecert->colorID', '$oGnvPrecert->version', '$oGnvPrecert->ano_fab', '$oGnvPrecert->serie', '$oGnvPrecert->vin', '$oGnvPrecert->motor', '$oGnvPrecert->cilindros', '$oGnvPrecert->cilindrada', '$oGnvPrecert->ejes', '$oGnvPrecert->ruedas', '$oGnvPrecert->asientos', '$oGnvPrecert->pasajeros', '$oGnvPrecert->largo', '$oGnvPrecert->ancho', '$oGnvPrecert->alto', '$oGnvPrecert->pesoNeto', '$oGnvPrecert->pesoBruto', '$oGnvPrecert->combustibleMod', '$oGnvPrecert->pesoNetoMod','$oGnvPrecert->cargaUtil', '$oGnvPrecert->cargaUtilMod', '$oGnvPrecert->fechaCreacion', '$oGnvPrecert->usuCreacion')";
    return parent::Execute($query);
}

public static function  Update($oGnvPrecert){
        //Update data to table
    $query = " 	UPDATE gnv_precertificado SET 
    tipocertID	='$oGnvPrecert->tipocertID',
    modeloID ='$oGnvPrecert->modeloID',
    categoriaID ='$oGnvPrecert->categoriaID',
    combustibleID ='$oGnvPrecert->combustibleID',
    colorID ='$oGnvPrecert->colorID',
    version ='$oGnvPrecert->version',
    ano_fab ='$oGnvPrecert->ano_fab',
    serie ='$oGnvPrecert->serie',
    vin ='$oGnvPrecert->vin',
    motor ='$oGnvPrecert->motor',
    cilindros ='$oGnvPrecert->cilindros',
    cilindrada ='$oGnvPrecert->cilindrada',
    ejes ='$oGnvPrecert->ejes',
    ruedas ='$oGnvPrecert->ruedas',
    asientos ='$oGnvPrecert->asientos',
    pasajeros ='$oGnvPrecert->pasajeros',
    largo ='$oGnvPrecert->largo',
    ancho ='$oGnvPrecert->ancho',
    alto ='$oGnvPrecert->alto',
    pesoNeto ='$oGnvPrecert->pesoNeto',
    pesoBruto ='$oGnvPrecert->pesoBruto',
    combustibleMod ='$oGnvPrecert->combustibleMod',
    pesoNetoMod ='$oGnvPrecert->pesoNetoMod',
    cargaUtil = '$oGnvPrecert->cargaUtil',
    cargaUtilMod = '$oGnvPrecert->cargaUtilMod'
    WHERE precertID   =$oGnvPrecert->precertID";
    return parent::Execute($query);
        //echo $query;
}
public static function  Update3($oGnvPrecert){
        //Update data to table
    $query = "  UPDATE gnv_precertificado SET 
    pesoNetoMod ='$oGnvPrecert->pesoNetoMod',                            
    cargaUtilMod ='$oGnvPrecert->cargaUtilMod'
    WHERE precertID   =$oGnvPrecert->precertID";
    return parent::Execute($query);
        //echo $query;
}

public static function  Delete($oGnvPrecert){
    $query = " 	DELETE FROM gnv_precertificado 
    WHERE precertID ='$oGnvPrecert->precertID'";
    return parent::Execute($query);
}
}
?>