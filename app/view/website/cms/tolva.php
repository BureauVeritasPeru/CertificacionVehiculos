<?php
$action  = OWASP::RequestString('action');
$chiID  = OWASP::RequestString('ID');
if($action == 'insert'){
  $cmd = 'insert';
  $embarcacion= NULL;
  $inspector = NULL;
  $tolva = NULL;
  $chata = CrmChata::getItem($chiID);
  if($chata->plantaID != NULL){
    $planta = CrmPlanta::getItem($chata->plantaID);
  }
}else{
  $cmd = 'update';
  $embarcacion= NULL;
  $inspector = NULL;
  $tolva = NULL;
  $chiID = OWASP::RequestString('ID');
  $tolva = CrmTolva::getItemCHI($chiID);
  $chata = CrmChata::getItem($chiID);
  if($chata->plantaID != NULL){
    $planta = CrmPlanta::getItem($chata->plantaID);
  }
  if($tolva == NULL){
    $cmd = 'insert';
  }else
  {
    if($tolva->embarcacionID != NULL){
      $embarcacion = CrmEmbarcacion::getItem($tolva->embarcacionID);
    }
    if($tolva->inspectorID != NUlL){
      $inspector = CrmInspector::getItem($tolva->inspectorID); 
    }
  } 


}


?>

<script>
  $(function() {
    $( "#numReportePesaje" ).toggleClass( "block" );  $( "#numReportePesaje" ).attr('readonly', true);  
    $( "#horaReportePesaje" ).toggleClass( "block" );  $( "#horaReportePesaje" ).attr('readonly', true);   
    $('input[name=conforme]').attr("disabled",true);
  // Codigo para que con enter o tab funcione la busqueda interna de la planta
  $("#matriculaEmbarcacion").keydown(function(e) {
    if ( event.key == "Tab" || event.which == 13 ) {
      var dol = $("#matriculaEmbarcacion").val();
      $.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_embarcacion.php?mat='+ dol, function(data) {
        if(data.retval==1){
          $('#nombreEmbarcacion').val(data.nombre);
          $('#matriculaEmbarcacion').val(data.matricula);
          $('#capacidadBodega').val(data.capacidad);
        }else{
          alertify.error(data.message);
        }
      });
    }
  });
  // Edicion de Numero de Acta con el codigo de Planta
  $("#numActaInspeccion").keydown(function(e) {
    if ( event.key == "Tab" || event.which == 13 ) {
      var val = $("#numActaInspeccion").val();
      var planta = '<?php echo $planta->codigoPlanta; ?>';
      if(planta != "" && val != ""){
        $("#numActaInspeccion").val(planta + "-" + formatted_string('000000',val,'l'));
      }else{
        $("#numActaInspeccion").val();
      }
    }
  });

  // Capacidad de Bodega
  $("#tmDescargado").keydown(function(e) {
    if ( event.key == "Tab" || event.which == 13 ) {
      var val = Number($("#tmDescargado").val());
      if($('#matriculaEmbarcacion').val() != ''){
        if(Number($('#capacidadBodega').val()) < val ){
          var exceso = val - $('#capacidadBodega').val();
          var porcentaje = (exceso.toFixed(2)/$('#capacidadBodega').val()) * 100;
          $('#excesoBodega').val(exceso.toFixed(2)); 
          $('#porcentajeExceso').val(porcentaje.toFixed(3));
          $('#ro').val('Si');
        }
        else{
          $('#excesoBodega').val('0'); 
          $('#porcentajeExceso').val('0');
          $('#ro').val('No');
        }
      }else{
        $('#excesoBodega').val('0'); 
        $('#porcentajeExceso').val('0');
        $('#ro').val('No');
      } 
      
    }
  });

  // Codigo para que con enter o tab funcione la busqueda interna de los inspectores
  $("#codigoInspector").keydown(function(e) {
    if ( event.which == 13 || event.key == "Tab" ) {
      var dol = $("#codigoInspector").val();
      $.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_inspector.php?cod='+ dol, function(data) {
        if(data.retval==1){
          $('#nombreInspector').val(data.nombre);
        }else{
          alertify.error(data.message);
        }
      });
    }
  });
});


  function formatted_string(pad, user_str, pad_pos)
  {
    if (typeof user_str === 'undefined') 
      return pad;
    if (pad_pos == 'l'){
      return (pad + user_str).slice(-pad.length);
    }
    else{
      return (user_str + pad).substring(0, pad.length);
    }
  }
