

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
          <th><?php echo $MODULE->getSortingHeader("firstName", "Nombre");?></th>
          <th><?php echo $MODULE->getSortingHeader("userName", "Usuario");?></th>
          <th><?php echo $MODULE->getSortingHeader("profileName", "Perfil");?></th>
          <th><?php echo $MODULE->getSortingHeader("email", "Email");?></th>
          <th><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
        </tr>
      </thead>
      <?php
      $lAdmUser = AdmUser::getList_Paging();
      foreach ($lAdmUser as $oItem) {
      ?>
      <tr>
        <td><a href="<?php echo "javascript:Edit(".$oItem->userID.");"; ?>"><i class="fa fa-edit"></i></a>
        <?php
        if(!$oItem->isDefault) {
        ?>
        <a href="<?php echo "javascript:Delete(".$oItem->userID.");"; ?>"><i class="fa fa-remove"></i></a>
        <?php
        }
        ?>
      </td>
      <td><?php echo $oItem->firstName." ".$oItem->lastName; ?></td>
      <td><?php echo $oItem->userName; ?></td>
      <td><?php echo $oItem->profileName; ?></td>
      <td><?php echo $oItem->email; ?></td>
      <td><?php echo AdmUser::getState($oItem->state);?></td>
    </tr>
    <?php } ?>
  </table>
  
</div>
<div class="box-footer">
  <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)"><span class="fa fa-plus"></span> nuevo &iacute;tem</button>
  
  <?php echo $MODULE->getPaging();?>
</div>
</div>