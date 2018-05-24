<?php 
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;


$tipo        = OWASP::RequestString('tipo');
$oCert 		 = GnvCertificado::getItem(OWASP::RequestString('nro_certificado'));
$oPrecert 	 = GnvPrecertificado::getItem($oCert->precertID);



switch ($tipo) {
	case 'CERTIFICACIÓN ANUAL':
	DescargaAnual($oPrecert, $oCert);
	break;	
	case 'CERTIFICACIÓN INICIAL':
	DescargaInicial($oPrecert, $oCert);
	break;
	case 'CERTIFICACIÓN ORIGINAL':
	DescargaOriginal($oPrecert, $oCert);
	break;
	default:
	RaiseError('No tiene permisos para estos recursos');
	break;
}



function CambiarTema($var){
	$valor = '';
	switch ($var) {
		case '01':
		$valor = 'Enero';break;
		case '02':
		$valor = 'Febrero';break;
		case '03':
		$valor = 'Marzo';break;
		case '04':
		$valor = 'Abril';break;
		case '05':
		$valor = 'Mayo';break;
		case '06':
		$valor = 'Junio';break;
		case '07':
		$valor = 'Julio';break;
		case '08':
		$valor = 'Agosto';break;
		case '09':
		$valor = 'Septiembre';break;
		case '10':
		$valor = 'Octubre';break;
		case '11':
		$valor = 'Noviembre';break;
		case '12':
		$valor = 'Diciembre';break;
		default:
		$valor = ''; break;
	}

	return $valor;
}

