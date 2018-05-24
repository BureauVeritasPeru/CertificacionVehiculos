<?php  
$certificadoID=isset($_REQUEST['certificadoID'])? intval($_REQUEST['certificadoID']):'';
$oCert = NULL;
$oPrecert = NULL;
$oCliente = NULL;
$oSP = NULL;
$oClienteJ = NULL;
$oRest = NULL;
$lCliente = NULL;
$lComponentes = NULL;
$listAforo = NULL;
$oCert = GlpCertificado::getItem($certificadoID);
if($oCert != NULL){
  $oPrecert = GlpPrecertificado::getItem($oCert->precertID);
  $oRest = GlpRestriccion::getItem($oCert->precertID);
  switch ($oCert->tipoCliente) {
    case '2':
    $oSP = CrmClienteSP::getItem($oCert->clienteID);    
    break;
    case '1':
    $lCliente = CrmClienteCert::getList($oCert->precertID);    
    break;
    case '3':
    $oClienteJ = CrmClienteJ::getItem($oCert->clienteID);    
    break;
  }
}
?>
<script type="text/javascript">
  $(function(){$('#placaRest').attr('readonly','true');
   <?php if($oCert != NULL){ ?>$('.proob').show();<?php  if($oCert->formatoID != 0) { ?>$('.hide-valid').show();        <?php }else{ ?>$('.hide-valid').hide();<?php }  ?>

   <?php 
   switch ($oCert->tipoCliente) {
    case 1:
    echo '$("#divNatural").attr("style","display:block");';
    echo '$("#divJuridica").attr("style","display:none");';
    echo '$("#divSinPropiedad").attr("style","display:none");';
    break;
    case 2:
    echo '$("#divNatural").attr("style","display:none");';
    echo '$("#divJuridica").attr("style","display:none");';
    echo '$("#divSinPropiedad").attr("style","display:block");';
    break;
    case 3:
    echo '$("#divNatural").attr("style","display:none");';
    echo '$("#divJuridica").attr("style","display:block");';
    echo '$("#divSinPropiedad").attr("style","display:none");';
    break;
  }
  if($oSP != NULL){
    echo '$("#divInsSP").attr("style","display:none");';
    echo '$("#divActSP").attr("style","display:block");';
  }else{
    echo '$("#divInsSP").attr("style","display:block");';
    echo '$("#divActSP").attr("style","display:none");';
  }
  if($oClienteJ != NULL){
    echo '$("#divInsCliJur").attr("style","display:none");';
    echo '$("#divActCliJur").attr("style","display:block");';
  }else{
    echo '$("#divInsCliJur").attr("style","display:block");';
    echo '$("#divActCliJur").attr("style","display:none");';
  }
  if($oClienteJ != NULL){
    foreach($lCliente as $var){ ?>
      $('#list-cli').append('<tr class="fila_<?php echo $var->clienteID; ?>"><td><a href="javascript:getClienteModal(<?php echo $var->clienteID; ?>);"><i class="fa fa-pencil-square-o"></i></a>&nbsp;<a href="javascript:RemoveModal(<?php echo $var->clienteID; ?>,'+$('#precertID').val()+');"><i class="fa fa-times"></i></a></td><td><?php echo $var->name; ?></td><td><?php echo $var->lastname; ?></td><td><?php echo $var->numDoc; ?></td><td><?php echo $var->celular; ?></td></tr>');
      <?php } 
    } 
  }?>

  <?php if($oCert != NULL){ ?>
    var placa = $('#placa').val();
    $('#placaRest').val(placa);
    $.getJSON('<?php echo $URL_ROOT;?>ajax/valid_taller.php?taller='+$('#tallerID').val(), function(data) {
      if(data.retval==1){
        $.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_placa.php?placa='+$('#placa').val(), function(data) {
          if(data.retval==1){
            $('.hide-valid').show();
          }else{
            $('.hide-valid').hide();
          }
        }).error(function(jqXHR, textStatus, errorThrown) {
          alertify.error("Error interno");
          console.log("error: " + textStatus);
          console.log("error thrown: " + errorThrown);
          console.log("incoming Text: " + jqXHR.responseText);
        });
      }else{
        $('.hide-valid').hide();
      }

    });
    <?php } ?>
  });
