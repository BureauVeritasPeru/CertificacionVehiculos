<?php
$contentID  =OWASP::RequestInt('pID');
$langID     =OWASP::RequestInt('lID');
$sectionID  =OWASP::RequestInt('sID');
$furl       =OWASP::RequestString('furl'); //URL amigable parametro
$lightbox   =OWASP::RequestBoolean('lightbox'); //Flag para validar la carga de lightbox
$error		=OWASP::RequestString('error'); //Codigo de error

if($langID==NULL) $langID=isset($_SESSION["lID"])? $_SESSION["lID"]: 1; //ESP
if($sectionID==NULL) $sectionID=0; //Default Section (home)

$_SESSION["lID"]=$langID;
?>