

<?php
$langID		=1;
$lMenuUser 	 =CmsSectionLang::getWebList(4, $langID); //parentSectionID=4 Secciones Principales
$lMenuClient =CmsContentLang::getWebList(0,1, $langID); //parentSectionID=5 Pagina Principal 

?>
<!-- lista de la seccion pagina principal -->


<?php
$oUser=WebLogin::getUserSession();
if(isset($oUser)){
	$count = 0;
	foreach($lMenuUser as $oRegistro){
		$count++;
		$menu_activo=isset($oSectionLang) && $oRegistro->sectionID==$oSectionLang->sectionID ? 'active' : null;
		$oLink=new eLink();
		$oLink->url =SEO::get_URLSection($oRegistro);
		if($count==1){
			?>
			<li <?php if(!isset($oSectionLang)){echo 'class="active"';}else{echo '';} ?> >
				<a class="page-scroll" href="<?php echo SEO::get_URLHome();?>" >Inicio </a>
			</li>
			<?php } ?>
			<?php if(($oRegistro->sectionID == 5 && $oUser->glp != 0) || ($oRegistro->sectionID == 6 && $oUser->gnv != 0) || ($oRegistro->sectionID == 7 && $oUser->consulta_glp != 0) || ($oRegistro->sectionID == 8 && $oUser->consulta_gnv != 0) || ($oRegistro->sectionID == 9 && $oUser->reportes != 0)){ ?>
			<li class="<?php echo $menu_activo; ?>"><a class="page-scroll" href="<?php echo $oLink->url; ?>"><?php echo $oRegistro->title; ?></a>
				<?php } ?>
				<?php } ?>
				<li>
					<a class="page-scroll" href="<?php echo SEO::get_URLHome();?>"> |&nbsp;&nbsp; Bienvenido <?php echo $oUser->firstName; ?> <?php echo $oUser->lastName; ?> </a>
				</li>
				<li>
					<a class="page-scroll" href="<?php echo SEO::get_URLHome();?>?cmd=logoff">Cerrar Sesion</a>
				</li>
				<?php 
			}else{ ?>
			<?php 
			foreach($lMenuClient as $oClient){
				switch($oClient->templateID){
					case 14:
					?>
					<li class="hidden">
						<a href="#page-top"></a>
					</li>
					<?php
					$lDetail =CmsContentLang::getWebList(1,1, $langID);
					foreach ($lDetail as $det) {
						if($det->isPage != 0){
							?>
							<li>
								<a class="page-scroll white" href="#<?php echo trim($det->title); ?>"><?php echo $det->title; ?></a>
							</li>
							<?php
						}
					}
				}
			}?>
			<li>
				<a class="page-scroll white"  href="#login" data-toggle="modal">Log In</a>
			</li>
			<?php } ?>


