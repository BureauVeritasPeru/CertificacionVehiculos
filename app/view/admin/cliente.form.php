<?php
  $userAdmin  =AdmLogin::getUserSession();
?>
<script type="text/javascript">
function on_submit(xform){

  if($("#name").val() ==""){
    alertify.error("Por favor, ingrese el campo [Nombres]");
    $("#name").focus();
    return false;
  }

  if($("#lastname").val() ==""){
    alertify.error("Por favor, ingrese el campo [Apellidos]");
    $("#lastname").focus();
    return false;
  }

  if($("#tipoDoc").val() =="0"){
    alertify.error("Por favor, seleccione el campo [Tipo de Documento]");
    $("#tipoDoc").focus();
    return false;
  }

  if($("#numDoc").val() ==""){
    alertify.error("Por favor, ingrese el campo [Número de Documento]");
    $("#numDoc").focus();
    return false;
  }

  if($("#fecNac").val() ==""){
    alertify.error("Por favor, ingrese el campo [Fecha de Nacimiento]");
    $("#fecNac").focus();
    return false;
  }

  if($("#address").val() ==""){
    alertify.error("Por favor, ingrese el campo [Dirección]");
    $("#address").focus();
    return false;
  }

  if($("#phone").val() ==""){
    alertify.error("Por favor, ingrese el campo [Teléfono]");
    $("#phone").focus();
    return false;
  }

  if($("#celular").val() ==""){
    alertify.error("Por favor, ingrese el campo [Celular]");
    $("#celular").focus();
    return false;
  }  

xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
xform.submit();
}

$(function () {
  $('#fecNac').datetimepicker({
      locale: 'es',
      format: 'YYYY/MM/DD'
  });
});
</script>

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->name.' '.$oItem->lastname:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">
    <?php 
    if($MODULE->FormView=="edit"){
    ?>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Cliente ID</label>      
      <div class="col-sm-10">
        <input name="clienteID" autocomplete="off" type="text" id="clienteID" class="form-control" value="<?php echo $oItem->clienteID; ?>" disabled="true">
      </div>
    </div>
    <?php } ?>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Nombres</label>
      <div class="col-sm-10">
        <input name="name" type="text" class="form-control" id="name" value="<?php echo $oItem->name; ?>" maxlength="70">
      </div>
    </div>    
    <div class="form-group">
      <label class="col-sm-2 control-label ">Apellidos</label>
      <div class="col-sm-10">
        <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $oItem->lastname; ?>" maxlength="70">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Tipo de Documento</label>
      <div class="col-sm-10">
        <select name="tipoDoc" id="tipoDoc" class="form-control" <?php  if($MODULE->FormView=="edit") echo 'disabled="true"';?>>
          <option value="0">[SELECCIONE]</option>
          <?php
          $lTipoDoc=CmsParameterLang::getList(13, 1);
          foreach ($lTipoDoc as $obj) {          
          ?>
          <option value="<?php echo $obj->parameterID; ?>" <?php if($obj->parameterID==$oItem->tipoDoc) echo 'selected="true"'; ?>><?php echo $obj->parameterName; ?></option>
          <?php 
          } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Número de Documento</label>  
      <div class="col-sm-10">
        <input name="numDoc" type="text" class="form-control" id="numDoc" value="<?php echo $oItem->numDoc; ?>" maxlength="20" <?php  if($MODULE->FormView=="edit") echo 'disabled="true"';?>>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Fecha de Nacimiento</label>  
      <div class="col-sm-10">
        <input name="fecNac" type="text" class="form-control" id="fecNac" value="<?php echo $oItem->fecNac; ?>" placeholder="yyyy-mm-dd" maxlength="10"/>
       </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Sexo</label>
      <div class="col-sm-10">
        <label for="sexo1">
          <input type="radio" class="flat-blue" id="sexo1" name="sexo" value="1" <?php if($oItem->sexo==1) echo "checked";?>>          
          Femenino
        </label>        
        <label for="sexo2">
          <input type="radio" class="flat-blue" id="sexo2" name="sexo" value="0" <?php if($oItem->sexo==0) echo "checked";?>>          
          Masculino
        </label>        
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Departamento</label>
      <div class="col-sm-10">
        <select name="departamento" id="departamento" class="form-control">
          <option value="0">[SELECCIONE]</option>
          <?php
          $lDep=CrmUbigeo::getDepartamento_List();
          foreach ($lDep as $obj) {
          ?>
          <option value="<?php echo $obj->cod_dpto; ?>" <?php if($obj->cod_dpto==$oItem->departamento) echo 'selected="true"'; ?>><?php echo $obj->nombre; ?></option>
          <?php 
          } ?>
        </select>
      </div>
    </div>
    <script type="text/javascript"> 
      $(function(){ 
        $("#departamento").change(function(event){ 
          var id = $("#departamento").find(':selected').val();
          $("#provincia").load('<?php echo $URL_ROOT;?>ajax/select-provincia.php?id='+id); 
        }); 
      }); 
    </script> 
    <div class="form-group">
      <label class="col-sm-2 control-label ">Provincia</label>
      <div class="col-sm-10">
        <select name="provincia" id="provincia" class="form-control">
          <option value="0">[SELECCIONE]</option>
        </select>
      </div>
    </div>
    <script type="text/javascript"> 
      $(function(){ 
        $("#provincia").change(function(event){ 
          var idDep = $("#departamento").find(':selected').val();          
          var idProv = $("#provincia").find(':selected').val();
          $("#distrito").load('<?php echo $URL_ROOT;?>ajax/select-distrito.php?idDep='+idDep+'&idProv='+idProv); 
        }); 
      }); 
    </script> 
    <div class="form-group">
      <label class="col-sm-2 control-label ">Distrito</label>
      <div class="col-sm-10">
        <select name="distrito" id="distrito" class="form-control">
          <option value="0">[SELECCIONE]</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Dirección</label>  
      <div class="col-sm-10">
        <input name="address" type="text" class="form-control" id="address" value="<?php echo $oItem->address; ?>" maxlength="100">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Teléfono</label>  
      <div class="col-sm-10">
        <input name="phone" type="text" class="form-control" id="phone" value="<?php echo $oItem->phone; ?>" maxlength="50">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Celular</label>  
      <div class="col-sm-10">
        <input name="celular" type="text" class="form-control" id="celular" value="<?php echo $oItem->celular; ?>" maxlength="50">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Estado</label>
      <div class="col-sm-10">
        <?php 
        if($MODULE->FormView!="edit"){
        ?>
        <input type="checkbox" class="flat-blue form-control" name="state" value="1" checked> Activo
        <?php 
        }else{
        ?>
        <input type="checkbox" class="flat-blue form-control" name="state" value="1" <?php if($oItem->state==1) print "checked";?>> Activo
        <?php 
        } ?>        
      </div>
    </div>
  </div>
  <div class="box-footer">
    <input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
    <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
  </div>
</div>