<form id="grabar_fact">
    <div class="box box-default">
      <div class="box-header">
        <h2 class="box-title"><i class="fa fa-edit"></i> Detalle de la Factura N°<?php echo $oItem->facturacionID; ?> </h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
    </div>
    <div class="box-body">
        <input type="hidden" id="factID" name="factID" value="<?php echo $oItem->facturacionID; ?>">
        <table class="table table-bordered table-hover">
            <tr>                    
                <th width="120"><?php echo $MODULE->getSortingHeader("fechaEmi", "Fecha Emisión");?></th>
                <th width="120"><?php echo $MODULE->getSortingHeader("placa", "Placa");?></th>
                <th width="120"><?php echo $MODULE->getSortingHeader("vin", "VIN");?></th>
                <th width="120"><?php echo $MODULE->getSortingHeader("motor", "N° Motor");?></th>
                <th width="120"><?php echo $MODULE->getSortingHeader("estado", "Estado");?></th>
                <th width="120"><?php echo $MODULE->getSortingHeader("precio", "Costo (S/.)");?></th>
            </tr>
            <?php
            $list=CrmFacturacionDet::getListByFactura($oItem->facturacionID,'fechaEmision');
            foreach ($list as $o){
                ?>
                <tr>

                    <td><?php echo $o->fechaEmision; ?></td>
                    <td><?php echo $o->placa; ?></td>
                    <td><?php echo $o->vin; ?></td>
                    <td><?php echo $o->motor; ?></td>
                    <td><?php echo GlpCertificado::getState($o->estado); ?></td>
                    <td><?php echo $o->costo; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <div class="box-footer">
        <button class="btn btn-primary" id="btnExport" name="btnExport">Exportar</button>   
        <input type="button" class="btn btn-primary" name="btnCancel" value="Regresar" onClick="javascript:Back();">
    </div>
</div>
</form>

<script type="text/javascript">
    $(function(){
        $('#btnExport').click(function(){
            var fields=$('#grabar_fact').serialize();
            window.open('<?php echo $URL_ROOT;?>ajax/facturas.php?action=exportar&facturacionID='+$('#factID').val(),'_blank');
            // <?php  
            // include ("PHPExcel/Classes/PHPExcel.php");
            // $objPHPExcel = new PHPExcel();
            // // Establecer propiedades
            // $objPHPExcel->getProperties()
            // ->setCreator("videotutoriales.es")
            // ->setLastModifiedBy("videotutoriales.es")
            // ->setTitle("Documento Excel")
            // ->setSubject("Documento Excel")
            // ->setDescription("crear archivos de Excel desde PHP.")
            // ->setKeywords("Excel Office 2007 php")
            // ->setCategory("Pruebas de Excel");

            // $objPHPExcel->setActiveSheetIndex(0)
            // ->setCellValue('A1', 'videotutoriales.es')
            // ->setCellValue('A2', 'Cursos para descargar')
            // ;

            // // indicar que se envia un archivo de Excel.
            // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // header('Content-Disposition: attachment;filename="prueba.xlsx"');
            // header('Cache-Control: max-age=0');
            // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            // $objWriter->save('php://output');
            // ?>

        });
    });
</script>
