<?php
$param=XMLParser::getValue($oContentLang->media, 'img_regresar');
$img_regresar=!empty($param)? '<img src="'.$URL_ROOT.$param.'" />': NULL;
$param=XMLParser::getValue($oContentLang->media, 'img_contacto');
$img_contacto=!empty($param)? '<img src="'.$URL_ROOT.$param.'" />': NULL;

$lContent = CmsContentLang::getWebList($oContentLang->contentID, $oContentLang->sectionID, $oContentLang->langID);
$err_title=$oContentLang->subTitle;
$err_mssge=$oContentLang->description;

foreach ($lContent as $oItem){

    $parameter = XMLParser::getArray($oItem->parameter);
    if(isset($parameter['error']) && $parameter['error']==$error){
        $err_title=$oItem->title;
        $err_mssge=$oItem->description;
        break;
    }
}

$templateID=29;
$sectionID=2;
$lContacto    = CmsContentLang::getWebList_Template($templateID, $sectionID, $oContentLang->langID);
$url_contacto = $lContacto->getLength()>0 ? SEO::get_URLContent($lContacto->getItem(0)): '#';
?>
<h2><?php echo $err_title;?></h2>

<p class="err"><?php echo $err_mssge;?></p>
<p>
    <br />
    <a href="javascript:history.back()"><?php echo $img_regresar;?></a>
    <a href="<?php echo $url_contacto;?>"><?php echo $img_contacto?></a>
</p>
<style type="text/css">
.err a{
    color: #0096d6;
    font-weight: bold;
}
</style>