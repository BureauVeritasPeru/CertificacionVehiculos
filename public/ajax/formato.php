<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$action =OWASP::RequestString('action');

switch ($action) {
    case 'asignar':
    AsignarFormato();
    break;
    case 'reasignar':
    ReasignarFormato();
    break;
    case 'eliminar':
    EliminarFormato();
    break;
    default:
    RaiseError('No tiene permisos para estos recursos');
    break;
}

function AsignarFormato(){
    $fecha=strftime("%Y-%m-%d %H:%M:%S", time());
    $userAdmin  =AdmLogin::getUserSession();

    //Common Fields
    $nro_inicial =OWASP::RequestInt('nro_inicial');
    $cantidad    =OWASP::RequestInt('cantidad');
    $inspectorID =OWASP::RequestInt('inspectorID');
    $variable = 0;

    if( empty($nro_inicial) || empty($cantidad) || empty($inspectorID)){
        RaiseError('Por favor ingrese todos los datos.');
        return;
    }

    while ($variable < $cantidad) {

        $oFormato = new eGlpFormato();
        $oFormato->formatoID = $nro_inicial;
        $oFormato->userID = $inspectorID;
        $oFormato->userAdmID = $userAdmin->userID;
        $oFormato->fechaCreacion = $fecha;
        $oFormato->estado = 1;

        if(GlpFormato::AddNew($oFormato)){
            $nro_inicial+=1;
            $variable+=1;            
        }
        else {
            RaiseError(GlpFormato::GetErrorMsg());
            return;
        }
    }
    Response('Formato(s) asignado(s) correctamente');
}

function ReasignarFormato(){
    $userAdmin  =AdmLogin::getUserSession();

    //Common Fields
    $nro_inicialre =OWASP::RequestInt('nro_inicialre');
    $nro_finalre    =OWASP::RequestInt('nro_finalre');
    $inspectorIDre =OWASP::RequestInt('inspectorIDre');

    if( empty($nro_inicialre) || empty($inspectorIDre)){
        RaiseError('Por favor ingrese todos los datos.');
        return;
    }

    if(empty($nro_finalre)){
        $nro_finalre = $nro_inicialre;
    }

    while ($nro_inicialre <= $nro_finalre) {

        $oFormato = new eGlpFormato();
        $oFormato->formatoID = $nro_inicialre;
        $oFormato->userID = $inspectorIDre;
        $oFormato->userAdmID = $userAdmin->userID;

        if(GlpFormato::Update($oFormato)){
            $nro_inicialre+=1;         
        }
        else {
            RaiseError(GlpFormato::GetErrorMsg());
            return;
        }
    }
    Response('Formato(s) reasignado(s) correctamente');
}

function EliminarFormato(){

    //Common Fields
    $nro_inicialdel =OWASP::RequestInt('nro_inicialdel');
    $nro_finaldel   =OWASP::RequestInt('nro_finaldel');

    if( empty($nro_inicialdel)){
        RaiseError('Por favor ingrese todos los datos.');
        return;
    }

    if(empty($nro_finaldel)){
        $nro_finaldel = $nro_inicialdel;
    }

    while ($nro_inicialdel <= $nro_finaldel) {

        $oFormato = new eGlpFormato();
        $oFormato->formatoID = $nro_inicialdel;

        if(GlpFormato::Delete($oFormato)){
            $nro_inicialdel+=1;         
        }
        else {
            RaiseError(GlpFormato::GetErrorMsg());
            return;
        }
    }
    Response('Formato(s) eliminado(s) correctamente');
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