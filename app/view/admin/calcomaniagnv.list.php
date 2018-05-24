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
          <th style="width:110px;"><?php echo $MODULE->getSortingHeader("calcomaniaID", "N° Calcomania");?></th>
          <th><?php echo $MODULE->getSortingHeader("nombreCompleto", "Usuario Asignado");?></th>
          <th><?php echo $MODULE->getSortingHeader("fechaCreacion", "Fecha de Creación");?></th>
          <th><?php echo $MODULE->getSortingHeader("nombreCompletoAdm", "Usuario de Creación");?></th>
          <th><?php echo $MODULE->getSortingHeader("estado", "Estado");?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $lGnvCalcomania = GnvCalcomania::getList_Paging();

        foreach ($lGnvCalcomania as $oItem) {
        ?>
        <tr>
          <td><a href="<?php echo "javascript:Delete(".$oItem->calcomaniaID.");"; ?>"><i class="fa fa-remove"></i></a></td>
          <td><?php echo $oItem->calcomaniaID; ?></td>
          <td><?php echo $oItem->nombreCompleto; ?></td>
          <td><?php echo $oItem->fechaCreacion; ?></td>
          <td><?php echo $oItem->nombreCompletoAdm; ?></td>
          <td><?php echo GnvCalcomania::getState($oItem->estado);?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">    
    <!--<?php echo $MODULE->getPaging();?>-->
    <br/>
    <div class="row">
      <div class="col-lg-2 col-lg-offset-3"><a class="btn btn-primary" href="#asignarC" data-toggle="modal" data-backdrop="static"><span class="fa fa-plus fa-lg"></span> Asignar Calcomanías</a></div>
      <div class="col-lg-2"><a class="btn btn-primary" href="#reasignarC" data-toggle="modal" data-backdrop="static"><span class="fa fa-pencil fa-lg"></span> Reasignar Calcomanías</a></div>
      <div class="col-lg-2"><a class="btn btn-primary" href="#eliminarC" data-toggle="modal" data-backdrop="static"><span class="fa fa-times fa-lg"></span> Eliminar Calcomanías</a></div>   
     </div>  
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