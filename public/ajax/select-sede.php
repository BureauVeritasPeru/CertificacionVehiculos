<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$list= CrmSede::getWebListByTaller($_GET['id']);

echo "<option value=\"0\">[SELECCIONE]</option>"; 
foreach ($list as $obj) {
	$selected=NULL;
	//if($obj->sedeID==$_GET['id']) $selected =" selected"; 
        echo "<option value=\"".$obj->sedeID."\"$selected>".htmlentities($obj->descripcion, ENT_QUOTES, "UTF-8")."</option>"; 
}
?>