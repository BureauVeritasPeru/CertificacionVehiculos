<?php
session_start();
header("content-type: text/html; charset=utf-8");
require_once("../../app/config/main.php");

$oRegForm = new eCrmRegisterForm();
$oRegForm->formID = OWASP::RequestInt('formID');

$oRegForm->name		=OWASP::RequestString('name');
$oRegForm->lastname	=OWASP::RequestString('lastname');
$oRegForm->phone	=OWASP::RequestString('phone');
$oRegForm->email	=OWASP::RequestString('email');
$oRegForm->contactID=OWASP::RequestInt('contactID');
$oRegForm->comment	=OWASP::RequestString('comment');
$oRegForm->address	=OWASP::RequestString('address');
$oRegForm->optin    =OWASP::RequestBoolean('optin');
$oRegForm->state	=2; //Pendiente

$field = OWASP::RequestArray('field');
$upload=isset($_FILES['field'])? $_FILES['field']: NULL;

if($oRegForm->formID!=NULL){
    //Submit Form
    RegisterForm($oRegForm, $field, $upload);
}

function RegisterForm($oRegForm, $field, $upload){

    if(CrmRegisterForm::AddNew($oRegForm)){
        while (list($alias, $value) = each($field)){
            if(!RegisterField($oRegForm, $alias, $value)){
                CrmRegisterForm::Delete($oRegForm);
                RaiseError('Ocurrio un error al enviar los datos!');
                return;
            }
        }

        if($upload!=NULL){
            $upload=UploadFile::fixArray($upload);
            $path='../userfiles/form/'.$oRegForm->formID.'/';
            foreach($upload as $file){
                $name=md5($file["name"]).'.'.end(explode('.', $file["name"]));
                if(!RegisterField($oRegForm, key($upload), $name)){
                    CrmRegisterForm::Delete($oRegForm);
                    RaiseError('Ocurrio un error al enviar los datos!');
                    return;
                }

                if(UploadFile::ValidateUpload($file)){
                    UploadFile::MoveUploaded($file, $path.$name);
                }else{
                    CrmRegisterForm::Delete($oRegForm);
                    RaiseError(UploadFile::$ErrorMessage);
                    return;
                }
            }
        }

        //Enviar Notificacion al administrador
        if(!Email::Send_RegisterForm($oRegForm->registerID)){
            RaiseError(Email::$ErrorMessage);
        }

        Response('Gracias por registrarse.');
    }
    else{
        RaiseError(CrmRegisterForm::GetErrorMsg());
    }
	
}

function RegisterField($oRegForm, $alias, $value){
    $oField=CrmFormField::getItem_Alias($alias);
    if($oField!=NULL){
        $oRegField=new CrmRegisterField();
        $oRegField->registerID=$oRegForm->registerID;
        $oRegField->fieldID=$oField->fieldID;
        $oRegField->value=($oField->fieldType!=2)? $value: NULL;
        $oRegField->textValue=($oField->fieldType==2)? $value: NULL;
        return CrmRegisterField::AddNew($oRegField);
    }
    else
        return false;
}

function Response($msg){
    echo '<script type="text/javascript">parent.getMessage(1, "'.$msg.'");</script>';
    exit;
}

function RaiseError($msg){
    echo '<script type="text/javascript">parent.getMessage(0, "'.$msg.'");</script>';
    exit;
}

?>