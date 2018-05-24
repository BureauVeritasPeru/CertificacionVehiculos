<?php
$userAdmin  =AdmLogin::getUserSession();
?>
<script type="text/javascript">
function on_submit(xform){
if(xform.userName.value ===""){
alert("Debe ingresar un nombre de  usuario");
xform.userName.focus(); return false;
}
if(xform.password.value ===""){
alert("Debe ingresar una contrase\xF1a");
xform.password.focus(); return false;
}
if(xform.firstName.value ===""){
alert("Debe ingresar un nombre");
xform.firstName.focus(); return false;
}
if(xform.email.value ===""){
alert("Debe ingresar un email");
xform.email.focus(); return false;
}
if(!validateEmail(xform.email.value)){
alert("Debe ingresar un email v\xE1lido");
xform.email.focus(); return false;
}
xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
xform.submit();
}
</script>
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa fa-edit"></i> <?php echo ($MODULE->FormView=="edit")?$obj->profileName:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>

  </div>
  <div class="box-body">
    <div class="form-group">
      <label class="col-sm-2">Perfil</label>
      
      <div class="col-sm-10">
        <?php
        if($MODULE->FormView=="edit"){
        $oProfile=AdmProfile::getItem($oItem->profileID);
        echo '<strong>'.$obj->profileName.'</strong>';
        echo '<input type="hidden" name="profileID" value="'.$oItem->profileID.'" />';
        }
        else{
        
        $list = AdmProfile::getList();
        echo '<select name="profileID" class="form-control">';
          foreach ($list as $obj) {
          echo "<option value=\"".$obj->profileID."\"";
            if($obj->profileID==$oItem->profileID) echo " selected";
          echo ">".$obj->profileName."</option>";
          }
        echo '</select>';
        }
        ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 ">Usuario</label>
      
      <div class="col-sm-10">
        <?php
        if($MODULE->FormView=="edit"){
        echo '<strong>'.$oItem->userName.'</strong>';
        echo '<input type="hidden" name="userName" value="'.$oItem->userName.'" />';
        }
        else{
        echo '<input name="userName" class="form-control" type="text" id="userName" value="'.$oItem->userName.'" size="20" maxlength="15">';
        }
        ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Contrase&ntilde;a</label>
      
      <div class="col-sm-10">
        <input name="password" class="form-control" type="password" id="password" value="<?php echo $oItem->password; ?>" size="20" maxlength="15">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Nombre</label>
      <div class="col-sm-10">
        <input name="firstName" class="form-control" type="text" id="firstName" value="<?php echo $oItem->firstName; ?>" size="30" maxlength="30">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Apellido</label>
      <div class="col-sm-10">
        <input name="lastName" class="form-control" type="text" id="lastName" value="<?php echo $oItem->lastName; ?>" size="30" maxlength="30">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Email</label>
      <div class="col-sm-10">
        <input name="email" class="form-control" type="text" id="email" value="<?php echo $oItem->email; ?>" size="30" maxlength="40">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2  ">Estado</label>
      <div class="col-sm-10">
        <label for="radio1">
          <input type="radio" class="flat-blue form-control" id="radio1" name="state" value="1" <?php if($oItem->state==1) echo "checked";?>>
          
          Activo
        </label>
        <label for="radio2">
          <input type="radio" class="flat-blue form-control" id="radio2" name="state" value="2" <?php if($oItem->state==2) echo "checked";?>>
          
          Bloqueado
        </label>
        
        <label for="radio3">
          <input type="radio" class="flat-blue form-control" id="radio3" name="state" value="0" <?php if($oItem->state==0) echo "checked";?>>
          
          Inactivo
        </label>
        
      </div>
    </div>
  </div>
  <div class="box-footer">
    <button class="btn btn-primary" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);"><span class="fa fa-check"></span> guardar</button>

    
    <button class="btn btn-primary" name="btnCancel" onClick="javascript:Back();"><span class="fa fa-arrow-left"></span> cancelar</button>
  </div>
</div>