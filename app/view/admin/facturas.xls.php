<?php 
$oTaller = CrmTaller::getItem($tallerID);
$f1 = new DateTime($fechaIni);
$f2 = new DateTime($fechaFin);

$list=CrmReportes::getItemReportexTallerGLPA($fechaIni,$fechaFin,$usuarioID,$tallerID,$tipocertID,$placa);
$count = 0;
foreach ($list as $oItem){
    $count++;
}
?>
<table>
    <tr><th colspan="6">BUREAU VERITAS DEL PER&Uacute; S.A.</th></tr>
    <tr><th colspan="6">ANEXO DE FACTURACI&Oacute;N DE VEH&Iacute;CULOS</th></tr>
    <tr><th colspan="6">&nbsp;</th></tr>
    <tr><td colspan="6" style="text-align: center;">&lsaquo;&lsaquo;Fecha de Cierre <?php echo date_format($f2, 'd/m/y'); ?>&rsaquo;&rsaquo;</td></tr>
    <tr><th colspan="6">&nbsp;</th></tr>
    <tr>
        <td colspan="3" style="font-weight: bold; text-align: left;"><?php echo $oTaller->razonSocial; ?></td>
        <td colspan="3" style="font-weight: bold; text-align: right;">PER-<?php echo $oTaller->per; ?></td>
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
    <tr>
        <td colspan="6" style="font-weight: bold;">Local: <?php echo $oTaller->razonSocial; ?></td>
    </tr>
    <?php 
    $list=CrmReportes::getItemReportexTallerGLPA($fechaIni,$fechaFin,$usuarioID,$tallerID,$tipocertID,$placa);
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
            <td colspan="6" style="font-weight: bold; font-size: 25px;">TOTAL S/ <?php echo $total; ?>+I.G.V.</td>
        </tr>
</table>
