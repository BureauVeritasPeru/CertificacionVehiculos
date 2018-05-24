<?php
$oItem = new eCrmReportes();

$fechaIni	=OWASP::RequestString('fechaIni');
$fechaFin	=OWASP::RequestString('fechaFin');
$usuarioID  =OWASP::RequestInt('usuarioID');
$tallerID   =OWASP::RequestInt('tallerID');

$MODULE->processFormAction(new CrmReportes(), $oItem);

$DAO=$MODULE->StaticDAO;

$MODULE->FormTitle="Reporte Taller";
?>
