<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$action =OWASP::RequestString('action');

switch ($action) {
    case 'asignar':
        AsignarCalcomania();
        break;
    case 'reasignar':
        ReasignarCalcomania();
        break;
    case 'eliminar':
        EliminarCalcomania();
        break;
    default:
        RaiseError('No tiene permisos para estos recursos');
        break;
}

function AsignarCalcomania(){
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

        $oCalcomania = new eGnvCalcomania();
        $oCalcomania->calcomaniaID = $nro_inicial;
        $oCalcomania->userID = $inspectorID;
        $oCalcomania->userAdmID = $userAdmin->userID;
        $oCalcomania->fechaCreacion = $fecha;
        $oCalcomania->estado = 1;

        if(GnvCalcomania::AddNew($oCalcomania)){
            $nro_inicial+=1;
            $variable+=1;            
        }
        else {
            RaiseError(GnvCalcomania::GetErrorMsg());
            return;
        }
	}
    Response('Calcomania(s) asignada(s) correctamente');
}

function ReasignarCalcomania(){
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

        $oCalcomania = new eGnvCalcomania();
        $oCalcomania->calcomaniaID = $nro_inicialre;
        $oCalcomania->userID = $inspectorIDre;
        $oCalcomania->userAdmID = $userAdmin->userID;

        if(GnvCalcomania::Update($oCalcomania)){
            $nro_inicialre+=1;         
        }
        else {
            RaiseError(GnvCalcomania::GetErrorMsg());
            return;
        }
    }
    Response('Calcomania(s) reasignada(s) correctamente');
}

function EliminarCalcomania(){

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

        $oCalcomania = new eGnvCalcomania();
        $oCalcomania->calcomaniaID = $nro_inicialdel;

        if(GnvCalcomania::Delete($oCalcomania)){
            $nro_inicialdel+=1;         
        }
        else {
            RaiseError(GnvCalcomania::GetErrorMsg());
            return;
        }
    }
    Response('Calcomania(s) eliminada(s) correctamente');
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