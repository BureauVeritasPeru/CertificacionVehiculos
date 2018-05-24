<style>

tr{
    text-align: center;
    font-size: 10px;
}
.bord{
    border : 3px solid #000;

}
.gray{
    background-color: #C0C0C0;
    border : 3px solid #000;
}

.red{
    background-color: #E6B8B7;
    border : 3px solid #000;
}

.green{
    background-color: #C4D79B;
    border : 3px solid #000;
}
.soft{
    border-left : 1px solid #000;
    border-right : 1px solid #000;
    border-top : 1px solid #000;
}
.pendiente{
    background-color: #c6e0b4;
    border-left : 1px solid #000;
    border-right : 1px solid #000;
    border-top : 1px solid #000;
}

.pendientedash{
    background-color: #c6e0b4;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-top:3px dashed #000;

}
.softdash{
    border-top:3px dashed #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
}
.softfinal{
    border-top:1px solid #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom:1px solid #000;
}
.softfinaldash{
    border-top:1px dashed #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom:1px solid #000;
}

.pendientefinal{
    background-color: #c6e0b4;
    border-top:1px solid #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom:1px solid #000;
}
.pendientefinaldash{
    background-color: #c6e0b4;
    border-top:1px dashed #000;
    border-left:1px solid #000;
    border-right:1px solid #000;
    border-bottom:1px solid #000;
}

</style>

<?php 
session_start();
require_once("../../config/main.php");
require_once("../../app/include/admin/header_ajax.php");

// file name for download

$fileName = "reporte_general_glp" . date('Ymd') . ".xls";
function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$fechaIni       =OWASP::RequestString('fechaIni');
$fechaFin       =OWASP::RequestString('fechaFin');
$userID         =OWASP::RequestInt('userID');

// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table>
    <tr>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    <tr>
        <th class="gray">Nro. Certificado</th>
        <th class="gray">Nro. Formato </th>
        <th class="gray">Taller</th>
        <th class="gray">Sede del Taller</th>
        <th class="gray">Placa</th>
        <th class="gray">Fecha de emisi&oacute;n</th>
        <th class="gray">Tipo de Certificado</th>
        <th class="gray">A&ntilde;o de Fabricaci&oacute;n</th>
        <th class="gray">Costo (S/.)</th>
        <th class="gray">Inspector</th>
    </tr>
    <?php 
    $list=CrmReportes::getItemReporteGeneralGLP($fechaIni,$fechaFin, $userID);
    foreach ($list as $oItem){
        $date = new DateTime($oItem->fechaEmi);
    ?>
    <tr>
        <td class="<?php echo $valor; ?>"><?php echo $oItem->certificadoID; ?></td>
        <td class="<?php echo $valor; ?>"><?php echo $oItem->formatoID; ?></td>
        <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->razonSocial, ENT_QUOTES, "UTF-8"); ?></td>
        <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->sede, ENT_QUOTES, "UTF-8"); ?></td>
        <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->placa, ENT_QUOTES, "UTF-8"); ?></td>
        <td class="<?php echo $valor; ?>"><?php echo date_format($date, 'd/m/y'); ?> </td>
        <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->tipo, ENT_QUOTES, "UTF-8"); ?></td>
        <td class="<?php echo $valor; ?>"><?php echo $oItem->ano_fab; ?></td>
        <td class="<?php echo $valor; ?>"><?php echo $oItem->costo; ?></td>
        <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->usuario, ENT_QUOTES, "UTF-8"); ?></td>
    </tr>
    <?php } ?>
    
    </table>
    <?php exit();?>