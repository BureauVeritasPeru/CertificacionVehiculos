<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$action =OWASP::RequestString('action');

switch ($action) {
    case 'updateCertIncomp':
        ActualizarCertIncomp();
        break;
    default:
        RaiseError('No tiene permisos para estos recursos');
        break;
}

function ActualizarCertIncomp(){
    $tipo_servicioID    =OWASP::RequestInt('tipo_servicioID');
    $nro_certificado    =OWASP::RequestInt('nro_certificado');
    $inspectorID        =OWASP::RequestInt('inspectorID');
    $formatoID          =OWASP::RequestInt('nro_formato');
    $calcomaniaID        =OWASP::RequestInt('nro_calcomania');
    
    if($tipo_servicioID == 70){
        if(ValidarFormatoGLP($formatoID,$inspectorID)!=NULL && ValidarCalcomaniaGLP($calcomaniaID,$inspectorID)!=NULL){
            GlpCertificado::UpdateFormato($formatoID,$nro_certificado);
            GlpCertificado::UpdateCalcomania($calcomaniaID,$nro_certificado);
            GlpFormato::UpdateState2($formatoID);
            GlpCalcomania::UpdateState2($calcomaniaID);
            Response('Formato y Calcomanía actualizados correctamente');
        }
    }
    else if($tipo_servicioID == 71){
        if(ValidarFormatoGNV($formatoID,$inspectorID)!=NULL && ValidarCalcomaniaGNV($calcomaniaID,$inspectorID)!=NULL){
            GnvCertificado::UpdateFormato($formatoID,$nro_certificado);
            GnvCertificado::UpdateCalcomania($calcomaniaID,$nro_certificado);
            GnvFormato::UpdateState2($formatoID);
            GnvCalcomania::UpdateState2($calcomaniaID);            
            Response('Formato y Calcomanía actualizados correctamente');
        }
    }
}

function ValidarFormatoGLP($formatoID,$inspectorID){
    $oFormato = GlpFormato::getItem($formatoID);
    if($oFormato!=NULL){
        if($oFormato->userID == $inspectorID){
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

function ValidarCalcomaniaGLP($calcomaniaID,$inspectorID){
    $oCalcomania = GlpCalcomania::getItem($calcomaniaID);
    if($oCalcomania!=NULL){
        if($oCalcomania->userID == $inspectorID){
            if($oCalcomania->estado == '2'){
                RaiseError('El N° de calcomanía ya fue usado');
                return;
            }
            else if($oCalcomania->estado == '0'){
                RaiseError('El N° de calcomanía está anulado');
                return;
            }
        }
        else{
            RaiseError('El N° de calcomanía no le pertenece');
            return; 
        }
    }
    else {
        RaiseError('El N° de calcomanía no existe');
        return; 
    }
    return $oCalcomania;
}

function ValidarFormatoGNV($formatoID,$inspectorID){
    $oFormato = GnvFormato::getItem($formatoID);
    if($oFormato!=NULL){
        if($oFormato->userID == $inspectorID){
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

function ValidarCalcomaniaGNV($calcomaniaID,$inspectorID){
    $oCalcomania = GnvCalcomania::getItem($calcomaniaID);
    if($oCalcomania!=NULL){
        if($oCalcomania->userID == $inspectorID){
            if($oCalcomania->estado == '2'){
                RaiseError('El N° de calcomanía ya fue usado');
                return;
            }
            else if($oCalcomania->estado == '0'){
                RaiseError('El N° de calcomanía está anulado');
                return;
            }
        }
        else{
            RaiseError('El N° de calcomanía no le pertenece');
            return; 
        }
    }
    else {
        RaiseError('El N° de calcomanía no existe');
        return; 
    }
    return $oCalcomania;
}


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