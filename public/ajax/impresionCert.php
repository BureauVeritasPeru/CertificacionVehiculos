<?php 
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;


$tipo        = OWASP::RequestString('tipo');
$oCert 		 = GlpCertificado::getItem(OWASP::RequestString('nro_certificado'));
$oPrecert = GlpPrecertificado::getItem($oCert->precertID);



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
	$oCompInst   = GlpCompInst::getListByCertificado(OWASP::RequestString('nro_certificado'));

	$oTaller = CrmTaller::getItem($oCert->tallerID);
	$oClienteCert = CrmClienteCert::getList($oCert->precertID);

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
		$ano_fab    = $value->ano_fab;
		$mes_fab 	= $value->mes_fab;
		$capacidad  = $value->capacidad;
	}
	

	for ($i=0; $i<count($tipoCompID); $i++){
		$tipoComp = CmsParameterLang::getItem($tipoCompID[$i], 1);
		if($tipoComp->parameterName == 'REGULADOR'){
			$componentes.='<tr><td>'.$tipoComp->parameterName.'</td><td>'.$marca[$i].'</td><td>'.$modelo[$i].'</td><td>'.$serie[$i].'</td></tr>';
		}else{
			$componentes.='<tr><td>'.$tipoComp->parameterName.'</td><td>'.$marca[$i].'</td><td>'.$capacidad[$i].' Lt(*3) - '.$mes_fab[$i].'/'.$ano_fab[$i].'</td><td>'.$serie[$i].'</td></tr>';
		}
	}
	$count=0;
	$fred='';
	foreach ($oClienteCert as $var) {
		$count++;
		$oCliente = CrmCliente::getItem($var->clienteID);
		if($count==1){
			$fred = $oCliente->name.' '.$oCliente->lastname;
		}else{
			$fred .= ' / '.$oCliente->name.' '.$oCliente->lastname;
		}

	}

    // instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$html='
	<style>
	body{
		margin:15px;
		margin-bottom:45px;
		font-size:14px;
		font-family: Helvetica;
	}
	.area1{
		margin-right:10px;
	}

	.parrafo1{
		font-size:11px;
	}
	table{
		border-collapse:collapse;
		font-family: Helvetica;
		font-size: 11px;
	}
	tr,td{
		border:1px solid #000;
		margin:2px;
	}

	.td_1{
		text-align: center;
	}

	.parrafo2{
		font-size:9px;
	}

	.parrafo3{
		font-size:9px;
		font-style: italic;
	}

	</style>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>ANUAL GLP</title>
	</head>
	<body>
	<p >&nbsp;</p>
	<div class="area1">
	<p style="text-align: left;margin-left:480px;">'.$fecha.'</p>
	<p style="text-align: left;margin-left:480px;"><strong>PER-'.$oTaller->per.'-'.$oCert->certificadoID.'</strong></p>
	</div>
	<h4 style="text-align: center;line-height: 0.2px;text-decoration: underline;">CERTIFICADO DE INSPECCION DEL VEHICULO A GLP</h4>
	<p><strong>Tipo de Certificaci&oacute;n: ANUAL</strong></p>
	<p><strong>BUREAU VERITAS DEL PER&Uacute; S.A:</strong></p>
	<p><strong>CERTIFICA :</strong><br><t class="parrafo1">Haber efectuado la evaluaci&oacute;n de las condiciones de seguridad(*1) respecto de la conversi&oacute;n del sistema de combusti&oacute;n a Gas Licuado del Petroleo GLP efectuada por el Taller de ConveJurrsi&oacute;n a GLP Autorizado '.$oTaller->razonSocial.' al siguiente veh&iacute;culo:</t></p>	
	<table width="100%">
	<tbody>
	<tr>
	<td class="td_1" width="3%">1</td>
	<td>Propietario</td>
	<td colspan="4">'.$fred .'</td>
	</tr>
	<tr>
	<td class="td_1">2</td>
	<td>Placa de rodaje</td>
	<td>'.$oPrecert->placa.'</td>
	<td class="td_1" width="3%">10</td>
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
	<td class="td_1">6</td>
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
	<td>Peso Neto (Kgr)</td>
	<td>'.$oPrecert->pesoNeto.'</td>
	</tr>
	<tr>
	<td class="td_1">8</td>
	<td>Nro. Serie</td>
	<td>'.$oPrecert->serie.'</td>
	<td class="td_1" >16</td>
	<td>Peso Bruto Vehicular (Kgr)</td>
	<td>'.$oPrecert->pesoBruto.'</td>
	</tr>
	<tr>
	<td class="td_1">9</td>
	<td>Nro. de Motor</td>
	<td>'.$oPrecert->motor.'</td>
	<td class="td_1">17</td>
	<td>Carga &Uacute;til (Kgr)</td>
	<td>'.$oPrecert->cargaUtil.'</td>
	</tr>
	</tbody>
	</table>
	<p style="margin-bottom:8px;margin-top: 5px;font-size:12px">Habiendose instalado al mismo los siguientes componentes que permiten la combusti&oacute;n a GLP:</p>
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
	<p style="margin:7px 0 0 -10px;">Habiendose verificado que:</p>
	<ol style="margin-left:-28px;margin-top:-10px;">
	<li>El sistema de combusti&oacute;n a GLP (cilindro y kit de conversi&oacute;n) responde a las caracteristicas originales recomendadas por el fabricante de veh&iacute;culo y/o el Proveedor de Equipo Completos de Conversi&oacute;n a GLP (PEC_GLP), cumple con la Norma T&eacute;cnica Peruana NTP 321.115:2003 y su montaje cumple las exigencias sobre ventilaci&oacute;n en las distintas zonas de instalaci&oacute;n.</li>
	<li>El vaporizador/regulador cuenta con un sistema de coret de gas autom&aacute;tico, en caso que el motor deje de funcionar.</li>
	<li>El tanque de almacenamiento de GLP ha sido fabricado bajo normas ASME Secci&oacute;n VIII y cumple con las normas dictadas para recipientes a presi&oacute;n, asimismo,  cuenta con una v&aacute;lvula check en la entrada del gas, un limitador  autom&aacute;tico  de carga al 80%., una v&aacute;lvula de exceso a presi&oacute;n  y una v&aacute;lvula de exceso de flujo.</li>
	<li>Los accesorios  e insumos  (mangueras,  tuber&iacute;as y v&aacute;lvulas) utilizados en la instalaci&oacute;n   han sido certificados  para el uso del  GLP.</li>
	<li>Los equipos  y accesorios  utilizados en la modificaci&oacute;n  para uso de GLP cumplen  con la NTP 321.115.2003.</li>
	<li>No existan fugas en los empalmes o uniones y los elementos de cierre act&uacute;an herm&eacute;ticamente.</li>
	<li>Los controles ubicados en el tablero del veh&iacute;culo responden a las exigencias para los cuales fueron montados.</li>
	</ol>
	<p>Coste por el presente documento que el sistema de combusti&oacute;n a Gas Licuado de Petroleo -GLP del veh&iacute;culo antes referido, no afecta negativamente la seguridad del mismo, el transito terrestre, el medio ambiente o incunmple con las condiciones t&eacute;cnicas(*2) establecidas en la norma vigente en la materia, seg&uacute;n consta en el expediente t&eacute;cnico No.PER-311/13-346-'.$oCert->certificadoID.' , habilitandose al mismo para cargar Gas Licuado de Petroleo-GLP, hasta el '.$fecha2.'</p>
	</div>
	<p style="margin-top: -5px;margin-bottom: -9px;"><strong>OBSERVACIONES:</strong></p>
	<div class="parrafo3" style="margin-top: -15px;">
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
	$dompdf->stream('Certificado_Anual_'.$oTaller->per.'_'.$oCert->certificadoID, array("Attachment" => false));
	exit(0);
}


