<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $PAGE->pageTitle;?></title>
<link rel="shortcut icon" href="<?php echo $URL_BASE;?>images/favicon.ico">
<link rel="icon" href="<?php echo $URL_BASE;?>images/favicon.ico" type="image/x-icon"/>
<script type="text/javascript" src="<?php echo $URL_BASE;?>js/jquery.js"></script>
<link rel="stylesheet" href="<?php echo $URL_BASE;?>css/nanoscroller.css" />
<script type="text/javascript" src="<?php echo $URL_BASE;?>js/jquery.nanoscroller.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

</head>
<body>
<?php
$file_view ='../app/view/website/' . $PAGE->getFormView() ;
if( file_exists( $file_view ) )
	include $file_view ;
else
	$PAGE->addError("No se puede cargar el archivo => ".$file_view) ;
?>
<?php
$msgErr=$PAGE->getErrorMessage();
if($msgErr!="" && $WEBSITE["DEBUG_MODE"]) echo '<div id="divError">Error:<br />'.$msgErr.'</div>';
?>
<script type="text/javascript">
/*
    GOOGLE ANALYTICS CODE HERE!!
*/
</script>
</body>

</html>
