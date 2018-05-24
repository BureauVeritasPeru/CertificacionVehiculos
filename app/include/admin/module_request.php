<?php

$moduleID	= OWASP::RequestInt('moduleID');
$FormView	= OWASP::RequestString('FormView');
$Command	= OWASP::RequestString('Command');

$Page		= OWASP::RequestInt('Page');
$OrderBy	= OWASP::RequestString('OrderBy');
$callback	= OWASP::RequestBoolean('callback');

$kID		= OWASP::RequestInt('kID');
$OrderBy	= OWASP::RequestString('OrderBy');

if(!isset($moduleID))   $moduleID = 0; //Index module
?>