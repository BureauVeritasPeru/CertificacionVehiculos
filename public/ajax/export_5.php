<style>

tr{
    text-align: center;
    font-size: 10px;
}
.bord{
    border : 3px solid #000;

}
.light_blue{
    background-color: #DAEEF3;
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

$fileName = "Registro_RO_y_Decomisos" . date('Ymd') . ".xls";
function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$fechaInicial5 =OWASP::RequestString('fechaInicial5');
$fechaFinal5   =OWASP::RequestString('fechaFinal5');
$local5        =OWASP::RequestInt('local5');    


// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table>
    <tr>
        <th class="light_blue" colspan='13'>REPORTE DE OCURRENCIA</th>
        <th class="light_blue" colspan='6'>DECOMISO</th>
    </tr>
    <tr>
        <th class="light_blue">Nro</th>
        <th class="light_blue">Nro. de Acta de Inspecci&oacute;n</th>
        <th class="light_blue">Fecha</th>
        <th class="light_blue">Hora</th>
        <th class="light_blue">Nro de Acta de RO</th>
        <th class="light_blue">Infractor </th>
        <th class="light_blue">Numeral Infrigido(sub codigo) </th>
        <th class="light_blue">EIP</th>
        <th class="light_blue">Embarcaci&oacute;n</th>
        <th class="light_blue">Matricula</th>
        <th class="light_blue">Puerto</th>
        <th class="light_blue">Regi&oacute;n</th>
        <th class="light_blue">Especie</th>
        <th class="light_blue">Nro de Acta de Decomiso</th>
        <th class="light_blue">TM Autorizadas</th>
        <th class="light_blue">TM Descargadas</th>
        <th class="light_blue">TM Decomisadas</th>
        <th class="light_blue">Sub codigo de Numeral de Decomiso</th>
        <th class="light_blue">Empresa Supervisora</th>
    </tr>
    <?php 
    $count=0;$conteoTotal=0;
    $list=CrmReportes::getItemReporte5($fechaInicial5,$fechaFinal5,$local5);
    foreach ($list as $oItem){
        $conteoTotal++;
        $dateI = new DateTime($oItem->fechaInicial);
        $valor ='softfinal';
    ?>
        <tr>
            <td class="<?php echo $valor; ?>">&nbsp;<?php echo $conteoTotal; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->numActaInspeccion; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo date_format($dateI, 'd/m/y'); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->horaInicio; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->numReporteOcurrencia; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->infractor; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo 'falta'; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->nombrePlanta, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->nombreEmbarcacion, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->matriculaEmbarcacion, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->puertoPlanta, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->regionPlanta, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->especie, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->actaDecomiso; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->capacidadBodega; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->tmDescargado; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->tmDecomisado; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->subCodigoNumeroDecomiso; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->empresaSupervisora, ENT_QUOTES, "UTF-8"); ?> </td>
        </tr>
    <?php } ?>
    </table>
    <?php exit();?>