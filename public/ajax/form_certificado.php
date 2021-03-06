
<?php 
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$fecha = date('Y/m/d H:m:s');
$action =OWASP::RequestString('action');
$oPrecert = new eGlpPrecertificado();
$oPrecert->precertID        =OWASP::RequestInt('precertID');
$oPrecert->tipocertID       =OWASP::RequestInt('tipocertID');
$oPrecert->placa            =strtoupper(OWASP::RequestString('placa'));
$oPrecert->marcaID          =OWASP::RequestInt('marcaID');
$oPrecert->modeloID         =OWASP::RequestInt('modeloID');
$oPrecert->categoriaID      =OWASP::RequestInt('categoriaID');
$oPrecert->combustibleID    =OWASP::RequestInt('combustibleID');
$oPrecert->version          =strtoupper(OWASP::RequestString('version'));
$oPrecert->ano_fab          =OWASP::RequestInt('ano_fab');
$oPrecert->serie            =strtoupper(OWASP::RequestString('serie'));
$oPrecert->vin              =strtoupper(OWASP::RequestString('vin'));
$oPrecert->motor            =strtoupper(OWASP::RequestString('motor'));
$oPrecert->cilindros        =strtoupper(OWASP::RequestString('cilindros'));
$oPrecert->cilindrada       =strtoupper(OWASP::RequestString('cilindrada'));
$oPrecert->ejes             =strtoupper(OWASP::RequestString('ejes'));
$oPrecert->ruedas           =strtoupper(OWASP::RequestString('ruedas'));
$oPrecert->asientos         =strtoupper(OWASP::RequestString('asientos'));
$oPrecert->pasajeros        =strtoupper(OWASP::RequestString('pasajeros'));
$oPrecert->largo            =strtoupper(OWASP::RequestString('largo'));
$oPrecert->ancho            =strtoupper(OWASP::RequestString('ancho'));
$oPrecert->alto             =strtoupper(OWASP::RequestString('alto'));
$oPrecert->pesoNeto         =strtoupper(OWASP::RequestString('pesoNeto'));
$oPrecert->pesoBruto        =strtoupper(OWASP::RequestString('pesoBruto'));
$oPrecert->cargaUtil        =strtoupper(OWASP::RequestString('cargaUtil'));
$oPrecert->combustibleMod   =strtoupper(OWASP::RequestString('combustibleMod'));
$oPrecert->pesoNetoMod      =strtoupper(OWASP::RequestString('pesoNetoMod'));
$oPrecert->cargaUtilMod     =strtoupper(OWASP::RequestString('cargaUtilMod'));
$oPrecert->fechaCreacion    =$fecha;
$oPrecert->usuCreacion      =OWASP::RequestInt('usuarioID');

$oMarca = new eCmsParameterLang();
$oMarca->langID        = 1;
$oMarca->parameterName =OWASP::RequestString('marcaNew');
$oMarca->active        = 1;
$oMarca->groupID       = 8;

$oModelo = new eCmsParameterLang();
$oModelo->langID            = 1;
$oModelo->parameterName     =strtoupper(OWASP::RequestString('modeloNew'));
$oModelo->parentParameterID =OWASP::RequestInt('marcaNewModID');
$oModelo->active            = 1;
$oModelo->groupID           = 9;

$oCategoria = new eCmsParameterLang();
$oCategoria->langID        = 1;
$oCategoria->parameterName =strtoupper(OWASP::RequestString('categoriaNew'));
$oCategoria->active        = 1;
$oCategoria->groupID       = 4;

$oCombustible = new eCmsParameterLang();
$oCombustible->langID        = 1;
$oCombustible->parameterName =strtoupper(OWASP::RequestString('combustibleNew'));
$oCombustible->active        = 1;
$oCombustible->groupID       = 7;

