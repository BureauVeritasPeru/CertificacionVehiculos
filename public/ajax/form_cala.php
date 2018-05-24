<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");//ISOOO!!

$cmd  	 = OWASP::RequestString('cmd');
$valor   = 1;

RegisterCala($cmd);


function RegisterCala($cmd){
	$oRegCala = new eCrmCala();
	$oRegCala->chiID 	 						=OWASP::RequestString('ID');
	$oRegCala->numReporteCala 	 				=OWASP::RequestString('numReporteCala');
	$oRegCala->codigoFaenaWeb 	 				=OWASP::RequestString('codigoFaenaWeb');

	$oDetCala1 = new eCrmDetalleCala();
	$oDetCala2 = new eCrmDetalleCala();
	$oDetCala3 = new eCrmDetalleCala();
	$oDetCala4 = new eCrmDetalleCala();
	$oDetCala5 = new eCrmDetalleCala();
	$oDetCala6 = new eCrmDetalleCala();
	$oDetCala7 = new eCrmDetalleCala();

	$oDetCala1->correlativo	 					='1';
	$oDetCala1->latitud 	 					=OWASP::RequestString('latitud1');
	$oDetCala1->minLat 	 						=OWASP::RequestString('minLat1');
	$oDetCala1->segLat 	 						=OWASP::RequestString('segLat1');
	$oDetCala1->longitud 	 					=OWASP::RequestString('longitud1');
	$oDetCala1->minLong 	 					=OWASP::RequestString('minLong1');
	$oDetCala1->segLong 	 					=OWASP::RequestString('segLong1');
	$oDetCala1->fechaCala 	 					=OWASP::RequestString('fechaCala1');
	$oDetCala1->horaCala 	 					=OWASP::RequestString('horaCala1');
	$oDetCala1->tmDeclaradas 	 				=OWASP::RequestString('tmDeclaradas1');
	$oDetCala1->juveniles 	 					=OWASP::RequestString('juveniles1');
	$oDetCala1->porcJuveniles 	 				=OWASP::RequestString('porcJuveniles1');
	$oDetCala1->especie 	 					=OWASP::RequestString('especie1');
	$oDetCala1->porcEspecie 	 				=OWASP::RequestString('porcEspecie1');

	$oDetCala2->correlativo	 					='2';
	$oDetCala2->latitud 	 					=OWASP::RequestString('latitud2');
	$oDetCala2->minLat 	 						=OWASP::RequestString('minLat2');
	$oDetCala2->segLat 	 						=OWASP::RequestString('segLat2');
	$oDetCala2->longitud 	 					=OWASP::RequestString('longitud2');
	$oDetCala2->minLong 	 					=OWASP::RequestString('minLong2');
	$oDetCala2->segLong 	 					=OWASP::RequestString('segLong2');
	$oDetCala2->fechaCala 	 					=OWASP::RequestString('fechaCala2');
	$oDetCala2->horaCala 	 					=OWASP::RequestString('horaCala2');
	$oDetCala2->tmDeclaradas 	 				=OWASP::RequestString('tmDeclaradas2');
	$oDetCala2->juveniles 	 					=OWASP::RequestString('juveniles2');
	$oDetCala2->porcJuveniles 	 				=OWASP::RequestString('porcJuveniles2');
	$oDetCala2->especie 	 					=OWASP::RequestString('especie2');
	$oDetCala2->porcEspecie 	 				=OWASP::RequestString('porcEspecie2');

	$oDetCala3->correlativo	 					='3';
	$oDetCala3->latitud 	 					=OWASP::RequestString('latitud3');
	$oDetCala3->minLat 	 						=OWASP::RequestString('minLat3');
	$oDetCala3->segLat 	 						=OWASP::RequestString('segLat3');
	$oDetCala3->longitud 	 					=OWASP::RequestString('longitud3');
	$oDetCala3->minLong 	 					=OWASP::RequestString('minLong3');
	$oDetCala3->segLong 	 					=OWASP::RequestString('segLong3');
	$oDetCala3->fechaCala 	 					=OWASP::RequestString('fechaCala3');
	$oDetCala3->horaCala 	 					=OWASP::RequestString('horaCala3');
	$oDetCala3->tmDeclaradas 	 				=OWASP::RequestString('tmDeclaradas3');
	$oDetCala3->juveniles 	 					=OWASP::RequestString('juveniles3');
	$oDetCala3->porcJuveniles 	 				=OWASP::RequestString('porcJuveniles3');
	$oDetCala3->especie 	 					=OWASP::RequestString('especie3');
	$oDetCala3->porcEspecie 	 				=OWASP::RequestString('porcEspecie3');

	$oDetCala4->correlativo	 					='4';
	$oDetCala4->latitud 	 					=OWASP::RequestString('latitud4');
	$oDetCala4->minLat 	 						=OWASP::RequestString('minLat4');
	$oDetCala4->segLat 	 						=OWASP::RequestString('segLat4');
	$oDetCala4->longitud 	 					=OWASP::RequestString('longitud4');
	$oDetCala4->minLong 	 					=OWASP::RequestString('minLong4');
	$oDetCala4->segLong 	 					=OWASP::RequestString('segLong4');
	$oDetCala4->fechaCala 	 					=OWASP::RequestString('fechaCala4');
	$oDetCala4->horaCala 	 					=OWASP::RequestString('horaCala4');
	$oDetCala4->tmDeclaradas 	 				=OWASP::RequestString('tmDeclaradas4');
	$oDetCala4->juveniles 	 					=OWASP::RequestString('juveniles4');
	$oDetCala4->porcJuveniles 	 				=OWASP::RequestString('porcJuveniles4');
	$oDetCala4->especie 	 					=OWASP::RequestString('especie4');
	$oDetCala4->porcEspecie 	 				=OWASP::RequestString('porcEspecie4');

	$oDetCala5->correlativo	 					='5';
	$oDetCala5->latitud 	 					=OWASP::RequestString('latitud5');
	$oDetCala5->minLat 	 						=OWASP::RequestString('minLat5');
	$oDetCala5->segLat 	 						=OWASP::RequestString('segLat5');
	$oDetCala5->longitud 	 					=OWASP::RequestString('longitud5');
	$oDetCala5->minLong 	 					=OWASP::RequestString('minLong5');
	$oDetCala5->segLong 	 					=OWASP::RequestString('segLong5');
	$oDetCala5->fechaCala 	 					=OWASP::RequestString('fechaCala5');
	$oDetCala5->horaCala 	 					=OWASP::RequestString('horaCala5');
	$oDetCala5->tmDeclaradas 	 				=OWASP::RequestString('tmDeclaradas5');
	$oDetCala5->juveniles 	 					=OWASP::RequestString('juveniles5');
	$oDetCala5->porcJuveniles 	 				=OWASP::RequestString('porcJuveniles5');
	$oDetCala5->especie 	 					=OWASP::RequestString('especie5');
	$oDetCala5->porcEspecie 	 				=OWASP::RequestString('porcEspecie5');

	$oDetCala6->correlativo	 					='6';
	$oDetCala6->latitud 	 					=OWASP::RequestString('latitud6');
	$oDetCala6->minLat 	 						=OWASP::RequestString('minLat6');
	$oDetCala6->segLat 	 						=OWASP::RequestString('segLat6');
	$oDetCala6->longitud 	 					=OWASP::RequestString('longitud6');
	$oDetCala6->minLong 	 					=OWASP::RequestString('minLong6');
	$oDetCala6->segLong 	 					=OWASP::RequestString('segLong6');
	$oDetCala6->fechaCala 	 					=OWASP::RequestString('fechaCala6');
	$oDetCala6->horaCala 	 					=OWASP::RequestString('horaCala6');
	$oDetCala6->tmDeclaradas 	 				=OWASP::RequestString('tmDeclaradas6');
	$oDetCala6->juveniles 	 					=OWASP::RequestString('juveniles6');
	$oDetCala6->porcJuveniles 	 				=OWASP::RequestString('porcJuveniles6');
	$oDetCala6->especie 	 					=OWASP::RequestString('especie6');
	$oDetCala6->porcEspecie 	 				=OWASP::RequestString('porcEspecie6');

	$oDetCala7->correlativo	 					='7';
	$oDetCala7->latitud 	 					=OWASP::RequestString('latitud7');
	$oDetCala7->minLat 	 						=OWASP::RequestString('minLat7');
	$oDetCala7->segLat 	 						=OWASP::RequestString('segLat7');
	$oDetCala7->longitud 	 					=OWASP::RequestString('longitud7');
	$oDetCala7->minLong 	 					=OWASP::RequestString('minLong7');
	$oDetCala7->segLong 	 					=OWASP::RequestString('segLong7');
	$oDetCala7->fechaCala 	 					=OWASP::RequestString('fechaCala7');
	$oDetCala7->horaCala 	 					=OWASP::RequestString('horaCala7');
	$oDetCala7->tmDeclaradas 	 				=OWASP::RequestString('tmDeclaradas7');
	$oDetCala7->juveniles 	 					=OWASP::RequestString('juveniles7');
	$oDetCala7->porcJuveniles 	 				=OWASP::RequestString('porcJuveniles7');
	$oDetCala7->especie 	 					=OWASP::RequestString('especie7');
	$oDetCala7->porcEspecie 	 				=OWASP::RequestString('porcEspecie7');


	switch($cmd){
		case 'insert' : 
		if(CrmCala::AddNew($oRegCala)){
			if($oDetCala1->latitud != "" && $oDetCala1->longitud != "" ){$oDetCala1->calaID = $oRegCala->calaID; CrmDetalleCala::AddNew($oDetCala1);}
			if($oDetCala2->latitud != "" && $oDetCala2->longitud != "" ){$oDetCala2->calaID = $oRegCala->calaID; CrmDetalleCala::AddNew($oDetCala2);}
			if($oDetCala3->latitud != "" && $oDetCala3->longitud != "" ){$oDetCala3->calaID = $oRegCala->calaID; CrmDetalleCala::AddNew($oDetCala3);}
			if($oDetCala4->latitud != "" && $oDetCala4->longitud != "" ){$oDetCala4->calaID = $oRegCala->calaID; CrmDetalleCala::AddNew($oDetCala4);}
			if($oDetCala5->latitud != "" && $oDetCala5->longitud != "" ){$oDetCala5->calaID = $oRegCala->calaID; CrmDetalleCala::AddNew($oDetCala5);}
			if($oDetCala6->latitud != "" && $oDetCala6->longitud != "" ){$oDetCala6->calaID = $oRegCala->calaID; CrmDetalleCala::AddNew($oDetCala6);}
			if($oDetCala7->latitud != "" && $oDetCala7->longitud != "" ){$oDetCala7->calaID = $oRegCala->calaID; CrmDetalleCala::AddNew($oDetCala7);}				
			Response('Cala - Registrado Correctamente.',$oRegCala->chiID );
		}else{
			RaiseError(CrmCala::GetErrorMsg());
			return;
		}
		break;

		case 'update' : 
		if(CrmCala::Update($oRegCala)){
			if($oDetCala1->latitud != "" && $oDetCala1->longitud != "" ){$orespCala = CrmDetalleCala::getItemCorre($oRegCala->chiID,$oDetCala1->correlativo);if($orespCala != NULL){ $oDetCala1->chiID = $oRegCala->chiID;  CrmDetalleCala::Update($oDetCala1);}else{ $respIns = CrmCala::getItemCHI($oRegCala->chiID);  $oDetCala1->calaID = $respIns->calaID;  CrmDetalleCala::AddNew($oDetCala1);}}
			if($oDetCala2->latitud != "" && $oDetCala2->longitud != "" ){$orespCala = CrmDetalleCala::getItemCorre($oRegCala->chiID,$oDetCala2->correlativo);if($orespCala != NULL){ $oDetCala2->chiID = $oRegCala->chiID;  CrmDetalleCala::Update($oDetCala2);}else{ $respIns = CrmCala::getItemCHI($oRegCala->chiID);  $oDetCala2->calaID = $respIns->calaID;  CrmDetalleCala::AddNew($oDetCala2);}}
			if($oDetCala3->latitud != "" && $oDetCala3->longitud != "" ){$orespCala = CrmDetalleCala::getItemCorre($oRegCala->chiID,$oDetCala3->correlativo);if($orespCala != NULL){ $oDetCala3->chiID = $oRegCala->chiID;  CrmDetalleCala::Update($oDetCala3);}else{ $respIns = CrmCala::getItemCHI($oRegCala->chiID);  $oDetCala3->calaID = $respIns->calaID;  CrmDetalleCala::AddNew($oDetCala3);}}
			if($oDetCala4->latitud != "" && $oDetCala4->longitud != "" ){$orespCala = CrmDetalleCala::getItemCorre($oRegCala->chiID,$oDetCala4->correlativo);if($orespCala != NULL){ $oDetCala4->chiID = $oRegCala->chiID;  CrmDetalleCala::Update($oDetCala4);}else{ $respIns = CrmCala::getItemCHI($oRegCala->chiID);  $oDetCala4->calaID = $respIns->calaID;  CrmDetalleCala::AddNew($oDetCala4);}}
			if($oDetCala5->latitud != "" && $oDetCala5->longitud != "" ){$orespCala = CrmDetalleCala::getItemCorre($oRegCala->chiID,$oDetCala5->correlativo);if($orespCala != NULL){ $oDetCala5->chiID = $oRegCala->chiID;  CrmDetalleCala::Update($oDetCala5);}else{ $respIns = CrmCala::getItemCHI($oRegCala->chiID);  $oDetCala5->calaID = $respIns->calaID;  CrmDetalleCala::AddNew($oDetCala5);}}
			if($oDetCala6->latitud != "" && $oDetCala6->longitud != "" ){$orespCala = CrmDetalleCala::getItemCorre($oRegCala->chiID,$oDetCala6->correlativo);if($orespCala != NULL){ $oDetCala6->chiID = $oRegCala->chiID;  CrmDetalleCala::Update($oDetCala6);}else{ $respIns = CrmCala::getItemCHI($oRegCala->chiID);  $oDetCala6->calaID = $respIns->calaID;  CrmDetalleCala::AddNew($oDetCala6);}}
			if($oDetCala7->latitud != "" && $oDetCala7->longitud != "" ){$orespCala = CrmDetalleCala::getItemCorre($oRegCala->chiID,$oDetCala7->correlativo);if($orespCala != NULL){ $oDetCala7->chiID = $oRegCala->chiID;  CrmDetalleCala::Update($oDetCala7);}else{ $respIns = CrmCala::getItemCHI($oRegCala->chiID);  $oDetCala7->calaID = $respIns->calaID;  CrmDetalleCala::AddNew($oDetCala7);}}
			Response('Cala - Actualizado Correctamente.',$oRegCala->chiID );
		}else{
			RaiseError(CrmCala::GetErrorMsg());
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