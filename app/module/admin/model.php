<?php
$oItem = new eShopModel();

$oItem->modelID		=$kID;
$oItem->categoryID	=OWASP::RequestInt('categoryID');
$oItem->modelCode	=OWASP::RequestString('modelCode');
$oItem->modelName	=OWASP::RequestString('modelName');
$oItem->description	=OWASP::RequestString('description');
$oItem->price		=OWASP::RequestString('price');
$oItem->imgIcon		=OWASP::RequestString('imgIcon');
$oItem->imgPreview	=OWASP::RequestString('imgPreview');
$oItem->imgZoom		=OWASP::RequestString('imgZoom');
$oItem->active		=OWASP::RequestBoolean('active');

$MODULE->processFormAction(new ShopModel(), $oItem);

if($MODULE->FormView=="edit"){
    $oModel=ShopModel::getItem($kID);

    if($oModel!=null){
        if (empty($oItem->categoryID))	   $oItem->categoryID=$oModel->categoryID;
        if (empty($oItem->modelCode))	   $oItem->modelCode=$oModel->modelCode;
        if (empty($oItem->modelName)) 	   $oItem->modelName=$oModel->modelName;
        if (empty($oItem->description))    $oItem->description=$oModel->description;
        if (empty($oItem->price)) 		   $oItem->price=$oModel->price;
        if (empty($oItem->imgIcon))		   $oItem->imgIcon=$oModel->imgIcon;
        if (empty($oItem->imgPreview))     $oItem->imgPreview=$oModel->imgPreview;
        if (empty($oItem->imgZoom))		   $oItem->imgZoom=$oModel->imgZoom;
        if (empty($oItem->active)) 		   $oItem->active=$oModel->active;
    }
    else
        $MODULE->addError(ShopModel::getErrorMsg());

    $MODULE->ItemTitle=$oItem->modelName;
}
elseif($MODULE->FormView=="add"){
    //Default Values
    if(OWASP::RequestBoolean('active')) $oItem->active=1;
}

$MODULE->FormTitle="Modelo";
?>