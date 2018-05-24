<div id="recomienda"><div class="bgImg"></div>
  <form id="frmRecom">
    <p>Recomienda esta web</p>
    <input name="name" id="rec_name" class="required" placeholder="Su nombre *">
    <input name="name_to" id="rec_name_to" class="required" placeholder="Nombre de su amigo *">
    <input name="mail_to" id="rec_mail_to" class="required email" placeholder="E-mail de su amigo *">
    <input class="boton" id="rec_submit" type="button" value="Enviar">
    <input class="boton" id="rec_cancel" type="button" value="Cerrar">
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
	function rec_close(){
		var base=$('#nube').find("img").attr('base');
		$('#nube').find("img").attr('src',base+'images/nube.png');
		$('#recomienda').hide('slow');
	}
	$('#rec_cancel').click(function(){
		rec_close();
	});
	$('#rec_submit').click(function(){
		if (!isValidate("#frmRecom")) return false;
		
		var fields=$('#frmRecom').serialize();
		$.getJSON('<?php echo SEO::get_URLRoot();?>ajax/recomienda.php?send=true&'+fields+'&callback=?', function(data) {
			alert(data.message);
			if(data.retval==1){
				rec_close();
			}
		});

	});
});
</script>