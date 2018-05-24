<?php $numeralEmbarcacion=isset($_REQUEST['numeralEmbarcacion'])? $_REQUEST['numeralEmbarcacion']:''; ?>

<div class="box box-default">
  <div class="box-header">
    <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <div class="col-sm-10">
      <div class="form-group padding-right-10">
        <label >Numeral de Embarcacion: </label>
        <input name="txtsearch" id="numeralEmbarcacion" type="text" class="form-control" placeholder="Numeral de embarcacion" maxlength="255">            
      </div>
    </div>

    <div class="col-sm-2 col-lg-1">

      <label>&nbsp;</label>
      <div class="form-group">
        <div  id="btnBuscar" type="button" class="btn btn-primary" value="Buscar" autocomplete="off">Buscar</div>
      </div>
    </div>

    <table class="table table-bordered table-hover">
      <tr> 
        <th>&nbsp;</th>
        <th><?php echo $MODULE->getSortingHeader("numeralEmbarcacion", "Numeral");?></th>
        <th><?php echo $MODULE->getSortingHeader("nombreEmbarcacion", "Nombre Embarcación");?></th>
        <th><?php echo $MODULE->getSortingHeader("matriculaEmbarcacion", "Matricula");?></th>
        <th><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
      </tr>
      <?php
      $lCrmEmbarcacion = CrmEmbarcacion::getList_Paging($numeralEmbarcacion);

      foreach ($lCrmEmbarcacion as $oItem) {
        ?>
        <tr> 
          <td><a href="<?php echo "javascript:Edit(".$oItem->embarcacionID.");"; ?>"><i class="fa fa-edit"></i></a>
            <a href="<?php echo "javascript:Delete(".$oItem->embarcacionID.");"; ?>"><i class="fa fa-remove"></i></a></td>
            <td><?php echo $oItem->numeralEmbarcacion; ?></td>
            <td><?php echo $oItem->nombreEmbarcacion; ?></td>
            <td><?php echo $oItem->matriculaEmbarcacion; ?></td>
            <td><?php echo CrmEmbarcacion::getState($oItem->state);?></td>
          </tr>
          <?php } ?>
        </table>


      </div>
      <div class="box-footer">
        <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
        <button class="btn btn-success" name="btnNew" id="btnNew">
          <span class="fa fa-plus"></span>&nbsp;&nbsp;importar lista</button>
          <?php echo $MODULE->getPaging();?>
        </div>
      </div>

      <script type="text/javascript">
        $(document).ready(function() {

         $('#btnBuscar').on('click', function(){
          $numeralEmbarcacion   = $('#numeralEmbarcacion').val();
          location.href='<?php echo SEO::get_URLROOT(); ?>admin/?moduleID=26&numeralEmbarcacion='+$numeralEmbarcacion;
        });  


         $('#btnNew').click(function (e) {
          $('#ModalImport').modal('show');
          $('.FiltroImport').hide();
          return false;
        });

         $('#btnSelect').click(function (e){


          var  form  = document.getElementById("myForm");

          if($("#fleImport").val()==""){
            $("#fleImport").focus();
            alertify.error("Seleccione el archivo ");
            return false;
          }else{
            var fs = 0;   
            if($("#fleImport")[0].files[0].size != undefined){
              fs = $("#fleImport")[0].files[0].size;  
            }else{
              fs = $("#fleImport")[0].files[0].fileSize;
            }

            var ex = $("#fleImport").val().split('.').pop();

            if(ex !="csv"){
              $("#fleImport").focus();
              alertify.error("Seleccione un archivo csv");
              return false;
            }

            $.ajax({
              type: "POST",
              data: new FormData(form),
              contentType: false,       
              cache: false,             
              processData:false, 
              url: '<?php echo $URL_ROOT;?>ajax/form_import.php',
              success: function( response ) {
                if(response==1){
                  alertify.success('exito de importacion');
                }else{
                  $('.FiltroImport').show();
                  $('.RespuestaImport').html(response);
                }
              }
            });
          }






        });

       });
     </script>