<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");//ISOOO!!

$cmd  	 = OWASP::RequestString('cmd');
$valor   = 1;

RegisterMuestreo($cmd);


function RegisterMuestreo($cmd){
	$oRegMuestreo = new eCrmMuestreo();

	$oRegMuestreo->chiID 	 					=OWASP::RequestInt('ID');
	$oRegMuestreo->nroParteMuestreo 	 		=OWASP::RequestString('nroParteMuestreo');
	$oRegMuestreo->especie1ID 	 				=OWASP::RequestString('especie1ID');
	$oRegMuestreo->porcEspecie1		 			=OWASP::RequestString('porcEspecie1');
	$oRegMuestreo->especie2ID					=OWASP::RequestString('especie2ID');
	$oRegMuestreo->porcEspecie2		 			=OWASP::RequestString('porcEspecie2');
	$oRegMuestreo->especie3ID 					=OWASP::RequestString('especie3ID');
	$oRegMuestreo->porcEspecie3 				=OWASP::RequestString('porcEspecie3');
	$oRegMuestreo->especie4ID 					=OWASP::RequestString('especie4ID');
	$oRegMuestreo->porcEspecie4 				=OWASP::RequestString('porcEspecie4');
	$oRegMuestreo->especie5ID 					=OWASP::RequestString('especie5ID');
	$oRegMuestreo->porcEspecie5 				=OWASP::RequestString('porcEspecie5');
	$oRegMuestreo->reporteCala 					=OWASP::RequestString('reporteCala');
	$oRegMuestreo->estadio 						=OWASP::RequestString('estadio');
	//Buscando Inspector 
	$oInspector = CrmInspector::getItemCodigo(OWASP::RequestString('codigoInspector'));
	if($oInspector != NULL){$oRegMuestreo->inspectorID = $oInspector->inspectorID;}else{$oRegMuestreo->inspectorID = '';}
	$oRegMuestreo->nombreInspector 	 	=OWASP::RequestString('nombreInspector');

	$oRegMuestreo->zonaPesca 					=OWASP::RequestString('zonaPesca');
	$oRegMuestreo->numeroActaMuestreo 			=OWASP::RequestString('numeroActaMuestreo');
	$oRegMuestreo->frecuencia8 					=OWASP::RequestString('frecuencia8');
	$oRegMuestreo->frecuencia8_5 				=OWASP::RequestString('frecuencia8_5');
	$oRegMuestreo->frecuencia9 					=OWASP::RequestString('frecuencia9');
	$oRegMuestreo->frecuencia9_5 				=OWASP::RequestString('frecuencia9_5');
	$oRegMuestreo->frecuencia10 				=OWASP::RequestString('frecuencia10');
	$oRegMuestreo->frecuencia10_5 				=OWASP::RequestString('frecuencia10_5');
	$oRegMuestreo->frecuencia11 				=OWASP::RequestString('frecuencia11');
	$oRegMuestreo->frecuencia11_5 				=OWASP::RequestString('frecuencia11_5');
	$oRegMuestreo->frecuencia12 				=OWASP::RequestString('frecuencia12');
	$oRegMuestreo->frecuencia12_5 				=OWASP::RequestString('frecuencia12_5');
	$oRegMuestreo->frecuencia13 				=OWASP::RequestString('frecuencia13');
	$oRegMuestreo->frecuencia13_5 				=OWASP::RequestString('frecuencia13_5');
	$oRegMuestreo->frecuencia14 				=OWASP::RequestString('frecuencia14');
	$oRegMuestreo->frecuencia14_5 				=OWASP::RequestString('frecuencia14_5');
	$oRegMuestreo->frecuencia15 				=OWASP::RequestString('frecuencia15');
	$oRegMuestreo->frecuencia15_5 				=OWASP::RequestString('frecuencia15_5');
	$oRegMuestreo->frecuencia16 				=OWASP::RequestString('frecuencia16');
	$oRegMuestreo->frecuencia16_5 				=OWASP::RequestString('frecuencia16_5');
	$oRegMuestreo->frecuencia17 				=OWASP::RequestString('frecuencia17');
	$oRegMuestreo->frecuencia17_5 				=OWASP::RequestString('frecuencia17_5');
	$oRegMuestreo->frecuencia18 				=OWASP::RequestString('frecuencia18');
	$oRegMuestreo->totalEjemplares 				=OWASP::RequestString('totalEjemplares');
	$oRegMuestreo->moda 						=OWASP::RequestString('moda');
	$oRegMuestreo->frecuencia 					=OWASP::RequestString('frecuencia');
	$oRegMuestreo->porcJuveniles 				=OWASP::RequestString('porcJuveniles');
	$oRegMuestreo->observaciones 				=OWASP::RequestString('observaciones');
	$oRegMuestreo->pregunta11 					=OWASP::RequestString('pregunta11');
	$oRegMuestreo->pregunta12 					=OWASP::RequestString('pregunta12');

	//Buscando Observacion 
	$oObserv = CmsParameter::getItem(OWASP::RequestString('obsInusual'));
	if($oObserv != NULL){$oRegMuestreo->obsInusual=$oObserv->alias;}else{$oRegMuestreo->obsInusual='';  };

	switch($cmd){
		case 'insert' : 
		if(CrmMuestreo::AddNew($oRegMuestreo)){
			Response('Muestreo - Registrado Correctamente.',$oRegMuestreo->chiID);
		}else{
			RaiseError(CrmMuestreo::GetErrorMsg());
			return;
		}
		break;

		case 'update' : 
		if(CrmMuestreo::Update($oRegMuestreo)){
			Response('Muestreo - Actualizado Correctamente.',$oRegMuestreo->chiID);
		}else{
			RaiseError(CrmMuestreo::GetErrorMsg());
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