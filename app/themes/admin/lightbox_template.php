<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js ie6" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" dir="ltr" lang="es"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" dir="ltr" lang="es">
<!--<![endif]-->
<head>
	<title><?php echo $MODULE->moduleName;?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="../assets/admin/css/estilos.css" type="text/css" />
	<link rel="stylesheet" href="../assets/admin/css/simplemodal.css" type="text/css" />
	<link rel="shortcut icon" href="../assets/admin/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="assets/admin/favicon.ico" type="image/ico" />
	<script type="text/javascript" src="../assets/admin/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/admin/js/jquery.simplemodal.js"></script>
	<script type="text/javascript" src="../assets/admin/js/navigate.js"></script>
    <script type="text/javascript">
	<?php echo $MODULE->clientScript; ?>
    </script>
</head>

<body style="background-color: #fff;">
<div id="principal" style="width:100%; box-shadow: none;">
    <h1 class="titulo"><?php echo $MODULE->moduleName;?></h1>
    <?php if($MODULE->FormView!="list"){ ?>
    <h2 class="subtitulo"><?php echo $MODULE->getFormTitle();?></h2>
    <?php } ?>
    <form name="frmBrowse" action="<?php echo $MODULE->getURL();?>" method="post">
        <input type="hidden" name="Command" id="Command">
        <input type="hidden" name="moduleID" id="moduleID" value="<?php echo $MODULE->moduleID; ?>">
        <input type="hidden" name="FormView" id="FormView" value="<?php echo $MODULE->FormView; ?>">
        <input type="hidden" name="kID" id="kID" value="<?php echo $kID;?>">
        <input type="hidden" name="Page" id="Page" value="<?php echo $MODULE->Page;?>">
        <input type="hidden" name="OrderBy" id="OrderBy" value="<?php echo $MODULE->OrderBy;?>">
        <?php
            $file_view="../app/view/admin/".$MODULE->getFormView();
            if(file_exists($file_view))
                include($file_view);
            else
                $MODULE->addError("No se puede localizar el archivo: ".$file_view);
        ?>
        <?php if($MODULE->msgError!=""){ ?>
            <div id="divError"><ul><?php echo $MODULE->msgError;?></ul></div>
        <?php }?>
        <?php if($MODULE->msgAlert!=""){ ?>
            <div id="divAlert"><ul><?php echo $MODULE->msgAlert;?></ul></div>
        <?php }?>
    </form>
</div>
</body>
</html>