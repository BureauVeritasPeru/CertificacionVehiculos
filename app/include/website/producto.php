<?php
$url = XMLParser::getValue($oContentLang->media, 'imagen');
$imagen =!empty($url)? '<img src="'.$URL_ROOT.$url.'" />': NULL;
?>
<div class="coleccion">
	<div class="caja_detalle_left">
		<h1><?php echo $oContentLang->title;?></h1>
		<div class="texto">
			<?php echo $oContentLang->description;?>
		</div>

		<div class="item">
			<a href="contactenos.html" class="full"></a>
			<div class="ico"><img src="<?php echo $URL_BASE;?>images/icono_carrito.png"></div>
			<div class="texto">Realizar Pedido</div>
		</div>			
		<!--
		<div class="item">
			<a href="#" class="full"></a>
			<div class="ico"><img src="<?php echo $URL_BASE;?>images/icono_impresora.png"></div>
			<div class="texto">Imprimir</div>
		</div>
		 -->
		<div class="clear"></div>
      <?php
        $sectionID=17;
        $templateID=29; //sociales item (redes sociales)
        $lEnlaceRedes=CmsContentLang::getWebList_Template($templateID, $sectionID, $langID);
            
        foreach( $lEnlaceRedes as $oEnlaceRedes ){ 
			$url = XMLParser::getValue($oContentLang->media, 'imagen');
            $imagenRedes = !empty($url)? '<img src="'.$URL_ROOT.$url.'" alt="'.$oItem->title.'"/>': NULL;
            $urlRedes=XMLParser::getValue($oContentLang->parameter, 'url');

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
		<div class="imagen">
			<?php echo $imagen;?>
		</div>
		<!-- <div class="barra_zoom">
			<div class="btn_zoom">
				<div class="icono_lupa">
					<img src="<?php echo $URL_BASE;?>images/icono_lupa.png">
				</div>
				<div class="texto">zoom</div>

				<div class="clear"></div>
			</div>
			<div class="btn_siguiente"><a href="#wrapper_interna" class="full">Siguiente</a></div>
			<div class="clear"></div>
		</div> -->
		
	</div>
	<div class="clear"></div>	

</div>
