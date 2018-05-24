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

$fileName = "Facturacion_" . date('Ymd') . ".xls";
function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$fechaInicial8 =OWASP::RequestString('fechaInicial8');
$fechaFinal8   =OWASP::RequestString('fechaFinal8');
$local8        =OWASP::RequestInt('local8');    
$planta        =OWASP::RequestString('planta');

// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");


$oPlanta = CrmPlanta::getItem($planta);
?>



<table>
    <tr>
        <td class="softfinal">Region</td>
        <td class="softfinal"><?php echo $oPlanta->regionPlanta;?></td>
        <td class="softfinal">Planta</td>
        <td class="softfinal"><?php echo $oPlanta->nombrePlanta;?></td>
    </tr>
    <tr>
        <td class="softfinal">Puerto</td>
        <td class="softfinal"><?php echo $oPlanta->puertoPlanta;?></td>
        <td class="softfinal">Especie</td>
        <td class="softfinal"><?php echo 'ANCHOVETA';?></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="softfinal">Supervisora</td>
        <td class="softfinal"><?php echo 'BUREAU VERITAS DEL PERU S.A.'; ?></td>
    </tr>
</table>
<br/>
<table>
    <tr>
        <th class="light_green">Nro</th>
        <th class="light_green">Embarcaci&oacute;n</th>
        <th class="light_green">Matricula</th>
        <th class="light_green">Peso(TM)</th>
        <th class="light_green">Nro Acta PPPP</th>
        <th class="light_green">Fecha</th>
    </tr>
    <?php 
    $count=0;$conteoTotal=0;
    $list=CrmReportes::getItemReporte8($fechaInicial8,$fechaFinal8,$local8,$planta);
    foreach ($list as $oItem){
        $conteoTotal++;
        $dateI = new DateTime($oItem->fechaInicial);
        $valor ='softfinal';
    ?>
        <tr>
            <td class="<?php echo $valor; ?>">&nbsp;<?php echo $conteoTotal; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->nombreEmbarcacion, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->matriculaEmbarcacion, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->pesoTM, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->nroActa, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo date_format($dateI, 'd/m/y'); ?> </td>
            
        </tr>
    <?php } ?>
    </table>
    <?php exit();?>