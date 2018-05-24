<?php
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

$action =OWASP::RequestString('action');

switch ($action) {
    case 'login':
        LoginForm();
        break;
    default:
        RaiseError('No tiene permisos para estos recursos');
        break;
}

function LoginForm(){
    //Common Fields
    $password =OWASP::RequestString('password_login');
    $email    =OWASP::RequestString('usuario_login');

    if( empty($email) || empty($password) ){
        RaiseError('Porfavor ingrese todos los datos.'.$email.' '.$password);
		return;
    }

	if(CrmUser::getItem_Login($email, $password)!=NULL){
		WebLogin::Logon($email, $password);
		Response('Thanks for logon.');
	}
	else {
		RaiseError('Ingrese una cuenta válida y previamente registrada.');
		return;
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