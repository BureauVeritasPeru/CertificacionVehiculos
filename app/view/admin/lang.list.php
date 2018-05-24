<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">



    <table class="table table-bordered table-hover">
      <tr> 
        <th>&nbsp;</th>
        <th><?php echo $MODULE->getSortingHeader("langName", "Nombre");?></th>
        <th class="text-center"><?php echo $MODULE->getSortingHeader("isDefault", "Predeterminado");?></th>
        <th class="text-center"><?php echo $MODULE->getSortingHeader("active", "Activo");?></th>
      </tr>
    <?php $DAO=$MODULE->StaticDAO;//CmsLang
	$list=$DAO::getList_Paging();
	foreach ($list as $oItem) {
	?>
    <tr>
      <td><?php if($oItem->isDefault==0){ ?>
              <a href="<?php echo "javascript:Edit(".$oItem->langID.");"; ?>"><i class="fa fa-edit"></i></a>
          <a href="<?php echo "javascript:Delete(".$oItem->langID.");"; ?>"><i class="fa fa-remove"></i></a>
      <?php } else {?>
              <a href="<?php echo "javascript:View(".$oItem->langID.");"; ?>"><i class="fa fa-edit"></i></a>
      <?php } ?>
                              </td>
      <td><?php echo $oItem->langName; ?></td>
      <td class="text-center"><input type="checkbox" disabled="disabled" <?php if($oItem->isDefault==1) echo "checked";?> /></td>
      <td class="text-center"><input type="checkbox" disabled="disabled" <?php if($oItem->active==1) echo "checked";?> /></td>
    </tr>
    <?php } ?>
  </table>

  
</div>
<div class="box-footer">
  <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
  
  <?php echo $MODULE->getPaging();?>
</div>
</div>
