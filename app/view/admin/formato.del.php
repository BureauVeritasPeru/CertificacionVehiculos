<div class="portfolio-modal modal fade" id="eliminar" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Liberación de Formatos (Activos)</h4>
            </div>
            <form name="login" id="elimina_formato" class="login">
                <div class="modal-body">                
                    <p>Número inicial:</p>
                    <input type="text" class="form-control" placeholder="Ingrese N° formato inicial" id="nro_inicialdel" name="nro_inicialdel">
                    <br/>
                    <p>Número Final:</p>
                    <input type="text" class="form-control" placeholder="Ingrese N° formato final (opcional)" id="nro_finaldel" name="nro_finaldel">
                </div>
                <div class="modal-footer">
                    <div class="btn btn-primary" id="eliminarF">Eliminar Formatos</div>
                </br><br/>
                <p class="text-danger" id="alert_eliminar"></p>
            </div>
        </form>
        <script type="text/javascript">
            $(function(){
                    //prepareForm('#elimina_formato');
                    $('#eliminarF').click(function(){
                        if (!isValidate('#elimina_formato')){ alertify.error('Porfavor ingrese datos validos.'); return false; }
                        var fields2=$('#elimina_formato').serialize();
                        console.log('<?php echo $URL_ROOT;?>ajax/formato.php?action=eliminar&'+fields2);

                        $.getJSON('<?php echo $URL_ROOT;?>ajax/formato.php?action=eliminar&'+fields2, function(data) {
                            console.log(data.message);
                            if(data.retval==1){
                                alertify.success(data.message);
                                location.href= '<?php echo SEO::get_URLAdmin(); ?>?moduleID=38';
                            }else{
                                $('#alert_eliminar').html(data.message);
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