<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

/*
$sessionName=md5($_SERVER['SERVER_NAME']);
$cf = OWASP::RequestString('cf');
if (empty($_SESSION[$sessionName]) || strtolower(trim($cf)) != $_SESSION[$sessionName]) {
    RaiseError("Captcha incorrecto");
}
*/

$oRegForm = new eCrmRegisterForm();
$oRegForm->formID = OWASP::RequestInt('formID');

//Common Fields
$oRegForm->name		=OWASP::RequestString('name');
$oRegForm->phone	=OWASP::RequestString('phone');
$oRegForm->email	=OWASP::RequestString('email');
$oRegForm->comment	=OWASP::RequestString('comment');
$oRegForm->state	=2; //Pendiente

$field = OWASP::RequestArray('field');

if($oRegForm->formID!=NULL){
    //Submit Form
    RegisterForm($oRegForm, $field);
}

function RegisterForm($oRegForm, $field){

    if(CrmRegisterForm::AddNew($oRegForm)){
        if(is_array($field)){
            while (list($alias, $value) = each($field)){
                $oField=CrmFormField::getItem_Alias($alias);
                if($oField!=NULL){
                    $oRegField=new CrmRegisterField();
                    $oRegField->registerID=$oRegForm->registerID;
                    $oRegField->fieldID=$oField->fieldID;
                    $oRegField->value=($oField->fieldType!=2)? $value: NULL;
                    $oRegField->textValue=($oField->fieldType==2)? $value: NULL;
                    if(!CrmRegisterField::AddNew($oRegField)){
                        CrmRegisterForm::Delete($oRegForm);
                        RaiseError('Ocurrio un error al enviar los datos.');
                        return;
                    }
                }
            }
        }

        //Enviar Notificacion al administrador
        // if(!Email::Send_RegisterForm($oRegForm->registerID)){
        //     RaiseError(Email::$ErrorMessage);
        // }

        Response('Gracias por registrarse.');
    }
    else{
        RaiseError(CrmRegisterForm::GetErrorMsg());
    }

}

function Response($msg){
    echo filter_input(INPUT_GET, 'callback', FILTER_CALLBACK, array("options"=>"validateXSS")).
    "({
        \"retval\": 1,
        \"message\": \"".$msg."\"
    })";
exit;
return;
}

function RaiseError($err){
    echo filter_input(INPUT_GET, 'callback', FILTER_CALLBACK, array("options"=>"validateXSS")).
    "({
        \"retval\": 0,
        \"message\": \"".$err."\"
    })";
exit;
return;
}

function validateXSS($string){
    return preg_replace('|[^_$a-zA-Z0-9]*|','', $string);
}
?>