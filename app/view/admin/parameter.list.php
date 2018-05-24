<?php
$lLang=CmsLang::getList_Active();
if(CmsLang::getErrorMsg()!="") $MODULE->addError(CmsLang::getErrorMsg());
?>
<div class="box box-default">
  <div class="box-header">
    <h2><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <div class="box-body">

    <input type="hidden" name="groupID" value="<?php echo $groupID?>">

    <div class="row row-custom">
      <?php
      if($oItem->groupID==9){
        $lParentParam=CmsParameterLang::getList(8, $oItem->langID);
        ?>
        <div class="col-sm-5">
          <div class="form-group">
            <label>Marca: </label>
            <select name="parentParameterID" onchange="this.form.submit()" class="form-control">
              <?php
              foreach ($lParentParam as $obj){
                if(empty($oItem->parentParameterID)) $oItem->parentParameterID=$obj->parameterID;
                ?>
                <option value="<?php echo $obj->parameterID; ?>" <?php if($obj->parameterID==$oItem->parentParameterID) echo 'selected="true"'; ?>><?php echo $obj->parameterName; ?></option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>
        <?php
      }
      ?>

      <?php
      if($oItem->groupID==12){
        $lParentParam=CmsParameterLang::getList(11, $oItem->langID);
        ?>
        <div class="col-sm-5">
          <div class="form-group">
            <label>Tipo de Servicio: </label>
            <select name="parentParameterID" onchange="this.form.submit()" class="form-control">
              <?php
              foreach ($lParentParam as $obj){
                if(empty($oItem->parentParameterID)) $oItem->parentParameterID=$obj->parameterID;
                ?>
                <option value="<?php echo $obj->parameterID; ?>" <?php if($obj->parameterID==$oItem->parentParameterID) echo 'selected="true"'; ?>><?php echo $obj->parameterName; ?></option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>
        <?php
      }
      ?>

    <!-- <div class="col-sm-5">
      <div class="form-group">
        <label>Idioma: </label>
        <select name="langID" onChange="this.form.submit();" class="form-control">
          <?php
          /*foreach ($lLang as $obj) {
          if(!isset($oItem->langID)) $oItem->langID=$obj->langID;
          echo "<option value=\"$obj->langID\"";
            if($obj->langID==$oItem->langID) print " selected";
          echo ">$obj->alias</option>";
          }*/
          ?>
        </select>
        
      </div>
    </div> -->
  </div>
  <table class="table table-bordered table-hover" id="dataTables-example">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th><?php echo $MODULE->getSortingHeader("parameterName", "Nombre");?></th>
        <th><?php echo $MODULE->getSortingHeader("active", "Estado");?></th>
      </tr>
    </thead>
    <tbody>
      <?php

      if($oItem->groupID == 9 || $oItem->groupID == 12){
        $list = CmsParameterLang::getListParent_Paging($oItem->groupID, $oItem->parentParameterID, $langID);
      }
      else{
        $list = CmsParameterLang::getList_Paging($groupID, $langID);
      }
      foreach($list as $oItem){
        ?>
        <tr>
          <td><a href="<?php echo "javascript:Edit(".$oItem->parameterID.");"; ?>"><i class="fa fa-edit"></i></a>
            <a href="<?php echo "javascript:Delete(".$oItem->parameterID.");"; ?>"><i class="fa fa-remove"></i></a>
          </td>
          <td><?php echo $oItem->parameterName; ?></td>
          <td><?php echo CmsParameterLang::getActive($oItem->active);?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">Nuevo(a) <?php echo $MODULE->moduleName; ?></button>

    <?php echo $MODULE->getPaging();?>

  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    $('#btn-formI').hide();
    $('#btn-formU').hide();
    $('#dataTables-example').DataTable({
      responsive: true,
      dom:"<'row'<'col-sm-6'f><'col-sm-6'>>"+
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-6'p>>"
    });
  });
</script>