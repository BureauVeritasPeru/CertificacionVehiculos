<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");//ISOOO!!

$cmd  	 = OWASP::RequestString('cmd');
$valor   = 1;

RegisterRO($cmd);


function RegisterRO($cmd){
	for ($i=1; $i < 4 ; $i++) { 
		${'oRegRO'.$i} = new eCrmReporteOcurrencia();
		${'oRegRO'.$i}->chiID =OWASP::RequestString('ID');
		${'oRegRO'.$i}->correlativo = $i;
		${'oRegRO'.$i}->numReporteOcurrencia =OWASP::RequestString('numReporteOcurrencia'.$i);
		${'oRegRO'.$i}->actaDecomiso =OWASP::RequestString('actaDecomiso'.$i);
		${'oRegRO'.$i}->tmDecomisado =OWASP::RequestString('tmDecomisado'.$i);
		${'oRegRO'.$i}->subCodigoNumeroDecomiso =OWASP::RequestString('subCodigoNumeroDecomiso'.$i);
		${'oRegRO'.$i}->porcDecomisado =OWASP::RequestString('porcDecomisado'.$i);
		${'oRegRO'.$i}->actaRetencionPago =OWASP::RequestString('actaRetencionPago'.$i);
		${'oRegRO'.$i}->infractor =OWASP::RequestString('infractor'.$i);
		${'oRegRO'.$i}->nombreInspector =OWASP::RequestString('nombreInspector'.$i);
		//Buscando Inspector 
		${'oInspector'.$i} = CrmInspector::getItemCodigo(OWASP::RequestString('codigoInspector'.$i));
		if(${'oInspector'.$i} != NULL){${'oRegRO'.$i}->inspectorID = ${'oInspector'.$i}->inspectorID;}else{${'oRegRO'.$i}->inspectorID = '';}

		for ($j=1; $j < 4 ; $j++) { 
			${'oInfraccion'.$i.'_'.$j} = new eCrmInfraccion();
			${'oInfraccion'.$i.'_'.$j}->correlativo = $j;
			${'oInfraccion'.$i.'_'.$j}->codigoInfraccion =OWASP::RequestString('codigoInfraccion'.$i.'_'.$j);
			${'oInfraccion'.$i.'_'.$j}->detalleInfraccion =OWASP::RequestString('detalleInfraccion'.$i.'_'.$j);
		}
	}
	
	switch($cmd){
		case 'insert' : 
		for ($i=1; $i < 4 ; $i++) { 
			if(${'oRegRO'.$i}->numReporteOcurrencia != ""){
				if(CrmReporteOcurrencia::AddNew(${'oRegRO'.$i})){
					for ($j=1; $j < 4 ; $j++) { 
						if(${'oInfraccion'.$i.'_'.$j}->codigoInfraccion != "0" && ${'oInfraccion'.$i.'_'.$j}->detalleInfraccion != ""){
							${'oInfraccion'.$i.'_'.$j}->reporteOcurrenciaID = ${'oRegRO'.$i}->reporteOcurrenciaID; 
							CrmInfraccion::AddNew(${'oInfraccion'.$i.'_'.$j});
						}else
						{
							
						}
					}

				}else{
					RaiseError(CrmReporteOcurrencia::GetErrorMsg());
					return;
				}
			}	

		}	
		Response('Reporte de Ocurrencia - Registrado Correctamente.','1');
		break;

		case 'update' : 
		for ($i=1; $i < 4; $i++) { 
			if(${'oRegRO'.$i}->numReporteOcurrencia != ""){
				if(CrmReporteOcurrencia::Update(${'oRegRO'.$i})){
					for ($j=1; $j < 4 ; $j++) { 
						if(${'oInfraccion'.$i.'_'.$j}->codigoInfraccion != "0" && ${'oInfraccion'.$i.'_'.$j}->detalleInfraccion != ""){
							$oRespRO = CrmInfraccion::getItemCorre(${'oRegRO'.$i}->chiID,${'oInfraccion'.$i.'_'.$j}->correlativo);
							if($oRespRO != NULL){
								${'oInfraccion'.$i.'_'.$j}->chiID = ${'oRegRO'.$i}->chiID;
								CrmInfraccion::Update(${'oInfraccion'.$i.'_'.$j});	
							}else{
								$respIns = CrmReporteOcurrencia::getItemCHI(${'oRegRO'.$i}->chiID);  
								${'oInfraccion'.$i.'_'.$j}->reporteOcurrenciaID = $respIns->reporteOcurrenciaID;  
								CrmInfraccion::AddNew(${'oInfraccion'.$i.'_'.$j});
							}
						}
					}

				}else{
					RaiseError(CrmReporteOcurrencia::GetErrorMsg());
					return;
				}

			}
		}
		Response('Reporte de Ocurrencia - Actualizado Correctamente.','1');
		break;
	}

	
	
}

function Response($msg,$chiID){
	echo json_encode(array('retval'=>'1', 'message'=>$msg,'chiID'=>$chiID));
	exit;
	return;
}

function RaiseError($msg){
	echo json_encode(array('retval'=>'0', 'message'=>$msg));
	exit;
	return;
}




?>