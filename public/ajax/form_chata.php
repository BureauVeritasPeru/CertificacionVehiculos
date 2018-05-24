<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");//ISOOO!!

$cmd  	 = OWASP::RequestString('cmd');
$valor   = 1;

RegisterChatayChi($cmd);


function RegisterChatayChi($cmd){
	$oRegCHI = new eCrmChi();
	$oRegChata = new eCrmChata();

	//Common Fields
	$oRegCHI->userID 			 		=OWASP::RequestInt('userID');
	$oRegCHI->localID 			 		=OWASP::RequestInt('localID');
	$oRegCHI->estado					=1;
	$oRegCHI->pendiente					=OWASP::RequestInt('pendiente');

	//Buscando Planta 
	$oPlanta = CrmPlanta::getItemCodigo(OWASP::RequestString('codigoPlanta'));
	if($oPlanta != NULL){$oRegChata->plantaID = $oPlanta->plantaID;}else{$oRegChata->plantaID = '';}
	$oRegChata->nombrePlanta 	 		=OWASP::RequestString('nombrePlanta');
	$oRegChata->puertoPlanta 	 		=OWASP::RequestString('puertoPlanta');
	$oRegChata->zonaPlanta		 		=OWASP::RequestString('zonaPlanta');
	$oRegChata->numeroActaDesembarque	=OWASP::RequestString('numeroActaDesembarque');
	$oRegChata->pescaDeclarada		 	=OWASP::RequestString('pescaDeclarada');
	$oRegChata->cierrePuerto 			=OWASP::RequestString('cierrePuerto');
	$oRegChata->pregunta1		 		=OWASP::RequestString('pregunta1');
	$oRegChata->pregunta2				=OWASP::RequestString('pregunta2');
	$oRegChata->pregunta3		 		=OWASP::RequestString('pregunta3');
	$oRegChata->pregunta4 				=OWASP::RequestString('pregunta4');
	$oRegChata->pregunta5 				=OWASP::RequestString('pregunta5');
	//Buscando Inspector 
	$oInspector = CrmInspector::getItemCodigo(OWASP::RequestString('codigoInspector'));
	if($oInspector != NULL){$oRegChata->inspectorID = $oInspector->inspectorID;}else{$oRegChata->inspectorID = '';}
	$oRegChata->nombreInspector 	 	=OWASP::RequestString('nombreInspector');

	//Buscando Observacion 
	$oObserv = CmsParameter::getItem(OWASP::RequestString('obsInusual'));
	if($oObserv != NULL){$oRegChata->obsInusual=$oObserv->alias;}else{$oRegChata->obsInusual='';  };

	switch($cmd){
		case 'insert' : if(CrmChi::AddNew($oRegCHI)){
			CrmChata::AddNew($oRegChata);
			for ($i = 1; $i <= 3; $i++) {
				if(OWASP::RequestString('tipoSisesat'.$i) != '0'){
					${'oRegSisesat'.$i} = new eCrmSisesat();
					${'oRegSisesat'.$i}->tipoSisesat = OWASP::RequestString('tipoSisesat'.$i);
					${'oRegSisesat'.$i}->horaSisesat = OWASP::RequestString('horaSisesat'.$i);
					${'oRegSisesat'.$i}->operatividadSisesat = OWASP::RequestString('operatividadSisesat'.$i);
					${'oRegSisesat'.$i}->contestadoSisesat = OWASP::RequestString('contestadoSisesat'.$i);
					CrmSisesat::AddNew(${'oRegSisesat'.$i});
				}
			}
			Response('Chata - Registrado Correctamente.',$oRegChata->chiID);
		}else{
			RaiseError(CrmChi::GetErrorMsg());
			return;
		}
		break;

		case 'update' : 
		$oRegCHI->chiID =OWASP::RequestInt('ID');
		$oRegChata->chiID =$oRegCHI->chiID;
		if(CrmChi::Update($oRegCHI)){
			CrmChata::Update($oRegChata);
			$oChata = CrmSisesat::getWebListChata($oRegChata->chiID);
			$countChata = 0 ; 
			foreach ($oChata as $valor) {
				$countChata++;
				${'oRegSisesat'.$countChata} = new eCrmSisesat();
				${'oRegSisesat'.$countChata}->sisesatID = $valor->sisesatID;
				${'oRegSisesat'.$countChata}->tipoSisesat = OWASP::RequestString('tipoSisesat'.$countChata);
				${'oRegSisesat'.$countChata}->horaSisesat = OWASP::RequestString('horaSisesat'.$countChata);
				${'oRegSisesat'.$countChata}->operatividadSisesat = OWASP::RequestString('operatividadSisesat'.$countChata);
				${'oRegSisesat'.$countChata}->contestadoSisesat = OWASP::RequestString('contestadoSisesat'.$countChata);
				CrmSisesat::Update(${'oRegSisesat'.$countChata});
			}
			

			Response('Chata - Actualizado Correctamente.',$oRegCHI->chiID);
		}else{
			RaiseError(CrmChi::GetErrorMsg());
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