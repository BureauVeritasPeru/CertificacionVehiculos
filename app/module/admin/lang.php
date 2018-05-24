<?php
$oItem = new eCmsLang();

$oItem->langID      =$kID;
$oItem->langCode    =OWASP::RequestString('langCode');
$oItem->langName    =OWASP::RequestString('langName');
$oItem->alias       =OWASP::RequestString('alias');
$oItem->isDefault   =OWASP::RequestBoolean('isDefault');
$oItem->active      =OWASP::RequestBoolean('active');

$MODULE->processFormAction(new CmsLang(), $oItem);

$DAO=$MODULE->StaticDAO;
if($MODULE->FormView=="edit"){
    $obj=$DAO::getItem($kID);
    if($obj!=null){
        if (empty($oItem->langCode)) 	$oItem->langCode=$obj->langCode;
        if (empty($oItem->langName)) 	$oItem->langName=$obj->langName;
        if (empty($oItem->alias)) 	    $oItem->alias=$obj->alias;
        if (empty($oItem->isDefault)) 	$oItem->isDefault=$obj->isDefault;
        if (empty($oItem->active)) 	    $oItem->active=$obj->active;

        if($oItem->isDefault) $MODULE->addAlert("Este &iacute;tem est&aacute; predefinido, no puede ser modificado o eliminado.");
    }
    else
        $MODULE->addError($DAO::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->langName;
}

$MODULE->FormTitle="Idioma";
?>
