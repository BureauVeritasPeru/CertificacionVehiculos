<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">


<table class="table table-bordered table-hover">
  <tr> 
    <th>&nbsp;</th>
    <th><?php echo $MODULE->getSortingHeader("codigoInspector", "Codigo de Inspector");?></th>
    <th><?php echo $MODULE->getSortingHeader("nombreCompletoInspector", "Nombres");?></th>
    <th><?php echo $MODULE->getSortingHeader("nroDocumento", "Nro Documento");?></th>
    <th><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
  </tr>
    <?php
    $lCrmInspector = CrmInspector::getList_Paging();

    foreach ($lCrmInspector as $oItem) {
    ?>
        <tr> 
          <td><a href="<?php echo "javascript:Edit(".$oItem->inspectorID.");"; ?>"><i class="fa fa-edit"></i></a>
              <a href="<?php echo "javascript:Delete(".$oItem->inspectorID.");"; ?>"><i class="fa fa-remove"></i></a></td>
          <td><?php echo $oItem->codigoInspector; ?></td>
          <td><?php echo $oItem->nombreCompletoInspector; ?></td>
          <td><?php echo $oItem->nroDocumento; ?></td>
          <td><?php echo CrmInspector::getState($oItem->state);?></td>
        </tr>
    <?php } ?>
    </table>


</div>
<div class="box-footer">
  <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
  <?php echo $MODULE->getPaging();?>
</div>
</div>