</script>
<section class="content">
  <form name="frmMain" id="frmMain" class="form-horizontal" method="post" autocomplete="off" >
    <div class="box box-default">
      <div class="box-header">
        <h3 class="box-title"><i class="fa fa-inbox"></i> &nbsp; <?php if($oCert != NULL){ echo 'Edición del Certificado GLP N° '.$oCert->certificadoID;} else echo 'Nuevo Certificado GLP'; ?></h3>
      </div>
      <br />
      <div class="box-body">
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">Tipo de Certificado :</p>
            </div>
            <div class="col-sm-4">
              <select name="tipocertID" id="tipocertID" class="form-control input-sm" autocomplete="off">
                <option value="0">[SELECCIONE]</option> <?php $list= CmsParameterLang::getWebListParent(12, 70, 1); foreach ($list as $obj) {echo "<option value=\"".$obj->parameterID."\"";if($oPrecert != NULL){ if($obj->parameterID==$oPrecert->tipocertID) echo 'selected="true"';}echo ">".$obj->parameterName."</option>";}?>   
              </select>
            </div>                      
            <div class="col-sm-2">
              <p class="text-right">N° de placa :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="placa" name="placa" placeholder="Ingrese N° de placa" maxlength="28" value="<?php if($oPrecert != NULL){ echo $oPrecert->placa; } ?>" <?php if($oPrecert != NULL){ echo 'readonly="true"'; } ?>>
            </div>
            <script type="text/javascript">
              $(function(){
                $('#placa').change(function(){
                  $.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_placa.php?placa='+$('#placa').val(), function(data) {
                    if(data.retval==1){
                      alertify.success(data.message);    
                      $('#btnSavePrecert').show();
                    }else{
                      if($('#placa').val() == 'En Tramite'){
                        $('#btnSavePrecert').show();
                      }else{
                        alertify.error(data.message);
                        $('#btnSavePrecert').hide();
                      }
                    }
                  }).error(function(jqXHR, textStatus, errorThrown) {
                    alertify.error("Error interno");
                    console.log("error: " + textStatus);
                    console.log("error thrown: " + errorThrown);
                    console.log("incoming Text: " + jqXHR.responseText);
                  });

                });
              });
            </script>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">Marca :</p>
            </div>
            <div class="col-sm-3">
              <select name="marcaID" id="marcaID" class="form-control input-sm" autocomplete="off">
                <option value="0">[SELECCIONE]</option> <?php $list= CmsParameterLang::getWebList(8, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\"";if($oPrecert != NULL){ if($obj->parameterID==$oPrecert->marcaID) echo 'selected="true"';}echo ">".$obj->parameterName."</option>";}?>   
              </select>
            </div>
            <div class="col-sm-1">
              <a href="#newMarca" id="btnNewMarca" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-backdrop="static" title="Nueva Marca" tabindex="-1"><span class="fa fa-plus"></span></a>
            </div>
            <div id="newMarca" class="modal fade">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Nueva Marca</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-2">
                          <p>Marca: </p>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control input-sm" id="marcaNew" name="marcaNew" placeholder="Ingrese marca" maxlength="100">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div class="row">
                      <div class="col-sm-4 col-sm-offset-8">
                        <div class="btn btn-primary btn-block" id="btnAddMarca"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Agregar Marca</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <p class="text-right">Modelo :</p>
            </div>
            <div class="col-sm-3">
              <select name="modeloID" id="modeloID" class="form-control input-sm" autocomplete="off">
                <option value="0">[SELECCIONE]</option><?php if($oPrecert != NULL){$oModelo = CmsParameterLang::getItem($oPrecert->modeloID,1);?>
                <option value="<?php echo $oModelo->parameterID; ?>" selected><?php echo $oModelo->parameterName; ?></option><?php } ?>
              </select>
            </div>
            <div class="col-sm-1">
              <a href="#newModelo" id="btnNewModelo" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-backdrop="static" title="Nuevo Modelo" tabindex="-1"><span class="fa fa-plus"></span></a>
            </div>
            <div id="newModelo" class="modal fade">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Nuevo Modelo</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-2">
                          <p>Marca: </p>
                        </div>
                        <div class="col-sm-10">
                          <select name="marcaNewModID" id="marcaNewModID" class="form-control input-sm" autocomplete="off">
                            <option value="0">[SELECCIONE]</option> <?php $list= CmsParameterLang::getWebList(8, 1); foreach ($list as $obj) {echo "<option value=\"".$obj->parameterID."\"";echo ">".$obj->parameterName."</option>";}?>   
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-2">
                          <p>Modelo: </p>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control input-sm" id="modeloNew" name="modeloNew" placeholder="Ingrese modelo" maxlength="100">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div class="row">
                      <div class="col-sm-4 col-sm-offset-8">
                        <div class="btn btn-primary btn-block" id="btnAddModelo"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Agregar Modelo</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">Categoría :</p>
            </div>
            <div class="col-sm-3">
              <select name="categoriaID" id="categoriaID" class="form-control input-sm" autocomplete="off">
                <option value="0">[SELECCIONE]</option><?php $list= CmsParameterLang::getWebList(4, 1); foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\"";if($oPrecert != NULL){ if($obj->parameterID==$oPrecert->categoriaID) echo 'selected="true"';}echo ">".$obj->parameterName."</option>";}?>   
              </select>
            </div>
            <div class="col-sm-1">
              <a href="#newCategoria" id="btnNewCategoria" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-backdrop="static" title="Nueva Categoría" tabindex="-1"><span class="fa fa-plus"></span></a>
            </div>
            <div id="newCategoria" class="modal fade">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Nueva Categoría</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-2">
                          <p>Categoría: </p>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control input-sm" id="categoriaNew" name="categoriaNew" placeholder="Ingrese categoría" maxlength="100">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div class="row">
                      <div class="col-sm-5 col-sm-offset-7">
                        <div class="btn btn-primary btn-block" id="btnAddCategoria"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Agregar Categoría</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-2">
              <p class="text-right">Combustible :</p>
            </div>
            <div class="col-sm-3">
              <select name="combustibleID" id="combustibleID" class="form-control input-sm" autocomplete="off">
                <option value="0">[SELECCIONE]</option> <?php $list= CmsParameterLang::getWebList(7, 1); foreach ($list as $obj) {echo "<option value=\"".$obj->parameterID."\"";if($oPrecert != NULL){ if($obj->parameterID==$oPrecert->combustibleID) echo 'selected="true"';}echo ">".$obj->parameterName."</option>";}?>   
              </select>
            </div>
            <div class="col-sm-1">
              <a href="#newCombustible" id="btnNewCombustible" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-backdrop="static" title="Nuevo Combustible" tabindex="-1"><span class="fa fa-plus"></span></a>
            </div>
            <div id="newCombustible" class="modal fade">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Nuevo Combustible</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-2">
                          <p>Combustible: </p>
                        </div>
                        <div class="col-sm-10">
                          <input type="text" class="form-control input-sm" id="combustibleNew" name="combustibleNew" placeholder="Ingrese combustible" maxlength="100">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div class="row">
                      <div class="col-sm-5 col-sm-offset-7">
                        <div class="btn btn-primary btn-block" id="btnAddCombustible"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Agregar Combustible</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">Versión :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="version" name="version" placeholder="Ingrese versión" value="<?php if($oPrecert != NULL){ echo $oPrecert->version; } ?>">
            </div>
            <div class="col-sm-2">
              <p class="text-right">Año de fabricación :</p>
            </div>
            <div class="col-sm-4">
              <input type="number" min="0" class="form-control input-sm" id="ano_fab" name="ano_fab" placeholder="Ingrese año de fabricación" maxlength="4" value="<?php if($oPrecert != NULL){ echo $oPrecert->ano_fab; } ?>">
            </div>

          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">N° de motor :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="motor" name="motor" placeholder="Ingrese N° de motor" value="<?php if($oPrecert != NULL){ echo $oPrecert->motor; } ?>">
            </div>
            <div class="col-sm-2">
              <p class="text-right">N° de serie o Vin :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="serie" name="serie" placeholder="Ingrese N° de serie" value="<?php if($oPrecert != NULL){ echo $oPrecert->serie; } ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">N° de cilindros :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="cilindros" name="cilindros" placeholder="Ingrese N° de cilindros" maxlength="2" value="<?php if($oPrecert != NULL){ echo $oPrecert->cilindros; } ?>">
            </div>
            <div class="col-sm-2">
              <p class="text-right">Cilindrada :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="cilindrada" name="cilindrada" placeholder="Ingrese cilindrada" maxlength="8" value="<?php if($oPrecert != NULL){ echo $oPrecert->cilindrada; } ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">N° de ejes :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="ejes" name="ejes" placeholder="Ingrese N° de ejes" maxlength="2" value="<?php if($oPrecert != NULL){ echo $oPrecert->ejes; } ?>">
            </div>
            <div class="col-sm-2">
              <p class="text-right">N° de ruedas :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="ruedas" name="ruedas" placeholder="Ingrese N° de ruedas" maxlength="2" value="<?php if($oPrecert != NULL){ echo $oPrecert->ruedas; } ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">N° de asientos :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="asientos" name="asientos" placeholder="Ingrese N° de asientos" maxlength="2" value="<?php if($oPrecert != NULL){ echo $oPrecert->asientos; } ?>">
            </div>
            <div class="col-sm-2">
              <p class="text-right">N° de pasajeros :</p>
            </div>
            <div class="col-sm-4">
              <input type="text" class="form-control input-sm" id="pasajeros" name="pasajeros" placeholder="Ingrese N° de pasajeros" maxlength="2" value="<?php if($oPrecert != NULL){ echo $oPrecert->pasajeros; } ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">Largo (cm):</p>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control input-sm" id="largo" name="largo" placeholder="Ingrese largo" maxlength="7" value="<?php if($oPrecert != NULL){ echo $oPrecert->largo; } ?>">
            </div>
            <div class="col-sm-2">
              <p class="text-right">Ancho (cm):</p>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control input-sm" id="ancho" name="ancho" placeholder="Ingrese ancho" maxlength="7" value="<?php if($oPrecert != NULL){ echo $oPrecert->ancho; } ?>">
            </div>
            <div class="col-sm-2">
              <p class="text-right">Alto (cm):</p>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control input-sm" id="alto" name="alto" placeholder="Ingrese alto" maxlength="7" value="<?php if($oPrecert != NULL){ echo $oPrecert->alto; } ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-2">
              <p class="text-right">Peso Neto (kg):</p>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control input-sm" id="pesoNeto" name="pesoNeto" placeholder="Ingrese peso neto" maxlength="7" value="<?php if($oPrecert != NULL){ echo $oPrecert->pesoNeto; } ?>">
            </div>
            <div class="col-sm-2">
              <p class="text-right">Peso Bruto (kg):</p>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control input-sm" id="pesoBruto" name="pesoBruto" placeholder="Ingrese peso bruto" maxlength="7" value="<?php if($oPrecert != NULL){ echo $oPrecert->pesoBruto; } ?>">
            </div>
            <div class="col-sm-2">
              <p class="text-right">Carga Útil (kg):</p>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control input-sm" id="cargaUtil" name="cargaUtil" placeholder="Ingrese carga útil" maxlength="7" value="<?php if($oPrecert != NULL){ echo $oPrecert->cargaUtil; } ?>">
            </div>
          </div>
        </div>
        <div id="divModifCombPeso" style="<?php if($oPrecert == NULL){ echo 'display:none'; } else if($oPrecert != NULL){ if($oPrecert->tipocertID == 83) echo 'display:block'; else echo 'display:none'; }?>">
          <br>
          <legend style="text-align:left;">Modificación de combustible, peso neto y carga útil</legend>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-2">
                <p class="text-right">Combustible Modificado:</p>
              </div>
              <div class="col-sm-2">
                <select name="combustibleMod" id="combustibleMod" class="form-control input-sm" autocomplete="off">
                  <option value="0">[SELECCIONE]</option> <?php $list= CmsParameterLang::getWebList(16, 1); foreach ($list as $obj) {echo "<option value=\"".$obj->parameterID."\"";if($oPrecert != NULL){ if($obj->parameterID==$oPrecert->combustibleMod) echo 'selected="true"';}echo ">".$obj->parameterName."</option>";}?>   
                </select>
              </div>
              <div class="col-sm-2">
                <p class="text-right">Peso Neto Modificado (kg):</p>
              </div>
              <div class="col-sm-2">
                <input name="pesoNetoMod" type="text" id="pesoNetoMod" class="form-control input-sm" readOnly placeholder="Ingrese nuevo peso neto" maxlength="7" value="<?php if($oPrecert != NULL){ echo $oPrecert->pesoNetoMod; } ?>">
              </div>
              <script type="text/javascript">
                $(function(){
                  $('#pesoNeto').change(function(){
                    $('#pesoNetoMod').val($('#pesoNeto').val());
                  });
                  $('#cargaUtil').change(function(){
                    $('#cargaUtilMod').val($('#cargaUtil').val());
                  });
                })
              </script>
              <div class="col-sm-2">
                <p class="text-right">Carga Útil Modificada (kg):</p>
              </div>
              <div class="col-sm-2">
                <input name="cargaUtilMod" type="text" id="cargaUtilMod" class="form-control input-sm" readOnly placeholder="Ingrese nueva carga útil" maxlength="7" value="<?php if($oPrecert != NULL){ echo $oPrecert->cargaUtilMod; } ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="box-footer">
        <input type="text" class="form-control input-sm" style="display:none" id="precertID" name="precertID" value="<?php if($oPrecert != NULL){ echo $oPrecert->precertID; }?>">
        <div class="row" id="divInsPreCert" style="<?php if($oPrecert != NULL){ echo 'display:none'; }?>">
          <div class="col-sm-2 col-sm-offset-10">
            <div class="btn btn-primary" id="btnSavePrecert"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Grabar Cabecera</div>
          </div>
        </div>
        <div class="row" id="divActPreCert" style="<?php if($oPrecert == NULL){ echo 'display:none'; }?>">
          <div class="col-sm-2 col-sm-offset-10">
            <div class="btn btn-success" id="btnActPrecert"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Actualizar Cabecera</div>
          </div>
        </div>
      </div>
      <div id="divTabs" style="<?php if($oPrecert == NULL){ echo 'display:none'; } ?>">
        <br />
        <ul class="nav nav-tabs">
          <li id="li_A"  class ="active"><a data-toggle="tab" href="#sectionA">Cliente</a></li>
          <li id="li_B"><a data-toggle="tab" href="#sectionB">Componentes Instalados</a></li>
          <li id="li_C"><a data-toggle="tab" href="#sectionC">Registro Fotográfico</a></li>  
          <li id="li_D"><a data-toggle="tab" href="#sectionD">Aforo Documentario</a></li>                    
          <li id="li_E"><a data-toggle="tab" href="#sectionE">Observaciones</a></li>
          <li id="li_F"><a data-toggle="tab" href="#sectionF">Restriccion de Placas</a></li>
          <li id="li_G"><a data-toggle="tab" href="#sectionG">#Formato</a></li>
        </ul>
        <div class="tab-content">
          <div id="sectionA" class="tab-pane fade in active">
            <br />
            <p>Tipo de cliente:</p>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-4">
                  &nbsp;
                  <!-- <input id="rbtPersonaSinTitulo" type="radio" name="tipoCliente" value="2"><label>Sin titulo de Propiedad</label> -->
                </div>
                <div class="col-sm-4">
                  Seleccione el tipo de Cliente : 
                  <select id="tipoCliente" name="tipoCliente" class="form-control">
                    <option value="2" <?php if($oCert != NULL){ if($oCert->tipoCliente == '2'){ echo 'selected'; } } ?>>Sin Titulo de Propiedad</option>
                    <option value="1" <?php if($oCert != NULL){ if($oCert->tipoCliente == '1'){ echo 'selected'; } } ?>>Persona Natural</option>
                    <option value="3" <?php if($oCert != NULL){ if($oCert->tipoCliente == '3'){ echo 'selected'; } } ?>>Persona Juridica</option>
                  </select>
                  <!-- <input id="rbtPersonaNat" type="radio" name="tipoCliente" value="1"><label>Persona Natural</label> -->
                </div>
                <div class="col-sm-4">
                  &nbsp;
                  <!-- <input id="rbtPersonaJur" type="radio" name="tipoCliente" value="3"><label>Persona Jurídica</label> -->
                </div>
              </div>                            
              <input type="text" class="form-control input-sm" style="display:none" id="clienteID" name="clienteID" value="<?php if($oCliente != NULL){ echo $oCliente->clienteID; } ?>">
              <input type="text" class="form-control input-sm" style="display:none" id="clienteSPID" name="clienteSPID" value="<?php if($oSP != NULL){ echo $oSP->clienteID; } ?>">
              <input type="text" class="form-control input-sm" style="display:none" id="clienteJID" name="clienteJID" value="<?php if($oClienteJ != NULL){ echo $oClienteJ->clienteID; } ?>">
            </div>
            <div id="divSinPropiedad">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <p class="text-right">Dirección :</p>
                  </div>
                  <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="direccionSP" name="direccionSP" placeholder="Ingrese dirección" maxlength="255" value="<?php if($oSP != NULL){ echo $oSP->direccionSP; } ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <p class="text-right">Email :</p>
                  </div>
                  <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="emailSP" name="emailSP" placeholder="Ingrese email" maxlength="100" value="<?php if($oSP != NULL){ echo $oSP->emailSP; } ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <p class="text-right">Celular :</p>
                  </div>
                  <div class="col-sm-10">
                    <input type="text" class="form-control input-sm" id="celularSP" name="celularSP" placeholder="Ingrese celular" maxlength="100" value="<?php if($oSP != NULL){ echo $oSP->celularSP; } ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row" id="divInsSP" style="<?php if($SP != NULL){ echo 'display:none'; }?>">
                  <div class="col-sm-2 col-sm-offset-10">
                    <div class="btn btn-primary" id="btnSaveSP"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Grabar Cliente</div>
                  </div>
                </div>
                <div class="row" id="divActSP" style="<?php if($SP == NULL){ echo 'display:none'; }?>">
                  <div class="col-sm-2 col-sm-offset-10">
                    <div class="btn btn-success" id="btnActSP"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Actualizar Cliente</div>
                  </div>
                </div>
              </div>
            </div>
            <div id="divNatural" style="display:none" >
              <div class="form-group">
                <div class="row">
                  <table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbCliente">
                    <thead>
                      <tr> 
                        <th style="text-align:center;">&nbsp;</th>
                        <th style="text-align:center;"><a>Nombres </a></th>
                        <th style="text-align:center;"><a>Apellidos</a></th>
                        <th style="text-align:center;"><a>Nro Documento</a></th>
                        <th style="text-align:center;"><a>Télefono</a></th>
                      </tr>
                    </thead>
                    <tbody id="list-cli">
                      <tr></tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-1 col-sm-offset-11">
                  <div id="newCli" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target=".bs-chartCli" title="Nuevo Cliente"><i class="fa fa-plus"></i></div>
                </div>
              </div>
              <!-- Inicio Modal componentes  -->
              <div id="myModalClientes" class="modal fade bs-chartCli" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document" >
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="gridSystemModalLabel">Nuevo Cliente</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-2">
                            <p class="text-right">Nombres :</p>
                          </div>
                          <div class="col-sm-3">
                            <input type="text" class="form-control input-sm" id="name" name="name" placeholder="Ingrese nombres" maxlength="100" value="<?php if($oCliente != NULL){ echo $oCliente->name; } ?>">
                          </div>
                          <div class="col-sm-1">
                            <a href="#myModalPersona" id="btnFindPers" role="button" class="btn btn-info btn-xs" data-toggle="modal"
                            data-backdrop="static" title="Buscar Cliente" tabindex="-1" style="border-radius: 20px 20px;"><span class="fa fa-search fa-rotate-90"></span></a>
                          </div>
                          <div class="col-sm-2">
                            <p class="text-right">Apellidos :</p>
                          </div>
                          <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" id="lastname" name="lastname" placeholder="Ingrese apellidos" maxlength="100" value="<?php if($oCliente != NULL){ echo $oCliente->lastname; } ?>">
                          </div>
                        </div>
                      </div>
                      <!-- Inicio Modal Persona  -->
                      <div id="myModalPersona" class="modal fade">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Búsqueda de Personas Naturales</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <div class="row">
                                  <div class="col-sm-2 col-sm-offset-2">
                                    <p>Filtro: </p>
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control input-sm" id="txtsearchN" name="txtsearchN" placeholder="Ingrese N° documento / Nombre Completo" maxlength="50">
                                  </div>
                                  <div class="col-sm-2">
                                    <div class="btn btn-primary btn-block btn-sm" name="btnSearchCli" id="btnSearchCli"><i class="fa fa-search fa-rotate-90"></i>&nbsp;&nbsp;Buscar</div>
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="row">
                                  <table class="table table-striped table-hover table-condensed table-bordered table-responsive">
                                    <thead>
                                      <tr> 
                                        <th style="text-align:center;width: 5%;">&nbsp;</th>
                                        <th style="text-align:center;"><a>Nombres</a></th>
                                        <th style="text-align:center;"><a>Apellidos</a></th>
                                        <th style="text-align:center;"><a>N° documento</a></th>
                                        <th style="text-align:center;"><a>Fecha Nacimiento</a></th>                      
                                      </tr>
                                    </thead>
                                    <tbody id="list-cliente">
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal Persona  -->
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-2">
                            <p class="text-right">Tipo de documento :</p>
                          </div>
                          <div class="col-sm-4">
                            <select name="tipoDoc" id="tipoDoc" class="form-control input-sm" autocomplete="off" <?php if($oCliente != NULL){ echo "disabled"; } ?>>
                              <option value="0">[SELECCIONE]</option> <?php $list= CmsParameterLang::getWebList(13, 1); foreach ($list as $obj) {echo "<option value=\"".$obj->parameterID."\"";if($oCliente != NULL){ if($obj->parameterID==$oCliente->tipoDoc) echo 'selected="true"';}echo ">".$obj->parameterName."</option>";}?>   
                            </select>
                          </div>
                          <div class="col-sm-2">
                            <p class="text-right">N° de documento :</p>
                          </div>
                          <div class="col-sm-4">
                            <input type="number" min="0" class="form-control input-sm" id="numDoc" name="numDoc" placeholder="Ingrese N° de documento" value="<?php if($oCliente != NULL){ echo $oCliente->numDoc; } ?>" <?php if($oCliente != NULL){ echo "readonly"; } ?>>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-2">
                            <p class="text-right">Celular :</p>
                          </div>
                          <div class="col-sm-4">
                            <input type="text" class="form-control input-sm" id="celular" name="celular" placeholder="Ingrese celular" maxlength="100" value="<?php if($oCliente != NULL){ echo $oCliente->celular; } ?>">
                          </div>
                          <div class="col-sm-2">
                            <p class="text-right">Sexo :</p>
                          </div>
                          <div class="col-sm-4">
                            <input id="rbtMasculino" type="radio" name="sexo" value="0" checked="checked"><label>Masculino</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input id="rbtFemenino" type="radio" name="sexo" value="1"><label>Femenino</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-2">
                            <p class="text-right">Departamento :</p>
                          </div>
                          <div class="col-sm-2">
                            <select name="departamento" id="departamento" class="form-control input-sm">
                              <option value="0">[SELECCIONE]</option><?php $lDep=CrmUbigeo::getDepartamento_List(); foreach ($lDep as $obj) {?>
                              <option value="<?php echo $obj->cod_dpto; ?>" <?php if($oCliente != NULL){ if($obj->cod_dpto==$oCliente->departamento) echo 'selected="true"';} ?>><?php echo $obj->nombre; ?></option><?php } ?>
                            </select>
                          </div>
                          <div class="col-sm-2">
                            <p class="text-right">Provincia :</p>
                          </div>
                          <div class="col-sm-2">
                            <select name="provincia" id="provincia" class="form-control input-sm">
                              <option value="0">[SELECCIONE]</option><?php if($oCliente != NULL){ $oProvincia = CrmUbigeo::getProvincia_Item($oCliente->departamento,$oCliente->provincia);?><option value="<?php echo $oCliente->provincia; ?>" selected><?php echo $oProvincia->nombre; ?></option><?php } ?>
                            </select>
                          </div>
                          <div class="col-sm-2">
                            <p class="text-right">Distrito :</p>
                          </div>
                          <div class="col-sm-2">
                            <select name="distrito" id="distrito" class="form-control input-sm">
                              <option value="0">[SELECCIONE]</option><?php if($oCliente != NULL){ $oDistrito = CrmUbigeo::getDistrito_Item($oCliente->departamento,$oCliente->provincia,$oCliente->distrito); ?><option value="<?php echo $oCliente->distrito; ?>" selected><?php echo $oDistrito->nombre; ?></option><?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-2">
                            <p class="text-right">Dirección :</p>
                          </div>
                          <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" id="address" name="address" placeholder="Ingrese dirección" maxlength="255" value="<?php if($oCliente != NULL){ echo $oCliente->address; } ?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row" id="divInsCli" style="<?php if($oCliente != NULL){ echo 'display:none'; }?>">
                          <div class="col-sm-2 col-sm-offset-10">
                            <div class="btn btn-primary" id="btnSaveCliente"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Grabar Cliente</div>
                          </div>
                        </div>
                        <div class="row" id="divActCli" style="<?php if($oCliente == NULL){ echo 'display:none'; }?>">
                          <div class="col-sm-2 col-sm-offset-10">
                            <div class="btn btn-success" id="btnActCliente"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Actualizar Cliente</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <div class="row">
                        <div class="col-sm-4 col-sm-offset-8">
                          <div class="btn btn-primary btn-block" name="btnAddClienteNatural" id="btnAddClienteNatural"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Fin Modal componentes  -->
            </div>
            <div id="divJuridica" style="display:none">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <p class="text-right">Razón Social :</p>
                  </div>
                  <div class="col-sm-3">
                    <input type="text" class="form-control input-sm" id="razon" name="razonSocial" placeholder="Ingrese razón social" maxlength="100" ng-value="nuevo.razonSocial" ng-model="nuevo.razonSocial">
                  </div>
                  <div class="col-sm-1">
                    <a href="#myModalPersonaJ" id="btnFindPers" role="button" class="btn btn-info btn-xs" data-toggle="modal"
                    data-backdrop="static" title="Buscar Cliente" tabindex="-1" style="border-radius: 20px 20px;"><span class="fa fa-search fa-rotate-90"></span></a>
                  </div>
                  <div class="col-sm-2">
                    <p class="text-right">RUC :</p>
                  </div>
                  <div class="col-sm-4">
                    <input type="number" min="0" class="form-control input-sm" id="ruc" name="ruc" placeholder="Ingrese RUC" maxlength="11" ng-value="nuevo.ruc" ng-model="nuevo.ruc">
                  </div>
                </div>
              </div>
              <!-- Inicio Busqueda Personal Juridico-->
              <div id="myModalPersonaJ" class="modal fade">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Búsqueda de Personas Juridicas</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-2 col-sm-offset-2">
                            <p>Filtro: </p>
                          </div>
                          <div class="col-sm-6">
                            <input type="text" class="form-control input-sm" id="txtsearch" name="txtsearch" ng-model="search" placeholder="Ingrese RUC / Razon Social" maxlength="50">
                          </div>
                        </div>
                      </div>
                      <div class="form-group" >
                        <div class="row">
                          <table class="table table-striped table-hover table-condensed table-bordered table-responsive" ng-controller="pJuridica">
                            <thead>
                              <tr> 
                                <th style="text-align:center;"><a>Razon Social</a></th>
                                <th style="text-align:center;"><a>RUC</a></th>
                                <th style="text-align:center;"><a>Representante Legal</a></th>
                                <th style="text-align:center;"><a>Email</a></th>                      
                              </tr>
                            </thead>
                            <tbody ng-if="lista.length != null">
                              <tr ng-click="get(x.pJuridicaID)" ng-repeat="x in lista | filter : search">
                                <td>{{x.razonSocial}}</td>
                                <td>{{x.ruc}}</td>
                                <td>{{x.representanteLegal}}</td>
                                <td>{{x.email}}</td>
                              </tr>
                            </tbody>
                            <tbody ng-if="lista.length == null">
                              <tr>
                                <td colspan="5">No hay datos disponibles</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Fin Busqueda -->
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <p class="text-right">Representante Legal :</p>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control input-sm" id="representanteLegal" name="representanteLegal" placeholder="Ingrese representante legal" maxlength="100" ng-value="nuevo.representanteLegal" ng-model="nuevo.representanteLegal">
                  </div>
                  <div class="col-sm-2">
                    <p class="text-right">Celular :</p>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Ingrese telefono" maxlength="100" ng-value="nuevo.telefono" ng-model="nuevo.telefono">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <p class="text-right">Dirección:</p>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control input-sm" id="direccion" name="direccion" placeholder="Ingrese dirección fiscal" maxlength="100" ng-value="nuevo.direccionFiscal" ng-model="nuevo.direccionFiscal">
                  </div>
                  <div class="col-sm-2">
                    <p class="text-right">E-mail :</p>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control input-sm" id="email" name="email" placeholder="Ingrese e-mail" maxlength="100"   ng-value="nuevo.email" ng-model="nuevo.email">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row" id="divInsCliJur">
                  <div class="col-sm-2 col-sm-offset-10">
                    <div class="btn btn-primary" id="btnSaveClienteJur"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Grabar Cliente</div>
                  </div>
                </div>
                <div class="row" id="divActCliJur" style="display:none">
                  <div class="col-sm-2 col-sm-offset-10">
                    <div class="btn btn-success" id="btnActClienteJur"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Actualizar Cliente</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="sectionB" class="tab-pane fade">
            <br />
            <div class="form-group">
              <div class="row">
                <table class="table table-striped table-hover table-condensed table-bordered table-responsive" id="tbComponentes">
                  <thead>
                    <tr> 
                      <th style="text-align:center;width: 5%;">&nbsp;</th>
                      <th style="text-align:center;width: 15%;"><a>Tipo de Componente </a></th>
                      <th style="text-align:center;width: 17%;"><a>Marca</a></th>
                      <th style="text-align:center;width: 17%;"><a>Modelo</a></th>
                      <th style="text-align:center;width: 15%;"><a>Serie</a></th>
                      <th style="text-align:center;"><a>Capacidad</a></th>
                      <th style="text-align:center;width: 10%;"><a>Mes</a></th>
                      <th style="text-align:center;"><a>Año</a></th>
                    </tr>
                  </thead>
                  <tbody id="list-comp">
                    <?php
                    function CambiarTema($var){
                      $valor = '';
                      switch ($var) {
                        case '01':
                        $valor = 'ENERO';break;
                        case '02':
                        $valor = 'FEBRERO';break;
                        case '03':
                        $valor = 'MARZO';break;
                        case '04':
                        $valor = 'ABRIL';break;
                        case '05':
                        $valor = 'MAYO';break;
                        case '06':
                        $valor = 'JUNIO';break;
                        case '07':
                        $valor = 'JULIO';break;
                        case '08':
                        $valor = 'AGOSTO';break;
                        case '09':
                        $valor = 'SEPTIEMBRE';break;
                        case '10':
                        $valor = 'OCTUBRE';break;
                        case '11':
                        $valor = 'NOVIEMBRE';break;
                        case '12':
                        $valor = 'DICIEMBRE';break;
                        default:
                        $valor = ''; break;
                      }
                      return $valor;
                    }

                    if($oCert != NULL){ 
                      $lComponentes  =GlpCompInst::getListByCertificado($oCert->certificadoID);
                      foreach ($lComponentes as $oCompInst) {
                        $oTipoComp = CmsParameterLang::getItem($oCompInst->tipoCompID,1);
                        ?>
                        <tr class='fila'>
                          <td><div class='remove btn btn-danger btn-sm'><i class='fa fa-close'></i></div></td>
                          <td style='display:none;'><input type='text' name='tipoCompIDT[]' id='tipoCompIDT' class='form-control input-sm' readonly='true' value='<?php echo $oCompInst->tipoCompID;?>'></td>
                          <td><input type='text' name='tipoCompT[]' id='tipoCompT' class='form-control input-sm' readonly='true' value='<?php echo $oTipoComp->parameterName;?>'></td>
                          <td><input type='text' name='marcaCompT[]' id='marcaCompT' class='form-control input-sm' readonly='true' value='<?php echo $oCompInst->marca;?>'></td>
                          <td><input type='text' name='modeloCompT[]' id='modeloCompT' class='form-control input-sm' readonly='true' value='<?php echo $oCompInst->modelo;?>'></td>
                          <td><input type='text' name='serieCompT[]' id='serieCompT' class='form-control input-sm' readonly='true' value='<?php echo $oCompInst->serie;?>'></td>
                          <td><input type='text' name='capacidadCompT[]' id='capacidadCompT' class='form-control input-sm' readonly='true' value='<?php echo $oCompInst->capacidad;?>'></td>
                          <td style='display:none;'><input type='text' name='mesCompIDT[]' id='mesCompIDT' class='form-control input-sm' readonly='true' value='<?php echo $oCompInst->mes_fab;?>'></td>
                          <td><input type='text' name='mesCompT[]' id='mesCompT' class='form-control input-sm' readonly='true' value='<?php echo CambiarTema($oCompInst->mes_fab); ?>'></td>
                          <td><input type='text' name='anoCompT[]' id='anoCompT' class='form-control input-sm' readonly='true' value='<?php echo $oCompInst->ano_fab;?>'></td>
                        </tr>
                        <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-1 col-sm-offset-11">
                <div id="newComp" class="btn btn-primary" data-toggle="modal" data-backdrop="static" data-target=".bs-chart2" title="Nuevo Componente"><i class="fa fa-plus"></i></div>
              </div>
            </div>
            <!-- Inicio Modal componentes  -->
            <div id="myModalComponentes" class="modal fade bs-chart2" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-lg" role="document" >
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Nuevo Componente</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label>Tipo de Componente</label>
                          <select name="tipoCompID" id="tipoCompID" class="form-control" autocomplete="off">
                            <option value="0">[SELECCIONE]</option> <?php $list= CmsParameterLang::getWebList(14, 1);  foreach ($list as $obj) { echo "<option value=\"".$obj->parameterID."\""; echo ">".$obj->parameterName."</option>"; } ?>
                          </select>
                        </div>
                      </div> 
                      <div class="col-sm-5 col-sm-offset-2 cilindro" style="display:none;">
                        <div class="form-group">
                          <label>Peso</label>
                          <input name="cilindro" type="text" class="form-control" id="cilindro" placeholder="Ingrese Peso" maxlength="100">
                        </div>
                      </div>
                    </div>
                    <script type="text/javascript">
                      $(function(){
                        $('#tipoCompID').change(function(){
                          if($('#tipoCompID').val() == 79){
                            $('#capacidadComp').attr('disabled','disabled');
                            $('#capacidadComp').val('NE');
                            $('.cilindro').hide();
                          }else{
                            $('#capacidadComp').removeAttr('disabled','');
                            $('#capacidadComp').val('');
                            $('.cilindro').show();
                          }
                        });
                      });
                    </script>
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label>Marca</label>
                          <input name="marcaComp" type="text" class="form-control" id="marcaComp" placeholder="Ingrese marca" maxlength="100">
                        </div>
                      </div>
                      <div class="col-sm-5 col-sm-offset-2">
                        <div class="form-group">
                          <label>Modelo</label>
                          <input name="modeloComp" type="text" class="form-control" id="modeloComp" placeholder="Ingrese modelo" maxlength="100">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label>Serie</label>
                          <input name="serieComp" type="text" class="form-control" id="serieComp" placeholder="Ingrese serie" maxlength="100">
                        </div>
                      </div>
                      <div class="col-sm-5 col-sm-offset-2 capacidad_none" >
                        <div class="form-group">
                          <label>Capacidad (Litros)</label>
                          <input name="capacidadComp" type="text" class="form-control" id="capacidadComp" placeholder="Ingrese capacidad" maxlength="100">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-5">
                        <div class="form-group">
                          <label>Mes de Fabricación</label>
                          <select name="mesComp" id="mesComp" class="form-control" autocomplete="off">
                            <option value="00">[SELECCIONE]</option>
                            <option value="01">ENERO</option>
                            <option value="02">FEBRERO</option>
                            <option value="03">MARZO</option>
                            <option value="04">ABRIL</option>
                            <option value="05">MAYO</option>
                            <option value="06">JUNIO</option>
                            <option value="07">JULIO</option>
                            <option value="08">AGOSTO</option>
                            <option value="09">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-5 col-sm-offset-2">
                        <div class="form-group">
                          <label>Año de Fabricación</label>
                          <input name="anoComp" type="text" class="form-control" id="anoComp" placeholder="Ingrese año" maxlength="4">
                        </div>
                      </div>               
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div class="row">
                      <div class="col-sm-4 col-sm-offset-8">
                        <div class="btn btn-primary btn-block" name="btnAddComponente" id="btnAddComponente"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Guardar</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Fin Modal componentes  -->
          </div>
          <div id="sectionC" class="tab-pane fade">
            <p>Seleccione las fotos presentadas:</p>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-offset-2 col-sm-8"> 
                  <table class="table  table-hover table-bordered table-responsive" id="tbDocumentos">
                    <thead>
                      <tr>
                        <th class="text-center">FOTOS</th>
                        <th class="text-center proob" style="display: none;">FOTOS SUBIDAS</th>
                        <th class="text-center proob" style="display: none;" >VER FOTOS</th>
                      </tr>
                    </thead>
                    <tbody><?php $list= CmsParameterLang::getWebList(15, 1);  if($oCert != NULL){  $listAforo = GlpAforoFoto::getListByCertificado($oCert->certificadoID); }$count=0;foreach ($list as $obj) {$count++; if($oCert != NULL){  $countSpecial = CrmManageImage::getCountFilter($oCert->precertID,$obj->parameterID); $photo = CrmManageImage::getItemFilter($oCert->precertID,$obj->parameterID);} ?>
                      <tr>
                        <td>
                          <div class="checkbox checkbox-inline">
                            <input id="fotoID<?php echo $count; ?>" type="checkbox" value="<?php echo $obj->parameterID; ?>" <?php if($oCert != NULL){  foreach ($listAforo as $o) {if($o->fotoID == $obj->parameterID){ echo 'checked';}}if($countSpecial->archivo != '0'){ echo ' disabled';}} ?> />
                            <label for="fotoID<?php echo $count; ?>"><?php echo $obj->parameterName; ?></label>
                          </div>
                        </td>
                        <td class="proob" style="display: none;"><?php if($oCert != NULL){ echo $countSpecial->archivo;}else{ echo '0';} ?>
                        </td><?php if($oCert != NULL){ if($countSpecial->archivo != '0'){ ?>
                        <td class="proob" style="display: none;">
                          <div class="btn btn-primary btn-ms modal-photo<?php echo $obj->parameterID; ?>"><i class="fa fa-search"></i></div>
                          <div class="btn btn-primary btn-ms update<?php echo $obj->parameterID; ?>"><i class="fa fa-upload"></i></div>
                        </td><?php }else{ ?>
                        <td class="proob" style="display: none;">
                          <div class="btn btn-primary btn-ms update<?php echo $obj->parameterID; ?>"><i class="fa fa-upload"></i></div>
                        </td><?php } } else{ ?>
                        <td class="proob" style="display: none;"><div class="btn btn-primary btn-ms update<?php echo $obj->parameterID; ?>"><i class="fa fa-upload"></i></div></td>  <?php } ?>
                      </tr>
                      <script type="text/javascript">
                        $(function(){
                          if($('#fotoID<?php echo $count; ?>').is(':checked')) {$('.update<?= $obj->parameterID ?>').removeClass('disabled');}else{$('.update<?= $obj->parameterID ?>').addClass('disabled');}
                          $( ".update<?= $obj->parameterID ?>" ).click(function() {if ($('#fotoID<?php echo $count; ?>').is(':checked')) {$('#valfotoID').val('<?= $obj->parameterID ?>');
                            $('.modal-upload2').modal('show');
                          }
                        });
                          $( ".modal-photo<?php echo $obj->parameterID; ?>" ).click(function() {
                            $('.modal-fake<?php echo $obj->parameterID; ?>').modal('show');
                          });

                          $('#fotoID<?php echo $count; ?>').change(function(){
                            if(this.checked){
                              $('.update<?= $obj->parameterID ?>').removeClass('disabled');
                            }else
                            {
                              $('.update<?= $obj->parameterID ?>').addClass('disabled');
                            }
                          });
                        });
                      </script><?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div id="sectionD" class="tab-pane fade">
            <p>Seleccione los documentos presentados:</p>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-offset-2 col-sm-8"> 
                  <table class="table  table-hover table-bordered table-responsive" id="tbDocumentos">
                    <thead>
                      <tr>
                        <th class="text-center">DOCUMENTO</th>
                        <th class="text-center proob" style="display: none;">ARCHIVOS SUBIDOS</th>
                        <th class="text-center proob" style="display: none;" >VER ARCHIVOS</th>
                      </tr>
                    </thead>
                    <tbody><?php $list= CmsParameterLang::getWebList(10, 1);  if($oCert != NULL){ $listAforo = GlpAforoDoc::getListByCertificado($oCert->certificadoID); }$count=0;foreach ($list as $obj) {$count++;if($oCert != NULL){  $countSpecial = CrmManagePhoto::getCountFilter($oCert->precertID,$obj->parameterID); $photo = CrmManagePhoto::getItemFilter($oCert->precertID,$obj->parameterID);} ?>
                      <tr>
                        <td>
                          <div class="checkbox checkbox-inline">
                            <input id="documentoID<?php echo $count; ?>" type="checkbox" value="<?php echo $obj->parameterID; ?>" <?php if($oCert != NULL){  foreach ($listAforo as $o) {if($o->documentoID == $obj->parameterID){ echo 'checked';}}if($countSpecial->archivo != '0'){ echo ' disabled';}} ?> />
                            <label for="documentoID<?php echo $count; ?>"><?php echo $obj->parameterName; ?></label>
                          </div>
                        </td>
                        <td class="proob" style="display: none;"><?php if($oCert != NULL){ echo $countSpecial->archivo;}else{ echo '0';} ?></td><?php if($oCert != NULL){ if($countSpecial->archivo != '0'){ ?><?php if($obj->parameterID != '46'){ ?>
                        <td class="proob" style="display: none;"><a href="<?php echo SEO::get_URLRoot().'userfiles/'.CrmManagePhoto::getRoute($obj->parameterID).$photo->archivo; ?>" target="_blank"><div class="btn btn-primary btn-ms"><i class="fa fa-search"></i></div></a></td><?php  }else{ ?>
                        <td class="proob" style="display: none;">
                          <div class="btn btn-primary btn-ms modal-photo"><i class="fa fa-search"></i></div>
                        </td>
                        <td><div class="btn btn-primary btn-ms update<?php echo $obj->parameterID; ?>"><i class="fa fa-upload"></i></div></td><?php } ?><?php }else{ ?>
                        <td class="proob" style="display: none;">
                          <div class="btn btn-primary btn-ms update<?php echo $obj->parameterID; ?>"><i class="fa fa-upload"></i></div>
                        </td><?php } } else{ ?>
                        <td class="proob" style="display: none;"><div class="btn btn-primary btn-ms update<?php echo $obj->parameterID; ?>"><i class="fa fa-upload"></i></div></td>  <?php } ?>
                      </tr>
                      <script type="text/javascript">
                        $(function(){
                          if($('#documentoID<?php echo $count; ?>').is(':checked')) {$('.update<?= $obj->parameterID ?>').removeClass('disabled');}else{$('.update<?= $obj->parameterID ?>').addClass('disabled');}
                          $( ".update<?= $obj->parameterID ?>" ).click(function() {
                            if ($('#documentoID<?php echo $count; ?>').is(':checked')) {
                              $('#valDocumentoID').val('<?= $obj->parameterID ?>');
                              $('.modal-upload').modal('show');
                            }
                          });
                          $( ".modal-photo" ).click(function() {
                            $('.modal-fake').modal('show');
                          });

                          $('#documentoID<?php echo $count; ?>').change(function(){
                            if(this.checked){
                              $('.update<?= $obj->parameterID ?>').removeClass('disabled');
                            }else
                            {
                              $('.update<?= $obj->parameterID ?>').addClass('disabled');
                            }
                          });


                        });
                      </script><?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div id="sectionE" class="tab-pane fade">
            <br />
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <textarea name="observaciones" rows="4" cols="20" id="observaciones" class="form-control input-sm" placeholder="Ingrese observaciones"><?php if($oCert != NULL){ echo $oCert->observaciones; } ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div id="sectionF" class="tab-pane fade">
            <br />
            <div class="form-group">

              <div class="row">
                <div class="col-sm-12">
                  <p>Restriccion de Placas</p>
                </div>
                <div class="col-sm-6">
                  <input type="text" name="placaRest" id="placaRest" value="<?php if($oRest != NULL){ echo $oRest->placaRest; } ?>" class="form-control">
                  <br>
                </div>
                <div class="col-sm-12">
                  <textarea name="observacionesRest" rows="4" cols="20" id="observacionesRest" class="form-control input-sm" placeholder="Ingrese observaciones para la Restriccion"><?php if($oRest != NULL){ echo $oRest->observacionesRest; } ?></textarea>
                  <br>
                </div>
                <div class="hide-valid">
                  <div class="col-sm-3 col-sm-offset-9">
                    <div class="btn btn-primary" id="btn-acept-rest">Guardar Restriccion</div>
                  </div>
                </div>
                <script type="text/javascript">
                  $(function(){
                    $('#btn-acept-rest').click(function(){
                      $.getJSON('<?php echo $URL_ROOT;?>ajax/insert_restriccion.php?precertID='+$('#precertID').val()+'&placaRest='+$('#placaRest').val()+'&observacionesRest='+$('#observacionesRest').val(), function(data) {
                        if(data.retval==1){
                          alertify.success(data.message);
                          $('.hide-valid').hide();
                        }else{
                          alertify.error(data.message);
                        }
                      }).error(function(jqXHR, textStatus, errorThrown) {
                        alertify.error("Error interno");
                        console.log("error: " + textStatus);
                        console.log("error thrown: " + errorThrown);
                        console.log("incoming Text: " + jqXHR.responseText);
                      });
                    });
                  });
                </script>
              </div>
            </div>
          </div>
          <div id="sectionG" class="tab-pane fade">
            <br />
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <p class="text-right">Taller Certificador :</p>
                </div>
                <div class="col-sm-3">
                  <select name="tallerID" id="tallerID" class="form-control input-sm" autocomplete="off">
                    <option value="0">[SELECCIONE]</option> <?php $list= CrmTaller::getWebListGLP();foreach ($list as $obj) {echo "<option value=\"".$obj->tallerID."\"";if($oCert != NULL){ if($obj->tallerID==$oCert->tallerID) echo 'selected="true"';}echo ">".$obj->razonSocial."</option>";}?>
                  </select>
                </div> 
                <div class="col-sm-1">
                  <div id="actTaller" class="btn btn-info btn-xs" style="border-radius:20px 20px;" ><span class="fa fa-undo"></span></div>
                </div>
                <!--Modal Cambio Formato-->
                <div id="changeFormato" class="modal fade">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Cambio de Formato</h4>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-4">
                              <p>Nuevo N° formato: </p>
                            </div>
                            <div class="col-sm-8">
                              <input type="number" min="0" class="form-control input-sm" id="formatoNew" name="formatoNew" placeholder="Ingrese Nuevo N° formato" maxlength="8">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-4">
                              <p>Motivo del cambio: </p>
                            </div>
                            <div class="col-sm-8">
                              <select name="motivo" id="motivo" class="form-control input-sm">
                                <option value="0">[SELECCIONE]</option>
                                <option value="DUPLICADO DE CERTIFICADO">DUPLICADO DE CERTIFICADO</option>
                                <option value="MALA IMPRESIÓN">MALA IMPRESIÓN</option>
                                <option value="ERROR DEL CERTIFICADOR">ERROR DEL CERTIFICADOR</option>
                                <option value="ERROR DEL CLIENTE">ERROR DEL CLIENTE</option>
                                <option value="OTROS">OTROS</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <div class="row">
                          <div class="col-sm-5 col-sm-offset-7">
                            <div class="btn btn-primary btn-block" id="btnChangeFormato"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Cambiar Formato</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--Fin Modal Cambio de Formato-->
                <div class="hide-valid">
                  <div class="col-sm-2" style="display: none;">
                    <p class="text-right">N° formato :</p>
                  </div>
                  <div class="col-sm-2" style="display: none;">
                    <input type="number" min="0" class="form-control input-sm" id="formatoID" name="formatoID" placeholder="Ingrese N° de formato" maxlength="8" value="<?php if($oCert != NULL){ echo $oCert->formatoID; } ?>" <?php if($oCert != NULL){ echo "readonly"; } ?>>
                  </div>                                
                  <div class="col-sm-1" style="display: none;">
                    <a href="#changeFormato" id="btnCambForm" class="btn btn-info btn-xs" style="border-radius:20px 20px;<?php if($oCert == NULL){ echo 'display:none'; } ?>" data-toggle="modal" data-backdrop="static" data-original-title="Cambiar Formato"><span class="fa fa-file-text-o"></span></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2 ">
                  <p class="text-right">Sede del Taller :</p>
                </div>
                <div class="col-sm-4">
                  <select name="sedeID" id="sedeID" class="form-control input-sm">
                    <option value="0">[SELECCIONE]</option><?php if($oCert != NULL){$oSede = CrmSede::getItem($oCert->sedeID);?>
                    <option value="<?php echo $oSede->sedeID; ?>" selected><?php echo $oSede->descripcion; ?></option><?php } ?>
                  </select>
                </div>
                <div class="hide-valid">
                  <div class="col-sm-2" style="display: none;">
                    <p class="text-right">N° calcomanía :</p>
                  </div>
                  <div class="col-sm-2" style="display: none;">
                    <input type="number" min="0" class="form-control input-sm" id="calcomaniaID" name="calcomaniaID" placeholder="Ingrese N° de calcomanía" maxlength="8" value="<?php if($oCert != NULL){ echo $oCert->calcomaniaID; } ?>" <?php if($oCert != NULL){ echo "readonly"; } ?>>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <p class="text-right">Fecha de Emisión :</p>
                </div>
                <div class="col-sm-2">
                  <input type="text" class="form-control input-sm" id="fechaEmi" name="fechaEmi" placeholder="yyyy/mm/dd" maxlength="10" readonly="true" value="<?php if($oCert != NULL){ echo $oCert->fechaEmi; } ?>">
                </div>
              </div>
            </div>
            <div class="form-group"><?php $oUser=WebLogin::getUserSession(); ?>
              <input type="text" class="form-control input-sm" style="display:none" id="certificadoID" name="certificadoID" value="<?php if($oCert != NULL){ echo $oCert->certificadoID; }?>">
              <input type="text" class="form-control input-sm" style="display:none" id="usuarioID" name="usuarioID" value="<?php echo $oUser->userID; ?>">
              <div class="row" id="divInsCert" style="<?php if($oCert != NULL){ echo 'display:none'; }?>">
                <div class="col-sm-2 col-sm-offset-10">
                  <div class="btn btn-primary" id="btnSaveCert"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Generar Certificado</div>
                </div>
              </div>                           
              <div class="row" id="divActCert" style="<?php if($oCert == NULL){ echo 'display:none'; }?>">
                <div class="col-sm-2 col-sm-offset-10">
                  <div class="btn btn-success" id="btnActCert"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Actualizar Certificado</div>
                </div>
              </div>
              <br>
              <div class="hide-valid">
                <div class="row" id="divDownload" style="<?php if($oCert == NULL){ echo 'display:none'; }?>">
                  <div class="col-sm-2 col-sm-offset-10">
                    <div class="btn btn-warning" id="btnDownload"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Dercargar Certificado</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>                    
  </form>
  <!-- Subida de Archivos  -->
  <div class="modal fade modal-upload" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content">
        <form id="frm4" name="frm4" autocomplete="off" enctype="multipart/form-data" method="post" target="hideFrame">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Ingrese un archivo</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Archivo</label>
                  <input name="field[archivoServidor]" class="form-control" id="archivoServidor" type="file"  maxlength="30">
                  <input type="hidden" name="valDocumentoID" id="valDocumentoID">
                  <input type="hidden" name="certID" id="certID">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div class="btn btn-primary btn-block" name="btnCrear" id="send_upload"><i class="fa fa-floppy-o"></i>&nbsp;Guardar</div>
                </div>
              </div>              
            </div>            
          </div>
        </form>
      </div>
      <script>

        function getMessage(retVal,msg,msg2){
          if(retVal==1){  <?php if($oCert == NULL){  ?>location.href="<?php echo $URL_ROOT;?>certificados.html?action=update&certificadoID="+$('#certID').val();<?php }else{ ?>location.reload();<?php } ?>}else{alert(msg);console.log(msg);}
        }
        $(function(){
          $('#btn_close').click(function(){
            $( ".modal-backdrop" ).remove();
          });

          $('.close').click(function(){
            $('.modal').hide();
            $( ".modal-backdrop" ).remove();
          });


          $('#send_upload').click(function(){
            if (!isValidate('#frm4')){ alert('No hay data'); return false; }
            var ex = $("#archivoServidor").val().split('.').pop();
            if(ex!=""){

              var fs = 0;   
              if($("#archivoServidor")[0].files[0].size != undefined){
                fs = $("#archivoServidor")[0].files[0].size;  
              }else{
                fs = $("#archivoServidor")[0].files[0].fileSize;
              }

            }
            var documento = $('#valDocumentoID').val();
            $('.content').after('<iframe id="hideFrame" name="hideFrame" style="display:none"></iframe>'); 

            $('#frm4').attr('action', '<?php echo SEO::get_URLRoot();?>ajax/form_upload.php?documentoID='+documento+'&ID='+$('#precertID').val());

            $('#frm4').submit();

            return false; 
          });

        });
      </script>
    </div>
  </div>
  <!-- Fin de subida de Archivos -->
  <!-- Listado de Archivos -->
  <div class="modal fade modal-fake" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Listado de Fotos</h4>
          <?php $photos = CrmManagePhoto::getListFilter($oCert->certificadoID,46); 
          ?>
          <ul>
            <?php foreach ($photos as $var) {
              echo '<li><a href="'.SEO::get_URLRoot().'userfiles/'.CrmManagePhoto::getRoute(46).$var->archivo.'" target="_blank">'.$var->archivo.'</a></li>';
            } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin de Listado de Fotos -->


  <!-- Subida de Fotos -->
  <div class="modal fade modal-upload2" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content">
        <form id="frm5" name="frm5" autocomplete="off" enctype="multipart/form-data" method="post" target="hideFrame">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Ingrese una foto</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Foto </label>
                  <input name="field[fotoServidor]" class="form-control" id="fotoServidor" type="file"  maxlength="30">
                  <input type="hidden" name="valfotoID" id="valfotoID">
                  <input type="hidden" name="precertID" id="precertID">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <div class="btn btn-primary btn-block" name="btnCrear" id="send_upload2"><i class="fa fa-floppy-o"></i>&nbsp;Guardar</div>
                </div>
              </div>  
            </div>            
          </div>
        </form>
      </div>
      <script>

        function getMessage2(retVal,msg,msg2){
          if(retVal==1){  <?php if($oCert == NULL){  ?>location.href="<?php echo $URL_ROOT;?>certificados.html?action=update&certificadoID="+$('#certID').val();<?php }else{ ?>location.reload();<?php } ?>}else{alert(msg);console.log(msg);}
        }
        $(function(){
          $('#btn_close').click(function(){
            $( ".modal-backdrop" ).remove();
          });


          $('#send_upload2').click(function(){
            if (!isValidate('#frm5')){ alert('No hay data'); return false; }
            var ex = $("#fotoServidor").val().split('.').pop();
            if(ex!=""){

              var fs = 0;   
              if($("#fotoServidor")[0].files[0].size != undefined){
                fs = $("#fotoServidor")[0].files[0].size;  
              }else{
                fs = $("#fotoServidor")[0].files[0].fileSize;
              }

            }
            var foto = $('#valfotoID').val();
            $('.content').after('<iframe id="hideFrame" name="hideFrame" style="display:none"></iframe>'); 

            $('#frm5').attr('action', '<?php echo SEO::get_URLRoot();?>ajax/form_upload2.php?fotoID='+foto+'&ID='+$('#precertID').val());

            $('#frm5').submit();

            return false; 
          });

        });
      </script>
    </div>
  </div>
  <!-- Fin de subida de Fotos -->
  <?php $list= CmsParameterLang::getWebList(15, 1);  
  foreach ($list as $obj) { ?>
  <!-- Listado de Fotos -->
  <div class="modal fade modal-fake<?php  echo $obj->parameterID; ?>" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Listado de Fotos</h4>
          <?php $photos2 = CrmManageImage::getListFilter($oCert->precertID,$obj->parameterID); 
          ?>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <?php foreach ($photos2 as $var) {
                echo '<div class="col-sm-6"> ';
                echo '<img src="'.SEO::get_URLRoot().'userfiles/'.CrmManageImage::getRoute($obj->parameterID).$var->archivo.'" class="img-responsive">';
                echo '</div>';
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin de Listado de Fotos -->
  <?php } ?>
</section>
<script>
  function getClienteN(n){
    $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=getCliN&nID='+n, function(data) {
      if(data.retval==1){
        $("#clienteID").val(data.cliID);
        $("#name").val(data.name);
        $("#lastname").val(data.lastname);
        $("#tipoDoc").val(data.tipoDoc);
        $("#numDoc").val(data.numDoc);
        $("#fecNac").val(data.fecNac);
        $("#departamento").val(data.departamento);
        $("#provincia").html("<option value='"+data.provincia+"'>"+data.nombreProvincia+"</option>");
        $("#distrito").html("<option value='"+data.distrito+"'>"+data.nombreDistrito+"</option>");
        if(data.sexo == 0){
          $("#rbtMasculino").prop('checked',true);
          $("#rbtFemenino").prop('checked',false);
        }
        else if(data.sexo == 1){
          $("#rbtFemenino").prop('checked',true);
          $("#rbtMasculino").prop('checked',false);
        }
        $("#address").val(data.address);
        $("#celular").val(data.celular);
        $('#divInsCli').attr('style','display:none');
        $('#divActCli').attr('style','display:block');        
        $('#tipoDoc').attr('disabled','true');
        $('#numDoc').attr('disabled','true');
        $("#myModalPersona").modal("hide");
      }else{
        alertify.error(data.message);
      }
    }).error(function(jqXHR, textStatus, errorThrown) {
      alertify.error("Error interno");
      console.log("error: " + textStatus);
      console.log("error thrown: " + errorThrown);
      console.log("incoming Text: " + jqXHR.responseText);
    });
  }

  function getClienteModal(n){
    $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=getCliN&nID='+n, function(data) {
      if(data.retval==1){
        $("#clienteID").val(data.cliID);
        $("#name").val(data.name);
        $("#lastname").val(data.lastname);
        $("#tipoDoc").val(data.tipoDoc);
        $("#numDoc").val(data.numDoc);
        $("#fecNac").val(data.fecNac);
        $("#departamento").val(data.departamento);
        $("#provincia").html("<option value='"+data.provincia+"'>"+data.nombreProvincia+"</option>");
        $("#distrito").html("<option value='"+data.distrito+"'>"+data.nombreDistrito+"</option>");
        if(data.sexo == 0){
          $("#rbtMasculino").prop('checked',true);
          $("#rbtFemenino").prop('checked',false);
        }
        else if(data.sexo == 1){
          $("#rbtFemenino").prop('checked',true);
          $("#rbtMasculino").prop('checked',false);
        }
        $("#address").val(data.address);
        $("#celular").val(data.celular);
        $('#divInsCli').attr('style','display:none');
        $('#divActCli').attr('style','display:block');        
        $('#tipoDoc').attr('disabled','true');
        $('#numDoc').attr('disabled','true');
        $("#myModalClientes").modal("show");
        $('#btnAddClienteNatural').hide();
      }else{
        alertify.error(data.message);
      }
    }).error(function(jqXHR, textStatus, errorThrown) {
      alertify.error("Error interno");
      console.log("error: " + textStatus);
      console.log("error thrown: " + errorThrown);
      console.log("incoming Text: " + jqXHR.responseText);
    });
  }

  function RemoveModal(n,s){
    $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=removeCliN&nID='+n+'&preID='+s, function(data) {
      if(data.retval==1){
        $(".fila_"+n).remove();
      }else{
        alertify.error(data.message);
      }
    }).error(function(jqXHR, textStatus, errorThrown) {
      alertify.error("Error interno");
      console.log("error: " + textStatus);
      console.log("error thrown: " + errorThrown);
      console.log("incoming Text: " + jqXHR.responseText);
    });
  }


  function mayuscula(campo){
    $(campo).keyup(function() {
      $(this).val($(this).val().toUpperCase());
    });
  }

  $(function(){
    var checkEmptyContext = function ( $target ) {    
      $target = ( $target instanceof jQuery ) ? $target : $( $target ); 
      return ( $target.length > 0 ) && ! $.trim( $target.html() );
    };

    $('#btnFindPers').tooltip();
    $('#newComp').tooltip();    
    $('#btnCambForm').tooltip();
    $('#btnNewCombustible').tooltip();
    $('#btnNewCategoria').tooltip();
    $('#btnNewModelo').tooltip();
    $('#btnNewMarca').tooltip();

    mayuscula("input#placa");    
    mayuscula("input#version");
    mayuscula("input#motor");
    mayuscula("input#serie");
    mayuscula("input#vin");
    mayuscula("input#cilindros");
    mayuscula("input#cilindrada");
    mayuscula("input#ejes");
    mayuscula("input#ruedas");
    mayuscula("input#asientos");
    mayuscula("input#pasajeros");
    mayuscula("input#largo");
    mayuscula("input#ancho");
    mayuscula("input#alto");
    mayuscula("input#pesoNeto");
    mayuscula("input#pesoBruto");
    mayuscula("input#cargaUtil");
    mayuscula("input#pesoNetoMod");
    mayuscula("input#cargaUtilMod");
    mayuscula("input#marcaNew");
    mayuscula("input#modeloNew");
    mayuscula("input#categoriaNew");
    mayuscula("input#combustibleNew");

    $("#pesoBruto").keyup(function() {
      var cargaUtil = $("#pesoBruto").val() - $("#pesoNeto").val();
      $("#cargaUtil").val(cargaUtil);
      $("#cargaUtilMod").val(cargaUtil);
    });

    $("#pesoNetoMod").keyup(function() {
      var cargaUtil = $("#pesoBruto").val() - $("#pesoNetoMod").val();
      $("#cargaUtilMod").val(cargaUtil);
    });

    $("#tipocertID").change(function(){
      if($(this).val() == 72 || $(this).val() == 84 || $(this).val() == 0){
        $("#divModifCombPeso").hide();
      }
      else if($(this).val() == 83){
        $("#divModifCombPeso").show();
      }
    });

    $('#btnAddMarca').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#marcaNew').val() == ''){ $('#marcaNew').focus(); alertify.error('Ingrese marca'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=addMarca&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message);
          $("#newMarca").modal("toggle");
          $('#marcaNew').val('');
          $('#marcaID').load('<?php echo $URL_ROOT;?>ajax/select-marcaPopup.php');
        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $('#btnAddModelo').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#marcaNewModID').val() == '0'){ $('#marcaNewModID').focus(); alertify.error('Seleccione una marca'); return false; }        
      if ($('#modeloNew').val() == ''){ $('#modeloNew').focus(); alertify.error('Ingrese modelo'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=addModelo&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message);
          $("#newModelo").modal("toggle");
          $('#modeloNew').val('');
          $('#marcaNewModID').val('0');                
          $('#marcaID').val('0');
        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $('#btnAddCategoria').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#categoriaNew').val() == ''){ $('#categoriaNew').focus(); alertify.error('Ingrese categoría'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=addCategoria&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message);
          $("#newCategoria").modal("toggle");
          $('#categoriaNew').val('');
          $('#categoriaID').load('<?php echo $URL_ROOT;?>ajax/select-categoriaPopup.php');
        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $('#btnAddCombustible').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#combustibleNew').val() == ''){ $('#combustibleNew').focus(); alertify.error('Ingrese combustible'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=addCombustible&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message);
          $("#newCombustible").modal("toggle");
          $('#combustibleNew').val('');
          $('#combustibleID').load('<?php echo $URL_ROOT;?>ajax/select-combustiblePopup.php');
        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $('#fechaEmi').datepicker({
      autoclose: true,
      todayHighlight: true
    });  

    $('#fecNac').datepicker({
      autoclose: true,
      todayHighlight: true
    });

    $('#tipoCliente').change(function(event){

      if($('#tipoCliente').val() == '1'){
        $('#divNatural').attr('style','display:block');
        $('#divJuridica').attr('style','display:none');
        $('#divSinPropiedad').attr('style','display:none');
      }
      if($('#tipoCliente').val() == '2'){
        $('#divNatural').attr('style','display:none');
        $('#divSinPropiedad').attr('style','display:block');
        $('#divJuridica').attr('style','display:none');
      }
      if($('#tipoCliente').val() == '3'){

        $('#divNatural').attr('style','display:none');
        $('#divSinPropiedad').attr('style','display:none');
        $('#divJuridica').attr('style','display:block');
      }

    });

    $("#marcaID").change(function(event){ 
      var id = $("#marcaID").find(':selected').val();
      $("#modeloID").load('<?php echo $URL_ROOT;?>ajax/select-modelo.php?id='+id);
    }); 

    $("#departamento").change(function(event){ 
      var id = $("#departamento").find(':selected').val();
      $("#provincia").load('<?php echo $URL_ROOT;?>ajax/select-provincia.php?id='+id); 
    });

    $("#provincia").change(function(event){ 
      var idDep = $("#departamento").find(':selected').val();
      var idProv = $("#provincia").find(':selected').val();
      $("#distrito").load('<?php echo $URL_ROOT;?>ajax/select-distrito.php?idDep='+idDep+'&idProv='+idProv); 
    });

    $("#tallerID").change(function(event){ 
      var id = $("#tallerID").find(':selected').val();
      $("#sedeID").load('<?php echo $URL_ROOT;?>ajax/select-sede.php?id='+id); 
    });


    $('#btnActPrecert').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#tipocertID').val() == '0'){ $('#tipocertID').focus(); alertify.error('Seleccione un tipo de certificado'); return false; }
      if ($('#marcaID').val() == '0'){ $('#marcaID').focus(); alertify.error('Seleccione una marca'); return false; }
      if ($('#modeloID').val() == '0'){ $('#modeloID').focus(); alertify.error('Seleccione un modelo'); return false; }
      if ($('#categoriaID').val() == '0'){ $('#categoriaID').focus(); alertify.error('Seleccione una categoría'); return false; }
      if ($('#combustibleID').val() == '0'){ $('#combustibleID').focus(); alertify.error('Seleccione un combustible'); return false; }
      if ($('#version').val() == ''){ $('#version').focus(); alertify.error('Ingrese versión'); return false; }
      if ($('#ano_fab').val() == ''){ $('#ano_fab').focus(); alertify.error('Ingrese año de fabricación'); return false; }
      if ($('#motor').val() == ''){ $('#motor').focus(); alertify.error('Ingrese N° de motor'); return false; }
      if ($('#serie').val() == ''){ $('#serie').focus(); alertify.error('Ingrese N° de serie'); return false; }
      if ($('#cilindros').val() == ''){ $('#cilindros').focus(); alertify.error('Ingrese N° de cilindros'); return false; }
      if ($('#cilindrada').val() == ''){ $('#cilindrada').focus(); alertify.error('Ingrese cilindrada'); return false; }
      if ($('#ejes').val() == ''){ $('#ejes').focus(); alertify.error('Ingrese N° de ejes'); return false; }
      if ($('#ruedas').val() == ''){ $('#ruedas').focus(); alertify.error('Ingrese N° de ruedas'); return false; }
      if ($('#asientos').val() == ''){ $('#asientos').focus(); alertify.error('Ingrese N° de asientos'); return false; }
      if ($('#pasajeros').val() == ''){ $('#pasajeros').focus(); alertify.error('Ingrese N° de pasajeros'); return false; }
      if ($('#largo').val() == ''){ $('#largo').focus(); alertify.error('Ingrese largo'); return false; }
      if ($('#ancho').val() == ''){ $('#ancho').focus(); alertify.error('Ingrese ancho'); return false; }
      if ($('#alto').val() == ''){ $('#alto').focus(); alertify.error('Ingrese alto'); return false; }
      if ($('#pesoNeto').val() == ''){ $('#pesoNeto').focus(); alertify.error('Ingrese peso neto'); return false; }
      if ($('#pesoBruto').val() == ''){ $('#pesoBruto').focus(); alertify.error('Ingrese peso bruto'); return false; }
      if ($('#cargaUtil').val() == ''){ $('#cargaUtil').focus(); alertify.error('Ingrese carga útil'); return false; }
      if ($('#tipocertID').val() == 83){
        if ($('#combustibleMod').val() == '0'){ $('#combustibleMod').focus(); alertify.error('Seleccione el combustible modificado'); return false; }
        if ($('#pesoNetoMod').val() == ''){ $('#pesoNetoMod').focus(); alertify.error('Ingrese peso neto modificado'); return false; }
        if ($('#cargaUtilMod').val() == ''){ $('#cargaUtilMod').focus(); alertify.error('Seleccione la carga útil modificada'); return false; }
      }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=update&'+fields, function(data) {

        if(data.retval==1){
          alertify.success(data.message);
        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });


    $('#btnFindPers').click(function(){
      $("#list-cliente tr").remove();
      $('#txtsearchN').val("");
    });

    $('#btnSearchCli').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#txtsearchN').val() == ''){ $('#txtsearchN').focus(); alertify.error('Ingrese filtro'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=searchCli&'+fields, function(data) {
        if(data.retval==1){
          $("#list-cliente tr").remove();
          $("#list-cliente").append(data.message);
        }else{
          $("#list-cliente tr").remove();
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno en búsqueda de clientes");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $('#btnSaveCliente').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#name').val() == ''){ $('#name').focus(); alertify.error('Ingrese nombres'); return false; }
      if ($('#lastname').val() == ''){ $('#lastname').focus(); alertify.error('Ingrese apellidos'); return false; }
      if ($('#tipoDoc').val() == '0'){ $('#tipoDoc').focus(); alertify.error('Seleccione un tipo de documento'); return false; }
      if ($('#numDoc').val() == ''){ $('#numDoc').focus(); alertify.error('Ingrese N° de documento'); return false; }
      if ($('#fecNac').val() == ''){ $('#fecNac').focus(); alertify.error('Ingrese fecha de nacimiento'); return false; }
      if ($('#celular').val() == ''){ $('#celular').focus(); alertify.error('Ingrese celular'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=saveCli&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message); 
          $('#divInsCli').attr('style','display:none');
          $('#divActCli').attr('style','display:block');
          $('#clienteID').attr('value',data.clienteID);
          $('#tipoDoc').attr('disabled','true');
          $('#numDoc').attr('disabled','true');

        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $('#btnSaveClienteJur').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#razon').val() == ''){ $('#razon').focus(); alertify.error('Ingrese razon social'); return false; }
      if ($('#ruc').val() == ''){ $('#ruc').focus(); alertify.error('Ingrese apellidos'); return false; }
      if ($('#representanteLegal').val() == '0'){ $('#representanteLegal').focus(); alertify.error('Ingrese un representante legal'); return false; }
      if ($('#telefono').val() == ''){ $('#telefono').focus(); alertify.error('Ingrese N° de telefono'); return false; }
      if ($('#direccion').val() == ''){ $('#direccion').focus(); alertify.error('Ingrese una direccion'); return false; }
      if ($('#email').val() == '0'){ $('#email').focus(); alertify.error('Ingrese un email'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=saveCliJur&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message); 
          $('#divInsCliJur').attr('style','display:none');
          $('#divActCliJur').attr('style','display:block');
          $('#clienteID').attr('value',data.clienteID);
          $('#ruc').attr('disabled','true');

        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $('#btnActClienteJur').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#razon').val() == ''){ $('#razon').focus(); alertify.error('Ingrese razon social'); return false; }
      if ($('#ruc').val() == ''){ $('#ruc').focus(); alertify.error('Ingrese apellidos'); return false; }
      if ($('#representanteLegal').val() == '0'){ $('#representanteLegal').focus(); alertify.error('Ingrese un representante legal'); return false; }
      if ($('#telefono').val() == ''){ $('#telefono').focus(); alertify.error('Ingrese N° de telefono'); return false; }
      if ($('#direccion').val() == ''){ $('#direccion').focus(); alertify.error('Ingrese una direccion'); return false; }
      if ($('#email').val() == '0'){ $('#email').focus(); alertify.error('Ingrese un email'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=actCliJur&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message);
        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $('#btnSaveSP').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#direccionSP').val() == ''){ $('#direccionSP').focus(); alertify.error('Ingrese direccion'); return false; }
      if ($('#emailSP').val() == ''){ $('#emailSP').focus(); alertify.error('Ingrese email'); return false; }
      if ($('#celularSP').val() == '0'){ $('#celularSP').focus(); alertify.error('Ingrese un celular'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=saveCliSP&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message); 
          $('#divInsSP').attr('style','display:none');
          $('#divActSP').attr('style','display:block');
          $('#clienteID').attr('value',data.clienteID);

        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $('#btnActSP').click(function(){
      if ($('#direccionSP').val() == ''){ $('#direccionSP').focus(); alertify.error('Ingrese direccion'); return false; }
      if ($('#emailSP').val() == ''){ $('#emailSP').focus(); alertify.error('Ingrese email'); return false; }
      if ($('#celularSP').val() == '0'){ $('#celularSP').focus(); alertify.error('Ingrese un celular'); return false; }
      var fields=$('#frmMain').serialize();
      console.log('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=actCliSP&'+fields);
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=actCliSP&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message);
        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });


    $('#btnAddClienteNatural').click(function(){
     if ($('#name').val() == ''){ $('#name').focus(); alertify.error('Ingrese nombres'); return false; }
     if ($('#lastname').val() == ''){ $('#lastname').focus(); alertify.error('Ingrese apellidos'); return false; }
     if ($('#tipoDoc').val() == '0'){ $('#tipoDoc').focus(); alertify.error('Seleccione un tipo de documento'); return false; }
     if ($('#numDoc').val() == ''){ $('#numDoc').focus(); alertify.error('Ingrese N° de documento'); return false; }
     if ($('#fecNac').val() == ''){ $('#fecNac').focus(); alertify.error('Ingrese fecha de nacimiento'); return false; }

     var fields=$('#frmMain').serialize();
     $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=addCliNatural&'+fields, function(data) {
      if(data.retval==1){
        alertify.success(data.message); 
        $("#myModalClientes").modal("hide");
        $('#list-cli').append('<tr class="fila_'+data.clienteID+'"><td><a href="javascript:getClienteModal('+data.clienteID+');"><i class="fa fa-pencil-square-o"></i></a>&nbsp;<a href="javascript:RemoveModal('+data.clienteID+','+$('#precertID').val()+')"><i class="fa fa-times"></i></a></td><td>'+$('#name').val()+'</td><td>'+$('#lastname').val()+'</td><td>'+$('#numDoc').val()+'</td><td>'+$('#celular').val()+'</td></tr>');
        $('#divInsCli').show();
        $('#divActCli').hide();
        $('#tipoDoc').removeAttr('disabled');
        $('#numDoc').removeAttr('disabled');
        $('#name').val('');$('#lastname').val('');$('#numDoc').val('');$('#celular').val('');$("#departamento").val($("#departamento option:first").val());$("#provincia").val($("#provincia option:first").val());$("#distrito").val($("#distrito option:first").val());$('#address').val('');
      }else{
        alertify.error(data.message);
      }
    }).error(function(jqXHR, textStatus, errorThrown) {
      alertify.error("Error interno");
      console.log("error: " + textStatus);
      console.log("error thrown: " + errorThrown);
      console.log("incoming Text: " + jqXHR.responseText);
    });
  });

    $('#btnActCliente').click(function(){
      var fields=$('#frmMain').serialize();
      if ($('#name').val() == ''){ $('#name').focus(); alertify.error('Ingrese nombres'); return false; }                                        
      if ($('#lastname').val() == ''){ $('#lastname').focus(); alertify.error('Ingrese apellidos'); return false; }
      if ($('#fecNac').val() == ''){ $('#fecNac').focus(); alertify.error('Ingrese fecha de nacimiento'); return false; }
      if ($('#celular').val() == ''){ $('#celular').focus(); alertify.error('Ingrese celular'); return false; }
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=actCli&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message);

        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

    $( "#btnAddComponente" ).click(function() {
      if ($('#tipoCompID').val() == '0'){ $('#tipoCompID').focus(); alertify.error('Seleccione un tipo de componente'); return false; }
      if ($('#marcaComp').val() == ''){ $('#marcaComp').focus(); alertify.error('Ingrese marca'); return false; }
      if ($('#modeloComp').val() == ''){ $('#modeloComp').focus(); alertify.error('Ingrese modelo'); return false; }
      if ($('#serieComp').val() == ''){ $('#serieComp').focus(); alertify.error('Ingrese serie'); return false; }
      if ($('#capacidadComp').val() == ''){ $('#capacidadComp').focus(); alertify.error('Ingrese capacidad'); return false; }
      if ($('#mesComp').val() == '00'){ $('#mesComp').focus(); alertify.error('Seleccione un mes'); return false; }
      if ($('#anoComp').val() == ''){ $('#anoComp').focus(); alertify.error('Ingrese año de fabricación'); return false; }

      tipoCompID = $("#tipoCompID").val(); 
      tipoComp = $("#tipoCompID option:selected").text();
      marcaComp = $("#marcaComp").val();
      modeloComp = $("#modeloComp").val();
      serieComp = $("#serieComp").val();
      capacidadComp = $("#capacidadComp").val();
      mesCompID = $("#mesComp").val();
      mesComp = $("#mesComp option:selected").text();
      anoComp = $("#anoComp").val();
      if(tipoCompID == 78){
        $('#pesoNetoMod').val(parseFloat($('#pesoNetoMod').val()) + parseFloat($('#cilindro').val()));
        $('#cargaUtilMod').val(parseFloat($('#cargaUtilMod').val()) - parseFloat($('#cilindro').val()));
      }
      $("#list-comp").append("<tr class='fila'><td><div class='remove btn btn-danger btn-sm'><i class='fa fa-close'></i></div></td><td style='display:none;'><input type='text' name='tipoCompIDT[]' id='tipoCompIDT' class='form-control input-sm' readonly='true' value='"+tipoCompID+"'></td><td><input type='text' name='tipoCompT[]' id='tipoCompT' class='form-control input-sm' readonly='true' value='"+tipoComp+"'></td><td><input type='text' name='marcaCompT[]' id='marcaCompT' class='form-control input-sm' readonly='true' value='"+marcaComp+"'></td><td><input type='text' name='modeloCompT[]' id='modeloCompT' class='form-control input-sm' readonly='true' value='"+modeloComp+"'></td><td><input type='text' name='serieCompT[]' id='serieCompT' class='form-control input-sm' readonly='true' value='"+serieComp+"'></td><td><input type='text' name='capacidadCompT[]' id='capacidadCompT' class='form-control input-sm' readonly='true' value='"+capacidadComp+"'></td><td style='display:none;'><input type='text' name='mesCompIDT[]' id='mesCompIDT' class='form-control input-sm' readonly='true' value='"+mesCompID+"'></td><td><input type='text' name='mesCompT[]' id='mesCompT' class='form-control input-sm' readonly='true' value='"+mesComp+"'></td><td><input type='text' name='anoCompT[]' id='anoCompT' class='form-control input-sm' readonly='true' value='"+anoComp+"'></td></tr>");
      if(tipoCompID == 78){
        $.getJSON('<?php echo $URL_ROOT;?>ajax/insert_pesoMod.php?precertID='+$('#precertID').val()+'&pesoNetoMod='+$('#pesoNetoMod').val()+'&cargaUtilMod'+$('#cargaUtilMod').val(), function(data) {
          if(data.retval==1){
            alertify.success('Peso Neto y Carga Util actualizados')
          }
        }).error(function(jqXHR, textStatus, errorThrown) {
          alertify.error("Error interno");
          console.log("error: " + textStatus);
          console.log("error thrown: " + errorThrown);
          console.log("incoming Text: " + jqXHR.responseText);
        });
      }
      $(".bs-chart2").modal("toggle");
    });

    $('#myModalComponentes').on('hidden.bs.modal', function () {
      $(this).find("input,textarea").val('').end();
      $(this).find("#mesComp").val('00').end();
      $(this).find("#tipoCompID").val('0').end();
    });

    $(document).on('click', '.remove', function() {
      $(this).closest(".fila").remove();
    });

    $('#tallerID').change(function(){
      $.getJSON('<?php echo $URL_ROOT;?>ajax/valid_taller.php?taller='+$('#tallerID').val(), function(data) {
        if(data.retval==1){
          $.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_placa.php?placa='+$('#placa').val(), function(data2) {
            if(data2.retval==1){
              $('.hide-valid').show();
            }else{
              $('.hide-valid').hide();
            }
          }).error(function(jqXHR, textStatus, errorThrown) {
            alertify.error("Error interno");
            console.log("error: " + textStatus);
            console.log("error thrown: " + errorThrown);
            console.log("incoming Text: " + jqXHR.responseText);
          });
        }else{
          $('.hide-valid').hide();
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });


    $('#btnSaveCert').click(function(){

      var valor;

      if ($('#precertID').val() == ''){
        $('#tipocertID').focus(); alertify.error('Registre primero la Cabecera'); return false;
      }

      <?php 
      $list= CmsParameterLang::getWebList(10, 1); 
      $count=0;
      foreach ($list as $obj){
        $count++;
        ?>
        if($("#documentoID<?php echo $count; ?>").is(':checked')){
          $("#documentoID<?php echo $count; ?>").attr('name','documentoID[]');
          console.log('<?php echo $count; ?>');
        }
        else                
          $("#documentoID<?php echo $count; ?>").attr('name','');
        <?php 
      } 
      ?>

      <?php 
      $list= CmsParameterLang::getWebList(15, 1); 
      $count=0;
      foreach ($list as $obj){
        $count++;
        ?>
        if($("#fotoID<?php echo $count; ?>").is(':checked')){
          $("#fotoID<?php echo $count; ?>").attr('name','fotoID[]');
          console.log('<?php echo $count; ?>');
        }
        else                
          $("#fotoID<?php echo $count; ?>").attr('name','');
        <?php 
      } 
      ?>

      $('#list-comp').each(function (i, ele){
        if(checkEmptyContext(ele)) {
          valor = false;
        }
        else{
          valor = true;
        }
      });

      if(valor == false){
        $('#li_B').attr('class','active');
        $('#li_E').attr('class','');
        $('#sectionB').attr('class','tab-pane fade active in');
        $('#sectionE').attr('class','tab-pane fade');
        alertify.error('Registre los componentes instalados');
        return false;
      }

        // $.getJSON('<?php echo $URL_ROOT;?>ajax/valid_taller.php?taller='+$('#tallerID').val(), function(data) {
        //   if(data.retval==1){
        //     if ($('#formatoID').val() == ''){ $('#formatoID').focus(); alertify.error('Ingrese N° formato'); return false; }
        //     if ($('#calcomaniaID').val() == ''){ $('#calcomaniaID').focus(); alertify.error('Ingrese N° calcomanía'); return false; }
        //   }
        // }).error(function(jqXHR, textStatus, errorThrown) {
        //   alertify.error("Error interno");
        //   console.log("error: " + textStatus);
        //   console.log("error thrown: " + errorThrown);
        //   console.log("incoming Text: " + jqXHR.responseText);
        // });
        if ($('#fechaEmi').val() == ''){ $('#fechaEmi').focus(); alertify.error('Ingrese fecha de emisión'); return false; }
        if ($('#tallerID').val() == '0'){ $('#tallerID').focus(); alertify.error('Seleccione un taller'); return false; }
        if ($('#sedeID').val() == '0'){ $('#sedeID').focus(); alertify.error('Seleccione una sede del taller'); return false; }
        var fields=$('#frmMain').serialize();
        $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=insertCert&'+fields, function(data) {
          if(data.retval==1){
            alertify.success(data.message);
            $('#divInsCert').attr('style','display:none');
            $('#divActCert').attr('style','display:block');
            $('#divDownload').attr('style','display:block');
            $('#certificadoID').attr('value',data.certificadoID);
            $('#certID').val(data.certificadoID);
            $('#formatoID').attr('readonly','true');
            $('#calcomaniaID').attr('readonly','true');                
            $('#btnCambForm').show();
            $('.proob').show();
          }else{
            alertify.error(data.message);
          }
        }).error(function(jqXHR, textStatus, errorThrown) {
          alertify.error("Error interno");
          console.log("error: " + textStatus);
          console.log("error thrown: " + errorThrown);
          console.log("incoming Text: " + jqXHR.responseText);
        });
      });

    $('#btnActCert').click(function(){

      var valor;

      if ($('#precertID').val() == ''){
        $('#tipocertID').focus(); alertify.error('Registre primero la Cabecera'); return false;
      }

      <?php 
      $list= CmsParameterLang::getWebList(10, 1); 
      $count=0;
      foreach ($list as $obj){
        $count++;
        ?>
        if($("#documentoID<?php echo $count; ?>").is(':checked')){
          $("#documentoID<?php echo $count; ?>").attr('name','documentoID[]');
          console.log('<?php echo $count; ?>');
        }
        else                
          $("#documentoID<?php echo $count; ?>").attr('name','');
        <?php 
      } 
      ?>

      <?php 
      $list= CmsParameterLang::getWebList(15, 1); 
      $count=0;
      foreach ($list as $obj){
        $count++;
        ?>
        if($("#fotoID<?php echo $count; ?>").is(':checked')){
          $("#fotoID<?php echo $count; ?>").attr('name','fotoID[]');
          console.log('<?php echo $count; ?>');
        }
        else                
          $("#fotoID<?php echo $count; ?>").attr('name','');
        <?php 
      } 
      ?>

      $('#list-comp').each(function (i, ele){
        if(checkEmptyContext(ele)) {
          valor = false;
        }
        else{
          valor = true;
        }
      });

      if(valor == false){
        $('#li_B').attr('class','active');
        $('#li_E').attr('class','');
        $('#sectionB').attr('class','tab-pane fade active in');
        $('#sectionE').attr('class','tab-pane fade');
        alertify.error('Registre los componentes instalados');
        return false;
      }

      if ($('#fechaEmi').val() == ''){ $('#fechaEmi').focus(); alertify.error('Ingrese fecha de emisión'); return false; }
      if ($('#tallerID').val() == '0'){ $('#tallerID').focus(); alertify.error('Seleccione un taller'); return false; }
      if ($('#sedeID').val() == '0'){ $('#sedeID').focus(); alertify.error('Seleccione una sede del taller'); return false; }
      var fields=$('#frmMain').serialize();
      $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=actCert&'+fields, function(data) {
        if(data.retval==1){
          alertify.success(data.message);
        }else{
          alertify.error(data.message);
        }
      }).error(function(jqXHR, textStatus, errorThrown) {
        alertify.error("Error interno");
        console.log("error: " + textStatus);
        console.log("error thrown: " + errorThrown);
        console.log("incoming Text: " + jqXHR.responseText);
      });
    });

      // $('#btnChangeFormato').click(function(){
      //   var fields=$('#frmMain').serialize();
      //   if ($('#formatoNew').val() == ''){ $('#formatoNew').focus(); alertify.error('Ingrese Nuevo N° formato'); return false; }
      //   if ($('#motivo').val() == '0'){ $('#motivo').focus(); alertify.error('Seleccione un motivo'); return false; }
      //   $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=changeFormato&'+fields, function(data) {
      //     if(data.retval==1){
      //       alertify.success(data.message);
      //       $("#changeFormato").modal("toggle");
      //       $('#formatoNew').val('');
      //       $('#motivo').val('0');
      //       $('#formatoID').val(data.newFormato);
      //     }else{
      //       alertify.error(data.message);
      //     }
      //   }).error(function(jqXHR, textStatus, errorThrown) {
      //     alertify.error("Error interno");
      //     console.log("error: " + textStatus);
      //     console.log("error thrown: " + errorThrown);
      //     console.log("incoming Text: " + jqXHR.responseText);
      //   });
      // });

      $('#btnDownload').click(function(){
        var fields=$('#frmMain').serialize();
        if($('#tipocertID').val() == 72){
          window.open('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=downloadAnual&'+fields,'_blank');
        }
        else if($('#tipocertID').val() == 83){
          window.open('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=downloadInicial&'+fields,'_blank');
        }
        else if($('#tipocertID').val() == 84){
          window.open('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=downloadOriginal&'+fields,'_blank');
        }
      });

      $('#btnSavePrecert').click(function(){
        if ($('#tipocertID').val() == '0'){ $('#tipocertID').focus(); alertify.error('Seleccione un tipo de certificado'); return false; }
        if ($('#placa').val() == ''){ $('#placa').focus(); alertify.error('Ingrese placa'); return false; }
        if ($('#marcaID').val() == '0'){ $('#marcaID').focus(); alertify.error('Seleccione una marca'); return false; }
        if ($('#modeloID').val() == '0'){ $('#modeloID').focus(); alertify.error('Seleccione un modelo'); return false; }
        if ($('#categoriaID').val() == '0'){ $('#categoriaID').focus(); alertify.error('Seleccione una categoría'); return false; }
        if ($('#combustibleID').val() == '0'){ $('#combustibleID').focus(); alertify.error('Seleccione un combustible'); return false; }
        if ($('#version').val() == ''){ $('#version').focus(); alertify.error('Ingrese versión'); return false; }
        if ($('#ano_fab').val() == ''){ $('#ano_fab').focus(); alertify.error('Ingrese año de fabricación'); return false; }
        if ($('#motor').val() == ''){ $('#motor').focus(); alertify.error('Ingrese N° de motor'); return false; }
        if ($('#serie').val() == ''){ $('#serie').focus(); alertify.error('Ingrese N° de serie'); return false; }
        if ($('#cilindros').val() == ''){ $('#cilindros').focus(); alertify.error('Ingrese N° de cilindros'); return false; }
        if ($('#cilindrada').val() == ''){ $('#cilindrada').focus(); alertify.error('Ingrese cilindrada'); return false; }
        if ($('#ejes').val() == ''){ $('#ejes').focus(); alertify.error('Ingrese N° de ejes'); return false; }
        if ($('#ruedas').val() == ''){ $('#ruedas').focus(); alertify.error('Ingrese N° de ruedas'); return false; }
        if ($('#asientos').val() == ''){ $('#asientos').focus(); alertify.error('Ingrese N° de asientos'); return false; }
        if ($('#pasajeros').val() == ''){ $('#pasajeros').focus(); alertify.error('Ingrese N° de pasajeros'); return false; }
        if ($('#largo').val() == ''){ $('#largo').focus(); alertify.error('Ingrese largo'); return false; }
        if ($('#ancho').val() == ''){ $('#ancho').focus(); alertify.error('Ingrese ancho'); return false; }
        if ($('#alto').val() == ''){ $('#alto').focus(); alertify.error('Ingrese alto'); return false; }
        if ($('#pesoNeto').val() == ''){ $('#pesoNeto').focus(); alertify.error('Ingrese peso neto'); return false; }
        if ($('#pesoBruto').val() == ''){ $('#pesoBruto').focus(); alertify.error('Ingrese peso bruto'); return false; }
        if ($('#cargaUtil').val() == ''){ $('#cargaUtil').focus(); alertify.error('Ingrese carga útil'); return false; }
        if ($('#tipocertID').val() == '83'){
          if ($('#combustibleMod').val() == '0'){ $('#combustibleMod').focus(); alertify.error('Seleccione el combustible modificado'); return false; }
          if ($('#pesoNetoMod').val() == ''){ $('#pesoNetoMod').focus(); alertify.error('Ingrese peso neto modificado'); return false; }
          if ($('#cargaUtilMod').val() == ''){ $('#cargaUtilMod').focus(); alertify.error('Seleccione la carga útil modificada'); return false; }
        }
        var fields=$('#frmMain').serialize();
        $.getJSON('<?php echo $URL_ROOT;?>ajax/form_certificado.php?action=insert&'+fields, function(data) {
          if(data.retval==1){
            alertify.success(data.message); 
            $('#divInsPreCert').attr('style','display:none');
            $('#divActPreCert').attr('style','display:block');
            $('#divTabs').attr('style','display:block');
            $('#precertID').attr('value',data.precertID);
            $('#placa').attr('readonly','true');
            $('#placaRest').val($('#placa').val());
          }else{
            alertify.error(data.message);
          }
        }).error(function(jqXHR, textStatus, errorThrown) {
          alertify.error("Error interno");
          console.log("error: " + textStatus);
          console.log("error thrown: " + errorThrown);
          console.log("incoming Text: " + jqXHR.responseText);
        });
      });

$('#actTaller').click(function(){
  $('#tallerID').empty();
  $("#tallerID").load('<?php echo $URL_ROOT;?>ajax/list_taller.php'); 
  alertify.success('Talleres Actualizados');
});

});
</script>