<?php if ($maxPgs>1) {
$xlink="</td><td align='right'> <input type='hidden' name='Pg' value='$Pg'> Pag. ";

$j=floor($Pg/10)*10;
if($Pg>10) $xlink.="<a href='javascript:MovePg(".($j-1).")'><<</a> ";
for ($i=0;$i<10;$i++){
	if($j==$Pg)
		$xlink.= "<b>".($j+1)."</b> ";
		else
			$xlink.= "<a href='javascript:MovePg($j)'>".($j+1)."</a> ";
	if(($j+1)>=$maxPgs) break;
	$j++;
}
if(($j+1)<$maxPgs) $xlink.="<a href='javascript:MovePg($j)'>>></a> ";
print $xlink;
} ?>