$oCliente = new eCrmCliente();
if(OWASP::RequestString('clienteID') != null){
	$oCliente->clienteID   =OWASP::RequestString('clienteID');	
}
$oCliente->name        =OWASP::RequestString('name');
$oCliente->lastname    =OWASP::RequestString('lastname');
$oCliente->tipoDoc     =OWASP::RequestString('tipoDoc');
$oCliente->numDoc      =OWASP::RequestString('numDoc');
$oCliente->fecNac      =OWASP::RequestString('fecNac');
$oCliente->sexo        =OWASP::RequestString('sexo');
$oCliente->departamento=OWASP::RequestString('departamento');
$oCliente->provincia   =OWASP::RequestString('provincia');
$oCliente->distrito    =OWASP::RequestString('distrito');
$oCliente->address     =OWASP::RequestString('address');
$oCliente->phone       =OWASP::RequestString('phone');
$oCliente->celular     =OWASP::RequestString('celular');
$oCliente->state       = "1";

$oClienteJur = new eCrmClienteJ();
$oClienteJur->clienteID	 			=  OWASP::RequestString('clienteJID');	
$oClienteJur->razonSocial	 		= OWASP::RequestString('razonSocial');
$oClienteJur->ruc 					= OWASP::RequestString('ruc');
$oClienteJur->representanteLegal 	= OWASP::RequestString('representanteLegal');
$oClienteJur->telefono 				= OWASP::RequestString('telefono');	
$oClienteJur->direccion 			= OWASP::RequestString('direccion');	
$oClienteJur->email 				= OWASP::RequestString('email');	


$oClienteSP = new eCrmClienteSP();
$oClienteSP->clienteID	 			= OWASP::RequestString('clienteSPID');	
$oClienteSP->direccionSP	 		= OWASP::RequestString('direccionSP');
$oClienteSP->celularSP	 			= OWASP::RequestString('celularSP');
$oClienteSP->emailSP	 			= OWASP::RequestString('emailSP');


$txtsearchN = OWASP::RequestString('txtsearchN');
$nID = OWASP::RequestString('nID');
$preID = OWASP::RequestString('preID');

$oCert = new eGlpCertificado();
$oCert->certificadoID   =OWASP::RequestInt('certificadoID');
$oCert->usuarioID       =OWASP::RequestInt('usuarioID');
$oCert->tipoCliente		=OWASP::RequestInt('tipoCliente');
$oCert->clienteID       =OWASP::RequestInt('clienteID');
$oCert->precertID       =OWASP::RequestInt('precertID');
$oCert->tallerID        =OWASP::RequestInt('tallerID');
$oCert->sedeID          =OWASP::RequestInt('sedeID');
$oCert->fechaEmi        =OWASP::RequestString('fechaEmi');
$nuevafecha = strtotime ('+1 year', strtotime($oCert->fechaEmi));
$nuevafecha = date ( 'Y/m/d' , $nuevafecha );
$fecVen = strtotime ('-1 day', strtotime($nuevafecha));
$fecVen = date ( 'Y/m/d' , $fecVen );
$oCert->fechaVen        = $fecVen;    
$oCert->formatoID       =OWASP::RequestInt('formatoID');
$oCert->calcomaniaID    =OWASP::RequestInt('calcomaniaID');
$oCert->observaciones   =OWASP::RequestString('observaciones');
$oCert->fechaCrea       =$fecha;
$oCert->fechaMod        =$fecha;
$oCert->estado          = "1";

$oCompInst = new eGlpCompInst();
$oCompInst->tipoCompID  =OWASP::RequestArray('tipoCompIDT');
$oCompInst->marca       =OWASP::RequestArray('marcaCompT');
$oCompInst->modelo      =OWASP::RequestArray('modeloCompT');
$oCompInst->serie       =OWASP::RequestArray('serieCompT');
$oCompInst->capacidad   =OWASP::RequestArray('capacidadCompT');
$oCompInst->mes_fab     =OWASP::RequestArray('mesCompIDT');
$oCompInst->ano_fab     =OWASP::RequestArray('anoCompT');

$oAforoDoc = new eGlpAforoDoc();
$oAforoDoc->documentoID =OWASP::RequestArray('documentoID');

