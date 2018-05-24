<?php
$parentSectionID=4;//Secciones generales
$lSitemap=CmsSectionLang::getWebList($parentSectionID, $oContentLang->langID);
?>
<h1>Mapa de sitio</h1>
<article class="mapa_principal">
<div class="bordes"></div>
	<ul class="lista_mapa">
<?php
foreach ($lSitemap as $oSection) {
	$parentContentID=0;//root de cada seccion
	$lContent=CmsContentLang::getWebList_Menu($parentContentID, $oSection->sectionID, $oSection->langID);
	$oLink=new eLink();
	if( $oSection->showContent==0 && $lContent->getLength()>0)
		$oLink=SEO::get_ContentLink($lContent->getItem(0));
	else
		$oLink->url =SEO::get_URLSection($oSection);
	
	$oLink->title=$oSection->title;
?>
	<li class="items_pricipales">
		<a href="<?php echo $oLink->url;?>" target="<?php echo $oLink->target;?>"><?php echo $oLink->title;?></a>
	<?php 
		if($lContent->getLength()>0){
		echo '<ul class="lista_sub_menu">';
		foreach ($lContent as $oItem) {
			$oLink=SEO::get_ContentLink($oItem);

			echo '<li class="items_secundarios"><a href="'.$oLink->url.'" target="'.$oLink->target.'">'.$oLink->title.'</a></li>';
		}
		echo '</ul>';
	}
	?>
	</li>
<?php
}
?>
	</ul>
	</article>
<?php
$parentSectionID=5;//Secciones generales
$lSitemap2=CmsSectionLang::getWebList($parentSectionID, $oContentLang->langID);
?>
<article class="mapa_secundario">
<div class="bordes"></div>
<ul class="lista_mapa">
<?php
foreach ($lSitemap2 as $oSection) {
    
	$parentContentID=0;//root de cada seccion
	$lContent2=CmsContentLang::getWebList_Menu($parentContentID, $oSection->sectionID, $oSection->langID);
	$oLink=new eLink();
	if( $oSection->showContent==0 && $lContent2->getLength()>0)
		$oLink=SEO::get_ContentLink($lContent2->getItem(0));
                
	else
		$oLink->url =SEO::get_URLSection($oSection);
          
	$oLink->title=$oSection->title;
        
?>
	<li class="items_pricipales <?php echo(($lContent2->getLength()>0)?" item_long":""); ?>" >
		<a href="<?php echo $oLink->url;?>" target="<?php echo $oLink->target;?>"><?php echo $oLink->title;?></a>
	<?php 
                if($lContent2->getLength()>0) {
                    echo '<ul class="lista_sub_menu">';
                    foreach ($lContent2 as $oItem) {
                            $oLink=SEO::get_ContentLink($oItem);

                            echo '<li class="items_secundarios"><a href="'.$oLink->url.'" target="'.$oLink->target.'">'.$oLink->title.'</a></li>';
                    }
                    echo '</ul>';
               }
	?>
	</li>
<?php
}
?>

</ul>
 </article>
<article class="mapa_final">
 <?php
$sectionID=2; //Secciones Principales
$langID=$PAGE->langID;
$lContent=CmsContentLang::getWebList(0, $sectionID, $langID);

?>
<div class="bordes"></div>
<ul class="lista_mapa">
<?php
	foreach ($lContent as $oItem) {
	$oLink=SEO::get_ContentLink($oItem);
	
		switch($oItem->templateID){

			case 27:
					echo '';
					break;
			default:
					echo '<li class="items_pricipales"><a href="'.$oLink->url.'">'.$oLink->title.'</a></li>';
					break;
		}
 }
?>
    
</ul>
</article>
<div class="clear"></div>			
                    