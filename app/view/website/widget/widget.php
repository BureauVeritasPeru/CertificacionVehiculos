<?php
$imagen=XMLParser::getValue($oWidget->media, 'imagen');

$imagen=!empty($imagen)? '<img src="'.$URL_ROOT.$imagen.'" />': null;
$oLink=SEO::get_ContentLink($oWidget);
?>
<div class="our_history">
	<h3><?php echo $oWidget->title;?></h3>
	<?php echo $imagen;?>
	<p>
		<?php echo $oWidget->resumen;?>
	</p>
	<a href="<?php echo $oLink->url;?>" target="<?php echo $oLink->target;?>" class="more_aside_int">Leer m&aacute;s</a>
</div>
