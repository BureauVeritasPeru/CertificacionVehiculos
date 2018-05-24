<?php
$userAdmin	=AdmLogin::getUserSession();

$oItem = new eAdmProfile();
$oItem->profileID   =$kID;
$oItem->profileName =OWASP::RequestString('profileName');
$oItem->isDefault   =OWASP::RequestBoolean('isDefault');
$oItem->events      =OWASP::RequestArray('events');

$MODULE->processFormAction(new AdmProfile(), $oItem);

if($MODULE->FormView=="edit"){
	$DAO=$MODULE->StaticDAO;
	$obj=$DAO::getItem($kID);
	if($obj!=null){
		if (empty($oItem->profileID)) 		$oItem->profileID	=$obj->profileID;
		if (empty($oItem->profileName)) 	$oItem->profileName	=$obj->profileName;
	}
	else
		$MODULE->addError($DAO::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->profileName;
}

$MODULE->FormTitle="Perfil";
?>
