  <div class="portfolio-modal modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="modal-body login-web">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body login-web">
                            <!-- Project Details Go Here -->
                            <img src="<?php echo $URL_ROOT; ?>assets/admin/images/logo_bureau.jpg" class="img" style="width: 38% !important;">
                            <h2>Login</h2>
                            <p class="item-intro text-muted">Ingrese su usuario y contraseña para ingresar.</p>
                            <!-- <img class="img-responsive img-centered" src="img/portfolio/roundicons-free.png" alt=""> -->
                            <form name="login" id="login_produce" class="login">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control input_login" placeholder="Usuario *" id="usuario_login" name="usuario_login" required data-validation-required-message="Por favor ingrese su usuario.">
                                            <p class="help-block text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control input_login" placeholder="Password *" id="password_login" name="password_login" required data-validation-required-message="Por favor ingrese su contraseña.">
                                            <p class="help-block text-danger"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <div  class="btn btn-primary btn-lg" id="send-login">Ingresar</div>
                                </div>
                                <p class="text-danger" id="alert_login" ></p>
                            </form>
                        </div>
                        <script type="text/javascript">
                            $(function(){
                                prepareForm('#login_produce');
                                $('#send-login').click(function(){
                                    if (!isValidate('#login_produce')){ alert('Porfavor ingrese datos validos.'); return false; }

                                    var fields2=$('#login_produce').serialize();
                                    console.log('<?php echo $URL_ROOT;?>ajax/form_login.php?action=login&'+fields2);
                                    $.getJSON('<?php echo $URL_ROOT;?>ajax/form_login.php?action=login&'+fields2, function(data) {
                                        if(data.retval==1){
                                            location.href='<?php echo SEO::get_URLHome();?>';
                                        }else{
                                            $('#alert_login').html(data.message);
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>