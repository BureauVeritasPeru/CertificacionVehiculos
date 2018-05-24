<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$list= CrmUbigeo::getProvincia_List($_GET['id']);                                         

echo "<option value=\"0\">[SELECCIONE]</option>"; 
foreach ($list as $obj) {
	$selected=NULL;
	//if($obj->cod_prov==$_GET['selProv']) $selected =" selected"; 
        echo "<option value=\"".$obj->cod_prov."\"$selected>".htmlentities($obj->nombre, ENT_QUOTES, "UTF-8")."</option>";
}
?>