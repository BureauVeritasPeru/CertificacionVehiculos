<?php
$sectionID=$oContentLang->sectionID;
$langID=$oContentLang->langID;

$title=$oContentLang->title;
$templateID=8;//Proyectos
$lNoticias=CmsContentLang::getWebList_Template($templateID, $sectionID, $langID, 'date DESC');
?>
<h1><?php echo $oContentLang->title;?></h1>
<p><?php echo $oContentLang->description;?></p>

<div class="noti_proyectos">
	<ul id="itemContainer">
		<h3><?php echo $title;?></h3>
	<?php
	foreach($lNoticias as $oItem){
		$url=XMLParser::getValue($oItem->media, 'icono');
		$icono=!empty($url)? '<figure><img src="'.$URL_ROOT.$url.'" /></figure>': NULL;
	?>
		<li>
			<?php echo $icono;?>
			<blockquote>
			<p><?php echo $oItem->title;?></p>
			<a href="<?php echo SEO::get_URLContent($oItem);?>" class="more_noti_proy vermas">Leer M&aacute;s</a>
			</blockquote>
		</li>
	<?php }
	?>
	</ul>
</div>
<div class="pages holder"></div>

<link rel="stylesheet" type="text/css" href="<?php echo $URL_BASE;?>css/jqtransform.css">
<link rel="stylesheet" type="text/css" href="<?php echo $URL_BASE;?>css/jPages.css" />
<script type="text/javascript" src="<?php echo $URL_BASE;?>js/jquery.jqtransform.js"></script>
<script type="text/javascript" src="<?php echo $URL_BASE;?>js/jPages.min.js"></script>
<script type="text/javascript" src="<?php echo $URL_BASE;?>js/custom_jPages.js" ></script>
<script type="text/javascript">
$(function(){
	$('#sectorID').change(function(){
		location.href='<?php echo SEO::get_URLContent($oContentLang);?>?sectorID='+$(this).val();
	});
});
</script>