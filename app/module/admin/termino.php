<?php
$oItem = new eCmsTerminoLang();

$groupID    =OWASP::RequestInt('groupID');
$langID     =OWASP::RequestInt('langID');
if(empty($langID)) $langID=1;

$oItem->terminoID   =$kID;
$oItem->groupID     =OWASP::RequestInt('groupID');
$oItem->langID      =OWASP::RequestInt('langID');
$oItem->alias       =OWASP::RequestString('alias');
$oItem->terminoName =OWASP::RequestString('terminoName');
$oItem->varName     =OWASP::RequestString('varName');
$oItem->inputType   =OWASP::RequestString('inputType');

$MODULE->processFormAction('CmsTerminoLang', $oItem);

if($MODULE->FormView=="edit"){
    $obj=CmsTerminoLang::getItem($kID, $langID);
    if($obj!=null){
        if (empty($oItem->groupID))        $oItem->groupID=$obj->groupID;
        if (empty($oItem->langID))         $oItem->langID=$obj->langID;
        if (empty($oItem->alias))          $oItem->alias=$obj->alias;
        if (empty($oItem->terminoName))    $oItem->terminoName=$obj->terminoName;
        if (empty($oItem->varName))        $oItem->description=$obj->varName;
        if (empty($oItem->inputType))      $oItem->inputType=$obj->inputType;

        if($obj->nullValue==1)
            $MODULE->addAlert("No se ha registrado informaci&oacute;n para esta versi&oacute;n de idioma, por favor edite el contenido.");
    }
    else
        $MODULE->addError(CmsTerminoLang::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->alias;
}

$MODULE->FormTitle="T&eacute;rmino";
?>
