<?php
$DAO=$MODULE->StaticDAO;
$obj=$DAO::getItem($kID);
if($obj!=null){
    $oItem->langCode=$obj->langCode;
    $oItem->langName=$obj->langName;
    $oItem->alias=$obj->alias;
    $oItem->isDefault=$obj->isDefault;
    $oItem->active=$obj->active;

    if($oItem->isDefault) $MODULE->addAlert("Este &iacute;tem est&aacute; predeterminado, no puede ser modificado o eliminado.");
}
else
    $MODULE->addError($DAO::GetErrorMsg());
?>

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><?php echo $oItem->langName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">


<div class="form-group">
      <label class="col-sm-2 control-label ">C&oacute;digo</label>
      <div class="col-sm-10">
       <?php echo $oItem->langCode; ?>
        
      </div>
    </div>

    
<div class="form-group">
      <label class="col-sm-2 control-label ">Nombre</label>
      <div class="col-sm-10">
       <?php echo $oItem->langName; ?>
        
      </div>
    </div>


    
<div class="form-group">
      <label class="col-sm-2 control-label ">Alias</label>
      <div class="col-sm-10">
       <?php echo $oItem->alias; ?>
        
      </div>
    </div>
    
<div class="form-group">
      <label class="col-sm-2 control-label ">Estado</label>
      <div class="col-sm-10">
       <?php echo $oItem->alias; ?>
        
      </div>
    </div>
      

</div>
  <div class="box-footer">
    <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
  </div>
</div>