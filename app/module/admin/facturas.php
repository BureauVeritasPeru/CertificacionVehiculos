<?php
$oItem = new eCrmFacturacion();

$fechaIni	=OWASP::RequestString('fechaIni');
$fechaFin	=OWASP::RequestString('fechaFin');
$tallerID   =OWASP::RequestInt('tallerID');

$MODULE->processFormAction(new CrmFacturacion(), $oItem);

if($MODULE->FormView=="edit"){
    $obj=CrmFacturacion::getItem($kID);
    if($obj!=null){
        if (empty($oItem->facturacionID)) 	        $oItem->facturacionID         =$obj->facturacionID;
        if (empty($oItem->fechaRegistro)) 	        $oItem->fechaRegistro         =$obj->fechaRegistro;
    }
    else
        $MODULE->addError(CrmFacturacion::GetErrorMsg());

}

$MODULE->FormTitle="Facturas";
?>
