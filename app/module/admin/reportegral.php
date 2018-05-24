<?php
$oItem = new eCrmReportes();

$fechaIni	=OWASP::RequestString('fechaIni');
$fechaFin	=OWASP::RequestString('fechaFin');
$usuarioID  =OWASP::RequestInt('usuarioID');
$tallerID   =OWASP::RequestInt('tallerID');
$placa	    =OWASP::RequestString('placa');
$tipoServicio = OWASP::RequestString('tipoServicio');

$MODULE->processFormAction(new CrmReportes(), $oItem);

$DAO=$MODULE->StaticDAO;

$MODULE->FormTitle="Registro";
?>
