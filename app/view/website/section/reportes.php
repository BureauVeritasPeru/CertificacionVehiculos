<?php $oUser=WebLogin::getUserSession(); ?>
<section class="content">
    <form name="frmMain" id="frmMain" class="form-horizontal" method="post" autocomplete="off" >
        <div class="box box-default" >
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-inbox"></i>&nbsp; Reportes </h3>
            </div>
            <br>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3"></div>      
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-primary btn-block btn-reportes" data-toggle="modal" data-target=".bs-reporte-diario-chi" data-backdrop="static">Reporte Certificados Generales</button>
                    </div>  
                    <div class="col-sm-3"></div>   
                </div>
                <br>
                <div class="row">  
                    <div class="col-sm-3"></div>  
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-primary btn-block btn-reportes" data-toggle="modal" data-target=".bs-reporte-semanal-chi" data-backdrop="static">Reporte Certificados por Taller</button>
                    </div>
                    <div class="col-sm-3"></div>    
                </div>
                <br>
                <div class="row" style="display: none;">
                    <div class="col-sm-3"></div>       
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-primary btn-block btn-reportes" data-toggle="modal" data-target=".bs-reporte-actas-observadas" data-backdrop="static">Reporte Estadística de Talleres</button>
                    </div>  
                    <div class="col-sm-3"></div>    
                </div>
            </div>
        </div>
        <br>
        <div class="box-footer">
        </div>
    </div>                     
</form>
</section>

<div class="modal fade bs-reporte-diario-chi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 class="modal-title" style="color:black">Certificados Generales</h4>-->
            </div>
            <div class="modal-body">
                <fieldset class="scheduler-border">
                    <legend  class="scheduler-border" >Certificados Generales GLP</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Fecha Inicio</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="fechaIni" name="fechaIni" placeholder="yyyy/mm/dd" maxlength="10" readonly="true">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Fecha Fin</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="fechaFin" name="fechaFin" placeholder="yyyy/mm/dd" maxlength="10" readonly="true">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-7">
                            <div class="btn btn-primary btn-block" name="btnCrear" id="send_1">Generar Reporte&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></div>
                        </div>
                    </div>
                </fieldset>
                <br><br>
                <fieldset class="scheduler-border">
                    <legend  class="scheduler-border" >Certificados Generales GNV</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Fecha Inicio</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="fechaIni2" name="fechaIni2" placeholder="yyyy/mm/dd" maxlength="10" readonly="true">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Fecha Fin</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="fechaFin2" name="fechaFin2" placeholder="yyyy/mm/dd" maxlength="10" readonly="true">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-7">
                            <div class="btn btn-primary btn-block" name="btnCrear2" id="send_2">Generar Reporte&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <br><br>
        </div>
    </div>
</div>


<script>
    $(function(){
        $('#fechaIni').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#fechaFin').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#fechaIni2').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#fechaFin2').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#send_1').click(function(){
            if($('#fechaIni').val() != '' && $('#fechaFin').val() != ''){                
                location.href = '<?php echo $URL_ROOT;?>ajax/export_1.php?fechaIni='+$('#fechaIni').val()+'&fechaFin='+$('#fechaFin').val()+'&userID=<?php echo $oUser->userID; ?>';
                console.log("<?php echo $URL_ROOT;?>ajax/export_1.php?fechaIni='+$('#fechaIni').val()+'&fechaFin='+$('#fechaFin').val()+'&userID=<?php echo $oUser->userID; ?>'");
            }
            else{
                alertify.error('Por favor ingrese todos los datos');
            }
        });
        $('#send_2').click(function(){
            if($('#fechaIni2').val() != '' && $('#fechaFin2').val() != ''){                
                location.href = '<?php echo $URL_ROOT;?>ajax/export_2.php?fechaIni2='+$('#fechaIni2').val()+'&fechaFin2='+$('#fechaFin2').val()+'&userID=<?php echo $oUser->userID; ?>';
                console.log("<?php echo $URL_ROOT;?>ajax/export_2.php?fechaIni2='+$('#fechaIni2').val()+'&fechaFin2='+$('#fechaFin2').val()+'&userID=<?php echo $oUser->userID; ?>'");
            }
            else{
                alertify.error('Por favor ingrese todos los datos');
            }
        });
    });
