<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$list= CrmUbigeo::getDistrito_List($_GET['idDep'],$_GET['idProv']);

echo "<option value=\"0\">[SELECCIONE]</option>"; 
foreach ($list as $obj) {
	$selected=NULL;
	//if($obj->cod_dist==$_GET['selDist']) $selected =" selected"; 
        echo "<option value=\"".$obj->cod_dist."\"$selected>".htmlentities($obj->nombre, ENT_QUOTES, "UTF-8")."</option>"; 
}
?>