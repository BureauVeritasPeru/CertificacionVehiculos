<?php
$oItem = new eCrmFormNotify();

$oItem->userID      =$kID;
$oItem->formID      =OWASP::RequestInt('formID');
$oItem->contactID   =OWASP::RequestInt('contactID');
$oItem->recipients  =OWASP::RequestString('recipients');
$oItem->active      =OWASP::RequestBoolean('active');
$oItem->recipients  =isset($oItem->recipients)? preg_replace(array("/;/", "/\n\r/", "/\r\n/", "/\t/"), ",", $oItem->recipients ) : NULL;

$MODULE->processFormAction(new CrmFormNotify(), $oItem);

$userAdmin	=AdmLogin::getUserSession();
$DAO=$MODULE->StaticDAO;
if($MODULE->FormView=="edit"){
    $obj=$DAO::getItem($oItem->formID, $kID, $oItem->contactID);
    if($obj!=null){
        if (empty($oItem->recipients)) $oItem->recipients  =$obj->recipients;
        if (empty($oItem->active))     $oItem->active      =$obj->active;

        $oItem->firstName   =$obj->firstName;
        $oItem->lastName    =$obj->lastName;
        $oItem->email       =$obj->email;
    }
    else
        $MODULE->addError($DAO::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->firstName." ".$oItem->lastName;
}

$MODULE->FormTitle="Notificaci&oacute;n";
?>
