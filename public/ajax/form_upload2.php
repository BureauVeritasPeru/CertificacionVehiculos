<?php
session_start();
//header("content-type: text/html; charset=utf-8");
require_once("../../config/main.php");

$oRegForm = new eCrmManageImage();

$field = OWASP::RequestArray('field');
$foto     = OWASP::RequestString('fotoID');
$ID       = OWASP::RequestString('ID');
$upload=isset($_FILES['field'])? $_FILES['field']: NULL;

$oRegForm->precertID = $ID;
$oRegForm->fotoID = $foto;

RegisterForm($oRegForm, $field, $upload);

function RegisterForm($oRegForm, $field, $upload ){
    for($i=0; $i<count($_FILES['field']['name']); $i++){
        if(CrmManageImage::AddNew($oRegForm)){
            if($upload!=NULL){
                $upload=UploadFile::fixArray($upload);
                switch($oRegForm->fotoID){
                    case '116' : $path='../userfiles/foto/cilindro/'; break;
                    case '118' : $path='../userfiles/foto/conmutador/'; break;
                    case '115' : $path='../userfiles/foto/motor/'; break;
                    case '117' : $path='../userfiles/foto/tuberia/'; break;
                }
                $var = '';
                foreach($upload as $file){
                    $name=$file["name"];
                    if($name != NULL && $name != ""){
                        if(UploadFile::ValidateUpload($file)){
                            UploadFile::MoveUploaded($file, $path.$name);
                            $oRegForm->archivo = $file["name"] ; 
                            $var.= $oRegForm->archivo.',';
                            CrmManageImage::Update($oRegForm);
                        }else{
                            CrmManageImage::Delete($oRegForm);
                            RaiseError(UploadFile::$ErrorMessage);
                            return;
                        }
                    }
                }
            }
            Response($var,$oRegForm->fechaRegistro);
        }
        else{
            RaiseError(CrmManageImage::GetErrorMsg());
        }
    }
}
function Response($msg,$msg2){
    echo '<script type="text/javascript">parent.getMessage2(1, "'.$msg.'","'.$msg2.'");</script>';
    exit;
}

function RaiseError($msg){
    echo '<script type="text/javascript">parent.getMessage2(0, "'.$msg.'");</script>';
    exit;
}
