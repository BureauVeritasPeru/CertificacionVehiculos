<?php
$lAccesos=CmsContentLang::getWebList($oItem->contentID, $oItem->sectionID, $oItem->langID);
?>
<div class="contenido">
	<section>
<?php
foreach($lAccesos as $oItem){
	
	switch($oItem->templateID){
	case 17:
		include("../view/website/home/noticias.php");
		break;
	case 16:
		include("../view/website/home/bloque_accesos.php");
		break;
	}
}
?>    
	</section>
</div>
