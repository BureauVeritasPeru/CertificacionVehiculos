<?php
$oItem = new eCrmReportes();

$fechaIni	=OWASP::RequestString('fechaIni');
$fechaFin	=OWASP::RequestString('fechaFin');
$usuarioID  =OWASP::RequestInt('usuarioID');
$tallerID   =OWASP::RequestInt('tallerID');
$tipocertID   =OWASP::RequestInt('tipocertID');
$placa	    =OWASP::RequestString('placa');

$MODULE->processFormAction(new CrmReportes(), $oItem);

$DAO=$MODULE->StaticDAO;

$MODULE->FormTitle="Registro";
?>