function DescargaAnual($oPrecert, $oCert){
	$oCategoria = CmsParameterLang::getItem($oPrecert->categoriaID, 1);
	$oMarca = CmsParameterLang::getItem($oPrecert->marcaID, 1);
	$oModelo = CmsParameterLang::getItem($oPrecert->modeloID, 1);
	$oCombustible = CmsParameterLang::getItem($oPrecert->combustibleID, 1);    
	$oColor = CmsParameterLang::getItem($oPrecert->colorID, 1);
	$oCompInst   = GnvCompInst::getListByCertificado(OWASP::RequestString('nro_certificado'));

	$oTaller = CrmTaller::getItem($oCert->tallerID);

	setlocale(LC_TIME, 'es_ES.UTF-8');
	$f = $oCert->fechaEmi;
    //$fecha = date("d F Y", strtotime($f));
	$dia = date("d", strtotime($f));
	$mes = date("m", strtotime($f));
	$año = date("Y", strtotime($f));
	$fecha = $dia.' de '.CambiarTema($mes).' de '.$año;
	$f2 = $oCert->fechaVen;
	$fecha2 = date("d/m/Y", strtotime($f2));

	$componentes = '';
	foreach ($oCompInst as $value) {
		$tipoCompID = $value->tipoCompID;
		$marca      = $value->marca;
		$modelo     = $value->modelo;
		$serie      = $value->serie;
	}

	for ($i=0; $i<count($tipoCompID); $i++){
		$tipoComp = CmsParameterLang::getItem($tipoCompID[$i], 1);
		$componentes.='<tr><td>'.$tipoComp->parameterName.'</td><td>'.$marca[$i].'</td><td>'.$modelo[$i].'</td><td>'.$serie[$i].'</td></tr>';
	}

    // instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$html='
	<style>
	body{
		margin:15px;
		margin-bottom:45px;
		font-size:14px;
		font-family: "Helvetica";
	}
	h4{
		font-family: "Helvetica";
	}
	.area1{
		margin-right:10px;
	}

	.parrafo1{
		font-size:12px;
	}
	table{
		border-collapse:collapse;
		font-family: Helvetica;
		font-size: 12px;
	}
	tr,td{
		border:2px solid #000;
		margin:2px;
	}

	.td_1{
		text-align: center;
	}

	.parrafo2{
		font-size:10.5px;
	}

	.parrafo3{
		font-size:10px;
		font-style: italic;
	}
	ol{
		list-style-type: lower-latin;
	}
	</style>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>ANUAL GNV</title>
	</head>
	<body>
	<p style="margin-bottom:-13px;">&nbsp;</p>
	<div class="area1">
	<p style="text-align: left;margin-left:480px;">'.$fecha.'</p>
	<p style="text-align: left;margin-left:480px;"><strong>'.$oTaller->per.'-'.$oCert->certificadoID.'</strong></p>
	</div>
	<h4 style="text-align: center;line-height: 0.2px;text-decoration: underline;">CERTIFICADO DE INSPECCION ANUAL DEL</h4>
	<h4 style="text-align: center;line-height: 0.2px;text-decoration: underline;">VEHÍCULO A GNV</h4>
	<p><strong>BUREAU VERITAS DEL PER&Uacute; S.A:</strong></p>
	<p style="line-height: 0.2px;"><strong>CERTIFICA :</strong></p>
	<p class="parrafo1">Haber efectuado la evaluaci&oacute;n de las condiciones de seguridad del sistema de combusti&oacute;n a Gas Natural Vehicular GNV en el Taller de Conversi&oacute;n Autorizado '.$oTaller->razonSocial.' al siguiente veh&iacute;culo(*1):</p>
	<table width="100%">
	<tbody>
	<tr>
	<td class="td_1">1</td>
	<td width="17%">Placa de rodaje</td>
	<td width="25%">'.$oPrecert->placa.'</td>
	<td class="td_1" width="3.5%">9</td>
	<td width="25%">Cilindros / Cilindrada (cm3)</td>
	<td width="29%">'.$oPrecert->cilindros.' / '.$oPrecert->cilindrada.'</td>
	</tr>
	<tr>
	<td class="td_1">2</td>
	<td>Categor&iacute;a</td>
	<td>'.$oCategoria->parameterName.'</td>
	<td class="td_1">10</td>
	<td >Combustible</td>
	<td>'.$oCombustible->parameterName.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3.5%">3</td>
	<td>Marca</td>
	<td>'.$oMarca->parameterName.'</td>
	<td class="td_1">11</td>
	<td>Nro. Ejes / Nro. Ruedas</td>
	<td>'.$oPrecert->ejes.' / '.$oPrecert->ruedas.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">4</td>
	<td>Modelo</td>
	<td>'.$oModelo->parameterName.'</td>
	<td class="td_1">12</td>
	<td >Nro. Asientos / Pasajeros</td>
	<td>'.$oPrecert->asientos.' / '.$oPrecert->pasajeros.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">5</td>
	<td>Versi&oacute;n</td>
	<td>'.$oPrecert->version.'</td>
	<td class="td_1">13</td>
	<td >Largo / Ancho / Alto (cm)</td>
	<td>'.$oPrecert->largo.' / '.$oPrecert->ancho.' / '.$oPrecert->alto.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">6</td>
	<td>A&ntilde;o Fabricaci&oacute;n</td>
	<td>'.$oPrecert->ano_fab.'</td>
	<td class="td_1" >14</td>
	<td>Color(es)</td>
	<td>'.$oColor->parameterName.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">7</td>
	<td>Nro. Serie</td>
	<td>'.$oPrecert->serie.'</td>
	<td class="td_1" >15</td>
	<td>Peso Neto (Kgr)</td>
	<td>'.$oPrecert->pesoNeto.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">8</td>
	<td>Nro. de Motor</td>
	<td>'.$oPrecert->motor.'</td>
	<td class="td_1">16</td>
	<td>Peso Bruto Vehicular (Kgr)</td>
	<td>'.$oPrecert->pesoBruto.'</td>
	</tr>
	</tbody>
	</table>
	<div class="parrafo2">
	<p style="margin-bottom: -8px;margin-top: 10px;font-size:13px;">Habiendose verificado que:</p>
	<ol style="margin-left:-26px;">
	<li>El equipo completo instalado en el veh&iacute;culo est&aacute; compuesto con los elementos, partes y piezas registradas en la base de datos del Sistema de Control de Carga de GNV.</li>
	<li>El cilindro y el Kit de montaje no han sido alterados ni se encuentran deteriorados por el uso ni han sido cambiados.</li>
	<li>Cada uno de los componentes est&aacute;n instalados de manera segura, incluyendo las  tuber&iacute;as de alta y baja presi&oacute;n, y que dichos componentes est&eacute;n ubicados en los sitios originales.</li>
	<li>No existan fugas en los empalmes o uniones.</li>
	<li>Los elementos de cierre act&uacute;en herm&eacute;ticamente.</li>
	<li>El Sistema de combusti&oacute;n a GNV responda a las caracter&iacute;sticas originales recomendadas por el fabricante del veh&iacute;culo o proveedor de equipos completos - PEC.</li>
	<li>Los controles ubicados en el tablero del veh&iacute;culo respondan a las exigencias para los cuales fueron montados.</li>
	<li>Las exigencias sobre ventilaci&oacute;n en las distintas zonas de instalaci&oacute;n no han sido alteradas, y dem&aacute;s exigencias establecidas por la normativa vigente en la materia.</li>
	</ol>
	<p style="font-size:13px;">Conste por el presente documento que el sistema de combusti&oacute;n a Gas Natural Vehicular -GNV del veh&iacute;culo antes referido, no afectan negativamente la seguridad(*2) del mismo, el tr&aacute;nsito terrestre, el medio ambiente o incunmple con las condiciones t&eacute;cnicas(*4) establecidas en la norma vigente en la materia, habilit&aacute;ndose al mismo para cargar Gas Natural Vehicular -GNV, por un(1) año a partir de la fecha de emisión de este certificado.</p>
	</div>
	<p style="margin-top: -5px;margin-bottom: -15px;"><strong>OBSERVACIONES:</strong></p>
	<div class="parrafo3">
	<p style="margin-top:-10px;margin-bottom:-1px;">(*1) Numerales 1 al 16, obtenidos de la tarjeta de propiedad del veh&iacute;culo y/o suministrados por el cliente, por tal motivo deber&aacute;n ser verificados por el cliente antes de iniciar cualquier tr&aacute;mite con este certificado</p>
	<p style="margin-top:-10px;margin-bottom:-1px;">(*2)y(*4) Las condiciones t&eacute;cnicas y de seguridad verificadas en el veh&iacute;culo corresponden a las expuestas en la NTP 111.015 y Directiva 001 2005 MTC.</p>
	<p style="margin-top:-10px;margin-bottom:-1px;">La sigla "NE" significa "Dato no especificado o no coherente en los documentos o plaqueta del veh&iacute;culo".</p>
	<p style="margin-top:-10px;margin-bottom:-1px;">Es obligaci&oacute;n del propietario del veh&iacute;culo convertido a GNV presentarlo anualmente a la entidad certificadora para su certificaci&oacute;n anual.</p>
	</div>
	<p style="margin-top:-12px;margin-bottom:-1px;font-size:10.5px;"><strong>ESTE CERTIFICADO TIENE VALIDEZ DE UN (01) AÑO A PARTIR DE LA FECHA DE EMISIÓN</strong></p>

	<p>&nbsp;</p>
	<p style="font-size:13px;">Se expide el presente certificado en la ciudad de Lima, el d&iacute;a '.$fecha.'</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p style="text-align: center;font-size:11px;"><strong>PROHIBIDA LA REPRODUCCI&Oacute;N DEL PRESENTE DOCUMENTO SIN AUTORIZACI&Oacute;N DE BUREAU VERITAS DEL PER&Uacute; S.A.</strong></p>
	</body>
	</html>';
	$dompdf->loadHtml($html,'UTF-8');

    // (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
	$dompdf->render();
    // Output the generated PDF to Browser
	$dompdf->stream('Certificado_Anual_gnv_'.$oTaller->per.'_'.$oCert->certificadoID, array("Attachment" => false));
}