</script>

<div class="modal fade bs-reporte-semanal-chi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <!--<h4 class="modal-title" style="color:black">Certificados Generales</h4>-->
            </div>
            <div class="modal-body">
                <fieldset class="scheduler-border">
                    <legend  class="scheduler-border" >Certificados GLP por Taller y Tipo</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Fecha Inicio</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="fechaIni3" name="fechaIni3" placeholder="yyyy/mm/dd" maxlength="10" readonly="true">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Fecha Fin</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="fechaFin3" name="fechaFin3" placeholder="yyyy/mm/dd" maxlength="10" readonly="true">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Taller</label>
                                <select name="tallerID" id="tallerID" class="form-control input-sm" autocomplete="off">
                                 <option value="0">[SELECCIONE]</option> 
                                 <?php
                                 $list= CrmTaller::getWebListGLP();
                                 foreach ($list as $obj) {
                                    echo "<option value=\"".$obj->tallerID."\"";
                                    echo ">".$obj->razonSocial."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color:black">Tipo de Certificado</label>
                            <select name="tipocertID" id="tipocertID" class="form-control input-sm" autocomplete="off">
                                <option value="0">[SELECCIONE]</option> 
                                <?php
                                    $list= CmsParameterLang::getWebListParent(12, 70, 1); //Tipo de Certificado GLP ->70
                                    foreach ($list as $obj) {
                                        echo "<option value=\"".$obj->parameterID."\"";
                                        echo ">".$obj->parameterName."</option>";
                                    }
                                    ?>   
                                </select>
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-7">
                            <div class="btn btn-primary btn-block" name="btnCrear3" id="send_3">Generar Reporte&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></div>
                        </div>
                    </div>
                </fieldset>
                <br><br>
                <fieldset class="scheduler-border">
                    <legend  class="scheduler-border" >Certificados GNV por Taller y Tipo</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Fecha Inicio</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="fechaIni4" name="fechaIni4" placeholder="yyyy/mm/dd" maxlength="10" readonly="true">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Fecha Fin</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="fechaFin4" name="fechaFin4" placeholder="yyyy/mm/dd" maxlength="10" readonly="true">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:black">Taller</label>
                                <select name="tallerID2" id="tallerID2" class="form-control input-sm" autocomplete="off">
                                 <option value="0">[SELECCIONE]</option> 
                                 <?php
                                 $list= CrmTaller::getWebListGNV();
                                 foreach ($list as $obj) {
                                    echo "<option value=\"".$obj->tallerID."\"";
                                    echo ">".$obj->razonSocial."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>                        
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="color:black">Tipo de Certificado</label>
                            <select name="tipocertID2" id="tipocertID2" class="form-control input-sm" autocomplete="off">
                                <option value="0">[SELECCIONE]</option> 
                                <?php
                                    $list= CmsParameterLang::getWebListParent(12, 71, 1); //Tipo de Certificado GNV ->71
                                    foreach ($list as $obj) {
                                        echo "<option value=\"".$obj->parameterID."\"";
                                        echo ">".$obj->parameterName."</option>";
                                    }
                                    ?>   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-7">
                            <div class="btn btn-primary btn-block" name="btnCrear4" id="send_4">Generar Reporte&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <br><br>
        </div>
    </div>
</div>

<script>
    $(function(){
        $('#fechaIni3').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#fechaFin3').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#fechaIni4').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#fechaFin4').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#send_3').click(function(){
            if($('#fechaIni3').val() != '' && $('#fechaFin3').val() != '' && $('#tallerID').val() != '0' && $('#tipocertID').val() != '0'){                
                location.href = '<?php echo $URL_ROOT;?>ajax/export_3.php?fechaIni3='+$('#fechaIni3').val()+'&fechaFin3='+$('#fechaFin3').val()+'&userID=<?php echo $oUser->userID; ?>'+'&tallerID='+$('#tallerID').val()+'&tipocertID='+$('#tipocertID').val();
                console.log("<?php echo $URL_ROOT;?>ajax/export_3.php?fechaIni3='+$('#fechaIni3').val()+'&fechaFin3='+$('#fechaFin3').val()+'&userID=<?php echo $oUser->userID; ?>'+'&tallerID='+$('#tallerID').val()+'&tipocertID='+$('#tipocertID').val()");
            }
            else{
                alertify.error('Por favor ingrese todos los datos');
            }
        });

        $('#send_4').click(function(){
            if($('#fechaIni4').val() != '' && $('#fechaFin4').val() != '' && $('#tallerID2').val() != '0' && $('#tipocertID2').val() != '0'){                
                location.href = '<?php echo $URL_ROOT;?>ajax/export_4.php?fechaIni4='+$('#fechaIni4').val()+'&fechaFin4='+$('#fechaFin4').val()+'&userID=<?php echo $oUser->userID; ?>'+'&tallerID2='+$('#tallerID2').val()+'&tipocertID2='+$('#tipocertID2').val();
                console.log("<?php echo $URL_ROOT;?>ajax/export_4.php?fechaIni4='+$('#fechaIni4').val()+'&fechaFin4='+$('#fechaFin4').val()+'&userID=<?php echo $oUser->userID; ?>'+'&tallerID2='+$('#tallerID2').val()+'&tipocertID2='+$('#tipocertID2').val()");
            }
            else{
                alertify.error('Por favor ingrese todos los datos');
            }
        });
    });