$oAforoFoto = new eGlpAforoFoto();
$oAforoFoto->fotoID =OWASP::RequestArray('fotoID');

$oCertLog = new eGlpCertificadoLog();
$oCertLog->certificadoID =OWASP::RequestInt('certificadoID');
$oCertLog->placa         =OWASP::RequestString('placa');
$oCertLog->fechaCambio   =$fecha;
$oCertLog->oldFormato    =OWASP::RequestInt('formatoID');
$oCertLog->newFormato    =OWASP::RequestInt('formatoNew');
$oCertLog->usuarioID     =OWASP::RequestInt('usuarioID');
$oCertLog->motivo        =OWASP::RequestString('motivo');



switch ($action) {
	case 'insert':
	GrabarPrecertificado($oPrecert);
	break;
	case 'update':
	ActualizarPrecertificado($oPrecert);
	break;
	case 'addMarca':
	AddMarca($oMarca);
	break;
	case 'addModelo':
	AddModelo($oModelo);
	break;
	case 'addCategoria':
	AddCategoria($oCategoria);
	break;
	case 'addCombustible':
	AddCombustible($oCombustible);
	break;
	case 'searchCli':
	SearchCliente($txtsearchN);
	break;
	case 'getCliN':
	ObtenerCliente($nID);
	break;
	case 'saveCli':
	GrabarCliente($oCliente);
	break;
	case 'actCli':
	ActualizarCliente($oCliente);
	break;
	case 'saveCliJur':
	GrabarClienteJur($oclienteJur);
	break;
	case 'actCliJur':
	ActualizarClienteJur($oClienteJur);
	break;
	case 'saveCliSP':
	GrabarClienteSP($oClienteSP);
	break;
	case 'actCliSP':
	ActualizarClienteSP($oClienteSP);
	break;
	case 'addCliNatural':
	addCliNatural($oCert);
	break;
	case 'insertCert':
	GrabarCertificado($oCert, $oCompInst, $oAforoDoc,$oAforoFoto);
	break;
	case 'actCert':
	ActualizarCertificado($oCert, $oCompInst, $oAforoDoc,$oAforoFoto);
	break;
	case 'changeFormato':
	CambioFormato($oCertLog);
	break;
	case 'downloadAnual':
	DescargaAnual($oPrecert, $oCert, $oCompInst);
	break;	
	case 'downloadInicial':
	DescargaInicial($oPrecert, $oCert, $oCompInst);
	break;
	case 'downloadOriginal':
	DescargaOriginal($oPrecert, $oCert, $oCompInst);
	break;
	case 'removeCliN':
	RemoveCliente($nID,$preID);
	break;
	default:
	RaiseError('No tiene permisos para estos recursos');
	break;
}

function GrabarPrecertificado($oPrecert){
	if(GlpPrecertificado::AddNew($oPrecert)){
		ResponsePre('Cabecera - Registrada Correctamente',$oPrecert->precertID);
	}
	else{
		RaiseError(GlpPrecertificado::GetErrorMsg());
		return;
	}
}

function ActualizarPrecertificado($oPrecert){
	if(GlpPrecertificado::Update($oPrecert)){
		ResponsePre('Cabecera - Actualizada Correctamente',$oPrecert->precertID);
	}
	else{
		RaiseError(GlpPrecertificado::GetErrorMsg());
		return;
	}
}

function AddMarca($oMarca){
	if(CmsParameterLang::AddNew($oMarca)){
		Response('Marca - Registrada Correctamente');
	}
	else{
		RaiseError(CmsParameterLang::GetErrorMsg());
		return;
	}
}

function AddModelo($oModelo){
	if(CmsParameterLang::AddNew($oModelo)){
		Response('Modelo - Registrado Correctamente');
	}
	else{
		RaiseError(CmsParameterLang::GetErrorMsg());
		return;
	}
}

