<?php 
$lInspector = CrmUser::getWebList();
?>
<div class="portfolio-modal modal fade" id="reasignar" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Reasignación de Formatos (Activos)</h4>
            </div>
            <form name="login" id="reasigna_formato" class="login">
                <div class="modal-body">                
                    <p>Número inicial:</p>
                    <input type="text" class="form-control" placeholder="Ingrese N° formato inicial" id="nro_inicialre" name="nro_inicialre">
                    <br/>
                    <p>Número Final:</p>
                    <input type="text" class="form-control" placeholder="Ingrese N° formato final (opcional)" id="nro_finalre" name="nro_finalre">
                    <br/>
                    <p>Inspector:</p>
                    <select name="inspectorIDre" id="inspectorIDre" class="form-control">
                      <option value="0">SELECCIONE</option>
                      <?php
                      foreach ($lInspector as $obj){
                        echo '<option value="' . $obj->userID . '">' . $obj->firstName . ' '. $obj->lastName . '</option>';
                      }
                      ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-primary" id="reasignarF">Reasignar Formatos</div>
                    </br><br/>
                    <p class="text-danger" id="alert_reasignar"></p>
                </div>
            </form>
            <script type="text/javascript">
                $(function(){
                    //prepareForm('#reasigna_formato');
                    $('#reasignarF').click(function(){
                        if (!isValidate('#reasigna_formato')){ alertify.error('Porfavor ingrese datos validos.'); return false; }
                        var fields2=$('#reasigna_formato').serialize();
                        console.log('<?php echo $URL_ROOT;?>ajax/formato.php?action=reasignar&'+fields2);

                        $.getJSON('<?php echo $URL_ROOT;?>ajax/formato.php?action=reasignar&'+fields2, function(data) {
                            if(data.retval==1){
                                alertify.success(data.message);
                                location.href= '<?php echo SEO::get_URLAdmin(); ?>?moduleID=38';
                            }else{
                                $('#alert_reasignar').html(data.message);
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