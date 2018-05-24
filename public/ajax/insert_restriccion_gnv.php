<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

Insert();

function Insert(){
    $precertID =OWASP::RequestString('precertID');
    $placaRest =OWASP::RequestString('placaRest');
    $observacionesRest =OWASP::RequestString('observacionesRest');

    $oRegForm = new eGnvRestriccion();
    $oRegForm->precertID = $precertID;
    $oRegForm->placaRest = $placaRest;
    $oRegForm->observacionesRest = $observacionesRest;

    $oRegRest = new eCrmRestriccionPlaca();
    $oRegRest->placa = $placaRest;
    $oRegRest->observaciones = $observacionesRest;
    $oRegRest->state = 1;


    if(GnvRestriccion::AddNew($oRegForm)){
        CrmRestriccionPlaca::AddNew($oRegRest);
        Response('Registro de Restriccion insertado correctamente');
        return;
    }else{
        RaiseError('No se pudo ingresar la restriccion');
    }
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