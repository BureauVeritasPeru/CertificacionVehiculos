<?php
$userAdmin      =AdmLogin::getUserSession();
$contactGroupID =0; //Initialized
?>
<script type="text/javascript">
$(function(){
$('#formID').change(function(){
$('#contactID').val('');
$('form').submit();
});
$('#contactID').change(function(){
$('form').submit();
});
});
</script>
<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <div class="box-body">


    <div class="col-sm-6">
      <div class="form-group padding-right-10">
      <label>Formulario:</label>
        <select name="formID" id="formID" class="form-control">
          <?php
          $list=CrmForm::getList();
          foreach ($list as $obj) {
          if(empty($oItem->formID)) $oItem->formID=$obj->formID;
          echo "<option value=\"".$obj->formID."\"";
            if($obj->formID==$oItem->formID){
            $contactGroupID=$obj->contactGroupID;
            echo " selected";
            }
          echo ">".$obj->formName."</option>";
          }
          ?>
        </select>
      </div>
    </div>

    
    <?php
    if($contactGroupID>0){
    ?>
    <div class="col-sm-6">
      <div class="form-group padding-right-10">
      <label>Tipo o asunto:</label>
        <select name="contactID" id="contactID" class="form-control">
          <?php
          $list= CmsParameterLang::getList($contactGroupID, 1); //default language
          foreach ($list as $obj) {
          if(empty($oItem->contactID)) $oItem->contactID=$obj->parameterID;
          echo "<option value=\"".$obj->parameterID."\"";
            if($obj->parameterID==$oItem->contactID) echo " selected";
          echo ">".$obj->parameterName."</option>";
          }
          ?>
        </select>
    </div>
    </div>
    
    
    <?php } ?>
    
    <table class="table table-bordered table-hover">
      <tr>
        <th>&nbsp;</th>
        <th><?php echo $MODULE->getSortingHeader("firstName", "Nombre");?></th>
        <th><?php echo $MODULE->getSortingHeader("email", "Email");?></th>
        <th><?php echo $MODULE->getSortingHeader("active", "Estado");?></th>
      </tr>
      <?php
        $list=CrmFormNotify::getList_Paging($oItem->formID, $oItem->contactID);
        foreach ($list as $oItem) {
      ?>
      <tr>
        <td nowrap="nowrap"><a href="<?php echo "javascript:Edit(".$oItem->userID.");"; ?>"><i class="fa fa-edit"></i></a>
        <a href="<?php echo "javascript:Delete(".$oItem->userID.");"; ?>"><i class="fa fa-remove"></i></a>
      </td>
      <td><?php echo $oItem->firstName; ?> <?php echo $oItem->lastName; ?></td>
      <td><?php echo $oItem->email;?></td>
      <td align="center"><?php echo CrmFormNotify::getActive($oItem->active);?></td>
    </tr>
    <?php } ?>
  </table>
</div>
<div class="box-footer">
  <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
  <input type="hidden" name="OrderBy" value="<?php echo $OrderBy?>">
  
  <?php echo $MODULE->getPaging();?>
  
</div>
</div>