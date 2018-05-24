<?php
$oItem = new eCrmCliente();

$oItem->clienteID   =$kID;
$oItem->name        =OWASP::RequestString('name');
$oItem->lastname    =OWASP::RequestString('lastname');
$oItem->tipoDoc     =OWASP::RequestString('tipoDoc');
$oItem->numDoc      =OWASP::RequestString('numDoc');
$oItem->fecNac      =OWASP::RequestString('fecNac');
$oItem->sexo        =OWASP::RequestString('sexo');
$oItem->departamento=OWASP::RequestString('departamento');
$oItem->provincia   =OWASP::RequestString('provincia');
$oItem->distrito    =OWASP::RequestString('distrito');
$oItem->address     =OWASP::RequestString('address');
$oItem->phone       =OWASP::RequestString('phone');
$oItem->celular     =OWASP::RequestString('celular');
$oItem->state       =OWASP::RequestString('state');

$MODULE->processFormAction(new CrmCliente(), $oItem);

if($MODULE->FormView=="edit"){
    $obj=CrmCliente::getItem($kID);
    if($obj!=null){
        if (empty($oItem->name)) 	   $oItem->name       =$obj->name;
        if (empty($oItem->lastname))   $oItem->lastname   =$obj->lastname;
        if (empty($oItem->tipoDoc))    $oItem->tipoDoc    =$obj->tipoDoc;
        if (empty($oItem->numDoc))     $oItem->numDoc     =$obj->numDoc;
        if (empty($oItem->fecNac))     $oItem->fecNac     =$obj->fecNac;
        if (empty($oItem->sexo))       $oItem->sexo       =$obj->sexo;
        if (empty($oItem->departamento))     $oItem->departamento     =$obj->departamento;
        if (empty($oItem->provincia))  $oItem->provincia     =$obj->provincia;
        if (empty($oItem->distrito))   $oItem->distrito     =$obj->distrito;
        if (empty($oItem->address))    $oItem->address    =$obj->address;
        if (empty($oItem->phone))      $oItem->phone      =$obj->phone;
        if (empty($oItem->celular))    $oItem->celular    =$obj->celular;
        if (empty($oItem->state))      $oItem->state      =$obj->state;
    }
    else
        $MODULE->addError(CrmCliente::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->name .' '. $oItem->lastname;
}

$MODULE->FormTitle="Cliente";
?>
