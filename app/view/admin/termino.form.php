<?php
$ctlEdit="<input type='text' name='terminoName' id='terminoName' class='form-control' value='".$oItem->terminoName."' />";
switch($oItem->inputType){
case 1:
    $ctlEdit="<input type='text' name='terminoName' id='terminoName' class='form-control' value='".$oItem->terminoName."' />";
    break;
case 2:
    $ctlEdit="<textarea name='terminoName' id='terminoName' class='form-control' rows='4'>".$oItem->terminoName."</textarea>";
    break;
case 3:
    //$oMediaGroup=CmsMediaGroup::getItem_Alias('termino_img_texto');
    //$path=($oMediaGroup!=NULL)? $oMediaGroup->basePath: "userfiles/cms/termino/imagen/";

    $ctlEdit="<input type='text' name='terminoName' class='form-control' id='terminoName' value='".(($oItem->nullValue==1)? $oItem->terminoName: '')."' />";
    break;
}

?>
<script type="text/javascript">
function on_submit(xform){
    if($("#terminoName").val() ==""){
        alert("Por favor, ingrese el campo [Nombre]");
        $("#terminoName").focus();
        return false;
    }

    xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
    xform.submit();
}
</script>
<input type="hidden" name="groupID" value="<?php echo $oItem->groupID?>">
<input type="hidden" name="langID" value="<?php echo $oItem->langID?>">


<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->terminoName:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">


    <div class="form-group">
      <label class="col-sm-2 control-label ">Nombre</label>
      
      <div class="col-sm-10">
       <?php echo $ctlEdit;?>
      </div>
    </div>


</div>
  <div class="box-footer">
    <input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
    <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
  </div>
</div>