</script>

<div class="modal fade bs-reporte-actas-observadas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">Reportes de Estadisticos de Talleres</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha Inicial</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" id="fechaInicial7" name="fechaInicial7" >
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th">

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha Final</label>
                            <div class="input-group date" data-provide="datepicker">
                                <input type="text" class="form-control" id="fechaFinal7" name="fechaFinal7">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th">

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Taller</label>
                            <select name="tallerID7" id="tallerID7" class="form-control input-sm" autocomplete="off">
                                <option value="0">[SELECCIONE]</option>  <?php $list= CrmTaller::getWebList(); foreach ($list as $obj) { echo "<option value=\"".$obj->tallerID."\"";  echo ">".$obj->razonSocial."</option>"; } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Inspector</label>
                            <select name="inspectorID7" id="inspectorID7" class="form-control input-sm" autocomplete="off">
                                <option value="0">[SELECCIONE]</option>  <?php $list= CrmUser::getListInspectores(); foreach ($list as $obj) { echo "<option value=\"".$obj->userID."\"";  echo ">".$obj->firstName.' '.$obj->lastName."</option>"; } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label></label>
                        <div class="btn btn-primary btn-block" name="btnCrear" id="send_7">Generar Reporte Estadistico &nbsp; &nbsp;<i class="fa fa-chevron-right"></i></div>
                    </div>
                    <div class="col-md-3">
                        <label></label>
                        <div class="btn btn-primary btn-block" name="btnCrear" id="send_7">Generar Reporte por Taller &nbsp; &nbsp; <i class="fa fa-chevron-right"></i></div>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    $(function(){
        $('#send_7').click(function(){
            if($('#fechaInicial7').val() != '' && $('#fechaFinal7').val() != ''){
                location.href = '<?php echo $URL_ROOT;?>ajax/export_7.php?fechaInicial7='+$('#fechaInicial7').val()+'&fechaFinal7='+$('#fechaFinal7').val()+'&inspectorID7='+$('#inspectorID7').val()+'&tallerID7='+$('#tallerID7').val();
            }
            else{
                alertify.error('Por favor ingrese todos los datos');
            }
        });
    });

</script>