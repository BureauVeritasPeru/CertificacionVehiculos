<?php
$oContent=CmsContentLang::getItem($oItem->contentID, $oItem->sectionID, $oItem->langID);
$url=XMLParser::getValue($oContent->media, 'imagen');
$imagen=!empty($url)? $URL_ROOT.'/userfiles/'.$url: NULL;
?>



<header style="background:url('<?php echo $URL_BASE.'/images/fondo.jpg'; ?>') center">
	<div class="container" id="maincontent" tabindex="-1">
		<div class="row">
			<div class="col-lg-12">
				<img class="img-responsive" src="<?php echo $URL_ROOT; ?>assets/admin/images/logo_bureau.jpg" style="width:15%;margin-bottom:24px;" >
				<div class="intro-text">
					<h1 class="name"><?php echo $oItem->title; ?></h1>
					<hr class="">
					<span class="skills"><?php echo $oItem->subTitle; ?></span>
				</div>
			</div>
		</div>
	</div>
</header>