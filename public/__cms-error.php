<?php
session_start();
//header("content-type: text/html; charset=utf-8");
require_once("../config/main.php");
require_once("../app/include/website/page_request.php");

//Get Error Template:
$lContent =  CmsContentLang::getWebList_Template(98, 2, $langID);
if($lContent->getLength()>0){
    header('location: '.SEO::get_URLContent($lContent->getItem(0)).'?error='.$error);
}
else
{
    header('location: '.SEO::get_URLHome().'?error='.$error);
}
?>