</script>
<section class="content">
  <form name="form_tolva" id="form_tolva" > 
    <div class="row">
      <div class="col-md-12"><h2 class="box-title"><i class="fa fa-inbox"></i>&nbsp;Tolva</h2></div>
    </div>
    <div class="row">
      <div class="col-md-12"><h2 class="box-title"></h2></div> <!--espaciado -->
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Número de Acta de Inspección</label>
          <input name="numActaInspeccion" id="numActaInspeccion" type="text" class="form-control required" value="<?php if($tolva != NUll){ echo $tolva->numActaInspeccion; } ?>"  maxlength="255" autocomplete="off"> <!-- JS Function busqueda -->
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Matrícula de la Embarcación</label>
          <input name="matriculaEmbarcacion" id="matriculaEmbarcacion" type="text" class="form-control" value="<?php if($embarcacion != NUll){ echo $embarcacion->matriculaEmbarcacion; } ?>"  maxlength="255" autocomplete="off">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Nombre de la Embarcación</label>
          <input name="nombreEmbarcacion" id="nombreEmbarcacion" type="text" class="form-control" value="<?php if($tolva != NUll){ echo $tolva->nombreEmbarcacion; } ?>"  maxlength="255" autocomplete="off">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>Tm Descargado</label>
          <input name="tmDescargado" id="tmDescargado" type="text" class="only_float form-control"  value="<?php if($tolva != NUll){ echo $tolva->tmDescargado; } ?>"  maxlength="255" autocomplete="off">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label> Capacidad de Bodega </label>
          <input name="capacidadBodega" id="capacidadBodega" type="text" class="form-control block"  readonly value="<?php if($tolva != NUll){ echo $tolva->capacidadBodega; } ?>"  maxlength="255" autocomplete="off">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Exceso de Bodega </label>
          <input name="excesoBodega" id="excesoBodega" type="text" class="form-control block" readonly  value="<?php if($tolva != NUll){ echo $tolva->excesoBodega; } ?>"  maxlength="255" autocomplete="off">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>% Exceso </label>
          <input name="porcentajeExceso" id="porcentajeExceso" type="text" class="form-control block"  readonly value="<?php if($tolva != NUll){ echo $tolva->porcentajeExceso; } ?>"  maxlength="255" autocomplete="off">
        </div>
      </div>
      <div class="col-md-1">
        <div class="form-group">
          <label>RO</label>
          <input name="ro" id="ro" type="text" class="form-control block"  readonly value="<?php if($tolva != NUll){ echo $tolva->ro; } ?>"  maxlength="255" autocomplete="off">
        </div>
      </div> 
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>Fecha Inicial</label>
          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" id="fechaInicial" name="fechaInicial"  value="<?php if($tolva != NUll){ echo  str_replace('00:00:00','',$tolva->fechaInicial); } ?>" >
            <div class="input-group-addon ">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Hora Inicio</label>
          <input name="horaInicio" id="horaInicio" type="time" class="form-control" value="<?php if($tolva != NUll){ echo $tolva->horaInicio; } ?>"  maxlength="255" autocomplete="off"> <!-- JS Function busqueda -->
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Fecha Final</label>
          <div class="input-group date" data-provide="datepicker">
            <input type="text" class="form-control" id="fechaFinal" name="fechaFinal" value="<?php if($tolva != NUll){ echo str_replace('00:00:00','',$tolva->fechaFinal); } ?>">
            <div class="input-group-addon ">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Hora Término</label>
          <input name="horaTermino" id="horaTermino" type="time" class="form-control" value="<?php if($tolva != NUll){ echo $tolva->horaTermino; } ?>"  maxlength="255" autocomplete="off">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>Número de Reporte de Pesaje</label>
          <input name="nroReportePesaje" id="nroReportePesaje" type="text" class="form-control" value="<?php if($tolva != NUll){ echo $tolva->nroReportePesaje; } ?>"  maxlength="255" autocomplete="off"> 
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Número de Tolva</label>
          <input name="nroTolva" id="nroTolva" type="text" class="form-control" value="<?php if($tolva != NUll){ echo $tolva->nroTolva; } ?>"  maxlength="255" autocomplete="off"> <!-- JS Function busqueda -->
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label>Codigo del inspector</label>
          <input name="codigoInspector" id="codigoInspector" type="text" class="form-control" value="<?php if($inspector != NUll){ echo $inspector->codigoInspector; } ?>"  maxlength="255" autocomplete="off"> 
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group">
          <label>Nombre del Inspector</label>
          <input name="nombreInspector" id="nombreInspector" type="text" class="form-control" value="<?php if($tolva != NUll){ echo $tolva->nombreInspector; } ?>"  maxlength="255" autocomplete="off">
        </div>
      </div>
    </div>
    <div class="row">
      <fieldset class="scheduler-border">
        <legend  class="scheduler-border" >Prueba de Pesaje</legend>
        <div class="col-md-12"> 
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label></label>
                  <br>
                  <div class="radio radio-primary radio-inline">
                    <input type="radio" value="1" class="radio-primary" name="pruebaPesaje" id="pruebaPesajeY" <?php if($tolva != NUll){ echo ($tolva->pruebaPesaje == 1) ? 'checked':''; }?>> 
                    <label for="pruebaPesajeY">Si</label>
                  </div>
                  <div class="radio radio-primary radio-inline">
                    <input type="radio" value="0" class="radio-primary" name="pruebaPesaje" id="pruebaPesajeN" <?php if($tolva != NUll){ echo ($tolva->pruebaPesaje == 0) ? 'checked':''; }?>> 
                    <label for="pruebaPesajeN">No</label>
                  </div>
                </div>
              </div> 
              <div class="col-md-3">
                <div class="form-group">
                  <label>Conforme</label>
                  <br>
                  <div class="radio radio-primary radio-inline">
                    <input type="radio" value="1" class="radio-primary" name="conforme" id="conformeY" <?php if($tolva != NUll){ echo ($tolva->conforme == 1) ? 'checked':''; }?>> 
                    <label for="conformeY">Si</label>
                  </div>
                  <div class="radio radio-primary radio-inline">
                    <input type="radio" value="0" class="radio-primary" name="conforme" id="conformeN" <?php if($tolva != NUll){ echo ($tolva->conforme == 0) ? 'checked':''; }?>> 
                    <label for="conformeN">No</label>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Número de Reporte de Pesaje</label>
                  <input name="numReportePesaje" id="numReportePesaje" type="text" class="form-control" value="<?php if($tolva != NUll){ echo $tolva->numReportePesaje; } ?>"  maxlength="255" autocomplete="off">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Hora Reporte de Pesaje</label>
                  <input name="horaReportePesaje" id="horaReportePesaje" type="time" class="form-control" value="<?php if($tolva != NUll){ echo $tolva->horaReportePesaje; } ?>"  maxlength="255" autocomplete="off">
                </div>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
    </div>
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label>Observación Inusual</label>
          <select name="obsInusual" id="obsInusual" class="form-control" autocomplete="off">
            <option value="0">Seleccione su observación</option> 
            <?php
          $list= CmsParameterLang::getList(2, 1); //Observaciones Inusuales
          foreach ($list as $obj) {
            echo "<option value=\"".$obj->parameterID."\"";
            if($tolva != NULL){if($obj->parameterName==$tolva->obsInusual) echo " selected";}
            echo ">".$obj->parameterName."</option>";
          }
          ?>   
        </select>
      </div>
    </div> 
    <div class="col-md-2">
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <label>Certificacion</label>
        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target=".bs-modal-tolva">Lista</button>
      </div>
    </div>

    <input type="hidden" value="<?php echo $oUser->userID; ?>" name="userID" id="userID" > 
    <input type="hidden" value="<?php echo $chiID; ?>" name="ID" id="ID" > 
    <div class="col-md-2">
      <label></label>
      <div class="btn btn-info btn-block" name="btnBack" id="back_tolva"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;regresar</div>
    </div>
    <div class="col-md-2">
      <label></label>
      <div class="btn btn-primary btn-block" name="btnCrear" id="send_tolva">Siguiente&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></div>
    </div>
  </div>
  <div class="modal fade bs-modal-tolva" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" id="modal-frame">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Certificado de Inspección</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Imprimir correctamente en el Reporte de Pesaje los datos de: Razón Social, Ubicación, Planta y modelo del Instrumento de Pesaje,  Especie, uso del recurso, nombre y matrícula de la embarcación pesquera, N° Tolva Balanza, carga objetivo, fecha y hora de inicio y término; N° de pesadas, peso(t) y hora de cada pesada y el peso acumulado (t).</label>
                <br>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="1" class="radio-primary" name="pregunta6" id="pregunta6Y" <?php if($tolva != NUll){ echo ($tolva->pregunta6 == 1) ? 'checked':''; }?>> 
                  <label for="pregunta6Y">Si</label>
                </div>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="0" class="radio-primary" name="pregunta6" id="pregunta6N" <?php if($tolva != NUll){ echo ($tolva->pregunta6 == 0) ? 'checked':''; }?>> 
                  <label for="pregunta1N">No</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>El tonelaje descargado no supera el exceso permitido para la capacidad de bodega de la embarcación pesquera.</label>
                <br>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="1" class="radio-primary" name="pregunta7" id="pregunta7Y" <?php if($tolva != NUll){ echo ($tolva->pregunta7 == 1) ? 'checked':''; }?>> 
                  <label for="pregunta7Y">Si</label>
                </div>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="0" class="radio-primary" name="pregunta7" id="pregunta7N" <?php if($tolva != NUll){ echo ($tolva->pregunta7 == 0) ? 'checked':''; }?>> 
                  <label for="pregunta7N">No</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>"En el Reporte de Pesaje se imprime al inicio y al final de la descarga el número de cuentas del conversor analógico SPAN, y del Cero (Z), el valor de peso de calibración (Wval) y el coeficiente de calibración (CC).</label>
                <br>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="1" class="radio-primary" name="pregunta8" id="pregunta8Y" <?php if($tolva != NUll){ echo ($tolva->pregunta8 == 1) ? 'checked':''; }?>> 
                  <label for="pregunta8Y">Si</label>
                </div>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="0" class="radio-primary" name="pregunta8" id="pregunta8N" <?php if($tolva != NUll){ echo ($tolva->pregunta8 == 0) ? 'checked':''; }?>> 
                  <label for="pregunta8N">No</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Las compuertas de la pre-tolva se encuentran completamente cerradas al momento que las compuertas de la tolva de pesaje se abren después de la estabilización y su pesaje, y se mantienen cerradas hasta que la tolva de pesaje termine de evacuar los recursos hidrobiológicos a la poza de almacenamiento.</label>
                <br>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="1" class="radio-primary" name="pregunta9" id="pregunta9Y" <?php if($tolva != NUll){ echo ($tolva->pregunta9 == 1) ? 'checked':''; }?>> 
                  <label for="pregunta9Y">Si</label>
                </div>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="0" class="radio-primary" name="pregunta9" id="pregunta9N" <?php if($tolva != NUll){ echo ($tolva->pregunta9 == 0) ? 'checked':''; }?>> 
                  <label for="pregunta4N">No</label>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Ante los eventos Falla de Celda y/o compuertas Abiertas no se continuara utilizando las Tolvas.</label>
                <br>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="1" class="radio-primary" name="pregunta10" id="pregunta10Y" <?php if($tolva != NUll){ echo ($tolva->pregunta10 == 1) ? 'checked':''; }?>> 
                  <label for="pregunta10Y">Si</label>
                </div>
                <div class="radio radio-primary radio-inline">
                  <input type="radio" value="0" class="radio-primary" name="pregunta10" id="pregunta10N" <?php if($tolva != NUll){ echo ($tolva->pregunta10 == 0) ? 'checked':''; }?>> 
                  <label for="pregunta10N">No</label>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>

              </div>
            </div>
          </div>          
        </div>
      </div>
    </div>
  </div>
