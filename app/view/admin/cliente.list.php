<div class="box box-default">
  <div class="box-header">
    <h2><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered table-hover" id="dataTables-example">
      <thead>
        <tr> 
          <th>&nbsp;</th>
          <th><?php echo $MODULE->getSortingHeader("clienteID", "ID");?></th>
          <th><?php echo $MODULE->getSortingHeader("numDoc", "N° Documento");?></th>
          <th><?php echo $MODULE->getSortingHeader("name", "Nombres");?></th>
          <th><?php echo $MODULE->getSortingHeader("lastname", "Apellidos");?></th>
          <th><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $lCrmCliente = CrmCliente::getList_Paging();

        foreach ($lCrmCliente as $oItem) {
        ?>
          <tr> 
            <td><a href="<?php echo "javascript:Edit(".$oItem->clienteID.");"; ?>"><i class="fa fa-edit"></i></a>
                <a href="<?php echo "javascript:Delete(".$oItem->clienteID.");"; ?>"><i class="fa fa-remove"></i></a>
            </td>
            <td><?php echo $oItem->clienteID; ?></td>
            <td><?php echo $oItem->numDoc; ?></td>
            <td><?php echo $oItem->name; ?></td>
            <td><?php echo $oItem->lastname; ?></td>
            <td><?php echo CrmPlanta::getState($oItem->state);?></td>
          </tr>
        <?php } ?>
    </table>
  </div>
  <div class="box-footer">
    <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">Nuevo <?php echo $MODULE->moduleName; ?></button>
    <!--<?php echo $MODULE->getPaging();?>-->
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