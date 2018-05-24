<?php
ob_start();	
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

include ("PHPExcel/Classes/PHPExcel.php");

$action =OWASP::RequestString('action');

switch ($action) {
	case 'exportar':
	ExportaFactura();
	break;
	default:
	RaiseError('No tiene permisos para estos recursos');
	break;
}

function ExportaFactura(){
	$facturacionID    =OWASP::RequestInt('facturacionID');
	$objPHPExcel = new PHPExcel();

	$oFacturacion = CrmFacturacion::getItem($facturacionID);
	$oListDetailFact = CrmFacturacionDet::getListByFactura($facturacionID);
	$oTaller = CrmTaller::getItem($oFacturacion->tallerID);
	$date = new DateTime($oFacturacion->fechaFin);
	// Establecer propiedades
	$style = array(
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		)
	);

	//----------------------CABECERA---------------------------------------
	$objPHPExcel->setActiveSheetIndex(0)
	->mergeCells('A1:I1')
	->setCellValue('A1', 'BUREAU VERITAS DEL PERU S.A')
	->mergeCells('A2:I2')
	->setCellValue('A2', 'ANEXO DE FACTURACION DE VEHICULOS')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(0)
	->mergeCells('A4:I4')
	->setCellValue('A4', '<<Fecha de Cierre '.date_format($date, 'd/m/Y').'>>');
	$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(0)
	->mergeCells('A6:D6')
	->setCellValue('A6',$oTaller->razonSocial)
	->mergeCells('G6:I6')
	->setCellValue('G6','PER-'.$oTaller->per);
	$objPHPExcel->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('G6:I6')->getFont()->setBold(true);
	//----------------------FIN DE CABECERA	---------------------------------------
	$objPHPExcel->setActiveSheetIndex(0)
	->mergeCells('A10:B10')
	->setCellValue('A10','F./Inspeccion')
	->setCellValue('C10','Tipo de Inspeccion')
	->setCellValue('D10','Placa')
	->mergeCells('E10:F10')
	->setCellValue('E10','VIN')
	->mergeCells('G10:H10')
	->setCellValue('G10','Numero de Motor')
	->setCellValue('I10','Estado')
	->setCellValue('J10','Precio')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A10:J10')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A10:J10')->getFont()->setBold(true);

	$objPHPExcel->setActiveSheetIndex(0)
	->mergeCells('A11:C11')
	->setCellValue('A11','Local: '.$oTaller->razonSocial);
	$objPHPExcel->getActiveSheet()->getStyle('A11:C11')->getFont()->setBold(true);
	//--------------------------LISTADO DE DETALLE -------------------------------
	$count=12;
	$countParticipantes=0;
	$suma=0.00;

	foreach ($oListDetailFact as $val) {
		$valor = '';$valor2 = '';
		switch ($val->tipoServicio) {
			case '70':
			$valor = 'GLP';
			break;
			case '71':
			$valor = 'GNV';
			break;
		}
		switch ($val->tipoCertificadoID) {
			case '74':
			$valor2 = 'INICIAL';
			break;
			case '87':
			$valor2 = 'ANUAL';
			break;
			case '88':
			$valor2 = 'ORIGINAL';
			break;
			case '83':
			$valor2 = 'INICIAL';
			break;
			case '72':
			$valor2 = 'ANUAL';
			break;
			case '84':
			$valor2 = 'ORIGINAL';
			break;
		}
		
		$dateDet = new DateTime($val->fechaEmision);
		$objPHPExcel->setActiveSheetIndex(0)
		->mergeCells('A'.$count.':B'.$count)
		->setCellValue('A'.$count,date_format($dateDet, 'd/m/Y'))
		->setCellValue('C'.$count,$valor.' '.$valor2)
		->setCellValue('D'.$count,$val->placa)
		->mergeCells('E'.$count.':F'.$count)
		->setCellValue('E'.$count,$val->vin)
		->mergeCells('G'.$count.':H'.$count)
		->setCellValue('G'.$count,$val->motor)
		->setCellValue('I'.$count,GnvCertificado::getState($val->estado))
		->setCellValue('J'.$count,$val->costo)
		;	
		$objPHPExcel->getActiveSheet()->getStyle('J'.$count)->getNumberFormat()->setFormatCode('0.00'); 
		$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':J'.$count)->applyFromArray($style);
		$count++;
		$countParticipantes++;
		$suma += $val->costo;

	}
	//--------------------------FINALIZADO DE DETALLE -------------------------------
	$objPHPExcel->setActiveSheetIndex(0)
	->mergeCells('A8:I8')
	->setCellValue('A8', 'Inspección de '.$countParticipantes.' vehículo(s) convertido(s)')
	;
	$count++;
	$objPHPExcel->setActiveSheetIndex(0)
	->mergeCells('A'.$count.':E'.$count)
	->setCellValue('A'.$count, 'Total S/.'.number_format($suma, 2, '.', '').'+I.G.V.')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setSize(16);

	$objPHPExcel->getActiveSheet()->setTitle('RESUMEN GENERAL');
	//-------------------------------------------------------------------------------------------------------

	//----------------------CABECERA---------------------------------------
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(1)
	->mergeCells('A1:I1')
	->setCellValue('A1', 'BUREAU VERITAS DEL PERU S.A')
	->mergeCells('A2:I2')
	->setCellValue('A2', 'ANEXO DE FACTURACION DE VEHICULOS')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(1)
	->mergeCells('A4:I4')
	->setCellValue('A4', '<<Fecha de Cierre '.date_format($date, 'd/m/Y').'>>');
	$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(1)
	->mergeCells('A6:D6')
	->setCellValue('A6',$oTaller->razonSocial)
	->mergeCells('G6:I6')
	->setCellValue('G6','PER-'.$oTaller->per);
	$objPHPExcel->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('G6:I6')->getFont()->setBold(true);
	//----------------------FIN DE CABECERA	---------------------------------------
	$objPHPExcel->setActiveSheetIndex(1)
	->mergeCells('A10:B10')
	->setCellValue('A10','F./Inspeccion')
	->setCellValue('C10','Placa')
	->mergeCells('D10:E10')
	->setCellValue('D10','VIN')
	->mergeCells('F10:G10')
	->setCellValue('F10','Numero de Motor')
	->setCellValue('H10','Estado')
	->setCellValue('I10','Precio')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->getFont()->setBold(true);

	$objPHPExcel->setActiveSheetIndex(1)
	->mergeCells('A11:C11')
	->setCellValue('A11','Local: '.$oTaller->razonSocial);
	$objPHPExcel->getActiveSheet()->getStyle('A11:C11')->getFont()->setBold(true);
	//--------------------------LISTADO DE DETALLE -------------------------------
	$count=12;
	$countParticipantes=0;
	$suma=0.00;
	foreach ($oListDetailFact as $val) {
		if($val->tipoServicio != '70'){
			if($val->tipoCertificadoID == '74'){
				$dateDet = new DateTime($val->fechaEmision);
				$objPHPExcel->setActiveSheetIndex(1)
				->mergeCells('A'.$count.':B'.$count)
				->setCellValue('A'.$count,date_format($dateDet, 'd/m/Y'))
				->setCellValue('C'.$count,$val->placa)
				->mergeCells('D'.$count.':E'.$count)
				->setCellValue('D'.$count,$val->vin)
				->mergeCells('F'.$count.':G'.$count)
				->setCellValue('F'.$count,$val->motor)
				->setCellValue('H'.$count,GnvCertificado::getState($val->estado))
				->setCellValue('I'.$count,$val->costo)
				;	
				$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->getNumberFormat()->setFormatCode('0.00'); 
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':I'.$count)->applyFromArray($style);
				$count++;
				$countParticipantes++;
				$suma += $val->costo;
			}
		}
	}
	//--------------------------FINALIZADO DE DETALLE -------------------------------
	$objPHPExcel->setActiveSheetIndex(1)
	->mergeCells('A8:I8')
	->setCellValue('A8', 'Inspección de '.$countParticipantes.' vehículo(s) convertido(s)  a GNV')
	;
	$count++;
	$objPHPExcel->setActiveSheetIndex(1)
	->mergeCells('A'.$count.':E'.$count)
	->setCellValue('A'.$count, 'Total S/.'.number_format($suma, 2, '.', '').'+I.G.V.')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setSize(16);

	$objPHPExcel->getActiveSheet()->setTitle('GNV INICIAL');
	//-------------------------------------------------------------------------------------------------------

	
	// Create a new worksheet, after the default sheet
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(2);
	//----------------------CABECERA---------------------------------------
	$objPHPExcel->setActiveSheetIndex(2)
	->mergeCells('A1:I1')
	->setCellValue('A1', 'BUREAU VERITAS DEL PERU S.A')
	->mergeCells('A2:I2')
	->setCellValue('A2', 'ANEXO DE FACTURACION DE VEHICULOS')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(2)
	->mergeCells('A4:I4')
	->setCellValue('A4', '<<Fecha de Cierre '.date_format($date, 'd/m/Y').'>>');
	$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(2)
	->mergeCells('A6:D6')
	->setCellValue('A6',$oTaller->razonSocial)
	->mergeCells('G6:I6')
	->setCellValue('G6','PER-'.$oTaller->per);
	$objPHPExcel->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('G6:I6')->getFont()->setBold(true);
	//----------------------FIN DE CABECERA	---------------------------------------
	$objPHPExcel->setActiveSheetIndex(2)
	->mergeCells('A10:B10')
	->setCellValue('A10','F./Inspeccion')
	->setCellValue('C10','Placa')
	->mergeCells('D10:E10')
	->setCellValue('D10','VIN')
	->mergeCells('F10:G10')
	->setCellValue('F10','Numero de Motor')
	->setCellValue('H10','Estado')
	->setCellValue('I10','Precio')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->getFont()->setBold(true);

	$objPHPExcel->setActiveSheetIndex(2)
	->mergeCells('A11:C11')
	->setCellValue('A11','Local: '.$oTaller->razonSocial);
	$objPHPExcel->getActiveSheet()->getStyle('A11:C11')->getFont()->setBold(true);
	//--------------------------LISTADO DE DETALLE -------------------------------
	$count=12;
	$countParticipantes=0;
	$suma=0.00;
	foreach ($oListDetailFact as $val) {
		if($val->tipoServicio != '70'){
			if($val->tipoCertificadoID == '87'){
				$dateDet = new DateTime($val->fechaEmision);
				$objPHPExcel->setActiveSheetIndex(2)
				->mergeCells('A'.$count.':B'.$count)
				->setCellValue('A'.$count,date_format($dateDet, 'd/m/Y'))
				->setCellValue('C'.$count,$val->placa)
				->mergeCells('D'.$count.':E'.$count)
				->setCellValue('D'.$count,$val->vin)
				->mergeCells('F'.$count.':G'.$count)
				->setCellValue('F'.$count,$val->motor)
				->setCellValue('H'.$count,GnvCertificado::getState($val->estado))
				->setCellValue('I'.$count,$val->costo)
				;	
				$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->getNumberFormat()->setFormatCode('0.00'); 
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':I'.$count)->applyFromArray($style);
				$count++;
				$countParticipantes++;
				$suma += $val->costo;
			}
		}
	}
	//--------------------------FINALIZADO DE DETALLE -------------------------------
	$objPHPExcel->setActiveSheetIndex(2)
	->mergeCells('A8:I8')
	->setCellValue('A8', 'Inspección de '.$countParticipantes.' vehículo(s) convertido(s)  a GNV')
	;
	$count++;
	$objPHPExcel->setActiveSheetIndex(2)
	->mergeCells('A'.$count.':E'.$count)
	->setCellValue('A'.$count, 'Total S/.'.number_format($suma, 2, '.', '').'+I.G.V.')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setSize(16);;
	// Rename 2nd sheet
	$objPHPExcel->getActiveSheet()->setTitle('GNV ANUAL');

	//----------------------------------------------------------------------------------------------------------

	// Create a new worksheet, after the default sheet
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(3);
	//----------------------CABECERA---------------------------------------
	$objPHPExcel->setActiveSheetIndex(3)
	->mergeCells('A1:I1')
	->setCellValue('A1', 'BUREAU VERITAS DEL PERU S.A')
	->mergeCells('A2:I2')
	->setCellValue('A2', 'ANEXO DE FACTURACION DE VEHICULOS')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(3)
	->mergeCells('A4:I4')
	->setCellValue('A4', '<<Fecha de Cierre '.date_format($date, 'd/m/Y').'>>');
	$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(3)
	->mergeCells('A6:D6')
	->setCellValue('A6',$oTaller->razonSocial)
	->mergeCells('G6:I6')
	->setCellValue('G6','PER-'.$oTaller->per);
	$objPHPExcel->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('G6:I6')->getFont()->setBold(true);
	//----------------------FIN DE CABECERA	---------------------------------------
	$objPHPExcel->setActiveSheetIndex(3)
	->mergeCells('A10:B10')
	->setCellValue('A10','F./Inspeccion')
	->setCellValue('C10','Placa')
	->mergeCells('D10:E10')
	->setCellValue('D10','VIN')
	->mergeCells('F10:G10')
	->setCellValue('F10','Numero de Motor')
	->setCellValue('H10','Estado')
	->setCellValue('I10','Precio')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->getFont()->setBold(true);

	$objPHPExcel->setActiveSheetIndex(3)
	->mergeCells('A11:C11')
	->setCellValue('A11','Local: '.$oTaller->razonSocial);
	$objPHPExcel->getActiveSheet()->getStyle('A11:C11')->getFont()->setBold(true);
	//--------------------------LISTADO DE DETALLE -------------------------------
	$count=12;
	$countParticipantes=0;
	$suma=0.00;
	foreach ($oListDetailFact as $val) {
		if($val->tipoServicio != '70'){
			if($val->tipoCertificadoID == '88'){
				$dateDet = new DateTime($val->fechaEmision);
				$objPHPExcel->setActiveSheetIndex(3)
				->mergeCells('A'.$count.':B'.$count)
				->setCellValue('A'.$count,date_format($dateDet, 'd/m/Y'))
				->setCellValue('C'.$count,$val->placa)
				->mergeCells('D'.$count.':E'.$count)
				->setCellValue('D'.$count,$val->vin)
				->mergeCells('F'.$count.':G'.$count)
				->setCellValue('F'.$count,$val->motor)
				->setCellValue('H'.$count,GnvCertificado::getState($val->estado))
				->setCellValue('I'.$count,$val->costo)
				;	
				$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->getNumberFormat()->setFormatCode('0.00'); 
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':I'.$count)->applyFromArray($style);
				$count++;
				$countParticipantes++;
				$suma += $val->costo;
			}
		}
	}
	//--------------------------FINALIZADO DE DETALLE -------------------------------
	$objPHPExcel->setActiveSheetIndex(3)
	->mergeCells('A8:I8')
	->setCellValue('A8', 'Inspección de '.$countParticipantes.' vehículo(s) convertido(s)  a GNV')
	;
	$count++;
	$objPHPExcel->setActiveSheetIndex(3)
	->mergeCells('A'.$count.':E'.$count)
	->setCellValue('A'.$count, 'Total S/.'.number_format($suma, 2, '.', '').'+I.G.V.')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setSize(16);;
	// Rename 2nd sheet
	$objPHPExcel->getActiveSheet()->setTitle('GNV ORIGINAL');




	//----------------------------------------------------------------------------------------------------------

	// Create a new worksheet, after the default sheet
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(4);
	//----------------------CABECERA---------------------------------------
	$objPHPExcel->setActiveSheetIndex(4)
	->mergeCells('A1:I1')
	->setCellValue('A1', 'BUREAU VERITAS DEL PERU S.A')
	->mergeCells('A2:I2')
	->setCellValue('A2', 'ANEXO DE FACTURACION DE VEHICULOS')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(4)
	->mergeCells('A4:I4')
	->setCellValue('A4', '<<Fecha de Cierre '.date_format($date, 'd/m/Y').'>>');
	$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(4)
	->mergeCells('A6:D6')
	->setCellValue('A6',$oTaller->razonSocial)
	->mergeCells('G6:I6')
	->setCellValue('G6','PER-'.$oTaller->per);
	$objPHPExcel->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('G6:I6')->getFont()->setBold(true);
	//----------------------FIN DE CABECERA	---------------------------------------
	$objPHPExcel->setActiveSheetIndex(4)
	->mergeCells('A10:B10')
	->setCellValue('A10','F./Inspeccion')
	->setCellValue('C10','Placa')
	->mergeCells('D10:E10')
	->setCellValue('D10','VIN')
	->mergeCells('F10:G10')
	->setCellValue('F10','Numero de Motor')
	->setCellValue('H10','Estado')
	->setCellValue('I10','Precio')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->getFont()->setBold(true);

	$objPHPExcel->setActiveSheetIndex(4)
	->mergeCells('A11:C11')
	->setCellValue('A11','Local: '.$oTaller->razonSocial);
	$objPHPExcel->getActiveSheet()->getStyle('A11:C11')->getFont()->setBold(true);
	//--------------------------LISTADO DE DETALLE -------------------------------
	$count=12;
	$countParticipantes=0;
	$suma=0.00;
	foreach ($oListDetailFact as $val) {
		if($val->tipoServicio != '71'){
			if($val->tipoCertificadoID == '83'){
				$dateDet = new DateTime($val->fechaEmision);
				$objPHPExcel->setActiveSheetIndex(4)
				->mergeCells('A'.$count.':B'.$count)
				->setCellValue('A'.$count,date_format($dateDet, 'd/m/Y'))
				->setCellValue('C'.$count,$val->placa)
				->mergeCells('D'.$count.':E'.$count)
				->setCellValue('D'.$count,$val->vin)
				->mergeCells('F'.$count.':G'.$count)
				->setCellValue('F'.$count,$val->motor)
				->setCellValue('H'.$count,GnvCertificado::getState($val->estado))
				->setCellValue('I'.$count,$val->costo)
				;	
				$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->getNumberFormat()->setFormatCode('0.00'); 
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':I'.$count)->applyFromArray($style);
				$count++;
				$countParticipantes++;
				$suma += $val->costo;
			}
		}
	}
	//--------------------------FINALIZADO DE DETALLE -------------------------------
	$objPHPExcel->setActiveSheetIndex(4)
	->mergeCells('A8:I8')
	->setCellValue('A8', 'Inspección de '.$countParticipantes.' vehículo(s) convertido(s)  a GLP')
	;
	$count++;
	$objPHPExcel->setActiveSheetIndex(4)
	->mergeCells('A'.$count.':E'.$count)
	->setCellValue('A'.$count, 'Total S/.'.number_format($suma, 2, '.', '').'+I.G.V.')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setSize(16);;
	// Rename 2nd sheet
	$objPHPExcel->getActiveSheet()->setTitle('GLP INICIAL');

	//----------------------------------------------------------------------------------------------------------

	// Create a new worksheet, after the default sheet
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(5);
	//----------------------CABECERA---------------------------------------
	$objPHPExcel->setActiveSheetIndex(5)
	->mergeCells('A1:I1')
	->setCellValue('A1', 'BUREAU VERITAS DEL PERU S.A')
	->mergeCells('A2:I2')
	->setCellValue('A2', 'ANEXO DE FACTURACION DE VEHICULOS')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(5)
	->mergeCells('A4:I4')
	->setCellValue('A4', '<<Fecha de Cierre '.date_format($date, 'd/m/Y').'>>');
	$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(5)
	->mergeCells('A6:D6')
	->setCellValue('A6',$oTaller->razonSocial)
	->mergeCells('G6:I6')
	->setCellValue('G6','PER-'.$oTaller->per);
	$objPHPExcel->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('G6:I6')->getFont()->setBold(true);
	//----------------------FIN DE CABECERA	---------------------------------------
	$objPHPExcel->setActiveSheetIndex(5)
	->mergeCells('A10:B10')
	->setCellValue('A10','F./Inspeccion')
	->setCellValue('C10','Placa')
	->mergeCells('D10:E10')
	->setCellValue('D10','VIN')
	->mergeCells('F10:G10')
	->setCellValue('F10','Numero de Motor')
	->setCellValue('H10','Estado')
	->setCellValue('I10','Precio')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->getFont()->setBold(true);

	$objPHPExcel->setActiveSheetIndex(5)
	->mergeCells('A11:C11')
	->setCellValue('A11','Local: '.$oTaller->razonSocial);
	$objPHPExcel->getActiveSheet()->getStyle('A11:C11')->getFont()->setBold(true);
	//--------------------------LISTADO DE DETALLE -------------------------------
	$count=12;
	$countParticipantes=0;
	$suma=0.00;
	foreach ($oListDetailFact as $val) {
		if($val->tipoServicio != '71'){
			if($val->tipoCertificadoID == '72'){
				$dateDet = new DateTime($val->fechaEmision);
				$objPHPExcel->setActiveSheetIndex(5)
				->mergeCells('A'.$count.':B'.$count)
				->setCellValue('A'.$count,date_format($dateDet, 'd/m/Y'))
				->setCellValue('C'.$count,$val->placa)
				->mergeCells('D'.$count.':E'.$count)
				->setCellValue('D'.$count,$val->vin)
				->mergeCells('F'.$count.':G'.$count)
				->setCellValue('F'.$count,$val->motor)
				->setCellValue('H'.$count,GnvCertificado::getState($val->estado))
				->setCellValue('I'.$count,$val->costo)
				;	
				$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->getNumberFormat()->setFormatCode('0.00'); 
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':I'.$count)->applyFromArray($style);
				$count++;
				$countParticipantes++;
				$suma += $val->costo;
			}
		}
	}
	//--------------------------FINALIZADO DE DETALLE -------------------------------
	$objPHPExcel->setActiveSheetIndex(5)
	->mergeCells('A8:I8')
	->setCellValue('A8', 'Inspección de '.$countParticipantes.' vehículo(s) convertido(s)  a GLP')
	;
	$count++;
	$objPHPExcel->setActiveSheetIndex(5)
	->mergeCells('A'.$count.':E'.$count)
	->setCellValue('A'.$count, 'Total S/.'.number_format($suma, 2, '.', '').'+I.G.V.')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setSize(16);;
	// Rename 2nd sheet
	$objPHPExcel->getActiveSheet()->setTitle('GLP ANUAL');

	//----------------------------------------------------------------------------------------------------------

	// Create a new worksheet, after the default sheet
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(6);
	//----------------------CABECERA---------------------------------------
	$objPHPExcel->setActiveSheetIndex(6)
	->mergeCells('A1:I1')
	->setCellValue('A1', 'BUREAU VERITAS DEL PERU S.A')
	->mergeCells('A2:I2')
	->setCellValue('A2', 'ANEXO DE FACTURACION DE VEHICULOS')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(6)
	->mergeCells('A4:I4')
	->setCellValue('A4', '<<Fecha de Cierre '.date_format($date, 'd/m/Y').'>>');
	$objPHPExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($style);

	$objPHPExcel->setActiveSheetIndex(6)
	->mergeCells('A6:D6')
	->setCellValue('A6',$oTaller->razonSocial)
	->mergeCells('G6:I6')
	->setCellValue('G6','PER-'.$oTaller->per);
	$objPHPExcel->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('G6:I6')->getFont()->setBold(true);
	//----------------------FIN DE CABECERA	---------------------------------------
	$objPHPExcel->setActiveSheetIndex(6)
	->mergeCells('A10:B10')
	->setCellValue('A10','F./Inspeccion')
	->setCellValue('C10','Placa')
	->mergeCells('D10:E10')
	->setCellValue('D10','VIN')
	->mergeCells('F10:G10')
	->setCellValue('F10','Numero de Motor')
	->setCellValue('H10','Estado')
	->setCellValue('I10','Precio')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->applyFromArray($style);
	$objPHPExcel->getActiveSheet()->getStyle('A10:I10')->getFont()->setBold(true);

	$objPHPExcel->setActiveSheetIndex(6)
	->mergeCells('A11:C11')
	->setCellValue('A11','Local: '.$oTaller->razonSocial);
	$objPHPExcel->getActiveSheet()->getStyle('A11:C11')->getFont()->setBold(true);
	//--------------------------LISTADO DE DETALLE -------------------------------
	$count=12;
	$countParticipantes=0;
	$suma=0.00;
	foreach ($oListDetailFact as $val) {
		if($val->tipoServicio != '71'){
			if($val->tipoCertificadoID == '84'){
				$dateDet = new DateTime($val->fechaEmision);
				$objPHPExcel->setActiveSheetIndex(6)
				->mergeCells('A'.$count.':B'.$count)
				->setCellValue('A'.$count,date_format($dateDet, 'd/m/Y'))
				->setCellValue('C'.$count,$val->placa)
				->mergeCells('D'.$count.':E'.$count)
				->setCellValue('D'.$count,$val->vin)
				->mergeCells('F'.$count.':G'.$count)
				->setCellValue('F'.$count,$val->motor)
				->setCellValue('H'.$count,GnvCertificado::getState($val->estado))
				->setCellValue('I'.$count,$val->costo)
				;	
				$objPHPExcel->getActiveSheet()->getStyle('I'.$count)->getNumberFormat()->setFormatCode('0.00'); 
				$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':I'.$count)->applyFromArray($style);
				$count++;
				$countParticipantes++;
				$suma += $val->costo;
			}
		}
	}
	//--------------------------FINALIZADO DE DETALLE -------------------------------
	$objPHPExcel->setActiveSheetIndex(6)
	->mergeCells('A8:I8')
	->setCellValue('A8', 'Inspección de '.$countParticipantes.' vehículo(s) convertido(s)  a GLP')
	;
	$count++;
	$objPHPExcel->setActiveSheetIndex(6)
	->mergeCells('A'.$count.':E'.$count)
	->setCellValue('A'.$count, 'Total S/.'.number_format($suma, 2, '.', '').'+I.G.V.')
	;
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$count.':E'.$count)->getFont()->setSize(16);;
	// Rename 2nd sheet
	$objPHPExcel->getActiveSheet()->setTitle('GLP ORIGINAL');


	ob_end_clean();
	header('Content-Type: application/vnd.ms-excel'); 
	header('Content-Disposition: attachment;filename="Facturacion'.$oTaller->razonSocial.'-'. date('Ymd') . '.xls"'); 
	header('Cache-Control: max-age=0'); 

	$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5'); 
	$objWriter->save('php://output'); 
	$objWriter->save('desktop'); 
	exit;  
}

?>