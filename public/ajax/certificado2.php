<?php 
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

// file name for download
$cert                =OWASP::RequestString('cert2');
$fecha               =OWASP::RequestString('fecha');
$planta              =OWASP::RequestString('planta');
$lReporte = CrmReportes::getListCertificacion($fecha,$planta);
?>
<script>
 window.onload = function(){
    <?php 
    $count=0;
    foreach ($lReporte as $val) {
        $count++;
        ?>
        var selector = document.getElementById('modal-frame');
        var iframe<?php echo $count; ?> = document.createElement('iframe');
        iframe<?php echo $count; ?>.setAttribute('src','<?php echo SEO::get_URLHome(); ?>ajax/certificado.php?cert1=<?php echo $cert; ?>&nroActaInspeccion=<?php echo $val->nroActa; ?>');
        selector.appendChild(iframe<?php echo $count; ?>);
        <?php } ?>
    }
</script>   
<div id="modal-frame" style="display: none;"></div>
<?php
// // // // headers for download
    // header("Content-Disposition: attachment; filename=prueba");
    // header("Content-Type: application/vnd.ms-excel");


?>


<?php exit();?>