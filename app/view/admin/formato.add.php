<?php 
$lInspector = CrmUser::getWebList();
?>
<div class="portfolio-modal modal fade" id="asignar" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Asignación de Formatos</h4>
            </div>
            <form name="login" id="asigna_formato" class="login">
                <div class="modal-body">                
                    <p>Formato inicial:</p>
                    <input type="text" class="form-control" placeholder="Ingrese N° formato inicial" id="nro_inicial" name="nro_inicial">
                    <br/>
                    <p>Cantidad:</p>
                    <input type="text" class="form-control" placeholder="Ingrese la cantidad de formatos" id="cantidad" name="cantidad">
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
                    <div class="btn btn-primary" id="grabar">Grabar Formatos</div>
                    </br><br/>
                    <p class="text-danger" id="alert_asignar"></p>
                </div>
            </form>
            <script type="text/javascript">
                $(function(){
                    //prepareForm('#asigna_formato');
                    $('#grabar').click(function(){
                        if (!isValidate('#asigna_formato')){ alertify.error('Porfavor ingrese datos validos.'); return false; }
                        var fields2=$('#asigna_formato').serialize();
                        console.log('<?php echo $URL_ROOT;?>ajax/formato.php?action=asignar&'+fields2);

                        $.getJSON('<?php echo $URL_ROOT;?>ajax/formato.php?action=asignar&'+fields2, function(data) {
                            if(data.retval==1){
                                alertify.success(data.message);
                                location.href= '<?php echo SEO::get_URLAdmin(); ?>?moduleID=38';
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