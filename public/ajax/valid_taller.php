<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");


Consulta();

function Consulta(){

    $taller =OWASP::RequestString('taller');
    $oValor = CrmTaller::getItemValidado($taller);

    if($oValor!=NULL){
      Response($oValor->razonSocial);
  }
  else 
  {
      RaiseError('Taller no validado , verificar');
      return;
  }
}

function Response($val1){
    echo json_encode(array('retval'=>'1','taller'=>$val1));
    exit;
    return;
}

function RaiseError($msg){
    echo json_encode(array('retval'=>'0', 'message'=>$msg));
    exit;
    return;
}
?>