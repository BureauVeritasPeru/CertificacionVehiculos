<?php
$userAdmin  =AdmLogin::getUserSession();
?>
<script type="text/javascript">
  function on_submit(xform){
    if(xform.password.value ==""){
      alert("Please, enter [Password]");
      xform.password.focus(); return false;}
      xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
      xform.submit();
    }
  </script>
  <div class="box box-default">
    <div class="box-header">
      <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->userName:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
    </div>
    <div class="box-body">
      <div class="form-group">
        <label class="col-sm-2 control-label ">Usuario</label>

        <div class="col-sm-10">
          <input name="userName" autocomplete="off" type="text" id="userName" <?php echo ($MODULE->FormView=="edit")? 'readonly="true" class="readonly form-control"': 'class="form-control"';?> value="<?php echo $oItem->userName; ?>" maxlength="15">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label ">Contrase&ntilde;a</label>

        <div class="col-sm-10">
          <input name="password" autocomplete="off" type="password" id="password" class="form-control" value="<?php echo $oItem->password; ?>" maxlength="15">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label ">Nombre</label>

        <div class="col-sm-10">
          <input name="firstName" type="text" class="form-control" id="firstName" value="<?php echo $oItem->firstName; ?>" maxlength="30">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label ">Apellido</label>

        <div class="col-sm-10">
          <input name="lastName" type="text" class="form-control" id="lastName" value="<?php echo $oItem->lastName; ?>" maxlength="30">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label ">Email</label>

        <div class="col-sm-10">
          <input name="email" type="text" class="form-control" id="email" value="<?php echo $oItem->email; ?>" maxlength="40">
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

      <div class="form-group">
        <label class="col-sm-2 control-label ">Clasificacion</label>
        <div class="col-sm-10">
          <label class="checkbox-inline"><input type="checkbox"  class="flat-blue" id="glp" name="glp" <?php if($oItem->glp==1) echo "checked";?> >GLP</label>
          <label class="checkbox-inline"><input type="checkbox" class="flat-blue" id="gnv" name="gnv" <?php if($oItem->gnv==1) echo "checked";?>>GNV</label>
          <label class="checkbox-inline"><input type="checkbox"  class="flat-blue" id="consulta_glp" name="consulta_glp" <?php if($oItem->consulta_glp==1) echo "checked";?>>Consulta GLP</label>
          <label class="checkbox-inline"><input type="checkbox"  class="flat-blue" id="consulta_gnv" name="consulta_gnv" <?php if($oItem->consulta_gnv==1) echo "checked";?>>Consulta GNV</label>
          <label class="checkbox-inline"><input type="checkbox"  class="flat-blue" id="reportes" name="reportes" <?php if($oItem->reportes==1) echo "checked";?>>Reportes</label>
        </div>
      </div>
    </div>
    <div class="box-footer">
      <input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
      <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
    </div>
  </div>