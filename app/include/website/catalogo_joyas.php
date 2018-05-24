<div class="joyeria_seccion_3">
	<ul class="lista_joyas">
<?php
foreach($lContent as $oItem){
    $param= XMLParser::getValue($oItem->media, 'imagen');
    $imagen= !empty($param)? '<img src="'.$URL_ROOT.$param.'" />': NULL;
    $oLink=SEO::get_ContentLink($oItem);
?>
	<li class="btn_lista">
		<a href="<?php echo $oLink->url;?>" class="full"></a>
		<?php echo $imagen;?>
		<div class="box_detalle">
			<div class="titulo"><?php echo $oItem->title;?></div>
			<div class="icono"></div>
			<div class="texto"></div>
		</div>
	</li>
<?php
}
?>
	</ul>
</div>
<div class="barra_ver_mas">
	<div class="caja_texto">Ver m&aacute;s Aretes</div>
</div>
