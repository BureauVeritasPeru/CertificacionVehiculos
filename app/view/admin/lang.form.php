<script type="text/javascript">
function on_submit(xform){
	if(xform.langName.value ==""){
		alert("Por favor, ingrese el campo [Nombre]");
		xform.langName.focus();
		return false;
	}

	xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
	xform.submit();
}
</script>
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->langName:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">


    <div class="form-group">
      <label class="col-sm-2 control-label ">C&oacute;digo</label>
      
      <div class="col-sm-10">
        <input name="langCode" type="text" class="form-control" id="langCode" value="<?php echo $oItem->langCode; ?>" maxlength="50" />
        (ES, EN, ES-PE, etc.)
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Nombre</label>
      
      <div class="col-sm-10">
        <input name="langName" type="text" class="form-control" id="langName" value="<?php echo $oItem->langName; ?>" maxlength="50" />
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Alias</label>
      
      <div class="col-sm-10">
        <input name="alias" type="text" class="form-control" id="alias" value="<?php echo $oItem->alias; ?>" size="45" maxlength="50" placeholder="descripción en el mismo idioma" />
      </div>
    </div>


    <div class="form-group">
      <label class="col-sm-2 control-label ">Estado</label>
      <div class="col-sm-10">
        <label for="radio1">
          <input type="checkbox" class="flat-blue" id="radio1" name="active" value="1" <?php if($oItem->active==1) echo "checked";?>>
          
          Activo
        </label> 
        
      </div>
    </div>
      



</div>
  <div class="box-footer">
    <input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
    <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
  </div>
</div>