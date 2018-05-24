<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">


<table class="table table-bordered table-hover">
  <tr> 
    <th>&nbsp;</th>
    <th><?php echo $MODULE->getSortingHeader("codigoPlanta", "Codigo Planta");?></th>
    <th><?php echo $MODULE->getSortingHeader("nombrePlanta", "Nombre");?></th>
    <th><?php echo $MODULE->getSortingHeader("puertoPlanta", "Puerto");?></th>
    <th><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
  </tr>
    <?php
    $lCrmPlanta = CrmPlanta::getList_Paging();

    foreach ($lCrmPlanta as $oItem) {
    ?>
        <tr> 
          <td><a href="<?php echo "javascript:Edit(".$oItem->plantaID.");"; ?>"><i class="fa fa-edit"></i></a>
              <a href="<?php echo "javascript:Delete(".$oItem->plantaID.");"; ?>"><i class="fa fa-remove"></i></a></td>
          <td><?php echo $oItem->codigoPlanta; ?></td>
          <td><?php echo $oItem->nombrePlanta; ?></td>
          <td><?php echo $oItem->puertoPlanta; ?></td>
          <td><?php echo CrmPlanta::getState($oItem->state);?></td>
        </tr>
    <?php } ?>
</table>


</div>
<div class="box-footer">
  <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
  <?php echo $MODULE->getPaging();?>
</div>
</div>