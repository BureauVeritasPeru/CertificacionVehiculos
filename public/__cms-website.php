<?php
session_start();
//header("content-type: text/html; charset=utf-8");
require_once("../config/main.php");
require_once("../app/include/website/page_request.php");
require_once("../app/include/website/module_request.php");
require_once("../app/include/website/array_termino.php");

require_once("../app/controller/UI_WebSite.php");

//echo "$furl, $contentID, $sectionID, $langID, $Command";
$PAGE=new UI_WebSite($furl, $contentID, $sectionID, $langID, $Command);
$file_module ='../app/module/website/'.$PAGE->module.'.php' ;//Content

$URL_ROOT=SEO::get_URLRoot();
$URL_BASE=SEO::get_URLAssets().'website/';

if (!WebLogin::isLogged()){
	if(isset($PAGE->oSectionLang)){
		if($PAGE->oSectionLang->sectionID != '5' && $PAGE->oSectionLang->sectionID != '6'){
			$file_module ='../app/module/website/'.$PAGE->module.'.php' ;//Content
			if( file_exists( $file_module ) )
				include $file_module ;
			else
				$PAGE->addError( 'No se puede localizar el archivo => ' . $file_module );
			
			if($lightbox) $WEB_TEMPLATE = "website/web_lightbox.php";
			
			include '../app/themes/' . $WEB_TEMPLATE;

			exit;
		}else{
			include '../app/themes/website/web_template.php';
			exit;
		}
	}else{
		include '../app/themes/website/web_template.php';
		exit;
	}	
}
else {
	if($Command == 'logoff'){
        //if(WebLogin::isLogged())
        //    echo "El usuario sali&oacute; del sistema";
		WebLogin::UnregisterUser();
		header('location: '.$URL_ROOT);
		exit;
	}

	$file_module ='../app/module/website/'.$PAGE->module.'.php' ;//Content
	if( file_exists( $file_module ) )
		include $file_module ;
	else
		$PAGE->addError( 'No se puede localizar el archivo => ' . $file_module );
	
	if($lightbox) $WEB_TEMPLATE = "website/web_lightbox.php";
	
	include '../app/themes/' . $WEB_TEMPLATE;

	exit;
}




?>