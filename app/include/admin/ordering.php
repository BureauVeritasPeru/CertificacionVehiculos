<?php
//ordering

function showHeader($field, $title){
global $OrderBy;

	$arrOrder =  explode(" ", $OrderBy);

	if($arrOrder[0]==$field)
		$strOrder="'$field ".(($arrOrder[1]=="ASC") ? "DESC" : "ASC")."'";
	else
		$strOrder="'$field ASC'";
	
	echo "<a href=\"javascript:OrderBy($strOrder)\">$title</a>";
	
}

?>