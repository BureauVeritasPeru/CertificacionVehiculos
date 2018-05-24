<?php
$oItem = new eCrmRestriccionPlaca();

$oItem->restriccionID           =$kID;
$oItem->placa                   =OWASP::RequestString('placa');
$oItem->observaciones           =OWASP::RequestString('observaciones');
$oItem->state                   =OWASP::RequestString('state');
$oItem->registerDate            =OWASP::RequestString('registerDate');

$MODULE->processFormAction(new CrmRestriccionPlaca(), $oItem);

if($MODULE->FormView=="edit"){
    $obj=CrmRestriccionPlaca::getItem($kID);
    if($obj!=null){
        if (empty($oItem->placa)) 	                    $oItem->placa         =$obj->placa;
        if (empty($oItem->observaciones)) 	            $oItem->observaciones =$obj->observaciones;
        if (empty($oItem->state)) 	                    $oItem->state         =$obj->state;
        if (empty($oItem->registerDate)) 	            $oItem->registerDate  =$obj->registerDate;
    }
    else
        $MODULE->addError(CrmRestriccionPlaca::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->placa;
}

$MODULE->FormTitle="Restriccion de Placa";
?>
