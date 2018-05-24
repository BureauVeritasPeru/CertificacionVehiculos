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
            if($("#tipoServicio").val() ==""){
                alertify.error("Por favor, ingrese un tipo de Servicio");
                $("#tipoServicio").focus();
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
                        $list= CrmTaller::getWebListGLP();
                        foreach ($list as $obj) {
                            echo "<option value=\"".$obj->tallerID."\"";
                            if($obj->tallerID==$tallerID) print ' selected';                        
                            echo ">".$obj->razonSocial."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group padding-right-10">
                    <label >Inspector: </label>
                    <select name="usuarioID" id="usuarioID" class="form-control" autocomplete="off" value="<?php echo $usuarioID;?>">
                        <option value="0">[TODOS]</option>
                        <?php
                        $list= CrmUser::getWebList();
                        foreach ($list as $obj) {
                            echo "<option value=\"".$obj->userID."\"";
                            if($obj->userID==$usuarioID) print ' selected';
                            echo ">".$obj->firstName." ".$obj->lastName."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group padding-right-10">
                    <label >Placa: </label>
                    <input type="text" class="form-control" name="placa" id="placa" value="<?php echo $placa;?>" placeholder="Ingrese placa" maxlength="20"/>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group padding-right-10">
                    <label >Tipo de servicio: </label>
                    <select name="tipoServicio" id="tipoServicio" class="form-control" autocomplete="off" value="<?php echo $tipoServicio;?>">
                        <option value="0">[SELECCIONE]</option>
                        <?php
                        $list= CmsParameterLang::getWebList(11, 1);
                        foreach ($list as $obj) {
                            echo "<option value=\"".$obj->parameterID."\"";
                            if($obj->parameterID==$tipoServicio) print ' selected';                        
                            echo ">".$obj->parameterName."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">            
                <label>&nbsp;</label>
                <div class="form-group">
                    <input name="btnSearch" id="btnSearch" type="button" class="btn btn-primary" value="Buscar" />            
                </div>
            </div>

            <table class="table table-bordered table-hover">
                <tr>
                    <th width="120"><?php echo $MODULE->getSortingHeader("certificadoID", "N° Certificado");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("tipoServicio", "Tipo de Servicio");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("formatoID", "N° Formato");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("razonSocial", "Taller");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("sede", "Sede del Taller");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("placa", "Placa");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("fechaEmi", "Fecha Emisión");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("tipo", "Tipo Certificado");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("costo", "Costo (S/.)");?></th>
                    <th width="120"><?php echo $MODULE->getSortingHeader("usuario", "Inspector");?></th>
                </tr>
                <?php
                if($tipoServicio == '71'){
                    $list=CrmReportes::getItemReporteGeneralGNVA($fechaIni,$fechaFin,$usuarioID,$tallerID,$placa);
                }elseif($tipoServicio == '70'){
                    $list=CrmReportes::getItemReporteGeneralGLPA($fechaIni,$fechaFin,$usuarioID,$tallerID,$placa);
                }else{
                    $list=CrmReportes::getItemReporteGeneralGLPA($fechaIni,$fechaFin,$usuarioID,$tallerID,$placa);
                    $list2=CrmReportes::getItemReporteGeneralGNVA($fechaIni,$fechaFin,$usuarioID,$tallerID,$placa);
                }

                foreach ($list as $oItem){
                    if($oItem->tipoServicio != '70'){$var = 'GLP';}else{$var = 'GNV';}
                    ?>
                    <tr>
                        <td><?php echo $oItem->certificadoID; ?></td>
                        <td><?php echo $var; ?></td>
                        <td><?php echo $oItem->formatoID; ?></td>
                        <td><?php echo $oItem->razonSocial; ?></td>
                        <td><?php echo $oItem->sede; ?></td>
                        <td><?php echo $oItem->placa; ?></td>
                        <td><?php echo $oItem->fechaEmi; ?></td>
                        <td><?php echo $oItem->tipo; ?></td>
                        <td><?php echo $oItem->costo; ?></td>
                        <td><?php echo $oItem->usuario; ?></td>
                    </tr>
                    <?php
                }
                foreach ($list2 as $oItem){
                    if($oItem->tipoServicio != '70'){$var = 'GLP';}else{$var = 'GNV';}
                    ?>
                    <tr>
                        <td><?php echo $oItem->certificadoID; ?></td>
                        <td><?php echo $var; ?></td>
                        <td><?php echo $oItem->formatoID; ?></td>
                        <td><?php echo $oItem->razonSocial; ?></td>
                        <td><?php echo $oItem->sede; ?></td>
                        <td><?php echo $oItem->placa; ?></td>
                        <td><?php echo $oItem->fechaEmi; ?></td>
                        <td><?php echo $oItem->tipo; ?></td>
                        <td><?php echo $oItem->costo; ?></td>
                        <td><?php echo $oItem->usuario; ?></td>
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
            <button class="btn btn-primary" name="btnExport" onClick="Export(this.form)">exportar</button>        
            <?php echo $MODULE->getPaging();?>        
        </div>
    </div>