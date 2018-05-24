<?php
require_once("../../config/main.php");
header("content-type: text/html; charset=iso-8859-1");
$URL_ROOT=SEO::get_URLRoot();
$URL_BASE=SEO::get_URLAssets().'website/';

$langID		=1;
$lMenuTop 	=CmsSectionLang::getWebList(4, $langID); //parentSectionID=4 Secciones Principales
$lMenuBottom=CmsSectionLang::getWebList(5, $langID); //parentSectionID=5 Otras Secciones
$lMenuTools =CmsSectionLang::getWebList(2, $langID); //parentSectionID=3 Herramientas

?>
<div class="box_web" id="menu_content">
	<div class="box_top">
		<div class="logo">
			<a href="index.html"><img src="<?php echo $URL_BASE?>images/logo.png"></a>
		</div>
		<div class="menu_top">
			<ul class="lista_menu_top">
				<li class="menu_items"><a href="index.html" class="full"></a>Inicio</li>
				<li class="separacion">I</li>
				<li class="menu_items"><a href="contactenos.html" class="full"></a>Contáctenos</li>
				<li class="buscador">
                    <input id="cse_search" placeholder="Buscar" rel="resultado.html" type="text" />
					<a id="cse_btn" href="#" class="buscador_lupa"><img src="<?php echo $URL_BASE?>images/buscador_lupa.png"></a>
                    <script type="text/javascript">
					$(document).ready(function(){
						$("#cse_btn").click(function(){
							if($("#cse_search").val()!='') location.href=$("#cse_search").attr('rel')+'?q='+$("#cse_search").val();
						});
						$("#cse_search").keypress(function(event){
							if ( event.which == 13 && $(this).val()!='') location.href=$(this).attr('rel')+'?q='+$(this).val();
						});
					});
					</script>
				</li>
			</ul>
			<div class="btn_close_buscador_mobile">
				<img src="<?php echo $URL_BASE?>images/btn_close_buscador_mobile.jpg" alt="">
			</div>			
		</div>
		<div class="lupita_mobile">
			<img src="<?php echo $URL_BASE?>images/lupita_mobile.png">
		</div>
	</div>
	<div class="nav_fondo" id="menu_topper">
		<div class="linea_blanca"></div>

		<div class="btn_sanguche">
			<div class="lineas"></div>
			<div class="lineas"></div>
			<div class="lineas"></div>
		</div>
		<nav>
		 	<ul class="lista_navegador">
		 	<?php
		 	foreach($lMenuTop as $oMenu){
				$lContent=CmsContentLang::getWebList_Menu(0, $oMenu->sectionID, $oMenu->langID);
				$estiloID=XMLParser::getValue($oMenu->parameter, 'estiloID');

				$oLink=new eLink();
				if($oMenu->showContent==0 && $lContent->getLength()>0)
					$oLink=SEO::get_ContentLink($lContent->getItem(0));
				else
					$oLink->url =SEO::get_URLSection($oMenu);
		 		?>
				<li id="<?php echo $estiloID;?>">
					<a href="<?php echo $oLink->url;?>" class="full desktop_link"></a>
					<div class="word">
						<?php echo $oMenu->title;?>
						<div class="barra_on"></div>
					</div>
					<?php
					if($oMenu->sectionID==8){
		 			?>
					<div class="desplegable doble_columna">
						<div class="caja_gris">
						<?php
			 				$i=1;
	 						foreach($lContent as $oSubCat){
								$columna="columna".($i++);
								$oLink=SEO::get_ContentLink($oSubCat);
						?>
							<div class="columna <?php echo $columna;?>">
								<div class="titulo"><a href="<?php echo $oLink->url?>" target="<?php echo $oLink->target?>" class="full"></a><?php echo $oLink->text?></div>
								<ul class="lista_joyeria">
							<?php
								$lItem=CmsContentLang::getWebList_Menu($oSubCat->contentID, $oSubCat->sectionID, $oSubCat->langID);
		 						foreach($lItem as $oItem){
									$oLink=SEO::get_ContentLink($oItem);
							?>
									<li><a href="<?php echo $oLink->url;?>" class="full"></a><?php echo $oLink->text;?></li>
				 			<?php
				 				}
							?>
								</ul>
							</div>
			 			<?php
			 				}
						?>
							<div class="clear"></div>
						</div>
					</div>
		 			<?php
		 				}
		 				else
		 				{
		 					if($lContent->getLength()>0){
					?>
					<div class="desplegable">
						<div class="caja_gris">
							<ul class="lista_submenu">
							<?php
		 						foreach($lContent as $oItem){
									$oLink=SEO::get_ContentLink($oItem);
							?>
								<li><a href="<?php echo $oLink->url;?>" class="full"></a><?php echo $oLink->text;?></li>
							<?php
							}
							?>
							</ul>
						</div>
					</div>
					<?php
							}
						}
					?>
				</li>
		 	<?php
		 	}
		 	?>
		 	<?php
		 	foreach($lMenuBottom as $oMenu){
				$lContent=CmsContentLang::getWebList_Menu(0, $oMenu->sectionID, $oMenu->langID);
				//$estiloID=XMLParser::getValue($oMenu->parameter, 'estiloID');

				$oLink=new eLink();
				if($oMenu->showContent==0 && $lContent->getLength()>0)
					$oLink=SEO::get_ContentLink($lContent->getItem(0));
				else
					$oLink->url =SEO::get_URLSection($oMenu);
		 	?>
				<li class="menu_mobile">
					<a href="<?php echo $oLink->url;?>" class="full"></a>
					<div class="word">
						<?php echo $oMenu->title;?>
					</div>
				</li>
		 	<?php
		 	}
		 	?>
			</ul>
		</nav>
	</div>
</div>
<div class="sombra_nav"></div>
