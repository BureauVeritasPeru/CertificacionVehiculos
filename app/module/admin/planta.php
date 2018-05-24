<?php
$oItem = new eCrmPlanta();

$oItem->plantaID        =$kID;
$oItem->codigoPlanta    =OWASP::RequestString('codigoPlanta');
$oItem->nombrePlanta    =OWASP::RequestString('nombrePlanta');
$oItem->puertoPlanta    =OWASP::RequestString('puertoPlanta');
$oItem->zonaPlanta      =OWASP::RequestString('zonaPlanta');
$oItem->regionPlanta    =OWASP::RequestString('regionPlanta');
$oItem->state           =OWASP::RequestString('state');

$MODULE->processFormAction(new CrmPlanta(), $oItem);

if($MODULE->FormView=="edit"){
    $obj=CrmPlanta::getItem($kID);
    if($obj!=null){
        if (empty($oItem->codigoPlanta)) 	$oItem->codigoPlanta    =$obj->codigoPlanta;
        if (empty($oItem->nombrePlanta)) 	$oItem->nombrePlanta    =$obj->nombrePlanta;
        if (empty($oItem->puertoPlanta)) 	$oItem->puertoPlanta    =$obj->puertoPlanta;
        if (empty($oItem->zonaPlanta)) 	    $oItem->zonaPlanta      =$obj->zonaPlanta;
        if (empty($oItem->regionPlanta))    $oItem->regionPlanta    =$obj->regionPlanta;
        if (empty($oItem->state))           $oItem->state           =$obj->state;
    }
    else
        $MODULE->addError(CrmPlanta::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->nombrePlanta;
}

$MODULE->FormTitle="Planta";
?>
