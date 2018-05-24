<?php
$DAO=$MODULE->StaticDAO;
$obj=$DAO::getItem($kID);
if($obj!=null){
    $oItem->name=$obj->name;
    $oItem->email=$obj->email;
    $oItem->phone=$obj->phone;
    $oItem->comment=$obj->comment;
    $oItem->registerDate=$obj->registerDate;
    $oItem->state=$obj->state;

}
else
    $MODULE->addError($DAO::GetErrorMsg());
?>

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><?php echo $oItem->name; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">


<div class="form-group">
      <label class="col-sm-2 control-label ">Nombre</label>
      <div class="col-sm-10">
       <?php echo $oItem->name; ?>
        
      </div>
    </div>

    
<div class="form-group">
      <label class="col-sm-2 control-label ">Email</label>
      <div class="col-sm-10">
       <?php echo $oItem->email; ?>
        
      </div>
    </div>


    
<div class="form-group">
      <label class="col-sm-2 control-label ">Telefono</label>
      <div class="col-sm-10">
       <?php echo $oItem->phone; ?>
        
      </div>
    </div>
    
<div class="form-group">
      <label class="col-sm-2 control-label ">Mensaje</label>
      <div class="col-sm-10">
       <?php echo $oItem->comment; ?>
        
      </div>
    </div>

<div class="form-group">
      <label class="col-sm-2 control-label ">Fecha Registro</label>
      <div class="col-sm-10">
       <?php echo $oItem->registerDate; ?>
        
      </div>
    </div>


<div class="form-group">
      <label class="col-sm-2 control-label ">Estado</label>
      <div class="col-sm-10">
       <?php echo CrmRegisterForm::getState($oItem->state); ?>
        
      </div>
    </div>

</div>
  <div class="box-footer">
    <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
  </div>
</div>