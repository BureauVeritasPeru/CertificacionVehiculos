<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");


Consulta();

function Consulta(){

  $cod =OWASP::RequestString('ID');
  $oChata = CrmChata::getItemCHI($cod);
  $oTolva = CrmTolva::getItemCHI($cod);
  $oMuestreo = CrmMuestreo::getItemCHI($cod);


  if(CrmChi::Delete($cod)){
    if(CrmChata::Delete($oChata->chataID)){
      if(CrmSisesat::Delete($oChata->chataID)){
        if($oTolva != NULL){
          if(CrmTolva::Delete($oTolva->tolvaID)){
            if($oMuestreo != NULL){
              if(CrmMuestreo::Delete($oMuestreo->muestreoID)){
                Response('Registro Eliminado Correctamente');
              }else{
                RaiseError('Muestreo de CHI no Eliminado , comuniquese con el administrador');
                return;    
              }
            }else
            {
               Response('Registro Eliminado Correctamente');
            }
          }else{
            RaiseError('Tolva de CHI no Eliminado , comuniquese con el administrador');
            return;    
          }
        }else{
           Response('Registro Eliminado Correctamente');
        }
      }else{
        RaiseError('SiseSat de CHI no Eliminado , comuniquese con el administrador');
        return;    
      }
    }
    else 
    {
      RaiseError('Chata de CHI no Eliminado , comuniquese con el administrador');
      return;
    }
  }
  else 
  { 
    RaiseError('CHI no Eliminado , comuniquese con el administrador');
    return;
  }
}

function Response($msg){
  echo json_encode(array('retval'=>'1','message'=>$msg));
  exit;
  return;
}

function RaiseError($msg){
  echo json_encode(array('retval'=>'0', 'message'=>$msg));
  exit;
  return;
}
?>