<?php 
session_start(); 
require_once("../../config/main.php"); 
require_once("../../app/include/admin/header_ajax.php"); 

$lTalleres = CrmTaller::getList();
echo '<option value="0">[SELECCIONE]</option>';
foreach ($lTalleres as $obj){
	echo '<option value="'.$obj->tallerID.'">'.$obj->razonSocial.'</option>';
}
?>