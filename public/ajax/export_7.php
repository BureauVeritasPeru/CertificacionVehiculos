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

$fileName = "Registro_acta_observaciones_" . date('Ymd') . ".xls";
function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$fechaInicial7      =OWASP::RequestString('fechaInicial7');
$fechaFinal7        =OWASP::RequestString('fechaFinal7');
$inspectorID7       =OWASP::RequestInt('inspectorID7');  
$tallerID7       =OWASP::RequestInt('tallerID7');    



// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table>
    <tr>
        <th class="light_green">Nro</th>
        <th class="light_green">Fecha</th>
        <th class="light_green">Nro de Acta</th>
        <th class="light_green">Tipo de Acta</th>
        <th class="light_green">Observaciones Inusuales</th>
    </tr>
    <?php 
    $count=0;$conteoTotal=0;
    if($chata){
    $list=CrmReportes::getItemReporte7C($fechaInicial7,$fechaFinal7,$local7);
    foreach ($list as $oItem){
        $conteoTotal++;
        $dateI = new DateTime($oItem->fechaInicial);
        $valor ='softfinal';
    ?>
        <tr>
            <td class="<?php echo $valor; ?>">&nbsp;<?php echo $conteoTotal; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo date_format($dateI, 'd/m/y'); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->nroActa, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->tipoActa, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->obsInusuales, ENT_QUOTES, "UTF-8"); ?> </td>
        </tr>
    <?php }} ?>
    <?php 
    if($tolva){
    $list2=CrmReportes::getItemReporte7T($fechaInicial7,$fechaFinal7,$local7);
    foreach ($list2 as $oItem2){
        $conteoTotal++;
        $dateI = new DateTime($oItem2->fechaInicial);
        $valor ='softfinal';
    ?>
        <tr>
            <td class="<?php echo $valor; ?>">&nbsp;<?php echo $conteoTotal; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo date_format($dateI, 'd/m/y'); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem2->nroActa, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem2->tipoActa, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem2->obsInusuales, ENT_QUOTES, "UTF-8"); ?> </td>
        </tr>
    <?php }} ?>
    <?php 
    if($muestreo){
    $list3=CrmReportes::getItemReporte7M($fechaInicial7,$fechaFinal7,$local7);
    foreach ($list3 as $oItem3){
        $conteoTotal++;
        $dateI = new DateTime($oItem3->fechaInicial);
        $valor ='softfinal';
    ?>
        <tr>
           <td class="<?php echo $valor; ?>">&nbsp;<?php echo $conteoTotal; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo date_format($dateI, 'd/m/y'); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem3->nroActa, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem3->tipoActa, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem3->obsInusuales, ENT_QUOTES, "UTF-8"); ?> </td>
        </tr>
    <?php }} ?>
    </table>
    <?php exit();?>