function AddCategoria($oCategoria){
	if(CmsParameterLang::AddNew($oCategoria)){
		Response('Categoría - Registrada Correctamente');
	}
	else{
		RaiseError(CmsParameterLang::GetErrorMsg());
		return;
	}
}

function AddCombustible($oCombustible){
	if(CmsParameterLang::AddNew($oCombustible)){
		Response('Combustible - Registrado Correctamente');
	}
	else{
		RaiseError(CmsParameterLang::GetErrorMsg());
		return;
	}
}

function ObtenerCliente($nID){
	$oCliente =  CrmCliente::getItem($nID);
	$Provincia = CrmUbigeo::getProvincia_Item($oCliente->departamento,$oCliente->provincia);
	if(!isset($provincia)){$Provincia = new eCrmUbigeo();}
	$Distrito = CrmUbigeo::getDistrito_Item($oCliente->departamento,$oCliente->provincia,$oCliente->distrito);
	if(!isset($Distrito)){$Distrito = new eCrmUbigeo();}
	if($oCliente != null){
		ResponseObtCli('Exito', $oCliente->clienteID, $oCliente->name, $oCliente->lastname, $oCliente->tipoDoc, $oCliente->numDoc, $oCliente->fecNac, $oCliente->sexo, $oCliente->departamento, $oCliente->provincia, $oCliente->distrito, $oCliente->address, $oCliente->phone, $oCliente->celular,$Provincia->nombre,$Distrito->nombre);
	}
	else{
		RaiseError(CrmCliente::GetErrorMsg());
		return;

	}
}

function SearchCliente($txtsearchN){
	$message = "";
	$list = CrmCliente::getWebListSearch($txtsearchN);
	if($list->getLength()!=0){
		foreach ($list as $obj){            
			$message.='<tr><td><a href="javascript:getClienteN('.$obj->clienteID.');"><i class="fa fa-eye"></i></a></td>';
			$message.='<td>'.$obj->name.'</td>';
			$message.='<td>'.$obj->lastname.'</td>';
			$message.='<td>'.$obj->numDoc.'</td>';
			$message.='<td>'.$obj->fecNac.'</td></tr>';
		}
		Response($message);
	}
	else{
		RaiseError('No se encontraron datos');
		return;
	}
}

function GrabarCliente($oCliente){
	if(CrmCliente::AddNew($oCliente)){
		ResponseCli('Cliente - Registrado Correctamente',$oCliente->clienteID);
	}
	else{
		RaiseError(CrmCliente::GetErrorMsg());
		return;
	}
}

function ActualizarCliente($oCliente){
	if(CrmCliente::Update($oCliente)){
		ResponseCli('Cliente - Actualizado Correctamente',$oCliente->clienteID);
	}
	else{
		RaiseError(CrmCliente::GetErrorMsg());
		return;
	}
}

function GrabarClienteJur($oClienteJur){
	if(CrmClienteJ::AddNew($oClienteJur)){
		ResponseCli('Cliente Juridico - Registrado Correctamente',$oClienteJur->clienteID);
	}
	else{
		RaiseError(CrmCliente::GetErrorMsg());
		return;
	}
}

function ActualizarClienteJur($oClienteJur){
	if(CrmClienteJ::Update($oClienteJur)){
		ResponseCli('Cliente Juridico - Actualizado Correctamente',$oClienteJur->clienteID);
	}
	else{
		RaiseError(CrmCliente::GetErrorMsg());
		return;
	}
}

function GrabarClienteSP($oClienteSP){
	if(CrmClienteSP::AddNew($oClienteSP)){
		ResponseCli('Sin titulo de Propiedad - Registrado Correctamente',$oClienteSP->clienteID);
	}
	else{
		RaiseError(CrmCliente::GetErrorMsg());
		return;
	}
}

function ActualizarClienteSP($oClienteSP){
	if(CrmClienteSP::Update($oClienteSP)){
		ResponseCli('Sin titulo de Propiedad - Actualizado Correctamente',$oClienteSP->clienteID);
	}
	else{
		RaiseError(CrmCliente::GetErrorMsg());
		return;
	}
}

