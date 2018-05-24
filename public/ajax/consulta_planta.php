<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");


Consulta();

function Consulta(){

    $cod =OWASP::RequestString('cod');
    $oValor = CrmPlanta::getItemCodigo($cod);

    if($oValor!=NULL){
      Response($oValor->nombrePlanta , $oValor->puertoPlanta,$oValor->zonaPlanta);
    }
    else 
    {
      RaiseError('Codigo de Planta no registrada , Solicitelo al administrador');
      return;
    }
}

function Response($val1,$val2,$val3){
    echo json_encode(array('retval'=>'1','nombre'=>$val1, 'puerto'=>$val2 , 'zona' =>$val3));
    exit;
    return;
}

function RaiseError($msg){
    echo json_encode(array('retval'=>'0', 'message'=>$msg));
    exit;
    return;
}
?>