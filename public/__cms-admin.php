<?php
session_start();
//header("content-type: text/html; charset=utf-8");
require_once("../config/main.php");
require_once("../app/controller/UI_AdmPage.php");
require_once("../app/include/admin/module_request.php");

$URL_ROOT=SEO::get_URLRoot();
$URL_ADMIN=SEO::get_URLAdmin();
$URL_BASE=SEO::get_URLAssets().'admin/';

if (!AdmLogin::isLogged()){
    $moduleID = 1; //Solo para login
    $MODULE=new UI_AdmPage($moduleID, $FormView, $Command);
    $MODULE->Page=$Page;
    $MODULE->OrderBy=$OrderBy;

    $file_module="../app/module/admin/login.php";
    if(file_exists($file_module))
        include($file_module); //Required module
    else
        $MODULE->addError("No se puede localizar el archivo: ".$file_module);

    include("../app/themes/admin/login_template.php");
    exit;
}
else {
    if($Command == 'logoff'){
        $MODULE=new UI_AdmPage($moduleID, $FormView, $Command);
        if(AdmLogin::isLogged())
            $MODULE->registerLog("El usuario sali&oacute; del sistema");

        AdmLogin::UnregisterUser();
        header('location: '.$URL_ADMIN);
        exit;
    }

    $MODULE=new UI_AdmPage($moduleID, $FormView, $Command);
    $MODULE->Page=$Page;
    $MODULE->OrderBy=$OrderBy;

    $file_module="../app/module/admin/".$MODULE->moduleForm.".php";
    if(file_exists($file_module))
        include($file_module); //Required module
    else
        $MODULE->addError("No se puede localizar el archivo: ".$file_module);

    if($callback){
        $file_view="../app/view/admin/".$MODULE->getFormView();
        if(file_exists($file_view)){
            require_once("../app/include/admin/header_ajax.php");
            include($file_view);
        }
        else
            $MODULE->addError("No se puede localizar el archivo: ".$file_view);
    }
    else
        include("../app/themes/".$ADM_TEMPLATE);

    exit;
}
?>
