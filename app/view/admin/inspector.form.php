<?php
  $userAdmin  =AdmLogin::getUserSession();
?>
<script type="text/javascript">
function on_submit(xform){
xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
xform.submit();
}
</script>
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->nombrePlanta:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">
    <div class="form-group">
      <label class="col-sm-2 control-label">Codigo de Inspector</label>
      
      <div class="col-sm-10">
        <input name="codigoInspector" autocomplete="off" type="text" id="codigoInspector" class="form-control" value="<?php echo $oItem->codigoInspector; ?>" maxlength="10">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Apellido Paterno</label>
      
      <div class="col-sm-10">
        <input name="apellidoPaterno" autocomplete="off" type="text" id="apellidoPaterno" class="form-control" value="<?php echo $oItem->apellidoPaterno; ?>" >
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Apellido Materno</label>
      <div class="col-sm-10">
        <input name="apellidoMaterno" type="text" class="form-control" id="apellidoMaterno" value="<?php echo $oItem->apellidoMaterno; ?>" >
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-sm-2 control-label ">Nombre de Inspector</label>
      <div class="col-sm-10">
        <input name="nombreInspector" type="text" class="form-control" id="nombreInspector" value="<?php echo $oItem->nombreInspector; ?>" maxlength="50">
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-sm-2 control-label ">Nro. Documento</label>  
      <div class="col-sm-10">
        <input name="nroDocumento" type="text" class="form-control" id="nroDocumento" value="<?php echo $oItem->nroDocumento; ?>" maxlength="50">
      </div>
    </div>
     <div class="form-group">
      <label class="col-sm-2 control-label ">Nombre Completo de Inspector</label>  
      <div class="col-sm-10">
        <input name="nombreCompletoInspector" type="text" class="form-control" id="nombreCompletoInspector" value="<?php echo $oItem->nombreCompletoInspector; ?>" maxlength="50">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Estado</label>
      <div class="col-sm-10">
        <label for="radio1">
          <input type="radio" class="flat-blue" id="radio1" name="state" value="1" <?php if($oItem->state==1) echo "checked";?>>
          
          Activo
        </label>
        <label for="radio2">
          <input type="radio" class="flat-blue" id="radio2" name="state" value="2" <?php if($oItem->state==2) echo "checked";?>>
          
          Bloqueado
        </label>
        
        <label for="radio3">
          <input type="radio" class="flat-blue" id="radio3" name="state" value="0" <?php if($oItem->state==0) echo "checked";?>>
          
          Inactivo
        </label>
        
      </div>
    </div>
  </div>
  <div class="box-footer">
    <input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
    <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
  </div>
</div>