<div class="portfolio-modal modal fade" id="eliminarC" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Liberación de Calcomanías (Activos)</h4>
            </div>
            <form name="login" id="elimina_calcomania" class="login">
                <div class="modal-body">                
                    <p>Número inicial:</p>
                    <input type="text" class="form-control" placeholder="Ingrese N° calcomanía inicial" id="nro_inicialdel" name="nro_inicialdel">
                    <br/>
                    <p>Número Final:</p>
                    <input type="text" class="form-control" placeholder="Ingrese N° calcomanía final (opcional)" id="nro_finaldel" name="nro_finaldel">
                </div>
                <div class="modal-footer">
                    <div class="btn btn-primary" id="eliminarF">Eliminar Calcomanías</div>
                    </br><br/>
                    <p class="text-danger" id="alert_eliminar"></p>
                </div>
            </form>
            <script type="text/javascript">
                $(function(){
                    //prepareForm('#elimina_calcomania');
                    $('#eliminarF').click(function(){
                        if (!isValidate('#elimina_calcomania')){ alertify.error('Porfavor ingrese datos validos.'); return false; }
                        var fields2=$('#elimina_calcomania').serialize();
                        console.log('<?php echo $URL_ROOT;?>ajax/calcomania.php?action=eliminar&'+fields2);

                        $.getJSON('<?php echo $URL_ROOT;?>ajax/calcomania.php?action=eliminar&'+fields2, function(data) {
                            if(data.retval==1){
                                alertify.success(data.message);
                                location.href= '<?php echo SEO::get_URLAdmin(); ?>?moduleID=39';
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