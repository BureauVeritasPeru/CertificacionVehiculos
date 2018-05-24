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

    function cambia_de_pagina(){
        location.href="http://www.elmiradordelaserrania.com"
    }
    function Download(id){
        window.open('<?php echo $URL_ROOT;?>ajax/facturas.php?action=exportar&facturacionID='+id,'_blank');
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
                        <option value="0">[TODOS]</option>
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
            
            <table class="table table-bordered table-hover">
                <tr>
                    <th width="120"><?php echo $MODULE->getSortingHeader("facturacionID", "N° Factura");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("fechaInicio", "Fecha Inicio");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("fechaFin", "Fecha Fin");?></th>                
                    <th width="120"><?php echo $MODULE->getSortingHeader("fechaRegistro", "Fecha de Registro");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("taller", "Taller");?></th>
                    <th width="40">&nbsp;</th>
                </tr>
                <?php
                $list=CrmFacturacion::getFacturasGral($fechaIni,$fechaFin,$tallerID);
                foreach ($list as $oItem){
                    ?>
                    <tr>
                        <?php 
                        $fecIni = new DateTime($oItem->fechaInicio);
                        $fecFin = new DateTime($oItem->fechaFin);
                        $fecReg = new DateTime($oItem->fechaRegistro);
                        ?>
                        <td><?php echo $oItem->facturacionID; ?></td>
                        <td><?php echo $fecIni->format('d/m/Y'); ?></td>
                        <td><?php echo $fecFin->format('d/m/Y'); ?></td>                    
                        <td><?php echo $fecReg->format('d/m/Y H:i:s'); ?></td>
                        <td><?php echo $oItem->razonSocial; ?></td>
                        <td>
                            <a href="<?php echo "javascript:Edit(".$oItem->facturacionID.");"; ?>" title="Ver Detalle"><i class="fa fa-edit"></i></a>                        
                            <a href='javascript:Download(<?php echo $oItem->facturacionID;?>);' title="Descargar"><i class="fa fa-file-excel-o"></i></a>
                        </td>
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
         <a href="<?php echo SEO::get_URLAdmin().'?moduleID=55'; ?>"> <input type="button" id="btnNew" name="btnNew" class="btn btn-primary" value="Nueva Factura" /> </a>
         <?php echo $MODULE->getPaging();?>        
     </div>
 </div>
</div>