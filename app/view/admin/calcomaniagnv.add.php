<?php 
$lInspector = CrmUser::getWebList();
?>
<div class="portfolio-modal modal fade" id="asignarC" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Asignación de Calcomanías</h4>
            </div>
            <form name="login" id="asigna_calcomania" class="login">
                <div class="modal-body">                
                    <p>Calcomanía inicial:</p>
                    <input type="text" class="form-control" placeholder="Ingrese N° Calcomanía inicial" id="nro_inicial" name="nro_inicial">
                    <br/>
                    <p>Cantidad:</p>
                    <input type="text" class="form-control" placeholder="Ingrese la cantidad de Calcomanías" id="cantidad" name="cantidad">
                    <br/>
                    <p>Inspector:</p>
                    <select name="inspectorID" id="inspectorID" class="form-control">
                      <option value="0">SELECCIONE</option>
                      <?php
                      foreach ($lInspector as $obj){
                        echo '<option value="' . $obj->userID . '">' . $obj->firstName . ' '. $obj->lastName . '</option>';
                      }
                      ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-primary" id="grabar">Grabar Calcomanías</div>
                    </br><br/>
                    <p class="text-danger" id="alert_asignar"></p>
                </div>
            </form>
            <script type="text/javascript">
                $(function(){
                    //prepareForm('#asigna_calcomania');
                    $('#grabar').click(function(){
                        if (!isValidate('#asigna_calcomania')){ alertify.error('Porfavor ingrese datos validos.'); return false; }
                        var fields2=$('#asigna_calcomania').serialize();
                        console.log('<?php echo $URL_ROOT;?>ajax/calcomaniagnv.php?action=asignar&'+fields2);

                        $.getJSON('<?php echo $URL_ROOT;?>ajax/calcomaniagnv.php?action=asignar&'+fields2, function(data) {
                            if(data.retval==1){                                
                                alertify.success(data.message);
                                location.href= '<?php echo SEO::get_URLAdmin(); ?>?moduleID=47';
                            }else{
                                $('#alert_asignar').html(data.message);
                            }
                        }).error(function(jqXHR, textStatus, errorThrown) {
                            alertify.error("Error interno");
                            console.log("error: " + textStatus);
                            console.log("error thrown: " + errorThrown);
                            console.log("incoming Text: " + jqXHR.responseText);
                        });
                    });
                });
            </script>
        </div>
    </div>
</div>