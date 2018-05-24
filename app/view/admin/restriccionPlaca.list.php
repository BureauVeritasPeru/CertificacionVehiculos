<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">


    <table class="table table-bordered table-hover" id="dataTables-example">
     <thead>
      <tr> 
        <th>&nbsp;</th>
        <th><?php echo $MODULE->getSortingHeader("placa", "Placa");?></th>
        <th><?php echo $MODULE->getSortingHeader("registerDate", "Fecha de Registro");?></th>
        <th><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $lCrmRestriccionPlaca = CrmRestriccionPlaca::getList_Paging();

      foreach ($lCrmRestriccionPlaca as $oItem) {
        ?>
        <tr> 
          <td><a href="<?php echo "javascript:Edit(".$oItem->restriccionID.");"; ?>"><i class="fa fa-edit"></i></a>
            <a href="<?php echo "javascript:Delete(".$oItem->restriccionID.");"; ?>"><i class="fa fa-remove"></i></a></td>
            <td><?php echo $oItem->placa; ?></td>
            <td><?php echo $oItem->registerDate; ?></td>
            <td><?php echo CrmRestriccionPlaca::getState($oItem->state);?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>


    </div>
    <div class="box-footer">
      <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
      <?php echo $MODULE->getPaging();?>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#dataTables-example').DataTable({
        responsive: true,
        dom:"<'row'<'col-sm-6'f><'col-sm-6'>>"+
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-6'p>>"
      });
    });
  </script>