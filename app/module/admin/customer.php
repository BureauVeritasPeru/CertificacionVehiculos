<?php
$oItem = new eShopCustomer();

$oItem->customerID	=$kID;
$oItem->customerCode	=OWASP::RequestString('customerCode');
$oItem->firstName	=OWASP::RequestString('firstName');
$oItem->lastName	=OWASP::RequestString('lastName');
$oItem->userName	=OWASP::RequestString('userName');
$oItem->password	=OWASP::RequestString('password');
$oItem->postalCode	=OWASP::RequestString('postalCode');
$oItem->countryID	=OWASP::RequestString('countryID');
$oItem->stateID		=OWASP::RequestString('stateID');
$oItem->address		=OWASP::RequestString('address');
$oItem->birthdate	=OWASP::RequestString('birthdate');
$oItem->phone		=OWASP::RequestString('phone');
$oItem->fax		=OWASP::RequestString('fax');
$oItem->email		=OWASP::RequestString('email');

$txtsearch		=OWASP::RequestString('txtsearch');

$MODULE->processFormAction(new ShopCustomer(), $oItem);

if($MODULE->FormView=="edit"){
    $result=ShopCustomer::getItem($kID);
    if($rs=ShopCustomer::fetchArray($result)){
        if (empty($oItem->customerCode))  $oItem->customerCode   =$rs["customerCode"];
        if (empty($oItem->firstName))     $oItem->firstName      =$rs["firstName"];
        if (empty($oItem->lastName))      $oItem->lastName       =$rs["lastName"];
        if (empty($oItem->userName))      $oItem->userName       =$rs["userName"];
        if (empty($oItem->password))      $oItem->password       =$rs["password"];
        if (empty($oItem->postalCode))    $oItem->postalCode     =$rs["postalCode"];
        if (empty($oItem->stateID))       $oItem->stateID        =$rs["stateID"];
        if (empty($oItem->city))          $oItem->city           =$rs["city"];
        if (empty($oItem->address))       $oItem->address        =$rs["address"];
        if (empty($oItem->birthdate))     $oItem->birthdate      =$rs["birthdate"];
        if (empty($oItem->phone))         $oItem->phone          =$rs["phone"];
        if (empty($oItem->fax))           $oItem->fax            =$rs["fax"];
        if (empty($oItem->email))         $oItem->email          =$rs["email"];
        if (empty($oItem->state))         $oItem->state          =$rs["state"];
    }
    else
        $MODULE->addError(ShopCustomer::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->firstName." ".$oItem->lastName;
}

$MODULE->FormTitle="Cliente";
?>