function addCliNatural($oCert){
	if(CrmClienteCert::AddNew($oCert)){
		ResponseCli('Cliente - Agregado Correctamente',$oCert->clienteID);
	}else{
		RaiseError(CrmClienteCert::GetErrorMsg());
		return;
	}
}

function GrabarCertificado($oCert, $oCompInst, $oAforoDoc,$oAforoFoto){    
	$oValor = CrmTaller::getItemValidado($oCert->tallerID);
	if($oValor != null){
		// if(ValidarFormato($oCert)!=NULL && ValidarCalcomania($oCert)!=NULL){
		if(GlpCertificado::AddNew($oCert)){
			$tipoCompID = $oCompInst->tipoCompID;
			$marca      = $oCompInst->marca;
			$modelo     = $oCompInst->modelo;
			$serie      = $oCompInst->serie;        
			$capacidad  = $oCompInst->capacidad;
			$mes_fab    = $oCompInst->mes_fab;
			$ano_fab    = $oCompInst->ano_fab;

			for ($i=0; $i<count($tipoCompID); $i++){
				$oComp =new eGlpCompInst();
				$oComp->certificadoID=$oCert->certificadoID;
				$oComp->tipoCompID   =$tipoCompID[$i];
				$oComp->marca        =$marca[$i];
				$oComp->modelo       =$modelo[$i];
				$oComp->serie        =$serie[$i];
				$oComp->capacidad    =$capacidad[$i];
				$oComp->mes_fab      =$mes_fab[$i];
				$oComp->ano_fab      =$ano_fab[$i];

				if(!GlpCompInst::AddNew($oComp)){
					GlpCertificado::Delete($oCert);
					//GlpFormato::UpdateState1($oCert->formatoID);
					//GlpCalcomania::UpdateState1($oCert->calcomaniaID);
					RaiseError('Ocurrio un error al registrar los componentes');
					return;
				}
			}

			$documentoID = $oAforoDoc->documentoID;
			for ($i=0; $i<count($documentoID); $i++){
				$oAforo = new eGlpAforoDoc();
				$oAforo->certificadoID = $oCert->certificadoID;
				$oAforo->documentoID   = $documentoID[$i];
				if(!GlpAforoDoc::AddNew($oAforo)){
					GlpCompInst::DeletexCert($oCert->certificadoID);
					GlpCertificado::Delete($oCert);
					// GlpFormato::UpdateState1($oCert->formatoID);
					// GlpCalcomania::UpdateState1($oCert->calcomaniaID);
					RaiseError('Ocurrio un error al registrar el aforo documentario1');
					return;
				}
			}

			$fotoID = $oAforoFoto->fotoID;
			for ($i=0; $i<count($fotoID); $i++){
				$oAforo = new eGlpAforoFoto();
				$oAforo->certificadoID = $oCert->certificadoID;
				$oAforo->fotoID   = $fotoID[$i];
				if(!GlpAforoFoto::AddNew($oAforo)){
					RaiseError('Ocurrio un error al registrar el aforo documentario2');
					return;
				}
			}

			// GlpFormato::UpdateState2($oCert->formatoID);
			// GlpCalcomania::UpdateState2($oCert->calcomaniaID);
			ResponseCert('Certificado - Registrado Correctamente',$oCert->certificadoID);
		}
		else{
			RaiseError(GlpCertificado::GetErrorMsg());
			return;
		}        
		// }F
	}else{
		if(GlpCertificado::AddNew($oCert)){
			$tipoCompID = $oCompInst->tipoCompID;
			$marca      = $oCompInst->marca;
			$modelo     = $oCompInst->modelo;
			$serie      = $oCompInst->serie;        
			$capacidad  = $oCompInst->capacidad;
			$mes_fab    = $oCompInst->mes_fab;
			$ano_fab    = $oCompInst->ano_fab;

			for ($i=0; $i<count($tipoCompID); $i++){
				$oComp =new eGlpCompInst();
				$oComp->certificadoID=$oCert->certificadoID;
				$oComp->tipoCompID   =$tipoCompID[$i];
				$oComp->marca        =$marca[$i];
				$oComp->modelo       =$modelo[$i];
				$oComp->serie        =$serie[$i];
				$oComp->capacidad    =$capacidad[$i];
				$oComp->mes_fab      =$mes_fab[$i];
				$oComp->ano_fab      =$ano_fab[$i];

				if(!GlpCompInst::AddNew($oComp)){
					GlpCertificado::Delete($oCert);
					RaiseError('Ocurrio un error al registrar los componentes');
					return;
				}
			}

			$documentoID = $oAforoDoc->documentoID;
			for ($i=0; $i<count($documentoID); $i++){
				$oAforo = new eGlpAforoDoc();
				$oAforo->certificadoID = $oCert->certificadoID;
				$oAforo->documentoID   = $documentoID[$i];
				if(!GlpAforoDoc::AddNew($oAforo)){
					GlpCompInst::DeletexCert($oCert->certificadoID);
					GlpCertificado::Delete($oCert);
					RaiseError('Ocurrio un error al registrar el aforo documentario3');
					return;
				}
			}

			$fotoID = $oAforoFoto->fotoID;
			for ($i=0; $i<count($fotoID); $i++){
				$oAforo = new eGlpAforoFoto();
				$oAforo->certificadoID = $oCert->precertID;
				$oAforo->fotoID   = $fotoID[$i];
				if(!GlpAforoFoto::AddNew($oAforo)){
					RaiseError('Ocurrio un error al registrar el aforo documentario4');
					return;
				}
			}
			ResponseCert('Certificado - Registrado Correctamente',$oCert->certificadoID);
		}
		else{
			RaiseError(GlpCertificado::GetErrorMsg());
			return;
		}        
		
	}
}

