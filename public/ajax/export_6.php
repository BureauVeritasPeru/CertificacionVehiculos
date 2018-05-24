<style>

tr{
    text-align: center;
    font-size: 10px;
}
.bord{
    border : 3px solid #000;

}
.light_green{
    background-color: #9BBB59;
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

$fileName = "Registro_parte_Muestreo_" . date('Ymd') . ".xls";
function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$fechaInicial6 =OWASP::RequestString('fechaInicial6');
$fechaFinal6   =OWASP::RequestString('fechaFinal6');
$local6        =OWASP::RequestInt('local6');    


// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table>
    <tr>
        <th class="light_green">Nro</th>
        <th class="light_green">Nro. de Acta de Inspecci&oacute;n</th>
        <th class="light_green">Fecha</th>
        <th class="light_green">Hora</th>
        <th class="light_green">Nro de Acta de Parte de Muestreo</th>
        <th class="light_green">% Juveniles </th>
        <th class="light_green">EIP</th>
        <th class="light_green">Embarcaci&oacute;n</th>
        <th class="light_green">Matricula</th>
        <th class="light_green">Puerto</th>
        <th class="light_green">Regi&oacute;n</th>
        <th class="light_green">Especie</th>
        <th class="light_green">Empresa Supervisora</th>
    </tr>
    <?php 
    $count=0;$conteoTotal=0;
    $list=CrmReportes::getItemReporte6($fechaInicial6,$fechaFinal6,$local6);
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
            <td class="<?php echo $valor; ?>"><?php echo $oItem->nroParteMuestreo; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->porcJuveniles; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->nombrePlanta, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->nombreEmbarcacion, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->matriculaEmbarcacion, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->puertoPlanta, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->regionPlanta, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->especie, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->empresaSupervisora, ENT_QUOTES, "UTF-8"); ?> </td>
        </tr>
    <?php } ?>
    </table>
    <?php exit();?>