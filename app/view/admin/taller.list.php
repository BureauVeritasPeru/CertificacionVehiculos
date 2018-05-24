<div class="box box-default">
  <div class="box-header">
    <!--<h2 class="box-title">-->
    <h2><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered table-hover" id="dataTables-example">
      <thead>
        <tr> 
          <th>&nbsp;</th>
          <th><?php echo $MODULE->getSortingHeader("ruc", "RUC");?></th>
          <th><?php echo $MODULE->getSortingHeader("razonSocial", "Razón Social");?></th>
          <th><?php echo $MODULE->getSortingHeader("per", "PER");?></th>
          <th><?php echo $MODULE->getSortingHeader("costo", "Costo (S/.)");?></th>
          <th><?php echo $MODULE->getSortingHeader("nomCompleto", "Usuario Creación");?></th>
          <th><?php echo $MODULE->getSortingHeader("estado", "Estado");?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $lCrmTaller = CrmTaller::getList_Paging();

        foreach ($lCrmTaller as $oItem) {
          ?>
          <tr> 
            <td><a href="<?php echo "javascript:Edit(".$oItem->tallerID.");"; ?>"><i class="fa fa-edit"></i></a>
              <a href="<?php echo "javascript:Delete(".$oItem->tallerID.");"; ?>"><i class="fa fa-remove"></i></a></td>
              <td><?php echo $oItem->ruc; ?></td>
              <td><?php echo $oItem->razonSocial; ?></td>
              <td><?php echo $oItem->per; ?></td>
              <td><?php echo $oItem->costo; ?></td>
              <td><?php echo $oItem->nomCompleto; ?></td>
              <td><?php echo CrmTaller::getState($oItem->estado);?></td>
            </tr>
            <?php } ?>
          </tbody>
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