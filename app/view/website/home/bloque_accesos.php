<?php
$lContent=CmsContentLang::getWebList($oItem->contentID, $oItem->sectionID, $oItem->langID);
?>
<div class="aside_home">
<?php
foreach($lContent as $oItem){
    $url= XMLParser::getValue($oItem->media, 'icono');
    $icono= !empty($url)? '<figure><img src="'.$URL_ROOT.$url.'" alt="'.$oItem->title.'" title="'.$oItem->title.'"></figure>': NULL;

    $url= XMLParser::getValue($oItem->media, 'imagen');
    $imagen= !empty($url)? '<figure><img src="'.$URL_ROOT.$url.'" alt="'.$oItem->title.'" title="'.$oItem->title.'"></figure>': NULL;

    $oLink=SEO::get_ContentLink($oItem);
?>
<div class="zona">
    <div class="titulo">
        <?php echo $icono;?>
        <h3><?php echo $oItem->title;?></h3>
    </div>
    <?php echo $imagen;?>
    <blockquote>
        <p>
            <?php echo $oItem->resumen;?>
        </p>
        <a href="<?php echo $oLink->url;?>" target="<?php echo $oLink->target;?>"><?php echo TextParser::UpperCase($oItem->subTitle);?></a>
    </blockquote>
</div>
<?php
}?>
</div>