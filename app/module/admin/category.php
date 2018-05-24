<?php
$oItem = new eShopCategory();

$oItem->categoryID	=$kID;
$oItem->lineID		=OWASP::RequestInt('lineID');
$oItem->categoryName	=OWASP::RequestString('categoryName');
$oItem->description	=OWASP::RequestString('description');
$oItem->imgIcon		=OWASP::RequestString('imgIcon');
$oItem->imgButtonOn	=OWASP::RequestString('imgButtonOn');
$oItem->imgButtonOff	=OWASP::RequestString('imgButtonOff');

$MODULE->processFormAction(new ShopCategory(), $oItem);

if($MODULE->FormView=="edit"){
    $DAO=$MODULE->StaticDAO;
    $obj=$DAO::getItem($kID);
    if($obj!=null){
        if (empty($oItem->lineID)) 		$oItem->lineID=$obj->lineID;
        if (empty($oItem->categoryName)) 	$oItem->categoryName=$obj->categoryName;
        if (empty($oItem->description)) 	$oItem->description=$obj->description;
        if (empty($oItem->imgIcon)) 		$oItem->imgIcon=$obj->imgIcon;
        if (empty($oItem->imgButtonOn)) 	$oItem->imgButtonOn=$obj->imgButtonOn;
        if (empty($oItem->imgButtonOff))	$oItem->imgButtonOff=$obj->imgButtonOff;
        if (empty($oItem->active)) 		$oItem->active=$obj->active;
    }
    else
        $MODULE->addError($DAO::GetErrorMsg());

    $MODULE->ItemTitle=$oItem->categoryName;
}

$MODULE->FormTitle="Categor&iacute;a";
?>
