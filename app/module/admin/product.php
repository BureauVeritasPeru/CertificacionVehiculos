<?php
$oItem = new eShopProduct();

$oItem->productID       =$kID;
$oItem->categoryID      =OWASP::RequestInt('categoryID');
$oItem->modelID         =OWASP::RequestInt('modelID');
$oItem->productName     =OWASP::RequestString('productName');
$oItem->description     =OWASP::RequestString('description');
$oItem->productCode     =OWASP::RequestString('productCode');
$oItem->price           =OWASP::RequestString('price');
$oItem->stock           =OWASP::RequestInt('stock');
$oItem->pointValue      =OWASP::RequestString('pointValue');
$oItem->information     =OWASP::RequestString('information');
$oItem->manual          =OWASP::RequestString('manual');
$oItem->specifications  =OWASP::RequestString('specifications');
$oItem->imgIcon         =OWASP::RequestString('imgIcon');
$oItem->imgPreview      =OWASP::RequestString('imgPreview');
$oItem->imgZoom         =OWASP::RequestString('imgZoom');
$oItem->state           =OWASP::RequestInt('state');

$oItem->imageIDs        =OWASP::RequestString('imageIDs');
$oItem->parameterIDs    =OWASP::RequestString('parameterIDs');

$MODULE->processFormAction(new ShopProduct(), $oItem);

if($MODULE->FormView=="edit"){
    $oProduct=ShopProduct::getItem($kID);

    if($oProduct!=null){
        if (empty($oItem->categoryID))     $oItem->categoryID      =$oProduct->categoryID;
        if (empty($oItem->modelID))        $oItem->modelID         =$oProduct->modelID;
        if (empty($oItem->productName))    $oItem->productName     =$oProduct->productName;
        if (empty($oItem->description))    $oItem->description     =$oProduct->description;
        if (empty($oItem->productCode))    $oItem->productCode     =$oProduct->productCode;
        if (empty($oItem->price))          $oItem->price           =$oProduct->price;
        if (empty($oItem->stock))          $oItem->stock           =$oProduct->stock;
        if (empty($oItem->pointValue))     $oItem->pointValue      =$oProduct->pointValue;
        if (empty($oItem->information))    $oItem->information     =$oProduct->information;
        if (empty($oItem->manual))         $oItem->manual          =$oProduct->manual;
        if (empty($oItem->specifications)) $oItem->specifications  =$oProduct->specifications;
        if (empty($oItem->imgIcon))        $oItem->imgIcon         =$oProduct->imgIcon;
        if (empty($oItem->imgPreview))     $oItem->imgPreview      =$oProduct->imgPreview;
        if (empty($oItem->imgZoom))        $oItem->imgZoom         =$oProduct->imgZoom;
        if (empty($oItem->state))          $oItem->state           =$oProduct->state;
    }else
        $MODULE->addError(ShopProduct::getErrorMsg());

    $MODULE->ItemTitle=$oItem->productName;
}

$MODULE->FormTitle="Producto";
?>