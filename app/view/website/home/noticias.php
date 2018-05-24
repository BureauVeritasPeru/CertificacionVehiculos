<?php
$langID=$PAGE->langID;
$title=$oItem->title;

$templateID=27; //pagina de Noticias
$sectionID=8; //Acerda de
$lPaginaNoticia=CmsContentLang::getWebList_Template($templateID, $sectionID, $langID);
if($lPaginaNoticia->getLength()>0){
    $oPaginaNoticia=$lPaginaNoticia->getItem(0);
?>
<div class="noticias_home">
    <h2><?php echo TextParser::UpperCase($title);?></h2>
        <ul>
<?php
$lNoticia=CmsContentLang::getWebList($oPaginaNoticia->contentID, $sectionID, $langID, 'clan.date DESC', true);
$rows=$lNoticia->getLength();
    foreach($lNoticia as $oItem){

        $icono= XMLParser::getValue($oItem->media, 'icono');

        $icono= !empty($icono)? '<figure><img src="'.$URL_ROOT.$icono.'" alt="'.$oItem->title.'" title="'.$oItem->title.'"></figure>': NULL;
    	$d=strtotime($oItem->date);
    	$dia=date("d", $d);
        $anio=date("y", $d);
    	$mes=strtoupper(strftime("%b", $d));
        $fecha="$dia / $mes / $anio";
?>
    <li>
        <?php echo $icono;?>
        <blockquote>
            <span><?php echo $fecha;?></span>
            <p>
                <?php echo $oItem->title;?>
            </p>
            <a href="<?php echo SEO::get_URLContent($oItem, 'nID='.$oItem->contentID); ?>">LEER M&Aacute;S</a>
        </blockquote>
    </li>
    <?php
        }
    ?>
    </ul>
    <a class="more_home" href="<?php echo SEO::get_URLContent($oPaginaNoticia);?>">LEER M&Aacute;S <?php echo TextParser::UpperCase($title);?></a>
</div>
<?php
}
?>
