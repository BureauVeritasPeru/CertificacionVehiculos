<?php
header("content-type: text/html; charset=utf-8");
require_once("../../app/config/main.php");

//Common Fields
$type       =OWASP::RequestString('type');
$parentID   =OWASP::RequestInt('pID');

switch ($type) {
    case 'country':
        getList_Country();
        break;
    case 'state':
        getList_State($parentID);
        break;
    case 'city':
        getList_City($parentID);
        break;
    case 'district':
        getList_District($parentID);
        break;
}

function getList_Country(){
    $lUbigeo = UbgCountry::getWebList();
    foreach ($lUbigeo as $oItem) {
        echo "<option value='$oItem->countryID'>".htmlentities($oItem->countryName)."</option>";
    }
}

function getList_State($countryID){
    $lUbigeo = UbgState::getWebList($countryID);
    foreach ($lUbigeo as $oItem) {
        echo "<option value='$oItem->stateID'>".htmlentities($oItem->stateName)."</option>";
    }
}

function getList_City($stateID){
    $lUbigeo = UbgCity::getWebList($stateID);
    foreach ($lUbigeo as $oItem) {
        echo "<option value='$oItem->cityID'>".htmlentities($oItem->cityName)."</option>";
    }
}

function getList_District($cityID){
    $lUbigeo = UbgDistrict::getWebList($cityID);
    foreach ($lUbigeo as $oItem) {
        echo "<option value='$oItem->districtID'>".htmlentities($oItem->districtName)."</option>";
    }
}

?>