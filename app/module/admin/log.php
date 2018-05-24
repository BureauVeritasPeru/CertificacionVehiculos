<?php
$userAdmin  =AdmLogin::getUserSession();
$arrKey     =explode(',', OWASP::RequestString('kID'));
        
$oItem = new eAdmLog();
if(is_array($arrKey) && count($arrKey)>2){
	$oItem->logDate =$arrKey[0];
	$oItem->eventID =$arrKey[1];
	$oItem->userID  =$arrKey[2];
}

$MODULE->processFormAction(new AdmLog(), $oItem);

if($MODULE->FormView=="view"){
    $DAO=$MODULE->StaticDAO;
    $obj=$DAO::getItem($oItem->logDate, $oItem->eventID, $oItem->userID);
    if($obj!=null){
        $oItem->comment	=$obj->comment;
        $oItem->object	=$obj->object;
        $oItem->userName=$obj->userName;
        $oItem->eventName=$obj->eventName;
    }
    else
        $MODULE->addError($DAO::GetErrorMsg());
    
    $MODULE->ItemTitle=$oItem->logDate;
}

$MODULE->FormTitle="Fecha";
?>
