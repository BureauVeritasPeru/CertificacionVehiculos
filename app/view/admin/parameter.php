<?php
$oItem = new eCmsParameterLang();

$groupID    =OWASP::RequestInt('groupID');
$langID     =OWASP::RequestInt('langID');
if(empty($langID)) $langID=1;

$oItem->parameterID     =$kID;
$oItem->groupID         =OWASP::RequestString('groupID');
$oItem->langID          =OWASP::RequestString('langID');
$oItem->parameterName   =OWASP::RequestString('parameterName');
$oItem->description     =OWASP::RequestHTML('description');
$oItem->attribute       =OWASP::RequestArray('attribute');
$oItem->active          =OWASP::RequestBoolean('active');

$MODULE->processFormAction('CmsParameterLang', $oItem);

if($MODULE->FormView=="edit"){
    $obj=CmsParameterLang::getItem($kID, $langID);
    if($obj!=null){
        if (empty($oItem->groupID)) 		$oItem->groupID=$obj->groupID;
        if (empty($oItem->langID)) 			$oItem->langID=$obj->langID;
        if (empty($oItem->parameterName))	$oItem->parameterName=$obj->parameterName;
        if (empty($oItem->description)) 	$oItem->description=$obj->description;
        if (empty($oItem->attribute)) 		$oItem->attribute=XMLParser::getArray($obj->attribute);
        if (empty($oItem->active)) 		$oItem->active=$obj->active;

        if($obj->nullValue==1)
            $MODULE->addAlert("No se ha registrado informaci&oacute;n para esta versi&oacute;n de idioma, por favor edite el contenido.");
    }
    else
        $MODULE->addError(CmsParameterLang::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->parameterName;
}

$MODULE->FormTitle="Par&aacute;metro";
?>
