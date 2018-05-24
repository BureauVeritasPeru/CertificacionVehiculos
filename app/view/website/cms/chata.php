<?php
$action  = OWASP::RequestString('action');

if($action == 'insert'){
	$cmd = 'insert';
	$chata= NULL;
	$planta = NULL;
	$chi = NULL;
	$inspector = NULL;

}else{
	$cmd = 'update';
	$ID = OWASP::RequestString('chiID');
	$chi = CrmChi::getItem($ID);
	$chata = CrmChata::getItem($ID);
	if($chata->plantaID != NULL){
		$planta = CrmPlanta::getItem($chata->plantaID);
	}
	if($chata->inspectorID != NUlL){
		$inspector = CrmInspector::getItem($chata->inspectorID); 
	}

	$oSisesat = CrmSisesat::getList($chata->chataID);
	if($oSisesat->getLength()>0){
		echo '<script>$(function() {';      
		$count=0;
		foreach ($oSisesat as $valor) {
			$count++; 
			echo '$("#tipoSisesat'.$count.'").val("'.$valor->tipoSisesat.'");';
			echo '$("#horaSisesat'.$count.'").val("'.$valor->horaSisesat.'");';
			if($valor->operatividadSisesat == '0' ) { echo '$("#operatividadSisesat'.$count.'N").prop("checked",true);'; }elseif($valor->operatividadSisesat == '1' ){echo '$("#operatividadSisesat'.$count.'Y").prop("checked",true);'; }
			if($valor->contestadoSisesat == '0' ) { echo '$("#contestadoSisesat'.$count.'N").prop("checked",true);'; }elseif($valor->contestadoSisesat == '1'){ echo '$("#contestadoSisesat'.$count.'Y").prop("checked",true);';}
		}
		echo '});</script>';
	}
}


?>


<script>
	$(function() {
		$('.carousel').carousel('pause');

	// Codigo para que con enter o tab funcione la busqueda interna de la planta
	$("#codigoPlanta").keydown(function(e) {
		if ( event.key == "Tab" ||  event.which == 13 ) {
			var dol = $("#codigoPlanta").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_planta.php?cod='+ dol, function(data) {
				if(data.retval==1){
					$('#nombrePlanta').val(data.nombre);
					$('#puertoPlanta').val(data.puerto);
					$('#zonaPlanta').val(data.zona);
				}else{
					alertify.error(data.message);
				}
			});
		}
	});
	// Edicion de Numero de Acta con el codigo de Planta
	$("#numeroActaDesembarque").keydown(function(e) {
		if ( event.key == "Tab" || event.which == 13 ) {
			var val = $("#numeroActaDesembarque").val();
			var planta = $("#codigoPlanta").val();
			var acta;
			if(planta != ""){
				$("#numeroActaDesembarque").val(planta + "-" + formatted_string('000000',val,'l'));
			}else{
				$("#numeroActaDesembarque").val();
			}
		}
	});

	// Codigo para que con enter o tab funcione la busqueda interna de los inspectores
	$("#codigoInspector").keydown(function(e) {
		if (  event.key == "Tab"  || event.which == 13 ) {
			var dol = $("#codigoInspector").val();
			$.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_inspector.php?cod='+ dol, function(data) {
				if(data.retval==1){
					$('#nombreInspector').val(data.nombre);
				}else{
					alertify.error(data.message);
				}
			});
		}
	});
});


	function formatted_string(pad, user_str, pad_pos)
	{
		if (typeof user_str === 'undefined') 
			return pad;
		if (pad_pos == 'l'){
			return (pad + user_str).slice(-pad.length);
		}
		else{
			return (user_str + pad).substring(0, pad.length);
		}
	}