function ActualizarCertificado($oCert, $oCompInst, $oAforoDoc,$oAforoFoto){
	if(GlpCertificado::Update($oCert)){
		$tipoCompID = $oCompInst->tipoCompID;
		$marca      = $oCompInst->marca;
		$modelo     = $oCompInst->modelo;
		$serie      = $oCompInst->serie;        
		$capacidad  = $oCompInst->capacidad;
		$mes_fab    = $oCompInst->mes_fab;
		$ano_fab    = $oCompInst->ano_fab;

		GlpCompInst::DeletexCert($oCert->certificadoID);
		GlpAforoDoc::DeletexCert($oCert->certificadoID);

		for ($i=0; $i<count($tipoCompID); $i++){
			$oComp =new eGlpCompInst();
			$oComp->certificadoID=$oCert->certificadoID;
			$oComp->tipoCompID   =$tipoCompID[$i];
			$oComp->marca        =$marca[$i];
			$oComp->modelo       =$modelo[$i];
			$oComp->serie        =$serie[$i];
			$oComp->capacidad    =$capacidad[$i];
			$oComp->mes_fab      =$mes_fab[$i];
			$oComp->ano_fab      =$ano_fab[$i];

			if(!GlpCompInst::AddNew($oComp)){
				RaiseError('Ocurrio un error al actualizar los componentes');
				return;
			}
		}

		$documentoID = $oAforoDoc->documentoID;
		for ($i=0; $i<count($documentoID); $i++){
			$oAforo = new eGlpAforoDoc();
			$oAforo->certificadoID = $oCert->certificadoID;
			$oAforo->documentoID   = $documentoID[$i];
			if(!GlpAforoDoc::AddNew($oAforo)){
				RaiseError('Ocurrio un error al actualizar el aforo documentario');
				return;
			}
		}

		$fotoID = $oAforoFoto->fotoID;
		for ($i=0; $i<count($fotoID); $i++){
			$oAforo = new eGlpAforoFoto();
			$oAforo->certificadoID = $oCert->certificadoID;
			$oAforo->fotoID   = $fotoID[$i];
			if(!GlpAforoFoto::AddNew($oAforo)){
				RaiseError('Ocurrio un error al actualizar las fotos');
				return;
			}
		}
		ResponseCert('Certificado - Actualizado Correctamente',$oCert->certificadoID);
	}
	else{
		RaiseError(GlpCertificado::GetErrorMsg());
		return;
	}
}

