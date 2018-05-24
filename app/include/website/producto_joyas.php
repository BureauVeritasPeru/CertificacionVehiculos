<?php
$url= XMLParser::getValue($oContentLang->media, 'imagen');
$imagen   = !empty($url)? '<img src="'.$URL_ROOT.$url.'" width="100%" height="100" alt="'.$oContentLang->title.'"/>': NULL;

$related  = XMLParser::getValue($oContentLang->parameter, 'related'); 
$lRelated = CmsContentLang::getWebList_ArrayID($related, $oContentLang->langID);
?>
<h1><?php echo $oContentLang->title;?></h1>
<div class="joyeria_seccion_detalle">
	<div class="caja_detalle_left">
		<div class="texto">
			<?php echo $oContentLang->description;?>
		</div>

		<div class="item">
			<a href="contactenos.html" class="full"></a>
			<div class="ico"><img src="<?php echo $URL_BASE;?>images/icono_carrito.png"></div>
			<div class="texto">Realizar Pedido</div>
		</div>
		<div class="clear"></div>
		<!-- <div class="item">
			<a href="#" class="full"></a>
			<div class="ico"><img src="<?php echo $URL_BASE;?>images/icono_Wishlist.png"></div>
			<div class="texto">Wishlist</div>
		</div>
		<div class="clear"></div> -->
		<!-- <div class="item">
			<a href="#" class="full"></a>
			<div class="ico"><img src="<?php echo $URL_BASE;?>images/icono_impresora.png"></div>
			<div class="texto">Imprimir</div>
		</div> -->
		<div class="clear"></div>
                  <?php
            $sectionID=17;
            $templateID=29; //sociales item (redes sociales)
            $lEnlaceRedes=CmsContentLang::getWebList_Template($templateID, $sectionID, $langID);
            
        foreach( $lEnlaceRedes as $oEnlaceRedes ){ 
            $media = XMLParser::getArray($oEnlaceRedes->media);
            $oEnlaceRedes->parameter=XMLParser::getArray($oEnlaceRedes->parameter);
            $urlRedes=isset($oEnlaceRedes->parameter['url'])? $oEnlaceRedes->parameter['url']: NULL;
            $imagenRedes = isset($media['imagen']['Url'])? '<img src="'.$URL_ROOT.$media['imagen']['Url'].'" alt="'.$oItem->title.'"/>': NULL;

            echo '<div class="iconos_redes">';
            echo '<a href="'.$urlRedes.'" target="_blank">';
            echo $imagenRedes;	
            echo '</a>';
            echo '</div>';
        } 
        ?>

		<div class="clear"></div>					
	</div>
	<div class="caja_imagen_right">
		<div class="imagen zoom" id='ex1'>
			<?php echo $imagen;?>
		</div>
		<div class="barra_zoom">
			<div class="btn_zoom">
				<div class="icono_lupa">
					<img src="<?php echo $URL_BASE;?>images/icono_lupa.png">
				</div>
				<div class="texto">zoom</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
<?php
if($lRelated->getLength()>0){
?>
		<div class="productos_otras_opciones">
			<div class="titulo">Tambíen te puede interesar</div>
			<ul class="lista_otros">
	<?php
	$i=0;
	foreach ($lRelated as $oItem) {
	if($i++>3) break;

	$oItem->media=XMLParser::getArray($oItem->media);
	$imagen= isset($oItem->media['thumbnail'])? '<img src="'.$URL_ROOT.$oItem->media['thumbnail']['Url'].'" />': NULL;
	$oLink=SEO::get_ContentLink($oItem);
	?>
				<li>
					<a href="<?php echo $oLink->url;?>" class="full"></a>
					<?php echo $imagen;?>
					<div class="nombre_producto"><?php echo $oItem->title;?></div>
				</li>
	<?php
	}
	?>
				<div class="clear"></div>
			</ul>
		</div>
<?php
}
?>

	</div>
	<div class="clear"></div>	

</div>