function DescargaInicial($oPrecert, $oCert){
	$oCategoria = CmsParameterLang::getItem($oPrecert->categoriaID, 1);
	$oMarca = CmsParameterLang::getItem($oPrecert->marcaID, 1);
	$oModelo = CmsParameterLang::getItem($oPrecert->modeloID, 1);
	$oCombustible = CmsParameterLang::getItem($oPrecert->combustibleID, 1);
	$oColor = CmsParameterLang::getItem($oPrecert->colorID, 1);
	$oCompInst   = GnvCompInst::getListByCertificado(OWASP::RequestString('nro_certificado'));

	$oTaller = CrmTaller::getItem($oCert->tallerID);

	setlocale(LC_TIME, 'es_ES.UTF-8');
	$f = $oCert->fechaEmi;
    //$fecha = date("d F Y", strtotime($f));
	$dia = date("d", strtotime($f));
	$mes = date("m", strtotime($f));
	$año = date("Y", strtotime($f));
	$fecha = $dia.' de '.CambiarTema($mes).' de '.$año;
	$f2 = $oCert->fechaVen;
	$fecha2 = date("d/m/Y", strtotime($f2));

	$componentes = '';
	foreach ($oCompInst as $value) {
		$tipoCompID = $value->tipoCompID;
		$marca      = $value->marca;
		$capacidad  = $value->capacidad;
		$mes_fab    = $value->mes_fab;
		$ano_fab    = $value->ano_fab;
	}
	

	for ($i=0; $i<count($tipoCompID); $i++){
		$tipoComp = CmsParameterLang::getItem($tipoCompID[$i], 1);
		$componentes.='<tr><td>'.$tipoComp->parameterName.'</td><td>'.$marca[$i].'</td><td>'.$capacidad[$i].'</td><td>'.$mes_fab[$i].'/'.$ano_fab[$i].'</td></tr>';
	}

    // instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$html='
	<style>
	body{
		margin:15px;
		margin-bottom:45px;
		font-size:14px;
		font-family: "Helvetica";
	}
	h4{
		font-family: "Helvetica";
	}
	.area1{
		margin-right:10px;
	}

	.parrafo1{
		font-size:12px;
	}
	table{
		border-collapse:collapse;
		font-family: Helvetica;
		font-size: 12px;
	}
	tr,td{
		border:2px solid #000;
		margin:2px;
	}

	.td_1{
		text-align: center;
	}

	.parrafo2{
		font-size:10.5px;
	}

	.parrafo3{
		font-size:10px;
		font-style: italic;
	}
	ol{
		list-style-type: lower-latin;
	}

	</style>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>INICIAL GNV</title>
	</head>
	<body>
	<p style="margin-bottom:-13px;">&nbsp;</p>
	<div class="area1">
	<p style="text-align: left;margin-left:480px;">'.$fecha.'</p>
	<p style="text-align: left;margin-left:480px;"><strong>'.$oTaller->per.'-'.$oCert->certificadoID.'</strong></p>
	</div>
	<h4 style="text-align: center;line-height: 0.2px;text-decoration: underline;">CERTIFICADO DE CONFORMIDAD</h4>
	<h4 style="text-align: center;margin-top: -5px;text-decoration: underline;">DE CONVERSI&Oacute;N A GNV</h4>
	<p><strong>BUREAU VERITAS DEL PER&Uacute; S.A:</strong></p>
	<p style="line-height: 0.2px;"><strong>CERTIFICA :</strong></p>
	<p class="parrafo1">Haber efectuado la evaluaci&oacute;n de las condiciones de seguridad(*1) respecto de la conversi&oacute;n del sistema de combustión a Gas Natural Vehicular - GNV efectuada por el Taller de Conversi&oacute;n de Conversión Autorizado '.$oTaller->razonSocial.' al siguiente veh&iacute;culo:</p>
	<table width="100%">
	<tbody>
	<tr>
	<td class="td_1" width="4px">2</td>
	<td>Placa de rodaje</td>
	<td >'.$oPrecert->placa.'</td>
	<td class="td_1" width="4px" >10</td>
	<td>Cilindros / Cilindrada (cm3)</td>
	<td>'.$oPrecert->cilindros.' / '.$oPrecert->cilindrada.'</td>
	</tr>
	<tr>
	<td class="td_1">3</td>
	<td>Categor&iacute;a</td>
	<td>'.$oCategoria->parameterName.'</td>
	<td class="td_1">11</td>
	<td >Combustible</td>
	<td>'.$oCombustible->parameterName.'</td>
	</tr>
	<tr>
	<td class="td_1">4</td>
	<td>Marca</td>
	<td>'.$oMarca->parameterName.'</td>
	<td class="td_1">12</td>
	<td>Nro. Ejes / Nro. Ruedas</td>
	<td>'.$oPrecert->ejes.' / '.$oPrecert->ruedas.'</td>
	</tr>
	<tr>
	<td class="td_1">5</td>
	<td>Modelo</td>
	<td>'.$oModelo->parameterName.'</td>
	<td class="td_1">13</td>
	<td >Nro. Asientos / Pasajeros</td>
	<td>'.$oPrecert->asientos.' / '.$oPrecert->pasajeros.'</td>
	</tr>
	<tr>
	<td class="td_1" >6</td>
	<td>Versi&oacute;n</td>
	<td>'.$oPrecert->version.'</td>
	<td class="td_1">14</td>
	<td >Largo / Ancho / Alto (cm)</td>
	<td>'.$oPrecert->largo.' / '.$oPrecert->ancho.' / '.$oPrecert->alto.'</td>
	</tr>
	<tr>
	<td class="td_1">7</td>
	<td>A&ntilde;o Fabricaci&oacute;n</td>
	<td>'.$oPrecert->ano_fab.'</td>
	<td class="td_1" >15</td>
	<td>Color(es)</td>
	<td>'.$oColor->parameterName.'</td>
	</tr>
	<tr>
	<td class="td_1">8</td>
	<td>Nro. Serie</td>
	<td>'.$oPrecert->serie.'</td>
	<td class="td_1" >16</td>
	<td>Peso Neto (Kgr)</td>
	<td>'.$oPrecert->pesoNeto.'</td>
	</tr>
	<tr>
	<td class="td_1">9</td>
	<td>Nro. de Motor</td>
	<td>'.$oPrecert->motor.'</td>
	<td class="td_1">17</td>
	<td>Peso Bruto Vehicular (Kgr)</td>
	<td>'.$oPrecert->pesoBruto.'</td>
	</tr>
	</tbody>
	</table>
	<p class="parrafo1">Habiendose instalado al mismo los siguientes componentes que permiten la combusti&oacute;n a GLP:</p>
	<table width="100%">
	<tbody>
	<tr>
	<td width="20%">Componente</td>
	<td width="25%">Marca</td>
	<td width="25%">Capacidad</td>
	<td width="25%">Fecha Fabricación</td>
	</tr>
	'.$componentes.'
	</tbody>
	</table>
	<p class="parrafo1">Como consecuencia de la conversi&oacute;n del sistema de combusti&oacute;n a GLP, las caracter&iacute;sticas originales del veh&iacute;culo se han modificado de la siguiente manera:</p>
	<table width="100%">
	<tbody>
	<tr>
	<td width="3%">11</td>
	<td width="17%">Combustible</td>
	<td width="80%">'.$oPrecert->combustibleMod.'</td>
	</tr>
	<tr>
	<td>15</td>
	<td>Peso Neto (Kgr)</td>
	<td>'.$oPrecert->pesoNetoMod.'</td>
	</tr>
	<tr>
	<td>17</td>
	<td>Carga &Uacute;til (Kgr)</td>
	<td>'.$oPrecert->cargaUtilMod.'</td>
	</tr>
	</tbody>
	</table>
	<p class="parrafo1">Asimismo se certifica que la conversión del sistema de combustión a Gas Natural Vehicular - GNV efectuada al vehículo antes referido no afecta
	negativamente la seguridad del mismo(*2), el tránsito terrestre, el medio ambiente o incumple las condiciones técnicas establecidas en la
	normativa vigente en la materia. (*4)
	</p>
	<p style="margin-top: -5px;margin-bottom: -9px;"><strong>OBSERVACIONES:</strong></p>
	<div class="parrafo3">
	<p style="margin-bottom: -5px;">(*) Numerales 1 al 17, obtenidos de la tarjeta de propiedad del veh&iacute;culo y/o suministrados por el cliente, por tal motivo deber&aacute;n ser verificados por el cliente antes de iniciar cualquier tr&aacute;mite con este certificado</p>
	<p style="margin-bottom: -5px;">(*1)y(*2) Las condiciones verificadas en el veh&iacute;culo corresponden a las expuestas en la NTP 321.115 y Directiva 005 2007 MTC. excepto las contenidas en el numero 5.6.3.1 de la directiva mencionada y referentes a la aprobaci&oacute;n de equipos y autorizaci&oacute;n de talleres, debido a los plazos otrogados en los Art&iacute;culos 4 y 5 de la RD14540-2007-MTC/15 o a la imposibilidad de realizar el tr&aacute;mite por inexistencia del mismo ante las entidades competentes. De encontrase la sigla "NE", esta significa "Dato no especificado en los documentos o plaqueta del veh&iacute;culo.</p>
	<p style="margin-bottom: -5px;">(*3) Capacidad en litros aproximada a la unidad m&aacute;s cercana, puede diferir de la capacidad nominal especificada por el fabricante.</p>
	</div>
	<p>&nbsp;</p>
	<p class="parrafo2">Se expide el presente certificado en la ciudad de Lima, el d&iacute;a '.$fecha.'</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p style="text-align: center;font-size:11px;"><strong>PROHIBIDA LA REPRODUCCI&Oacute;N DEL PRESENTE DOCUMENTO SIN AUTORIZACI&Oacute;N DE BUREAU VERITAS DEL PER&Uacute; S.A.</strong></p>
	</body>
	</html>';
	$dompdf->loadHtml($html,'UTF-8');

// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
	$dompdf->render();
// Output the generated PDF to Browser
	$dompdf->stream('Certificado_Inicial_gnv_'.$oTaller->per.'_'.$oCert->certificadoID, array("Attachment" => false));
}