</script>
<section class="content">
	<form name="form_chata" id="form_chata" > 
		<div class="row">
			<div class="col-md-12"><h2 class="box-title"><i class="fa fa-inbox"></i>&nbsp; Chata</h2></div>
		</div>
		<div class="row">
			<div class="col-md-12"><h2 class="box-title"></h2></div> <!--espaciado -->
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Codigo de Planta</label>
					<input name="codigoPlanta" id="codigoPlanta" type="text" class="form-control" value="<?php if($planta != NUll){ echo $planta->codigoPlanta; } ?>"  maxlength="255" autocomplete="off"> <!-- JS Function busqueda -->
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Nombre de la Planta</label>
					<input name="nombrePlanta" id="nombrePlanta" type="text" class="form-control" value="<?php if($chata != NUll){ echo $chata->nombrePlanta; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Puerto</label>
					<input name="puertoPlanta" id="puertoPlanta" type="text" class="form-control" value="<?php if($chata != NUll){ echo $chata->puertoPlanta; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Zona </label>
					<input name="zonaPlanta" id="zonaPlanta" type="text" class="form-control" value="<?php if($chata != NUll){ echo $chata->zonaPlanta; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label>Número de Acta de Desembarque E/P </label>
					<input name="numeroActaDesembarque" id="numeroActaDesembarque" type="text" class="form-control required" value="<?php if($chata != NUll){ echo $chata->numeroActaDesembarque; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label>Pesca Declarada (tm)</label>
					<input name="pescaDeclarada" id="pescaDeclarada" type="text" class="form-control" value="<?php if($chata != NUll){ echo $chata->pescaDeclarada; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div> 
		</div>


		<div class="row">
			<fieldset class="scheduler-border">
				<legend  class="scheduler-border" >SiseSat</legend>
				<div class="col-md-12"> 
					<div class="form-group">
						<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Tipo de Respuesta </label>
												<select name="tipoSisesat1" id="tipoSisesat1" class="form-control" autocomplete="off">
													<option value="0">Seleccionar</option> 
													<option value="1">LLamada</option>               
													<option value="2">Mensaje</option>               
												</select>
											</div>
										</div>
										<div class="col-md-2">
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label> Hora </label>
												<input name="horaSisesat1" id="horaSisesat1" type="time" class="form-control"  autocomplete="off">
											</div>
										</div>
										<div class="col-md-1">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Operatividad</label>
												<br>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="1" class="radio-primary" name="operatividadSisesat1" id="operatividadSisesat1Y"> 
													<label for="operatividadSisesat1Y">Si</label>
												</div>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="0" class="radio-primary" name="operatividadSisesat1" id="operatividadSisesat1N"> 
													<label for="operatividadSisesat1N">No</label>
												</div>
											</div>
										</div> 
										<div class="col-md-6">
											<div class="form-group">
												<label>LLamada Contestada</label>
												<br>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="1" class="radio-primary" name="contestadoSisesat1" id="contestadoSisesat1Y"> 
													<label for="contestadoSisesat1Y">Si</label>
												</div>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="0" class="radio-primary" name="contestadoSisesat1" id="contestadoSisesat1N"> 
													<label for="contestadoSisesat1N">No</label>
												</div>
											</div>
										</div> 
									</div>
								</div>
								<div class="item">
									<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Tipo de Respuesta </label>
												<select name="tipoSisesat2" id="tipoSisesat2" class="form-control" autocomplete="off">
													<option value="0">Seleccionar</option> 
													<option value="1">LLamada</option>               
													<option value="2">Mensaje</option>               
												</select>
											</div>
										</div>
										<div class="col-md-2">
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label> Hora </label>
												<input name="horaSisesat2" id="horaSisesat2" type="time" class="form-control"  autocomplete="off">
											</div>
										</div>
										<div class="col-md-1">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Operatividad</label>
												<br>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="1" class="radio-primary" name="operatividadSisesat2" id="operatividadSisesat2Y"> 
													<label for="operatividadSisesat2Y">Si</label>
												</div>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="0" class="radio-primary" name="operatividadSisesat2" id="operatividadSisesat2N"> 
													<label for="operatividadSisesat2N">No</label>
												</div>
											</div>
										</div> 
										<div class="col-md-6">
											<div class="form-group">
												<label>LLamada Contestada</label>
												<br>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="1" class="radio-primary" name="contestadoSisesat2" id="contestadoSisesat2Y"> 
													<label for="contestadoSisesat2Y">Si</label>
												</div>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="0" class="radio-primary" name="contestadoSisesat2" id="contestadoSisesat2N"> 
													<label for="contestadoSisesat2N">No</label>
												</div>
											</div>
										</div> 
									</div>
								</div>
								<div class="item">
									<div class="row">
										<div class="col-md-1">
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Tipo de Respuesta </label>
												<select name="tipoSisesat3" id="tipoSisesat3" class="form-control" autocomplete="off">
													<option value="0">Seleccionar</option> 
													<option value="1">LLamada</option>               
													<option value="2">Mensaje</option>               
												</select>
											</div>
										</div>
										<div class="col-md-2">
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label> Hora </label>
												<input name="horaSisesat3" id="horaSisesat3" type="time" class="form-control" value=""  maxlength="255" autocomplete="off">
											</div>
										</div>
										<div class="col-md-1">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Operatividad</label>
												<br>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="1" class="radio-primary" name="operatividadSisesat3" id="operatividadSisesat3Y"> 
													<label for="operatividadSisesat3Y">Si</label>
												</div>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="0" class="radio-primary" name="operatividadSisesat3" id="operatividadSisesat3N"> 
													<label for="operatividadSisesat3N">No</label>
												</div>
											</div>
										</div> 
										<div class="col-md-6">
											<div class="form-group">
												<label>LLamada Contestada</label>
												<br>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="1" class="radio-primary" name="contestadoSisesat3" id="contestadoSisesat3Y"> 
													<label for="contestadoSisesat3Y">Si</label>
												</div>
												<div class="radio radio-primary radio-inline">
													<input type="radio" value="0" class="radio-primary" name="contestadoSisesat3" id="contestadoSisesat3N"> 
													<label for="contestadoSisesat3N">No</label>
												</div>
											</div>
										</div> 
									</div>
								</div>
							</div>
							<!-- Left and right controls -->
							<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="background-image: none !important;width:0;">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="background-image: none !important;width:0;">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Cierre de Puerto </label>
					<br>
					<div class="radio radio-primary radio-inline">
						<input type="radio" value="1" class="radio-primary" name="cierrePuerto" id="cierrePuertoY" <?php if($chata != NUll){ echo ($chata->cierrePuerto == 1) ? 'checked':''; }?>> 
						<label for="cierrePuertoY">Si</label>
					</div>
					<div class="radio radio-primary radio-inline">
						<input type="radio" value="0" class="radio-primary" name="cierrePuerto" id="cierrePuertoN" <?php if($chata != NUll){ echo ($chata->cierrePuerto == 0) ? 'checked':''; }?>> 
						<label for="cierrePuertoN">No</label>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Codigo del Inspector </label>
					<input name="codigoInspector" id="codigoInspector" type="text" class="form-control" autocomplete="off" value="<?php if($inspector != NUll){ echo $inspector->codigoInspector; } ?>">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Nombre del Inspector</label>
					<input name="nombreInspector" id="nombreInspector" type="text" class="form-control" value="<?php if($chata != NUll){ echo $chata->nombreInspector; } ?>" maxlength="255" autocomplete="off">
				</div>
			</div> 
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Observación Inusual</label>
					<select name="obsInusual" id="obsInusual" class="form-control" autocomplete="off">
						<option value="0">Seleccione su observación</option> 
						<?php
					$list= CmsParameterLang::getList(2, 1); //Observaciones Inusuales
					foreach ($list as $obj) {
						echo "<option value=\"".$obj->parameterID."\"";
						if($chata != NULL){if($obj->parameterName==$chata->obsInusual) echo " selected";}
						echo ">".$obj->parameterName."</option>";
					}
					?>   
				</select>
			</div>
		</div> 
		<div class="col-md-2">
			<div class="form-group">
				<label>Local del CHI</label>
				<select name="localID" id="localID" class="form-control" autocomplete="off">
					<option value="0">Seleccione su local</option> 
					<?php
					$list= CmsParameterLang::getList(3, 1); //Observaciones Inusuales
					foreach ($list as $obj) {
						echo "<option value=\"".$obj->parameterID."\"";
						if($chi != NUll){if($obj->parameterID==$chi->localID) echo " selected";}
						echo ">".$obj->parameterName."</option>";
					}
					?>   
				</select>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<label>Certificacion</label>
				<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target=".bs-modal-chata">Lista</button>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<label>Pendiente</label>
				<br>
				<div class="radio radio-primary radio-inline">
					<input type="radio" value="1" class="radio-primary" name="pendiente" id="pendienteY" <?php if($chi != NUll){ echo ($chi->pendiente == 1) ? 'checked':''; }?>> 
					<label for="pendienteY">Si</label>
				</div>
				<div class="radio radio-primary radio-inline">
					<input type="radio" value="0" class="radio-primary" name="pendiente" id="pendienteN" <?php if($chi != NUll){ echo ($chi->pendiente == 0) ? 'checked':''; }?>> 
					<label for="pendienteN">No</label>
				</div>
			</div>
		</div>

		<input type="hidden" value="<?php echo $oUser->userID; ?>" name="userID" id="userID" > 
		<div class="col-md-2">
			<label></label>
			<div class="btn btn-info btn-block" name="btnCrear" id="back_chata"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;regresar</div>
		</div>
		<div class="col-md-2">
			<label></label>
			<div class="btn btn-primary btn-block" name="btnCrear" id="send_chata">Siguiente&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></div>
		</div>
	</div>

	<div class="modal fade bs-modal-chata" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" id="modal-frame">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="gridSystemModalLabel">Certificado de Inspección</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Identificación correcta de la Embarcación Pesquera</label>
								<br>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="1" class="radio-primary" name="pregunta1" id="pregunta1Y" <?php if($chata != NUll){ echo ($chata->pregunta1 == 1) ? 'checked':''; }?>> 
									<label for="pregunta1Y">Si</label>
								</div>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="0" class="radio-primary" name="pregunta1" id="pregunta1N" <?php if($chata != NUll){ echo ($chata->pregunta1 == 0) ? 'checked':''; }?>> 
									<label for="pregunta1N">No</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Equipo SISESAT operativo y código de identificación correcto</label>
								<br>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="1" class="radio-primary" name="pregunta2" id="pregunta2Y" <?php if($chata != NUll){ echo ($chata->pregunta2 == 1) ? 'checked':''; }?>> 
									<label for="pregunta2Y">Si</label>
								</div>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="0" class="radio-primary" name="pregunta2" id="pregunta2N" <?php if($chata != NUll){ echo ($chata->pregunta2 == 0) ? 'checked':''; }?>> 
									<label for="pregunta2N">No</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Verificar la integridad del precinto de seguridad SISESAT y número correcto</label>
								<br>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="1" class="radio-primary" name="pregunta3" id="pregunta3Y" <?php if($chata != NUll){ echo ($chata->pregunta3 == 1) ? 'checked':''; }?>> 
									<label for="pregunta3Y">Si</label>
								</div>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="0" class="radio-primary" name="pregunta3" id="pregunta3N" <?php if($chata != NUll){ echo ($chata->pregunta3 == 0) ? 'checked':''; }?>> 
									<label for="pregunta3N">No</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Embarcación Nominada </label>
								<br>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="1" class="radio-primary" name="pregunta4" id="pregunta4Y" <?php if($chata != NUll){ echo ($chata->pregunta4 == 1) ? 'checked':''; }?>> 
									<label for="pregunta4Y">Si</label>
								</div>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="0" class="radio-primary" name="pregunta4" id="pregunta4N" <?php if($chata != NUll){ echo ($chata->pregunta4 == 0) ? 'checked':''; }?>> 
									<label for="pregunta4N">No</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>&nbsp;</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>&nbsp;</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Permiso de pesca vigente</label>
								<br>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="1" class="radio-primary" name="pregunta5" id="pregunta5Y" <?php if($chata != NUll){ echo ($chata->pregunta5 == 1) ? 'checked':''; }?>> 
									<label for="pregunta5Y">Si</label>
								</div>
								<div class="radio radio-primary radio-inline">
									<input type="radio" value="0" class="radio-primary" name="pregunta5" id="pregunta5N" <?php if($chata != NUll){ echo ($chata->pregunta5 == 0) ? 'checked':''; }?>> 
									<label for="pregunta5N">No</label>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>&nbsp;</label>

							</div>
						</div>
					</div>          
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(function(){
		prepareForm('#form_chata');
		$('#send_chata').click(function(){
			<?php if($cmd!='update'){ ?>
				$.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_acta_embarque.php?cmd=insert&acta='+ $("#numeroActaDesembarque").val(), function(data) {
					if(data.retval==1){
					}else{
						$("#numeroActaDesembarque").focus();
						alertify.error(data.message);
						return false; 
					}
				});
				<?php }else{ ?>
					$.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_acta_embarque.php?cmd=update&ID=<?php echo $ID;?>&acta='+ $("#numeroActaDesembarque").val(), function(data) {
						if(data.retval==1){

						}else{
							$("#numeroActaDesembarque").focus();
							alertify.error(data.message);
							return false; 
						}
					});

					<?php } ?>


					if($('#localID').val() == '0'){alertify.error('Seleccione porfavor el local.'); return false;  }


					if ( ! $("#pendienteY").is(':checked') && ! $("#pendienteN").is(':checked') ){ alertify.error('Seleccione si el acta es pendiente ó no.'); return false;  }


					bootbox.confirm({
						title: "Produce - Bureau Veritas",
						message: "Estas seguro de guardar los datos?",
						buttons: {
							cancel: {
								label: '<i class="fa fa-times"></i> Cancelar'
							},
							confirm: {
								label: '<i class="fa fa-check"></i> Confirmar'
							}
						},
						callback: function (result) {
							if(result){
								if (!isValidate('#form_chata')){ 
									alertify.error('Porfavor ingrese datos validos.'); 
									return false; 
								}
								var fields3=$('#form_chata').serialize();
								<?php if($cmd!='update'){ ?>
									$.getJSON('<?php echo $URL_ROOT;?>ajax/form_chata.php?cmd=insert&'+fields3, function(data) {
										if(data.retval==1){
											alertify.success(data.message);
											$('.sombra').show();
											setTimeout(function(){
												location.href='<?php echo $URL_ROOT;?>chi/tolva.html?action=insert&ID='+data.chiID;
											}, 2000);
										}else{
											alertify.error(data.message);
										}
									});
									<?php }else{ ?>
										$.getJSON('<?php echo $URL_ROOT;?>ajax/form_chata.php?cmd=update&ID=<?php echo $ID;?>&'+fields3, function(data) {
											if(data.retval==1){
												alertify.success(data.message);
												$('.sombra').show();
												setTimeout(function(){
													location.href='<?php echo $URL_ROOT;?>chi/tolva.html?action=update&ID='+data.chiID;
												}, 2000);
											}else{
												alertify.error(data.message);
											}
										});
										<?php } ?>
									}
								}
							});





				});
	});



	$('#back_chata').click(function(){
		location.href='<?php echo $URL_ROOT;?>chi.html';
	});
</script>




</section>