<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");


Consulta();

function Consulta(){

    $cod =OWASP::RequestString('cod');
    $oValor= CrmInspector::getItemCodigo($cod); //Observaciones Inusuales
                                                                      


    if($oValor!=NULL){
      Response($oValor->nombreCompletoInspector);
    }
    else 
    {
      RaiseError('Codigo de Inspector no registrada , Solicitelo al administrador');
      return;
    }
}

function Response($val1){
    echo json_encode(array('retval'=>'1','nombre'=>$val1));
    exit;
    return;
}

function RaiseError($msg){
    echo json_encode(array('retval'=>'0', 'message'=>$msg));
    exit;
    return;
}
?>