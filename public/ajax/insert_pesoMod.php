<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

Insert();

function Insert(){
    $precertID =OWASP::RequestString('precertID');
    $pesoNetoMod =OWASP::RequestString('pesoNetoMod');
    $cargaUtilMod =OWASP::RequestString('cargaUtilMod');

    $oRegForm = new eGlpPrecertificado();
    $oRegForm->precertID = $precertID;
    $oRegForm->pesoNetoMod = $pesoNetoMod;
    $oRegForm->cargaUtilMod = $cargaUtilMod;


    if(GlpPrecertificado::Update3($oRegForm)){
        Response('Registro de Data Correcta');
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