<div class="extension">
<?php
$templateID=15; //Bloque de Widgets
$sectionID=$oSectionLang->sectionID;
$langID=$oSectionLang->langID;

$lWidgets=CmsContentLang::getWebList_Template($templateID, $sectionID, $langID);
if($lWidgets->getLength()>0){
    $oWidget=$lWidgets->getItem(0);
    $lWidgets=CmsContentLang::getWebList($oWidget->contentID, $oWidget->sectionID, $oWidget->langID);
    foreach($lWidgets as $oWidget){
        $oSchema=CmsSchema::getItem($oWidget->schemaID);
        $file_view ='../app/view/website/widget/'. $oSchema->webSource.'.php';
        if( file_exists( $file_view ) ){
            include $file_view ;
        }
        else
            $PAGE->addError("No se puede cargar el archivo => ".$file_view) ;
    }
}
?>
</div>
