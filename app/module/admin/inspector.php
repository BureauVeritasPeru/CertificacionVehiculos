<?php
$oItem = new eCrmInspector();

$oItem->inspectorID             =$kID;
$oItem->codigoInspector         =OWASP::RequestString('codigoInspector');
$oItem->apellidoPaterno         =OWASP::RequestString('apellidoPaterno');
$oItem->apellidoMaterno         =OWASP::RequestString('apellidoMaterno');
$oItem->nombreInspector         =OWASP::RequestString('nombreInspector');
$oItem->nroDocumento            =OWASP::RequestString('nroDocumento');
$oItem->nombreCompletoInspector =OWASP::RequestString('nombreCompletoInspector');
$oItem->fechaRegistro           =OWASP::RequestString('fechaRegistro');
$oItem->fechaActualizado        =OWASP::RequestString('fechaActualizado');
$oItem->state                   =OWASP::RequestString('state');

$MODULE->processFormAction(new CrmInspector(), $oItem);

if($MODULE->FormView=="edit"){
    $obj=CrmInspector::getItem($kID);
    if($obj!=null){
        if (empty($oItem->codigoInspector)) 	        $oItem->codigoInspector         =$obj->codigoInspector;
        if (empty($oItem->apellidoPaterno)) 	        $oItem->apellidoPaterno         =$obj->apellidoPaterno;
        if (empty($oItem->apellidoMaterno)) 	        $oItem->apellidoMaterno         =$obj->apellidoMaterno;
        if (empty($oItem->nombreInspector)) 	        $oItem->nombreInspector         =$obj->nombreInspector;
        if (empty($oItem->nroDocumento))                $oItem->nroDocumento            =$obj->nroDocumento;
        if (empty($oItem->nombreCompletoInspector))     $oItem->nombreCompletoInspector =$obj->nombreCompletoInspector;
        if (empty($oItem->fechaRegistro))               $oItem->fechaRegistro           =$obj->fechaRegistro;
        if (empty($oItem->fechaActualizado))            $oItem->fechaActualizado        =$obj->fechaActualizado;
        if (empty($oItem->state))                       $oItem->state                   =$obj->state;
    }
    else
        $MODULE->addError(CrmInspector::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->nombreCompletoInspector;
}

$MODULE->FormTitle="Inspector";
?>
