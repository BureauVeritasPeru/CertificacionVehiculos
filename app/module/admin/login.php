<?php
$userName =OWASP::RequestString('userName');
$password =OWASP::RequestString('password');

if($MODULE->Command=='login'){
    $oAdmUser=AdmLogin::Logon($userName, $password);
    if ($oAdmUser!=NULL){
        $MODULE->loadSessionUser();
        $MODULE->registerLog("El usuario ingres&oacute; al sistema");
        header('location: '.$URL_ADMIN);
    }else{
		$ErrDB=AdmLogin::GetErrorMsg();
        $MODULE->addError($ErrDB!=NULL?$ErrDB:'Usuario o Contrase&ntilde;a inv&aacute;lidos!');
    }
}
?>
