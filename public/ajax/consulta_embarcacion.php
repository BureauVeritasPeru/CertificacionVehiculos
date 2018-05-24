<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");


Consulta();

function Consulta(){

    $mat =OWASP::RequestString('mat');
    $oValor = CrmEmbarcacion::getItemNumeral($mat);

    if($oValor!=NULL){
      Response($oValor->matriculaEmbarcacion , $oValor->nombreEmbarcacion,$oValor->capbod_tm);
    }
    else 
    {
      RaiseError('Matricula de Embarcacion no registrada , Solicitelo al administrador');
      return;
    }
}

function Response($val1,$val2,$val3){
    echo json_encode(array('retval'=>'1','matricula'=>$val1, 'nombre'=>$val2 , 'capacidad' =>$val3));
    exit;
    return;
}

function RaiseError($msg){
    echo json_encode(array('retval'=>'0', 'message'=>$msg));
    exit;
    return;
}
?>