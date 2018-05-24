<?php
$filtro=OWASP::RequestString('filtro');
$langID=OWASP::RequestInt('langID');
if(empty($langID) && isset($_SESSION["langID"])) $langID=filter_var($_SESSION["langID"]);
if(empty($langID)) $langID=1;

if($MODULE->FormView=="section"){
    $oItem = new eCmsSectionLang();

    $obj=CmsSectionLang::getItem($kID, $langID);
    if(!isset($obj)) $obj = $oItem;

    $oItem->sectionID       = $kID;
    $oItem->langID          = $langID;
    $oItem->title           = OWASP::RequestString('title', $obj->title);
    $oItem->subTitle        = OWASP::RequestString('subTitle', $obj->subTitle);
    $oItem->description     = OWASP::RequestHTML('description', $obj->description);
    $oItem->resumen         = OWASP::RequestHTML('resumen', $obj->resumen);
    
    $oItem->showContent     = OWASP::RequestInt('showContent', $obj->showContent);
    $oItem->parentSectionID = OWASP::RequestString('parentSectionID', $obj->parentSectionID);
    
    $oItem->sectionName     = OWASP::RequestString('sectionName', $obj->sectionName);
    $oItem->position        = OWASP::RequestString('position', $obj->position);
    $oItem->isEditable      = OWASP::RequestInt('isEditable', ($MODULE->Command==""? $obj->isEditable: 0));
    $oItem->active          = OWASP::RequestInt('active', ($MODULE->Command==""? $obj->active: 0));
    $oItem->staticURL       = OWASP::RequestString('staticURL', $obj->staticURL);

    $oItem->media           = OWASP::RequestArray('media', $obj->media);
    $oItem->parameter       = OWASP::RequestArray('parameter', $obj->parameter);
    $oItem->metaTag         = OWASP::RequestArray('metaTag', $obj->metaTag);

    //if(empty($oItem->langID) && isset($_SESSION["langID"])) $oItem->langID=filter_var($_SESSION["langID"]);
    $MODULE->processFormAction('CmsSectionLang', $oItem);
    if($MODULE->FormView=="list"){
        header("location: ".$MODULE->getURL());
        exit;
    }
}
else{
    $oItem = new eCmsContentLang();

    $obj=CmsContentLang::getItem($kID, $langID);
    if(!isset($obj)) $obj = $oItem;

    $oItem->contentID       = $kID;
    $oItem->langID          = $langID;

    $oItem->title           = OWASP::RequestString('title', $obj->title);
    $oItem->subTitle        = OWASP::RequestString('subTitle', $obj->subTitle);
    $oItem->subTitle2       = OWASP::RequestString('subTitle2', $obj->subTitle2);
    $oItem->description     = OWASP::RequestHTML('description', $obj->description);
    $oItem->description2    = OWASP::RequestHTML('description2', $obj->description2);
    $oItem->description3    = OWASP::RequestHTML('description3', $obj->description3);
    $oItem->resumen         = OWASP::RequestHTML('resumen', $obj->resumen);
    $oItem->date            = OWASP::RequestString('date', $obj->date);
    
    $oItem->linkType        = OWASP::RequestInt('linkType', $obj->linkType);
    $oItem->linkContentID   = OWASP::RequestInt('linkContentID', $obj->linkContentID);
    $oItem->linkURL         = OWASP::RequestString('linkURL', $obj->linkURL);
    $oItem->linkTarget      = OWASP::RequestString('linkTarget', $obj->linkTarget);
    $oItem->staticURL       = OWASP::RequestString('staticURL', $obj->staticURL);
    $oItem->registerDate    = OWASP::RequestString('registerDate', $obj->registerDate);
    $oItem->active          = OWASP::RequestInt('active', ($MODULE->Command==""? $obj->active: 0));
    $oItem->showInHome      = OWASP::RequestInt('showInHome',  ($MODULE->Command==""? $obj->showInHome: 0));
    
    $oItem->parentContentID = OWASP::RequestInt('parentContentID');
    $oItem->schemaID        = OWASP::RequestInt('schemaID', $obj->schemaID);
    $oItem->contentName     = OWASP::RequestString('contentName', $obj->contentName);
    $oItem->position        = OWASP::RequestInt('position', $obj->position);
    $oItem->sectionID       = OWASP::RequestInt('sectionID', $obj->sectionID);
    $oItem->templateID      = OWASP::RequestInt('templateID', $obj->templateID);

    $oItem->media           = OWASP::RequestArray('media', $obj->media);
    $oItem->parameter       = OWASP::RequestArray('parameter', $obj->parameter);
    $oItem->metaTag         = OWASP::RequestArray('metaTag', $obj->metaTag);

    //if(empty($oItem->langID) && isset($_SESSION["langID"])) $oItem->langID=filter_var($_SESSION["langID"]);
    $MODULE->processFormAction('CmsContentLang', $oItem);
    if($MODULE->ValidateEvent("ADMINISTRAR") && $MODULE->Command=="moveUp" && $oItem->contentID>0){
        $oContent=CmsContent::getItem($oItem->contentID);
        $oContent->append($oItem->sectionID);
        CmsContent::MoveUp($oContent);//Update position
    }

}

if(($MODULE->Command=="insert" || $MODULE->Command=="update" || $MODULE->Command=="delete") && $MODULE->FormView=="list"){
	header("location: ".$MODULE->getURL()."&parentContentID=".$oItem->parentContentID."&langID=".$oItem->langID);
    exit;
}
if($MODULE->Command=="reorder" && $MODULE->FormView=="sort"){
    $kIDs=OWASP::RequestString('kIDs');
    $aItems=explode(',', $kIDs);
    if(is_array($aItems) && CmsContent::UpdatePositionList($aItems)){
        $MODULE->FormView="list";
    }
}

if($MODULE->FormView!="list" && isset($oItem->schemaID)){
    //Get Schema
    $oSchema=CmsSchema::getItem($oItem->schemaID);
    if(isset($oSchema)){
        $MODULE->ItemTitle=$oItem->title;
        $MODULE->FormTitle=$oSchema->alias;
    }
}

$_SESSION["langID"]=$oItem->langID;
?>
