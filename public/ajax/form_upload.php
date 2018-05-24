<?php
session_start();
//header("content-type: text/html; charset=utf-8");
require_once("../../config/main.php");

$oRegForm = new eCrmManagePhoto();

$field = OWASP::RequestArray('field');
$documento     = OWASP::RequestString('documentoID');
$ID      = OWASP::RequestString('ID');
$upload=isset($_FILES['field'])? $_FILES['field']: NULL;

$oRegForm->certificadoID = $ID;
$oRegForm->documentoID = $documento;

RegisterForm($oRegForm, $field, $upload);

function RegisterForm($oRegForm, $field, $upload ){

    if(CrmManagePhoto::AddNew($oRegForm)){
        if($upload!=NULL){
            $upload=UploadFile::fixArray($upload);
            switch($oRegForm->documentoID){
                case '42' : $path='../userfiles/form/cargo_certificado/'; break;
                case '44' : $path='../userfiles/form/certificado_reductor/'; break;
                case '43' : $path='../userfiles/form/certificado_tanque/'; break;
                case '48' : $path='../userfiles/form/checklist/'; break;
                case '41' : $path='../userfiles/form/copia_soat_dni/'; break;
                case '40' : $path='../userfiles/form/tarjeta_propiedad/'; break;
                case '45' : $path='../userfiles/form/declaracion_jurada/'; break;
                case '46' : $path='../userfiles/form/fotografias/'; break;
                case '47' : $path='../userfiles/form/vouchers/'; break;
            }
            foreach($upload as $file){
                $name=$file["name"];
                if($name != NULL && $name != ""){
                    if(UploadFile::ValidateUpload($file)){
                        UploadFile::MoveUploaded($file, $path.$name);
                        $oRegForm->archivo = $file["name"] ; 
                        CrmManagePhoto::Update($oRegForm);
                    }else{
                        CrmManagePhoto::Delete($oRegForm);
                        RaiseError(UploadFile::$ErrorMessage);
                        return;
                    }
                }
            }
        }
        Response($oRegForm->archivo,$oRegForm->fechaRegistro);
    }
    else{
        RaiseError(CrmManagePhoto::GetErrorMsg());
    }

}
function Response($msg,$msg2){
    echo '<script type="text/javascript">parent.getMessage(1, "'.$msg.'","'.$msg2.'");</script>';
    exit;
}

function RaiseError($msg){
    echo '<script type="text/javascript">parent.getMessage(0, "'.$msg.'");</script>';
    exit;
}
