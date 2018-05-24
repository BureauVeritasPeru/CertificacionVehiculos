<style>

tr{
    text-align: center;
    font-size: 16px;
    padding: 15px;
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

$fileName = "Reporte_taller_" . date('Ymd') . ".xls";
function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$fechaInicial       =OWASP::RequestString('fechaIni');
$fechaFinal         =OWASP::RequestString('fechaFin');
$inspectorID        =OWASP::RequestInt('inspector');  
$tallerID           =OWASP::RequestInt('taller');    



// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table>
    <tr>
        <th class="light_green" rowspan="2">Taller / Sede</th>
        <th class="light_green" colspan="3">GLP</th>
        <th class="light_green" colspan="3">GNV</th>
    </tr>
    <tr>
        <th class="light_green">Inicial</th>
        <th class="light_green">Anual</th>
        <th class="light_green">Original</th>
        <th class="light_green">Inicial</th>
        <th class="light_green">Anual</th>
        <th class="light_green">Original</th>
    </tr>
    <?php 
    $count=0;$conteoTotal=0;
    if($tallerID != 0){
        $list=CrmTaller::getListByTaller($tallerID);
    }else{
        $list=CrmTaller::getList();
    }
    foreach ($list as $oItem){
        $conteoTotal++;
        $valor ='softfinal';
        $oGlpCertAnual = GlpCertificado::getItemByTaller($fechaInicial,$fechaFinal,72,$oItem->tallerID,$inspectorID,0);
        $oGlpCertInicial = GlpCertificado::getItemByTaller($fechaInicial,$fechaFinal,83,$oItem->tallerID,$inspectorID,0);
        $oGlpCertOriginal = GlpCertificado::getItemByTaller($fechaInicial,$fechaFinal,84,$oItem->tallerID,$inspectorID,0);
        $oGnvCertAnual = GnvCertificado::getItemByTaller($fechaInicial,$fechaFinal,87,$oItem->tallerID,$inspectorID,0);
        $oGnvCertInicial = GnvCertificado::getItemByTaller($fechaInicial,$fechaFinal,74,$oItem->tallerID,$inspectorID,0);
        $oGnvCertOriginal = GnvCertificado::getItemByTaller($fechaInicial,$fechaFinal,88,$oItem->tallerID,$inspectorID,0);
        $oListSede = CrmSede::getListByTaller($oItem->tallerID);
    ?>
        <tr>
            <td class="softfinaldash"><strong><?php echo $oItem->razonSocial; ?></strong></td>
            <td class="softfinaldash"><strong><?php echo $oGlpCertInicial->certificadoID; ?> </strong></td>
            <td class="softfinaldash"><strong><?php echo $oGlpCertAnual->certificadoID; ?> </strong></td>
            <td class="softfinaldash"><strong><?php echo $oGlpCertOriginal->certificadoID; ?> </strong></td>
            <td class="softfinaldash"><strong><?php echo $oGnvCertInicial->certificadoID; ?> </strong></td>
            <td class="softfinaldash"><strong><?php echo $oGnvCertAnual->certificadoID; ?> </strong></td>
            <td class="softfinaldash"><strong><?php echo $oGnvCertOriginal->certificadoID; ?> </strong></td>
        </tr>
        <?php foreach ($oListSede as $oSede) { 
            $oGlpCertAnual = GlpCertificado::getItemByTaller($fechaInicial,$fechaFinal,72,$oItem->tallerID,$inspectorID,$oSede->sedeID);
            $oGlpCertInicial = GlpCertificado::getItemByTaller($fechaInicial,$fechaFinal,83,$oItem->tallerID,$inspectorID,$oSede->sedeID);
            $oGlpCertOriginal = GlpCertificado::getItemByTaller($fechaInicial,$fechaFinal,84,$oItem->tallerID,$inspectorID,$oSede->sedeID);
            $oGnvCertAnual = GnvCertificado::getItemByTaller($fechaInicial,$fechaFinal,87,$oItem->tallerID,$inspectorID,$oSede->sedeID);
            $oGnvCertInicial = GnvCertificado::getItemByTaller($fechaInicial,$fechaFinal,74,$oItem->tallerID,$inspectorID,$oSede->sedeID);
            $oGnvCertOriginal = GnvCertificado::getItemByTaller($fechaInicial,$fechaFinal,88,$oItem->tallerID,$inspectorID,$oSede->sedeID);
        ?>
        <tr>
            <td class="<?php echo $valor; ?>"><?php echo $oSede->descripcion; ?></td>
            <td class="<?php echo $valor; ?>"><?php echo $oGlpCertInicial->certificadoID; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oGlpCertAnual->certificadoID; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oGlpCertOriginal->certificadoID; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oGnvCertInicial->certificadoID; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oGnvCertAnual->certificadoID; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oGnvCertOriginal->certificadoID; ?> </td>
        </tr>
        <?php } ?>
    <?php } ?>
  
    </table>
    <?php exit();?>