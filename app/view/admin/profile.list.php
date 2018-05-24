<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>&nbsp;</th>
          <th><?php echo $MODULE->getSortingHeader("profileName", "Perfil");?></th>
        </tr>
        <?php
        $lAdmProfile=AdmProfile::getList_Paging();
        foreach ($lAdmProfile as $oItem){
        ?>
        <tr>
          <td nowrap="nowrap"><?php if($oItem->isDefault==0){ ?>
            <a href="<?php echo "javascript:Edit(".$oItem->profileID.");"; ?>"><i class="fa fa-edit"></i></a>
            <a href="<?php echo "javascript:Delete(".$oItem->profileID.");"; ?>"><i class="fa fa-remove"></i></a>
            <?php } else {?>
            <a href="<?php echo "javascript:View(".$oItem->profileID.");"; ?>"><i class="fa fa-edit"></i></a>
            <?php } ?>
          </td>
          <td><?php echo $oItem->profileName; ?> <?php if($oItem->isDefault==1) echo '<small><i class="fa fa-lock text-primary"></i></small>'; ?></td>
        </tr>
        <?php } ?>
      </table>

        
      </div>

        <div class="box-footer">
          <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
            
            <?php echo $MODULE->getPaging();?>
          
        </div>

    </div>