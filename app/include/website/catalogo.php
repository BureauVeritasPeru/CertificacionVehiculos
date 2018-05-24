<div class="lista_secundaria">
<?php
foreach($lContent as $oItem){
    $param= XMLParser::getValue($oItem->media, 'thumbnail');
    $imagen= !empty($param)? '<img src="'.$param.'" />': NULL;
    $oLink=SEO::get_ContentLink($oItem);
?>
	<div class="items">
		<a href="<?php echo $oLink->url;?>" class="full"></a>
		<?php echo $imagen;?>
		<div class="box_detalle">
			<div class="titulo"><?php echo $oItem->title;?></div>
			<div class="icono"></div>
			<div class="texto"></div>
		</div>						
	</div>
<?php
}
?>
</div>
