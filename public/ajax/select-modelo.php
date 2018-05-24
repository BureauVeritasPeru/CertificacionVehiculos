<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$list= CmsParameterLang::getWebListParent(9,$_GET['id'],1);                                         

echo "<option value=\"0\">[SELECCIONE]</option>"; 
foreach ($list as $obj) {
	$selected=NULL;
	//if($obj->parameterID==$_GET['selProv']) $selected =" selected"; 
        echo "<option value=\"".$obj->parameterID."\"$selected>".htmlentities($obj->parameterName, ENT_QUOTES, "UTF-8")."</option>";
}
?>