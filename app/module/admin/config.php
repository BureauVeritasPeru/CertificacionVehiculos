<?php
$arrValue=OWASP::RequestArray('value');

if($MODULE->Command=="update" && $arrValue!=NULL){
    $flgUpdate=false;
    
    foreach ($arrValue as $id=> $value){
        $oItem = new eConfig();

        $oItem->configID    = $id;
        $oItem->value       = OWASP::ValidateString($value);

        $flgUpdate=Config::Update($oItem);
    }

    if($flgUpdate){
        $MODULE->addAlert("Se han actualizado los datos!");	
    }
}

//$MODULE->processFormAction('Config', $oItem);
?>