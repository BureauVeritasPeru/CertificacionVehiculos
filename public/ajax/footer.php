<?php
require_once("../../config/main.php");
header("content-type: text/html; charset=iso-8859-1");
$URL_ROOT=SEO::get_URLRoot();
$URL_BASE=SEO::get_URLAssets().'website/';
?>
<div class="menu_azul">
	<div class="box_menu_azul">
		<ul class="lista_menu_azul">
			<li class="item_novedades"><a href="novedades.html" class="full">Novedades</a></li>
			<li class="item_servicios"><a href="servicios.html" class="full">Servicios</a></li>
			<li class="item_pedidos"><a href="contactenos.html" class="full">Pedidos Online</a></li>
			<li class="item_envios"><a href="contactenos.html" class="full">Envios al Exterior</a></li>
			<li class="item_ventas"><a href="contactenos.html" class="full">Ventas Corporativas</a></li>
		</ul>
	</div>
</div>
<div class="pie_de_pagina">
	<div class="box">
		<div class="redes">
			<div class="ico"><a href="https://www.facebook.com/ilariaperu" target="_blank"><img src="<?php echo $URL_BASE?>images/footer_ico_facebook.png"></a></div>
			<div class="ico"><a href="https://twitter.com/ilariaperu" target="_blank"><img src="<?php echo $URL_BASE?>images/footer_ico_twiter.png"></a></div>
			<div class="ico"><a href="https://instagram.com/ilaria_peru/" target="_blank"><img src="<?php echo $URL_BASE?>images/footer_ico_instagram.png"></a></div>
		</div>
		<div class="pie_menu">
			Ilaria® Todos los derechos reservados 2015  &nbsp;&nbsp;&nbsp; I  &nbsp;&nbsp;&nbsp;  <a href="terminos.html" class="terminos" 
			data-fancybox-type="iframe">Términos y Condiciones</a> &nbsp;&nbsp;&nbsp; I &nbsp;&nbsp;&nbsp;<a href="mapa-de-sitio.html">Mapa de sitio</a>
		</div>
		<div class="suscripcion">
			<input type="text" value="e-mail">
			<div class="btn_suscribirse">Suscribirse</div>
			<div class="texto">
				Recibe ofertas exclusivas, noticias y mucho más
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
