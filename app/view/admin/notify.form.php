<?php
?>
<script type="text/javascript">
function on_submit(xform){
xform.kID.value=xform.userID.value;

xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
xform.submit();
}
</script>
<input type="hidden" name="formID" value="<?php echo $oItem->formID;?>" />
<input type="hidden" name="contactID" value="<?php echo $oItem->contactID;?>" />
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->email:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">
    <div class="form-group">
      <label class="col-sm-2 control-label ">Usuario</label>
      <div class="col-sm-10">
        <?php if($MODULE->FormView=='add'){ ?>
        <select name="userID" id="userID" class="form-control">
          <?php
          $list=AdmUser::getList_Notify($oItem->formID, $oItem->contactID);
          foreach ($list as $obj) {
          if(!isset($oItem->userID)) $oItem->userID=$obj->userID;
          echo "<option value=\"".$obj->userID."\"";
            if($obj->userID==$oItem->userID) echo " selected";
          echo ">".$obj->firstName." ".$obj->lastName." (".$obj->email.")</option>";
          }
          ?>
        </select>
        <?php }
        else {?>
        <input type="hidden" name="userID" id="userID" value="<?php echo $oItem->userID;?>" />
        <?php echo $oItem->firstName. " ". $oItem->lastName." (".$obj->email.")"; ?>
        <?php } ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Correos adicionales</label>
      <div class="col-sm-10">
        <textarea name="recipients" class="form-control" id="recipients" cols="45" rows="4"><?php echo $oItem->recipients; ?></textarea>
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-sm-2 control-label ">Estado</label>
      <div class="col-sm-10">
        <input type="checkbox" class="flat-blue" name="active" value="1" <?php if($oItem->active==1) print "checked";?>> Activo
      </div>
    </div>
  </div>
  <div class="box-footer">
    <input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
    <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
  </div>
</div>