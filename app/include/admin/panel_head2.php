<?php
$oAdmUser = AdmLogin::getUserSession();

?>
    <div class="panel">
	    <div id="logo">
	        <a href="<?php echo $URL_ADMIN?>"><img alt="Ir al Inicio" src="../assets/admin/images/logo.png" border="0" /></a>
	    </div>
	    <div class="info">
	    	<p>
	        <span><strong>usuario:</strong> <?php echo strtolower($oAdmUser->fullName);?></span> |
			<span><a href="<?php echo $URL_ADMIN?>?Command=logoff"><strong>cerrar sesi&oacute;n</strong> X</a></span>
			</p>
		</div>
		<?php require_once('../app/include/admin/menu.php'); ?>
    </div>
