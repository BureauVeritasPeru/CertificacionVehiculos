 <section id="<?php echo $oItemss->title; ?>" class="contacto">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading"><?php echo $oItemss->title; ?></h2>
        <h3 class="section-subheading text-muted"><?php echo $oItemss->description; ?></h3>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form name="sentMessage" id="contactForm" novalidate>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <input type="text" class="form-control required" placeholder="Nombre *" id="name" name="name" required data-validation-required-message="Porfavor ingrese nombre.">
                <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
              <input type="email" class="form-control required email" placeholder="Email *" id="email" name="email" required data-validation-required-message="Porfavor ingrese su correo.">
                <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
              <input type="tel" class="form-control required phone" placeholder="Telefono *" id="phone" name="phone" required data-validation-required-message="Porfavor ingrese su telefono.">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <textarea class="form-control required" placeholder="Mensaje *" id="comment" name="comment" required data-validation-required-message="Porfavor ingrese un mensaje."></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12 text-center">
              <div id="success"></div>
              <div  class="btn btn-xl" id="send">Enviar mensaje</div>
            </div>
          </div>
        </form>

        <div id="message" style="display:none">
          <br />
          <div class="title"><strong>Gracias por registrarse</strong></div>
          <p>Su información se ha enviado con éxito, muy pronto estaremos en contacto con usted.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<script type="text/javascript">
  $(function(){
    prepareForm('#contactForm');
    $('#send').click(function(){
     if (!isValidate('#contactForm')){ alert('Debe completar los datos requeridos'); return false; }
     $('#contactForm').hide('slow');
     $('.contacto .text-center').hide('slow');
     $('#contactForm').after('<div id="loading">Enviando los datos...</div>');
        var formID=1; //Contactenos
        var fields=$('#contactForm').serialize();
        $.getJSON('<?php echo $URL_ROOT;?>ajax/form.php?formID='+formID+'&'+fields+'&callback=?', function(data) {
          if(data.retval==1){
            $('#loading').remove(); $('#message').show();
          }else{
            $('#contactForm').show('fast'); alert(data.message);
            $('.contacto .text-center').show('fast');
          }
        });
      });
  });
</script>




