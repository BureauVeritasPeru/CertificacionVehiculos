<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

Consulta();

function Consulta(){   
    $placa =OWASP::RequestString('placa');
    $oRestriccion = new eCrmRestriccionPlaca();
    $oRestriccion = CrmRestriccionPlaca::getItembyPlaca($placa); 
    if($oRestriccion != NULL){
        RaiseError('La placa '.$oRestriccion->placa.' presenta estas observaciones :'.$oRestriccion->observaciones);
    }else{
        Response('Placa no presenta Restricciones');
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