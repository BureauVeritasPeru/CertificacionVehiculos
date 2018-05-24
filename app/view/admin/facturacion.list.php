<script type="text/javascript">
    $(function(){
        $('#btnSearch').click(function(){
            if($("#fechaIni").val() ==""){
                alertify.error("Por favor, ingrese una Fecha de Inicio");
                $("#fechaIni").focus();
                return false;
            }
            if($("#fechaFin").val() ==""){
                alertify.error("Por favor, ingrese una Fecha de Fin");
                $("#fechaFin").focus();
                return false;
            }
            if($("#tallerID").val() =="0"){
                alertify.error("Por favor, seleccione un taller");
                $("#tallerID").focus();
                return false;
            }

            Search(document.forms[0]);
        });

        $('#datetimepicker1').datetimepicker({
            locale: 'es',
            format: 'YYYY/MM/DD'
        });
        $('#datetimepicker2').datetimepicker({
            locale: 'es',
            format: 'YYYY/MM/DD',
        useCurrent: false //Important! See issue #1075
    });
        $("#datetimepicker1").on("dp.change", function (e) {
            $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker2").on("dp.change", function (e) {
            $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
        });
    });

    function on_submit(xform){
        if($("#fechaIni").val() ==""){
            alertify.error("Por favor, ingrese una Fecha de Inicio");
            $("#fechaIni").focus();
            return false;
        }
        if($("#fechaFin").val() ==""){
            alertify.error("Por favor, ingrese una Fecha de Fin");
            $("#fechaFin").focus();
            return false;
        }
        if($("#tallerID").val() =="0"){
            alertify.error("Por favor, seleccione un taller");
            $("#tallerID").focus();
            return false;
        }
        if($('.table-factura tr:eq(1)').html() != undefined){
            xform.Command.value="<?php echo "insert";?>";
            alertify.success('Cierre realizado Correctamente');
            xform.submit();
        }else{
            alertify.error('No hay data para registrar en la facturación.')
        }
    }

</script>
<div class="box box-default">
    <div class="box-header">
        <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
    </div>
    <div class="box-body">
        <div>
            <div class="col-sm-3">
                <div class="form-group padding-right-10">
                    <label>Fecha Inicio: </label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type="text" class="form-control" name="fechaIni" id="fechaIni" value="<?php echo $fechaIni;?>" placeholder="yyyy/mm/dd" maxlength="10"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group padding-right-10">
                    <label>Fecha Fin: </label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type="text" class="form-control" name="fechaFin" id="fechaFin" value="<?php echo $fechaFin;?>" placeholder="yyyy/mm/dd" maxlength="10"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group padding-right-10">
                    <label >Taller: </label>
                    <select name="tallerID" id="tallerID" class="form-control" autocomplete="off" value="<?php echo $tallerID;?>">
                        <option value="0">[SELECCIONE]</option>
                        <?php
                        $list= CrmTaller::getWebList();
                        foreach ($list as $obj) {
                            echo "<option value=\"".$obj->tallerID."\"";
                            if($obj->tallerID==$tallerID) print ' selected';
                            echo ">".$obj->razonSocial."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-1">            
                <label>&nbsp;</label>
                <div class="form-group">
                    <input name="btnSearch" id="btnSearch" type="button" class="btn btn-primary" value="Buscar" />            
                </div>
            </div>

            <table class="table table-bordered table-hover table-factura">
                <tr>                    
                    <th width="120"><?php echo $MODULE->getSortingHeader("fechaEmi", "Fecha Emisión");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("tipoServicio", "Tipo de Servicio");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("tipoCertificado", "Tipo de Certificado");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("certificadoID", "N° Certificado");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("placa", "Placa");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("vin", "VIN");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("motor", "N° Motor");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("estado", "Estado");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("precio", "Costo (S/.)");?></th>
                </tr>
                <?php
                $list=CrmReportes::getItemReportexTallerGral($fechaIni,$fechaFin,$tallerID);
                foreach ($list as $oItem){
                    ?>
                    <tr>

                        <td><input style="display:none" type='text' name='fechaEmision[]' id='fechaEmision' value='<?php echo $oItem->fechaEmi;?>'><?php echo $oItem->fechaEmi; ?></td>                        
                        <td><input style="display:none" type='text' name='tipoServicio[]' id='tipoServicio' value='<?php echo $oItem->tipoServicio;?>'><?php echo CrmReportes::getTipoServ($oItem->tipoServicio); $oItem->tipoServicio; ?></td>
                        <td style="display:none"><input style="display:none" type='text' name='tipoCertificadoID[]' id='tipoCertificadoID' value='<?php echo $oItem->tipoCertificadoID;?>'><?php echo $oItem->tipoCertificadoID; ?></td>
                        <td><input style="display:none" type='text' name='tipoCertificado[]' id='tipoCertificado' value='<?php echo $oItem->tipoCertificado;?>'><?php echo $oItem->tipoCertificado; ?></td>
                        <td><input style="display:none" type='text' name='certificadoID[]' id='certificadoID' value='<?php echo $oItem->certificadoID;?>'><?php echo $oItem->certificadoID; ?></td>
                        <td><input style="display:none" type='text' name='placa[]' id='placa' value='<?php echo $oItem->placa;?>'><?php echo $oItem->placa; ?></td>
                        <td><input style="display:none" type='text' name='vin[]' id='vin' value='<?php echo $oItem->vin;?>'><?php echo $oItem->vin; ?></td>
                        <td><input style="display:none" type='text' name='motor[]' id='motor' value='<?php echo $oItem->motor;?>'><?php echo $oItem->motor; ?></td>
                        <td><input style="display:none" type='text' name='estado[]' id='estado' value='<?php echo $oItem->estado;?>'><?php echo GlpCertificado::getState($oItem->estado); ?></td>
                        <td><input style="display:none" type='text' name='costo[]' id='costo' value='<?php echo $oItem->costo;?>'><?php echo $oItem->costo; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <div id="divViewForm" style="display:none; height:420px; width:550px;">
                <img src="../assets/admin/images/i_loading.gif" align="absbottom" /> Cargando...
            </div>
        </div>
        <div class="box-footer">
            <input type="button" class="btn btn-primary" value="Guardar Cierre" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
            <a href="<?php echo SEO::get_URLAdmin().'?moduleID=56'; ?>"> <input type="button" id="Cancelar" name="Cancelar" class="btn btn-primary" value="Cancelar" /> </a>
            <?php echo $MODULE->getPaging();?>        
        </div>
    </div>
</div>