</form>

<script type="text/javascript">

  $( "#pruebaPesajeY" ).on( "click", function() {
    $( "#numReportePesaje" ).removeClass( "block" );  $( "#numReportePesaje" ).attr('readonly', false);  
    $( "#horaReportePesaje" ).removeClass( "block" );  $( "#horaReportePesaje" ).attr('readonly', false); 
    $('input[name=conforme]').attr("disabled",false);
  });

  $( "#pruebaPesajeN" ).on( "click", function() {
    $( "#numReportePesaje" ).toggleClass( "block" );  $( "#numReportePesaje" ).attr('readonly', true);  
    $( "#horaReportePesaje" ).toggleClass( "block" );  $( "#horaReportePesaje" ).attr('readonly', true);   
    $('input[name=conforme]').attr("disabled",true);
  });



  $(function(){
    prepareForm('#form_tolva');
    $('#send_tolva').click(function(){
      <?php if($cmd!='update'){ ?>
        $.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_acta_inspeccion.php?cmd=insert&acta='+ $("#numActaInspeccion").val(), function(data) {
          if(data.retval==1){
          }else{
            $("#numActaInspeccion").focus();
            alertify.error(data.message);
            return false; 
          }
        });
        <?php }else{ ?>
          $.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_acta_inspeccion.php?cmd=update&ID=<?php echo $chiID;?>&acta='+ $("#numActaInspeccion").val(), function(data) {
            if(data.retval==1){
            }else{
              $("#numActaInspeccion").focus();
              alertify.error(data.message);
              return false; 
            }
          });

          <?php } ?>


          bootbox.confirm({
            title: "Produce - Bureau Veritas",
            message: "Estas seguro de guardar los datos de Tolva?",
            buttons: {
              cancel: {
                label: '<i class="fa fa-times"></i> Cancelar'
              },
              confirm: {
                label: '<i class="fa fa-check"></i> Confirmar'
              }
            },
            callback: function (result) {
              if(result){
                if (!isValidate('#form_tolva')){ alertify.error('Porfavor ingrese datos validos.'); return false; }
                var fields3=$('#form_tolva').serialize();
                <?php if($cmd!='update'){ ?>
                  $.getJSON('<?php echo $URL_ROOT;?>ajax/form_tolva.php?cmd=insert&'+fields3, function(data) {
                    if(data.retval==1){
                      alertify.success(data.message);
                      $('.sombra').show();
                      setTimeout(function(){
                        location.href='<?php echo $URL_ROOT;?>chi/muestreo.html?action=insert&ID='+data.chiID;
                      }, 3000);
                    }else{
                      alertify.error(data.message);
                    }
                  });
                  <?php }else{ ?>
                    $.getJSON('<?php echo $URL_ROOT;?>ajax/form_tolva.php?cmd=update&ID=<?php echo $chiID;?>&'+fields3, function(data) {
                      if(data.retval==1){
                        $('.sombra').show();
                        alertify.success(data.message);
                        setTimeout(function(){
                          location.href='<?php echo $URL_ROOT;?>chi/muestreo.html?action=update&ID='+data.chiID;
                        }, 3000);
                      }else{
                        alertify.error(data.message);
                      }
                    });
                    <?php } ?>

                  }
                }
              });





        });
  });

  $('#back_tolva').click(function(){
    location.href='<?php echo $URL_ROOT;?>chi/chata.html?action=update&chiID=<?php echo $chiID; ?>';
  });
</script>




</section>