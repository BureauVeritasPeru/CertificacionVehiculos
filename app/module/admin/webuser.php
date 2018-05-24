<?php
$oItem = new eCrmUser();

$oItem->userID          =$kID;
$oItem->firstName       =OWASP::RequestString('firstName');
$oItem->lastName        =OWASP::RequestString('lastName');
$oItem->userName        =OWASP::RequestString('userName');
$oItem->password        =OWASP::RequestString('password');
$oItem->email           =OWASP::RequestString('email');
$oItem->state           =OWASP::RequestString('state');
$oItem->glp             =OWASP::RequestBoolean('glp');
$oItem->gnv             =OWASP::RequestBoolean('gnv');
$oItem->consulta_glp    =OWASP::RequestBoolean('consulta_glp');
$oItem->consulta_gnv    =OWASP::RequestBoolean('consulta_gnv');
$oItem->reportes        =OWASP::RequestBoolean('reportes');


$MODULE->processFormAction(new CrmUser(), $oItem);

if($MODULE->FormView=="edit"){
    $obj=CrmUser::getItem($kID);
    if($obj!=null){
        if (empty($oItem->firstName)) 	$oItem->firstName       =$obj->firstName;
        if (empty($oItem->lastName)) 	$oItem->lastName        =$obj->lastName;
        if (empty($oItem->userName)) 	$oItem->userName        =$obj->userName;
        if (empty($oItem->password)) 	$oItem->password        =$obj->password;
        if (empty($oItem->email))       $oItem->email           =$obj->email;
        if (empty($oItem->state))       $oItem->state           =$obj->state;
        if(empty($oItem->glp))          $oItem->glp             =$obj->glp;
        if(empty($oItem->gnv))          $oItem->gnv             =$obj->gnv;
        if(empty($oItem->consulta_glp)) $oItem->consulta_glp    =$obj->consulta_glp;
        if(empty($oItem->consulta_gnv)) $oItem->consulta_gnv    =$obj->consulta_gnv;
        if(empty($oItem->reportes))     $oItem->reportes        =$obj->reportes;
    }
    else
        $MODULE->addError(CrmUser::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->firstName." ".$oItem->lastName;
}

$MODULE->FormTitle="Usuario";
?>


