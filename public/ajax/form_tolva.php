<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");//ISOOO!!

$cmd  	 = OWASP::RequestString('cmd');
$valor   = 1;

RegisterTolva($cmd);


function RegisterTolva($cmd){
	$oRegTolva = new eCrmTolva();

	
	$oRegTolva->chiID 	 			=OWASP::RequestInt('ID');
	//Buscando Planta 
	$oEmbarcacion = CrmEmbarcacion::getItemCodigo(OWASP::RequestString('matriculaEmbarcacion'));
	if($oEmbarcacion != NULL){$oRegTolva->embarcacionID = $oEmbarcacion->embarcacionID;}else{$oRegTolva->embarcacionID = '';}

	$oRegTolva->numActaInspeccion 	 			=OWASP::RequestString('numActaInspeccion');
	$oRegTolva->nombreEmbarcacion 	 			=OWASP::RequestString('nombreEmbarcacion');
	$oRegTolva->tmDescargado		 			=OWASP::RequestString('tmDescargado');
	$oRegTolva->capacidadBodega					=OWASP::RequestString('capacidadBodega');
	$oRegTolva->excesoBodega		 			=OWASP::RequestString('excesoBodega');
	$oRegTolva->porcentajeExceso 				=OWASP::RequestString('porcentajeExceso');
	$oRegTolva->ro 								=OWASP::RequestString('ro');
	$oRegTolva->fechaInicial 					=OWASP::RequestString('fechaInicial');
	$oRegTolva->horaInicio 						=OWASP::RequestString('horaInicio');
	$oRegTolva->fechaFinal 						=OWASP::RequestString('fechaFinal');
	$oRegTolva->horaTermino 					=OWASP::RequestString('horaTermino');
	$oRegTolva->nroReportePesaje 				=OWASP::RequestString('nroReportePesaje');
	$oRegTolva->nroTolva 						=OWASP::RequestString('nroTolva');
	$oRegTolva->pregunta6		 				=OWASP::RequestString('pregunta6');
	$oRegTolva->pregunta7						=OWASP::RequestString('pregunta7');
	$oRegTolva->pregunta8		 				=OWASP::RequestString('pregunta8');
	$oRegTolva->pregunta9 						=OWASP::RequestString('pregunta9');
	$oRegTolva->pregunta10 						=OWASP::RequestString('pregunta10');
	//Buscando Inspector 
	$oInspector = CrmInspector::getItemCodigo(OWASP::RequestString('codigoInspector'));
	if($oInspector != NULL){$oRegTolva->inspectorID = $oInspector->inspectorID;}else{$oRegTolva->inspectorID = '';}
	$oRegTolva->nombreInspector 	 	=OWASP::RequestString('nombreInspector');

	$oRegTolva->pruebaPesaje 					=OWASP::RequestString('pruebaPesaje');
	$oRegTolva->conforme 						=OWASP::RequestString('conforme');
	$oRegTolva->numReportePesaje 				=OWASP::RequestString('numReportePesaje');
	$oRegTolva->horaReportePesaje 				=OWASP::RequestString('horaReportePesaje');

	//Buscando Observacion 
	$oObserv = CmsParameter::getItem(OWASP::RequestString('obsInusual'));
	if($oObserv != NULL){$oRegTolva->obsInusual=$oObserv->alias;}else{$oRegTolva->obsInusual='';  };

	switch($cmd){
		case 'insert' : 
		if(CrmTolva::AddNew($oRegTolva)){
			Response('Tolva - Registrado Correctamente.',$oRegTolva->chiID);
		}else{
			RaiseError(CrmTolva::GetErrorMsg());
			return;
		}
		break;

		case 'update' : 
		if(CrmTolva::Update($oRegTolva)){
			Response('Tolva - Actualizado Correctamente.',$oRegTolva->chiID);
		}else{
			RaiseError(CrmTolva::GetErrorMsg());
			return;
		}
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