function DescargaOriginal($oPrecert, $oCert){

	$oCategoria = CmsParameterLang::getItem($oPrecert->categoriaID, 1);
	$oMarca = CmsParameterLang::getItem($oPrecert->marcaID, 1);
	$oModelo = CmsParameterLang::getItem($oPrecert->modeloID, 1);
	$oCombustible = CmsParameterLang::getItem($oPrecert->combustibleID, 1);
	$oColor = CmsParameterLang::getItem($oPrecert->colorID, 1);
	$oCompInst   = GnvCompInst::getListByCertificado(OWASP::RequestString('nro_certificado'));

	$oTaller = CrmTaller::getItem($oCert->tallerID);

	setlocale(LC_TIME, 'es_ES.UTF-8');
	$f = $oCert->fechaEmi;
    //$fecha = date("d F Y", strtotime($f));
	$dia = date("d", strtotime($f));
	$mes = date("m", strtotime($f));
	$año = date("Y", strtotime($f));
	$fecha = $dia.' de '.CambiarTema($mes).' de '.$año;
	$f2 = $oCert->fechaVen;
	$fecha2 = date("d/m/Y", strtotime($f2));

	$componentes = '';
	foreach ($oCompInst as $value) {
		$tipoCompID = $value->tipoCompID;
		$marca      = $value->marca;
		$modelo     = $value->modelo;
		$serie      = $value->serie;
	}
	

	for ($i=0; $i<count($tipoCompID); $i++){
		$tipoComp = CmsParameterLang::getItem($tipoCompID[$i], 1);
		$componentes.='<tr><td>'.$tipoComp->parameterName.'</td><td>'.$marca[$i].'</td><td>'.$modelo[$i].'</td><td>'.$serie[$i].'</td></tr>';
	}

    // instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$html='
	<style>
	body{
		margin:15px;
		margin-bottom:45px;
		font-size:14px;
		font-family: "Helvetica";
	}
	h4{
		font-family: "Helvetica";
	}
	.area1{
		margin-right:10px;
	}

	.parrafo1{
		font-size:12px;
	}
	table{
		border-collapse:collapse;
		font-family: Helvetica;
		font-size: 12px;
	}
	tr,td{
		border:2px solid #000;
		margin:2px;
	}

	.td_1{
		text-align: center;
	}

	.parrafo2{
		font-size:10.5px;
	}

	.parrafo3{
		font-size:10px;
		font-style: italic;
	}
	ol{
		list-style-type: lower-latin;
	}
	</style>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>ORIGINAL GLP</title>
	</head>
	<body>
	<p style="margin-bottom:-13px;">&nbsp;</p>
	<div class="area1">
	<p style="text-align: left;margin-left:480px;">'.$fecha.'</p>
	<p style="text-align: left;margin-left:480px;"><strong>'.$oTaller->per.'-'.$oCert->certificadoID.'</strong></p>
	</div>
	<h4 style="text-align: center;line-height: 0.2px;text-decoration: underline;">CERTIFICADO DE INSPECCI&Oacute;N DE VEHICULO ORIGINAL A GLP</h4>
	<p><strong>BUREAU VERITAS DEL PER&Uacute; S.A:</strong></p>
	<p style="line-height: 0.2px;"><strong>CERTIFICA :</strong></p>
	<p class="parrafo1">Haber efectuado la evaluaci&oacute;n de las condiciones de seguridad(*1) respecto del sistema de combusti&oacute;n a Gas Licuado del Petroleo - GLP en Taller de Conversi&oacute;n a GLP Autorizado al siguiente veh&iacute;culo:</p>
	<table width="100%">
	<tbody>
	<tr>
	<td class="td_1">2</td>
	<td>Placa de rodaje</td>
	<td width="40%">'.$oPrecert->placa.'</td>
	<td class="td_1" width="1%">10</td>
	<td width="30%">Cilindros / Cilindrada (cm3)</td>
	<td width="29%">'.$oPrecert->cilindros.' / '.$oPrecert->cilindrada.'</td>
	</tr>
	<tr>
	<td class="td_1">3</td>
	<td>Categor&iacute;a</td>
	<td>'.$oCategoria->parameterName.'</td>
	<td class="td_1">11</td>
	<td >Combustible</td>
	<td>'.$oCombustible->parameterName.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">4</td>
	<td>Marca</td>
	<td>'.$oMarca->parameterName.'</td>
	<td class="td_1">12</td>
	<td>Nro. Ejes / Nro. Ruedas</td>
	<td>'.$oPrecert->ejes.' / '.$oPrecert->ruedas.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">5</td>
	<td>Modelo</td>
	<td>'.$oModelo->parameterName.'</td>
	<td class="td_1">13</td>
	<td >Nro. Asientos / Pasajeros</td>
	<td>'.$oPrecert->asientos.' / '.$oPrecert->pasajeros.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">6</td>
	<td>Versi&oacute;n</td>
	<td>'.$oPrecert->version.'</td>
	<td class="td_1">14</td>
	<td >Largo / Ancho / Alto (cm)</td>
	<td>'.$oPrecert->largo.' / '.$oPrecert->ancho.' / '.$oPrecert->alto.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">7</td>
	<td>A&ntilde;o Fabricaci&oacute;n</td>
	<td>'.$oPrecert->ano_fab.'</td>
	<td class="td_1" >15</td>
	<td>Peso Neto (Kgr)</td>
	<td>'.$oPrecert->pesoNeto.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">8</td>
	<td>Nro. Serie</td>
	<td>'.$oPrecert->serie.'</td>
	<td class="td_1" >16</td>
	<td>Peso Bruto Vehicular (Kgr)</td>
	<td>'.$oPrecert->pesoBruto.'</td>
	</tr>
	<tr>
	<td class="td_1" width="3%">9</td>
	<td>Nro. de Motor</td>
	<td>'.$oPrecert->motor.'</td>
	<td class="td_1">17</td>
	<td>Carga &Uacute;til (Kgr)</td>
	<td>'.$oPrecert->cargaUtil.'</td>
	</tr>
	</tbody>
	</table>
	<p class="parrafo1">Que cuenta con los siguientes componentes que permiten la combustion a GLP:</p>
	<table width="100%">
	<tbody>
	<tr>
	<td width="20%">Componente</td>
	<td width="25%">Marca</td>
	<td width="25%">Modelo</td>
	<td width="25%">Nro. Serie</td>
	</tr>
	'.$componentes.'
	</tbody>
	</table>
	<div class="parrafo2">
	<p>Coste por el presente documento que el sistema de combusti&oacute;n a Gas Licuado de Petroleo -GLP del veh&iacute;culo antes referido, no afecta negativamente la seguridad del mismo, el transito terrestre, el medio ambiente o incunmple con las condiciones t&eacute;cnicas(*2) establecidas en la norma vigente en la materia, seg&uacute;n consta en el expediente t&eacute;cnico No.PER-311/13-346-'.$oCert->certificadoID.' , habilitandose al mismo para cargar Gas Licuado de Petroleo-GLP, hasta el '.$fecha2.'</p>
	</div>
	<p style="margin-top: -5px;margin-bottom: -9px;"><strong>OBSERVACIONES:</strong></p>
	<div class="parrafo2">
	<p>La inspecci&oacute;n del veh&iacute;culo fue realizada en el taller '.$oTaller->razonSocial.'</p>
	</div>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p style="text-align: center;font-size:11px;"><strong>PROHIBIDA LA REPRODUCCI&Oacute;N DEL PRESENTE DOCUMENTO SIN AUTORIZACI&Oacute;N DE BUREAU VERITAS DEL PER&Uacute; S.A.</strong></p>
	</body>
	</html>';
	$dompdf->loadHtml($html,'UTF-8');

// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
	$dompdf->render();
// Output the generated PDF to Browser
	$dompdf->stream('Certificado_Original_gnv'.$oTaller->per.'_'.$oCert->certificadoID, array("Attachment" => false));
}


//////////////////////////////////////////////////////////////////////////////////////////////
function Response($msg){
	echo json_encode(array('retval'=>'1', 'message'=>$msg));
	exit;
	return;
}


function RaiseError($msg){
	echo json_encode(array('retval'=>'0', 'message'=>$msg));
	exit;
	return;
}
?>