function RemoveCliente($nID,$preID){
	if(CrmClienteCert::Remove($nID,$preID)){
		Response('Fila Eliminada Correctamente');
	}else{
		RaiseError(CrmClienteCert::GetErrorMsg());
	}
}


function CambioFormato($oCertLog){
	if(ValidarFormatoLog($oCertLog)!=NULL){
		if(GlpCertificadoLog::AddNew($oCertLog)){
			GlpCertificado::UpdateFormato($oCertLog->newFormato, $oCertLog->certificadoID);
			GlpFormato::UpdateState2($oCertLog->newFormato);
			GlpFormato::UpdateState0($oCertLog->oldFormato);
			ResponseLog('Formato cambiado correctamente',$oCertLog->newFormato);
		}
		else{
			RaiseError(GlpCertificadoLog::GetErrorMsg());
			return;
		}
	}
}

// function ValidarFormato($oCert){
// 	$oFormato = GlpFormato::getItem($oCert->formatoID);
// 	if($oFormato!=NULL){
// 		if($oFormato->userID == $oCert->usuarioID){
// 			if($oFormato->estado == '2'){
// 				RaiseError('El N° de formato ya fue usado');
// 				return;
// 			}
// 			else if($oFormato->estado == '0'){
// 				RaiseError('El N° de formato está anulado');
// 				return;
// 			}
// 		}
// 		else{
// 			RaiseError('El N° de formato no le pertenece');
// 			return; 
// 		}
// 	}
// 	else {
// 		RaiseError('El N° de formato no existe');
// 		return; 
// 	}
// 	return $oFormato;
// }

function ValidarFormatoLog($oCertLog){
	$oFormato = GlpFormato::getItem($oCertLog->newFormato);
	if($oFormato!=NULL){
		if($oFormato->userID == $oCertLog->usuarioID){
			if($oFormato->estado == '2'){
				RaiseError('El N° de formato ya fue usado');
				return;
			}
			else if($oFormato->estado == '0'){
				RaiseError('El N° de formato está anulado');
				return;
			}
		}
		else{
			RaiseError('El N° de formato no le pertenece');
			return; 
		}
	}
	else {
		RaiseError('El N° de formato no existe');
		return; 
	}
	return $oFormato;
}

// function ValidarCalcomania($oCert){
// 	$oCalcomania = GlpCalcomania::getItem($oCert->calcomaniaID);
// 	if($oCalcomania!=NULL){
// 		if($oCalcomania->userID == $oCert->usuarioID){
// 			if($oCalcomania->estado == '2'){
// 				RaiseError('El N° de calcomanía ya fue usado');
// 				return;
// 			}
// 			else if($oCalcomania->estado == '0'){
// 				RaiseError('El N° de calcomanía está anulado');
// 				return;
// 			}
// 		}
// 		else{
// 			RaiseError('El N° de calcomanía no le pertenece');
// 			return; 
// 		}
// 	}
// 	else {
// 		RaiseError('El N° de calcomanía no existe');
// 		return; 
// 	}
// 	return $oCalcomania;
// }

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

function DescargaAnual($oPrecert, $oCert, $oCompInst){
	$oCategoria = CmsParameterLang::getItem($oPrecert->categoriaID, 1);
	$oMarca = CmsParameterLang::getItem($oPrecert->marcaID, 1);
	$oModelo = CmsParameterLang::getItem($oPrecert->modeloID, 1);
	$oCombustible = CmsParameterLang::getItem($oPrecert->combustibleID, 1);

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
	$tipoCompID = $oCompInst->tipoCompID;
	$marca      = $oCompInst->marca;
	$modelo     = $oCompInst->modelo;
	$serie      = $oCompInst->serie;
	$ano_fab    = $oCompInst->ano_fab;
	$mes_fab 	= $oCompInst->mes_fab;
	$capacidad  = $oCompInst->capacidad;

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

	if($fred==''){$fred = 'Sin Titulo de Propiedad';}

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
}

