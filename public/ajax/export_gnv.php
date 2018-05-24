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

$fileName = "Reporte_certificados_gnv" . date('Ymd') . ".xls";
function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

$oUser=WebLogin::getUserSession();
$usuarioID = $oUser->userID;

$filtroID      =OWASP::RequestInt('filtroID');
$filtro        =OWASP::RequestString('filtro');
$startDate     =OWASP::RequestString('startDate');
$endDate       =OWASP::RequestString('endDate');

// headers for download
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");
?>
<table>
    <tr>
        <th class="light_green">Nro. Certificado</th>
        <th class="light_green">Fecha Emisi&oacute;</th>
        <th class="light_green">Nro. Formato</th>
        <th class="light_green">Placa</th>
        <th class="light_green">Cliente</th>
        <th class="light_green">Inspector</th>
        <th class="light_green">Estado</th>
    </tr>
    <?php 
    $count=0;$conteoTotal=0;
    $list=GnvCertificado::getList_Paging($usuarioID, $filtroID, $filtro, $startDate, $endDate);
    foreach ($list as $oItem){
        $valor ='softfinal';
    ?>
        <tr>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->certificadoID; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->fechaEmi; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo $oItem->formatoID; ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->placa, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->cliente, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php echo htmlentities($oItem->usuario, ENT_QUOTES, "UTF-8"); ?> </td>
            <td class="<?php echo $valor; ?>"><?php if($oItem->estado != 0){echo 'Activo';}else{echo 'Inactivo';}; ?> </td>
        </tr>
    <?php } ?>
    </table>
    <?php exit();?>