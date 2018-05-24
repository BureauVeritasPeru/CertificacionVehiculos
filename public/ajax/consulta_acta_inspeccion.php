<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");


Consulta();

function Consulta(){
    $cmd =OWASP::RequestString('cmd');
    $acta =OWASP::RequestString('acta');
    

    switch($cmd){
        case 'insert' : 
        $oValor = CrmTolva::getActa($acta);
        if($oValor!=NULL){
            RaiseError('El número de Acta de Inspeccion ya está registrado. Verifique por favor.');
            return;
        }
        else 
        {
            Response('Número de Acta Libre.');
        }
        break;
        case 'update' : 
        $ID =OWASP::RequestString('ID');
        $oValor = CrmTolva::getActaxID($ID);
        if($oValor->numActaInspeccion != $acta){
            $oValor2 = CrmTolva::getActa($acta);
            if($oValor2!=NULL){
                RaiseError('El número de Acta de Inspeccion ya está registrado. Verifique por favor.');
                return;
            }
            else 
            {
                Response('Número de Acta Libre.');
            }
        }
        else 
        {
            Response('Número de Acta Libre.');
        }
        break;
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