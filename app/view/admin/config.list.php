<?php

?>
<script type="text/javascript" src="../assets/admin/js/datepicker/popcalendar.js"></script>
<script type="text/javascript">
function on_submit(xform){

	xform.Command.value="update";
	xform.submit();
}
</script>

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa fa-edit"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <div class="box-body">


<?php
$list=Config::getList();
foreach($list as $oItem){
$lbl_input='<input name="value['.$oItem->configID.']" type="text" id="value_'.$oItem->configID.'" value="'.$oItem->value.'" class="form-control" maxlength="255">';
switch($oItem->inputType){
	case 'text':
		$lbl_input='<textarea name="value['.$oItem->configID.']" type="text" id="value_'.$oItem->configID.'" class="form-control" rows="4" maxlength="255">'.$oItem->value.'</textarea>';
		break;
	case 'numeric':
		$lbl_input='<input name="value['.$oItem->configID.']" type="text" id="value_'.$oItem->configID.'" value="'.$oItem->value.'" class="form-control" maxlength="5">';
		break;
	case 'bool':
		$lbl_input='<input name="value['.$oItem->configID.']" type="radio" class="flat-blue" id="value_'.$oItem->configID.'_1" value="1" '.(($oItem->value=='1')?'checked="true"':'').'> activo <input name="value['.$oItem->configID.']" type="radio" class="flat-blue" id="value_'.$oItem->configID.'_0" value="0" '.(($oItem->value!='1')?'checked="true"':'').'> inactivo';
		break;
	case 'date':
		$lbl_input='<input name="value['.$oItem->configID.']" type="text" readonly="readonly" id="value_'.$oItem->configID.'" value="'.$oItem->value.'" class="form-control" maxlength="10"><a href="javascript:;"><img src="../assets/admin/images/calendar.jpg" bsolicitud="0" onClick="popUpCalendar(this, document.forms[0].value_'.$oItem->configID.', \'yyyy-mm-dd\')"></a> (aaaa-mm-dd)';
		break;
	case 'email':
	default:
		$lbl_input='<input name="value['.$oItem->configID.']" type="text" id="value_'.$oItem->configID.'" value="'.$oItem->value.'" class="form-control" maxlength="255">';
		break;
}
	
?>                      
         <div class="form-group">
      <label class="col-sm-2 control-label "><?php echo $oItem->description?></label>
      <div class="col-sm-10">
       <?php echo $lbl_input; ?>
      </div>
    </div>         
               
                       

                    
<?php
}
?>                      
              

  </div>
  <div class="box-footer">
    <input type="button" class="btn btn-primary" value="actualizar datos" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
  </div>
</div>