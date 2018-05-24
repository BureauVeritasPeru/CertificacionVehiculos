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
    <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->placa:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">
    <div class="form-group">
      <label class="col-sm-2 control-label ">Placa</label>

      <div class="col-sm-10">
        <input name="placa" autocomplete="off" type="text" id="placa" <?php echo ($MODULE->FormView=="edit")? 'readonly="true" class="readonly form-control"': 'class="form-control"';?> value="<?php echo $oItem->placa; ?>" maxlength="15">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label ">Observaciones</label>
      <div class="col-sm-10">
        <textarea name="observaciones" class="form-control" id="observaciones"><?php echo $oItem->observaciones; ?></textarea>
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