function DescargaInicial($oPrecert, $oCert, $oCompInst){
	$oCategoria = CmsParameterLang::getItem($oPrecert->categoriaID, 1);
	$oMarca = CmsParameterLang::getItem($oPrecert->marcaID, 1);
	$oModelo = CmsParameterLang::getItem($oPrecert->modeloID, 1);
	$oCombustible = CmsParameterLang::getItem($oPrecert->combustibleID, 1);
	$oCombustibleMod = CmsParameterLang::getItem($oPrecert->combustibleMod,1);

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
	$tipoCompID = $oCompInst->tipoCompID;
	$marca      = $oCompInst->marca;
	$modelo     = $oCompInst->modelo;
	$serie      = $oCompInst->serie;
	$ano_fab    = $oCompInst->ano_fab;
	$mes_fab 	= $oCompInst->mes_fab;
	$capacidad  = $oCompInst->capacidad;

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

	if($fred==''){$fred = 'Sin Titulo de Propiedad';}

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
	<td width="80%">'.$oCombustibleMod->parameterName.'</td>
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


function DescargaOriginal($oPrecert, $oCert, $oCompInst){

	$oCategoria = CmsParameterLang::getItem($oPrecert->categoriaID, 1);
	$oMarca = CmsParameterLang::getItem($oPrecert->marcaID, 1);
	$oModelo = CmsParameterLang::getItem($oPrecert->modeloID, 1);
	$oCombustible = CmsParameterLang::getItem($oPrecert->combustibleID, 1);

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
	$tipoCompID = $oCompInst->tipoCompID;
	$marca      = $oCompInst->marca;
	$modelo     = $oCompInst->modelo;
	$serie      = $oCompInst->serie;
	$ano_fab    = $oCompInst->ano_fab;
	$mes_fab 	= $oCompInst->mes_fab;
	$capacidad  = $oCompInst->capacidad;

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

	if($fred==''){$fred = 'Sin Titulo de Propiedad';}

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

function ResponseObtCli($msg, $cliID, $name, $lastname, $tipoDoc, $numDoc, $fecNac, $sexo, $departamento, $provincia, $distrito, $address, $phone, $celular,$nombreProvincia,$nombreDistrito){
	echo json_encode(array('retval'=>'1', 'message'=>$msg, 'cliID'=>$cliID, 'name'=>$name, 'lastname'=>$lastname,'tipoDoc'=>$tipoDoc, 'numDoc'=>$numDoc,'fecNac'=>$fecNac, 'sexo'=>$sexo, 'departamento'=>$departamento, 'provincia'=>$provincia, 'distrito'=>$distrito,'address'=>$address, 'phone'=>$phone,'celular'=>$celular,'nombreProvincia'=>$nombreProvincia,'nombreDistrito'=>$nombreDistrito));
	exit;
	return;
}

function ResponsePre($msg, $precertID){
	echo json_encode(array('retval'=>'1', 'message'=>$msg,'precertID'=>$precertID));
	exit;
	return;
}

function ResponseCli($msg, $clienteID){
	echo json_encode(array('retval'=>'1', 'message'=>$msg,'clienteID'=>$clienteID));
	exit;
	return;
}

function ResponseCert($msg, $certificadoID){
	echo json_encode(array('retval'=>'1', 'message'=>$msg,'certificadoID'=>$certificadoID));
	exit;
	return;
}

function ResponseLog($msg, $newFormato){
	echo json_encode(array('retval'=>'1', 'message'=>$msg,'newFormato'=>$newFormato));
	exit;
	return;
}

function RaiseError($msg){
	echo json_encode(array('retval'=>'0', 'message'=>$msg));
	exit;
	return;
}
?>