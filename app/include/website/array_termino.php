<?php
//$baseTermImg="../".$userFiles["Denuncia"]["imagen"];
$arrTerm=array();

foreach(CmsTerminoLang::getWebList(0, $langID) as $obj)
	$arrTerm[$obj->varName]=$obj->terminoName;
?>