function DescargaInicial($oPrecert, $oCert){
	$oCategoria = CmsParameterLang::getItem($oPrecert->categoriaID, 1);
	$oMarca = CmsParameterLang::getItem($oPrecert->marcaID, 1);
	$oModelo = CmsParameterLang::getItem($oPrecert->modeloID, 1);
	$oCombustible = CmsParameterLang::getItem($oPrecert->combustibleID, 1);
	$oCompInst   = GlpCompInst::getListByCertificado(OWASP::RequestString('nro_certificado'));

	$oTaller = CrmTaller::getItem($oCert->tallerID);
	$oClienteCert = CrmClienteCert::getList($oCert->precertID);

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
		$ano_fab    = $value->ano_fab;
		$mes_fab 	= $value->mes_fab;
		$capacidad  = $value->capacidad;
	}

	$count=0;
	$fred='';
	foreach ($oClienteCert as $var) {
		$count++;
		$oCliente = CrmCliente::getItem($var->clienteID);
		if($count==1){
			$fred = $oCliente->name.' '.$oCliente->lastname;
		}else{
			$fred .= ' / '.$oCliente->name.' '.$oCliente->lastname;
		}

	}

	for ($i=0; $i<count($tipoCompID); $i++){
		$tipoComp = CmsParameterLang::getItem($tipoCompID[$i], 1);
		if($tipoComp->parameterName == 'REGULADOR'){
			$componentes.='<tr><td>'.$tipoComp->parameterName.'</td><td>'.$marca[$i].'</td><td>'.$modelo[$i].'</td><td>'.$serie[$i].'</td></tr>';
		}else{
			$componentes.='<tr><td>'.$tipoComp->parameterName.'</td><td>'.$marca[$i].'</td><td>'.$capacidad[$i].' Lt(*3) - '.$mes_fab[$i].'/'.$ano_fab[$i].'</td><td>'.$serie[$i].'</td></tr>';
		}
	}

    // instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$html='
	<style>
	body{
		margin:15px;
		margin-bottom:45px;
		font-size:14px;
		font-family: Helvetica;
	}
	.area1{
		margin-right:10px;
	}

	.parrafo1{
		font-size:11px;
	}
	table{
		border-collapse:collapse;
		font-family: Helvetica;
		font-size: 11px;
	}
	tr,td{
		border:1px solid #000;
		margin:2px;
	}

	.td_1{
		text-align: center;
	}

	.parrafo2{
		font-size:9px;
	}

	.parrafo3{
		font-size:9px;
		font-style: italic;
	}

	</style>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>INICIAL GLP</title>
	</head>
	<body>
	<p style="margin-bottom:-13px;">&nbsp;</p>
	<div class="area1">
	<p style="text-align: left;margin-left:480px;">'.$fecha.'</p>
	<p style="text-align: left;margin-left:480px;"><strong>'.$oTaller->per.'-'.$oCert->certificadoID.'</strong></p>
	</div>
	<h4 style="text-align: center;line-height: 0.2px;text-decoration: underline;">CERTIFICADO DE CONFORMIDAD</h4>
	<h4 style="text-align: center;margin-top: -5px;text-decoration: underline;">DE CONVERSI&Oacute;N A GLP</h4>
	<p><strong>BUREAU VERITAS DEL PER&Uacute; S.A:</strong></p>
	<p><strong>CERTIFICA :</strong><br>
	<t class="parrafo1">Haber efectuado la evaluaci&oacute;n de las condiciones de seguridad(*1) respecto de la conversi&oacute;n del sistema de combusti&oacute;n a Gas Licuado del Petroleo GLP efectuada por el Taller de ConveJurrsi&oacute;n a GLP Autorizado '.$oTaller->razonSocial.' al siguiente veh&iacute;culo:</t></p>	
	<table width="100%">
	<tbody>
	<tr>
	<td class="td_1" width="3%">1</td>
	<td>Propietario</td>
	<td colspan="4">'.$fred.'</td>
	</tr>
	<tr>
	<td class="td_1">2</td>
	<td>Placa de rodaje</td>
	<td>'.$oPrecert->placa.'</td>
	<td class="td_1" width="3%">10</td>
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
	<td>Nro. Asientos / Pasajeros</td>
	<td>'.$oPrecert->asientos.' / '.$oPrecert->pasajeros.'</td>
	</tr>
	<tr>
	<td class="td_1">6</td>
	<td>Versi&oacute;n</td>
	<td>'.$oPrecert->version.'</td>
	<td class="td_1">14</td>
	<td>Largo / Ancho / Alto (cm)</td>
	<td>'.$oPrecert->largo.' / '.$oPrecert->ancho.' / '.$oPrecert->alto.'</td>
	</tr>
	<tr>
	<td class="td_1">7</td>
	<td>A&ntilde;o Fabricaci&oacute;n</td>
	<td>'.$oPrecert->ano_fab.'</td>
	<td class="td_1" >15</td>
	<td>Peso Neto (Kgr)</td>
	<td>'.$oPrecert->pesoNeto.'</td>
	</tr>
	<tr>
	<td class="td_1">8</td>
	<td>Nro. Serie</td>
	<td>'.$oPrecert->serie.'</td>
	<td class="td_1">16</td>
	<td>Peso Bruto Vehicular (Kgr)</td>
	<td>'.$oPrecert->pesoBruto.'</td>
	</tr>
	<tr>
	<td class="td_1">9</td>
	<td>Nro. de Motor</td>
	<td>'.$oPrecert->motor.'</td>
	<td class="td_1">17</td>
	<td>Carga &Uacute;til (Kgr)</td>
	<td>'.$oPrecert->cargaUtil.'</td>
	</tr>
	</tbody>
	</table>
	<p style="font-size:12px">Habiendose instalado al mismo los siguientes componentes que permiten la combusti&oacute;n a GLP:</p>
	<table width="100%" style="margin-top:-10px;">
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
	<p class="parrafo1" style="font-size:12px" >Como consecuencia de la conversi&oacute;n del sistema de combusti&oacute;n a GLP, las caracter&iacute;sticas originales del veh&iacute;culo se han modificado de la siguiente manera:</p>
	<table width="100%" style="margin-top:-10px;">
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
	<div class="parrafo2">
	<p style="margin:7px 0 0 -10px;">Habiendose verificado que:</p>
	<ol style="margin-left:-28px;margin-top:-10px;">
	<li>El sistema de combusti&oacute;n a GLP (cilindro y kit de conversi&oacute;n) responde a las caracteristicas originales recomendadas por el fabricante de veh&iacute;culo y/o el Proveedor de Equipo Completos de Conversi&oacute;n a GLP (PEC_GLP), cumple con la Norma T&eacute;cnica Peruana NTP 321.115:2003 y su montaje cumple las exigencias sobre ventilaci&oacute;n en las distintas zonas de instalaci&oacute;n.</li>
	<li>El vaporizador/regulador cuenta con un sistema de coret de gas autom&aacute;tico, en caso que el motor deje de funcionar.</li>
	<li>El tanque de almacenamiento de GLP ha sido fabricado bajo normas ASME Secci&oacute;n VIII y cumple con las normas dictadas para recipientes a presi&oacute;n.</li>
	<li>El tanque de almacenamiento de GLP cuenta con los siguientes componentes:
	<ol style="margin-left: -24px;" >
	<li>V&aacute;lvula check en la entrada del gas.</li>
	<li>Limitador autom&aacute;tico de carga al 80%.</li>
	<li>V&aacute;lvula de exceso a presi&oacute;n.</li>
	<li>V&aacute;lvula de exceso de flujo.</li>
	</ol>
	</li>
	<li>Los accesorios e insumos (mangueras, tuber&iacute;as y v&aacute;lvulas) utilizados en la instalaci&oacute;n han sido certificados para el 5. uso del GLP.</li>
	<li>No existan fugas en los empalmes o uniones y los elementos de cierre act&uacute;an herm&eacute;ticamente.</li>
	<li>Los controles ubicados en el tablero del veh&iacute;culo responden a las exigencias para los cuales fueron montados.</li>
	</ol>
	<p>Coste por el presente documento que el sistema de combusti&oacute;n a Gas Licuado de Petroleo -GLP del veh&iacute;culo antes referido, no afecta negativamente la seguridad del mismo, el transito terrestre, el medio ambiente o incunmple con las condiciones t&eacute;cnicas(*2) establecidas en la norma vigente en la materia, seg&uacute;n consta en el expediente t&eacute;cnico No.PER-311/13-346-'.$oCert->certificadoID.' , habilitandose al mismo para cargar Gas Licuado de Petroleo-GLP, hasta el '.$fecha2.'</p>
	</div>
	<p style="margin-top: -5px;margin-bottom: -9px;"><strong>OBSERVACIONES:</strong></p>
	<div class="parrafo3" style="margin-top: -15px;">
	<p style="margin-bottom: -5px;">(*) Numerales 1 al 17, obtenidos de la tarjeta de propiedad del veh&iacute;culo y/o suministrados por el cliente, por tal motivo deber&aacute;n ser verificados por el cliente antes de iniciar cualquier tr&aacute;mite con este certificado</p>
	<p style="margin-bottom: -5px;">(*1)y(*2) Las condiciones verificadas en el veh&iacute;culo corresponden a las expuestas en la NTP 321.115 y Directiva 005 2007 MTC. excepto las contenidas en el numero 5.6.3.1 de la directiva mencionada y referentes a la aprobaci&oacute;n de equipos y autorizaci&oacute;n de talleres, debido a los plazos otrogados en los Art&iacute;culos 4 y 5 de la RD14540-2007-MTC/15 o a la imposibilidad de realizar el tr&aacute;mite por inexistencia del mismo ante las entidades competentes. De encontrase la sigla "NE", esta significa "Dato no especificado en los documentos o plaqueta del veh&iacute;culo.</p>
	<p style="margin-bottom: -5px;">(*3) Capacidad en litros aproximada a la unidad m&aacute;s cercana, puede diferir de la capacidad nominal especificada por el fabricante.</p>
	</div>
	<p class="parrafo2">Se expide el presente certificado en la ciudad de Lima, el d&iacute;a '.$fecha.'</p>
	<p style="text-align: center;font-size:11px;"><strong>PROHIBIDA LA REPRODUCCI&Oacute;N DEL PRESENTE DOCUMENTO SIN AUTORIZACI&Oacute;N DE BUREAU VERITAS DEL PER&Uacute; S.A.</strong></p>
	</body>
	</html>';
	$dompdf->loadHtml($html,'UTF-8');

// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
	$dompdf->render();
// Output the generated PDF to Browser
	$dompdf->stream('Certificado_Inicial_'.$oTaller->per.'_'.$oCert->certificadoID, array("Attachment" => false));
}


function DescargaOriginal($oPrecert, $oCert){

	$oCategoria = CmsParameterLang::getItem($oPrecert->categoriaID, 1);
	$oMarca = CmsParameterLang::getItem($oPrecert->marcaID, 1);
	$oModelo = CmsParameterLang::getItem($oPrecert->modeloID, 1);
	$oCombustible = CmsParameterLang::getItem($oPrecert->combustibleID, 1);
	$oCompInst   = GlpCompInst::getListByCertificado(OWASP::RequestString('nro_certificado'));

	$oTaller = CrmTaller::getItem($oCert->tallerID);
	$oClienteCert = CrmClienteCert::getList($oCert->precertID);

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
		$ano_fab    = $value->ano_fab;
		$mes_fab 	= $value->mes_fab;
		$capacidad  = $value->capacidad;
	}

	$count=0;
	$fred='';
	foreach ($oClienteCert as $var) {
		$count++;
		$oCliente = CrmCliente::getItem($var->clienteID);
		if($count==1){
			$fred = $oCliente->name.' '.$oCliente->lastname;
		}else{
			$fred .= ' / '.$oCliente->name.' '.$oCliente->lastname;
		}

	}

	for ($i=0; $i<count($tipoCompID); $i++){
		$tipoComp = CmsParameterLang::getItem($tipoCompID[$i], 1);
		if($tipoComp->parameterName == 'REGULADOR'){
			$componentes.='<tr><td>'.$tipoComp->parameterName.'</td><td>'.$marca[$i].'</td><td>'.$modelo[$i].'</td><td>'.$serie[$i].'</td></tr>';
		}else{
			$componentes.='<tr><td>'.$tipoComp->parameterName.'</td><td>'.$marca[$i].'</td><td>'.$capacidad[$i].' Lt(*3) - '.$mes_fab[$i].'/'.$ano_fab[$i].'</td><td>'.$serie[$i].'</td></tr>';
		}
	}

// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$html='
	<style>
	body{
		margin:15px;
		margin-bottom:45px;
		font-size:14px;
		font-family: Helvetica;
	}
	.area1{
		margin-right:10px;
	}

	.parrafo1{
		font-size:11px;
	}
	table{
		border-collapse:collapse;
		font-family: Helvetica;
		font-size: 11px;
	}
	tr,td{
		border:1px solid #000;
		margin:2px;
	}

	.td_1{
		text-align: center;
	}

	.parrafo2{
		font-size:9px;
	}

	.parrafo3{
		font-size:9px;
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
	<p style="text-align: right;">'.$fecha.'</p>
	<p style="text-align: right;"><strong>'.$oTaller->per.'-'.$oCert->certificadoID.'</strong></p>
	</div>
	<h4 style="text-align: center;line-height: 0.2px;text-decoration: underline;">CERTIFICADO DE INSPECCI&Oacute;N DE VEHICULO ORIGINAL A GLP</h4>
	<p><strong>BUREAU VERITAS DEL PER&Uacute; S.A:</strong></p>
	<p style="line-height: 0.2px;"><strong>CERTIFICA :</strong></p>
	<p class="parrafo1">Haber efectuado la evaluaci&oacute;n de las condiciones de seguridad(*1) respecto del sistema de combusti&oacute;n a Gas Licuado del Petroleo - GLP en Taller de Conversi&oacute;n a GLP Autorizado al siguiente veh&iacute;culo:</p>
	<table width="100%">
	<tbody>
	<tr>
	<td width="3%" class="td_1">1</td>
	<td width="27%">Propietario</td>
	<td colspan="4" width="80%">'.$fred.'</td>
	</tr>
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
	<td> Nro. Serie</td>
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
	<p>La insJurpecci&oacute;n del veh&iacute;culo fue realizada en el taller '.$oTaller->razonSocial.'</p>
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
	$dompdf->stream('Certificado_Original_'.$oTaller->per.'_'.$oCert->certificadoID, array("Attachment" => false));
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