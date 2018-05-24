<?php
$oItem = new eCrmRegisterForm();

$oItem->registerID	=$kID;
$oItem->formID		=OWASP::RequestInt('formID');
$oItem->registerCode	=OWASP::RequestString('registerCode');
$oItem->name		=OWASP::RequestString('name');
$oItem->lastname	=OWASP::RequestString('lastname');
$oItem->surname		=OWASP::RequestString('surname');
$oItem->phone		=OWASP::RequestString('phone');
$oItem->countryID	=OWASP::RequestString('countryID');
$oItem->city		=OWASP::RequestString('city');
$oItem->address		=OWASP::RequestString('address');
$oItem->email		=OWASP::RequestString('email');
$oItem->contactID	=OWASP::RequestInt('contactID');
$oItem->comment		=OWASP::RequestString('comment');
$oItem->state		=OWASP::RequestString('state');
$oItem->registerDate	=OWASP::RequestString('registerDate');
$oItem->reviewDate	=OWASP::RequestString('reviewDate');

$txtsearch		=OWASP::RequestString('txtsearch');

$MODULE->processFormAction(new CrmRegisterForm(), $oItem);

$DAO=$MODULE->StaticDAO;
if($MODULE->FormView=="edit"){
    $obj=$DAO::getItem($kID);
    if($obj!=null){
        if (empty($oItem->formID))         $oItem->formID          = $obj->formID;
        if (empty($oItem->registerCode))   $oItem->registerCode    = $obj->registerCode;
        if (empty($oItem->name))           $oItem->name            = $obj->name;
        if (empty($oItem->lastname))       $oItem->lastname        = $obj->lastname;
        if (empty($oItem->surname))        $oItem->surname         = $obj->surname;
        if (empty($oItem->phone))          $oItem->phone           = $obj->phone;
        if (empty($oItem->countryID))      $oItem->countryID       = $obj->countryID;
        if (empty($oItem->city))           $oItem->city            = $obj->city;
        if (empty($oItem->district))       $oItem->district        = $obj->district;
        if (empty($oItem->address))        $oItem->address         = $obj->address;
        if (empty($oItem->email))          $oItem->email           = $obj->email;
        if (empty($oItem->contactID))      $oItem->contactID       = $obj->contactID;
        if (empty($oItem->comment))        $oItem->comment         = $obj->comment;
        if (empty($oItem->state))          $oItem->state           = $obj->state;
        if (empty($oItem->registerDate))   $oItem->registerDate    = $obj->registerDate;
        if (empty($oItem->reviewDate))     $oItem->reviewDate      = $obj->reviewDate;
    }
    else
        $MODULE->addError($DAO::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->name." ".$oItem->lastname;
}

$MODULE->FormTitle="Registro";
?>
