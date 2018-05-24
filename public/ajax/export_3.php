<?php 
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

// file name for download

$fileName = "certificados_glp_taller" . date('Ymd') . ".xls";
function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$fechaIni       =OWASP::RequestString('fechaIni3');
$fechaFin       =OWASP::RequestString('fechaFin3');
$userID         =OWASP::RequestInt('userID');
$tallerID       =OWASP::RequestInt('tallerID');
$tipocertID     =OWASP::RequestInt('tipocertID');

$oTaller = CrmTaller::getItem($tallerID);
$f1 = new DateTime($fechaIni);
$f2 = new DateTime($fechaFin);

$list=CrmReportes::getItemReportexTallerGLP($fechaIni,$fechaFin,$userID,$tallerID,$tipocertID);
$count = 0;
foreach ($list as $oItem){
    $count++;
}

// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table>
    <tr><th colspan="6">BUREAU VERITAS DEL PER&Uacute; S.A.</th></tr>
    <tr><th colspan="6">ANEXO DE FACTURACI&Oacute;N DE VEH&Iacute;CULOS</th></tr>
    <tr><th colspan="6">&nbsp;</th></tr>
    <tr><td colspan="6">Fecha Inspecci&oacute;n Del <?php echo date_format($f1, 'd/m/y'); ?> al <?php echo date_format($f2, 'd/m/y'); ?></td></tr>
    <tr><th colspan="6">&nbsp;</th></tr>
    <tr>
        <th colspan="3"><?php echo $oTaller->razonSocial; ?></th>
        <th colspan="3">PER-<?php echo $oTaller->per; ?></th>
    </tr>
    <tr><th colspan="6">&nbsp;</th></tr>
    <tr>
        <?php if($tipocertID == 72){ ?>
        <td colspan="6">Inspecci&oacute;n Anual de <?php echo $count; ?> veh&iacute;culo(s) a GLP</td>
        <?php }else{ ?>
        <td colspan="6">Inspecci&oacute;n de <?php echo $count; ?> veh&iacute;culo(s) convertido(s) a GLP</td>
        <?php } ?>
    </tr>
    <tr><th colspan="6">&nbsp;</th></tr>
    <tr>
        <th>F./Inspecci&oacute;n</th>
        <th>Placa</th>
        <th>VIN</th>
        <th>Nro. de Motor</th>
        <th>Estado</th>
        <th>Precio</th>
    </tr>
    <?php 
    $list=CrmReportes::getItemReportexTallerGLP($fechaIni,$fechaFin,$userID,$tallerID,$tipocertID);
    $total = 0;
    foreach ($list as $oItem){
        $total += $oItem->costo;
        $date = new DateTime($oItem->fechaEmi);
        ?>
        <tr>
            <td class="<?php echo $valor; ?>"><?php echo date_format($date, 'd/m/y'); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->placa, ENT_QUOTES, "UTF-8"); ?></td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->vin, ENT_QUOTES, "UTF-8"); ?></td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->motor, ENT_QUOTES, "UTF-8"); ?></td>
            <td class="<?php echo $valor; ?>"><?php echo GlpCertificado::getState($oItem->estado) ?></td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->costo; ?></td>
        </tr>
        <?php } ?>    
        <tr><th colspan="6">&nbsp;</th></tr>
        <tr>
            <td colspan="6">TOTAL S/ <?php echo $total; ?></td>
        </tr>
    </table>
    <?php exit();?>