 <?php
 $action  = OWASP::RequestString('action');
 $chiID  = OWASP::RequestString('ID');
 if($action == 'insert'){
 	$cmd = 'insert';
 	$inspector = NULL;
 	$muestreo = NULL;
 	$chata = CrmChata::getItem($chiID);
 	if($chata->plantaID != NULL){
 		$planta = CrmPlanta::getItem($chata->plantaID);
 	}
 }else{
 	$cmd = 'update';
 	$inspector = NULL;
 	$muestreo = NULL;
 	$chiID = OWASP::RequestString('ID');
 	$muestreo = CrmMuestreo::getItemCHI($chiID);
 	$chata = CrmChata::getItem($chiID);
 	if($chata->plantaID != NULL){
 		$planta = CrmPlanta::getItem($chata->plantaID);
 	}
 	if($muestreo == NULL){
 		$cmd = 'insert';
 	}else
 	{
 		if($muestreo->inspectorID != NUlL){
 			$inspector = CrmInspector::getItem($muestreo->inspectorID); 
 		}
 	} 


 }


 ?>
 <script src="<?php echo $URL_BASE;?>js/custom.js"></script>
 <script>

 	$(function() {
  // Edicion de Numero de Acta con el codigo de Planta
  $("#nroParteMuestreo").keydown(function(e) {
  	if ( event.key == "Tab" || event.which == 13 ) {
  		var val = $("#nroParteMuestreo").val();
  		var planta = '<?php echo $planta->codigoPlanta; ?>';
  		if(planta != ""){
  			$("#nroParteMuestreo").val(planta + "-" + formatted_string('000000',val,'l'));
  		}else{
  			$("#nroParteMuestreo").val();
  		}
  	}
  });
  $("#numeroActaMuestreo").keydown(function(e) {
  	if ( event.key == "Tab" || event.which == 13 ) {
  		var val = $("#numeroActaMuestreo").val();
  		var planta = '<?php echo $planta->codigoPlanta; ?>';
  		if(planta != ""){
  			$("#numeroActaMuestreo").val(planta + "-" + formatted_string('000000',val,'l'));
  		}else{
  			$("#numeroActaMuestreo").val();
  		}
  	}
  });
  // Codigo para que con enter o tab funcione la busqueda interna de los inspectores
  $("#codigoInspector").keydown(function(e) {
  	if ( event.which == 13 || event.key == "Tab" ) {
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
 	<form name="form_muestreo" id="form_muestreo" > 
 		<div class="row">
 			<div class="col-md-12"><h2 class="box-title"><i class="fa fa-inbox"></i>&nbsp;Muestreo</h2></div>
 		</div>
 		<div class="row">
 			<div class="col-md-12"><h2 class="box-title"></h2></div> <!--espaciado -->
 		</div>
 		<div class="row">
 			<div class="col-md-4">
 			</div>
 			<div class="col-md-4">
 				<div class="form-group">
 					<label>Número de Parte de Muestreo</label>
 					<input name="nroParteMuestreo" id="nroParteMuestreo" type="text" class="form-control" value="<?php if($muestreo != NUll){ echo $muestreo->nroParteMuestreo; } ?>"  maxlength="255" autocomplete="off">
 				</div>
 			</div>
 			<div class="col-md-4">
 			</div>
 		</div>
 		<div class="row">
 			<fieldset class="scheduler-border">
 				<legend  class="scheduler-border" >Pesca Incidental</legend>
 				<div class="col-md-12"> 
 					<div class="form-group">
 						<div class="row">
 							<div class="col-md-3">
 								<div class="form-group">
 									<label>Especie 1</label>
 									<select name="especie1ID" id="especie1ID" class="form-control" autocomplete="off">
 										<option value="0">Seleccione su especie</option> 
 										<?php
								          $list= CmsParameterLang::getList(4, 1); //Observaciones Inusuales
								          foreach ($list as $obj) {
								          	echo "<option value=\"".$obj->parameterID."\"";
								          	if($muestreo != NULL){if($obj->parameterID==$muestreo->especie1ID) echo " selected";}
								          	echo ">".$obj->parameterName."</option>";
								          }
								          ?>   
								      </select>
								  </div>
								</div> 
								<div class="col-md-3">
									<div class="form-group">
										<label>Porcentaje %</label>
										<input name="porcEspecie1" id="porcEspecie1" type="text" class="only_float form-control" value="<?php if($muestreo != NUll){ echo $muestreo->porcEspecie1; } ?>"  maxlength="255" autocomplete="off">	
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Especie 2</label>
										<select name="especie2ID" id="especie2ID" class="form-control" autocomplete="off">
											<option value="0">Seleccione su especie</option> 
											<?php
							          $list= CmsParameterLang::getList(4, 1); //Observaciones Inusuales
							          foreach ($list as $obj) {
							          	echo "<option value=\"".$obj->parameterID."\"";
							          	if($muestreo != NULL){if($obj->parameterID==$muestreo->especie2ID) echo " selected";}
							          	echo ">".$obj->parameterName."</option>";
							          }
							          ?>   
							      </select>
							  </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Porcentaje %</label>
									<input name="porcEspecie2" id="porcEspecie2" type="text" class="only_float form-control" value="<?php if($muestreo != NUll){ echo $muestreo->porcEspecie2; } ?>"  maxlength="255" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Especie 3</label>
									<select name="especie3ID" id="especie3ID" class="form-control" autocomplete="off">
										<option value="0">Seleccione su especie</option> 
										<?php
							          $list= CmsParameterLang::getList(4, 1); //Observaciones Inusuales
							          foreach ($list as $obj) {
							          	echo "<option value=\"".$obj->parameterID."\"";
							          	if($muestreo != NULL){if($obj->parameterID==$muestreo->especie3ID) echo " selected";}
							          	echo ">".$obj->parameterName."</option>";
							          }
							          ?>   
							      </select>
							  </div>
							</div> 
							<div class="col-md-3">
								<div class="form-group">
									<label>Porcentaje %</label>
									<input name="porcEspecie3" id="porcEspecie3" type="text" class="only_float form-control" value="<?php if($muestreo != NUll){ echo $muestreo->porcEspecie3; } ?>"  maxlength="255" autocomplete="off">	
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Especie 4</label>
									<select name="especie4ID" id="especie4ID" class="form-control" autocomplete="off">
										<option value="0">Seleccione su especie</option> 
										<?php
							          $list= CmsParameterLang::getList(4, 1); //Observaciones Inusuales
							          foreach ($list as $obj) {
							          	echo "<option value=\"".$obj->parameterID."\"";
							          	if($muestreo != NULL){if($obj->parameterID==$muestreo->especie4ID) echo " selected";}
							          	echo ">".$obj->parameterName."</option>";
							          }
							          ?>   
							      </select>
							  </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Porcentaje %</label>
									<input name="porcEspecie4" id="porcEspecie4" type="text" class="only_float form-control" value="<?php if($muestreo != NUll){ echo $muestreo->porcEspecie4; } ?>"  maxlength="255" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
							</div> 
							<div class="col-md-3">
								<div class="form-group">
									<label>Especie 5</label>
									<select name="especie5ID" id="especie5ID" class="form-control" autocomplete="off">
										<option value="0">Seleccione su especie</option> 
										<?php
							          $list= CmsParameterLang::getList(4, 1); //Observaciones Inusuales
							          foreach ($list as $obj) {
							          	echo "<option value=\"".$obj->parameterID."\"";
							          	if($muestreo != NULL){if($obj->parameterID==$muestreo->especie5ID) echo " selected";}
							          	echo ">".$obj->parameterName."</option>";
							          }
							          ?>   
							      </select>
							  </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label>Porcentaje %</label>
									<input name="porcEspecie5" id="porcEspecie5" type="text" class="only_float form-control" value="<?php if($muestreo != NUll){ echo $muestreo->porcEspecie5; } ?>"  maxlength="255" autocomplete="off">
								</div>
							</div>
							<div class="col-md-3">
							</div>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Reporte de Cala</label>
					<br>
					<div class="radio radio-primary radio-inline">
						<input type="radio" value="1" class="radio-primary" name="reporteCala" id="reporteCalaY" <?php if($muestreo != NUll){ echo ($muestreo->reporteCala == 1) ? 'checked':''; }?>> 
						<label for="reporteCalaY">Si</label>
					</div>
					<div class="radio radio-primary radio-inline">
						<input type="radio" value="0" class="radio-primary" name="reporteCala" id="reporteCalaN" <?php if($muestreo != NUll){ echo ($muestreo->reporteCala == 0) ? 'checked':''; }?>> 
						<label for="reporteCalaN">No</label>
					</div>
				</div>
			</div> 

			<div class="col-md-5">
				<div class="form-group">
					<label>Estadío</label>
					<input name="estadio" id="estadio" type="text" class="form-control"  value="<?php if($muestreo != NUll){ echo $muestreo->estadio; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label>Zona de Pesca</label>
					<input name="zonaPesca" id="zonaPesca" type="text" class="form-control"  value="<?php if($muestreo != NUll){ echo $muestreo->zonaPesca; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Codigo del inspector</label>
					<input name="codigoInspector" id="codigoInspector" type="text" class="form-control" value="<?php if($inspector != NUll){ echo $inspector->codigoInspector; } ?>"  maxlength="255" autocomplete="off"> 
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
					<label>Nombre del Inspector</label>
					<input name="nombreInspector" id="nombreInspector" type="text" class="form-control" value="<?php if($muestreo != NUll){ echo $muestreo->nombreInspector; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Número de Acta de Inspección de Muestreo</label>
					<input name="numeroActaMuestreo" id="numeroActaMuestreo" type="text" class="form-control" value="<?php if($muestreo != NUll){ echo $muestreo->numeroActaMuestreo; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-highlight table-hover table-chi">
						<thead >
							<th style="text-align: center;" colspan="22"><a>Moda</a></th>
						</thead>
						<tbody>
							<tr>
								<td>cm</td>
								<td>8</td>
								<td>8.5</td>
								<td>9</td>
								<td>9.5</td>
								<td>10</td>
								<td>10.5</td>
								<td>11</td>
								<td>11.5</td>
								<td>12</td>
								<td>12.5</td>
								<td>13</td>
								<td>13.5</td>
								<td>14</td>
								<td>14.5</td>
								<td>15</td>
								<td>15.5</td>
								<td>16</td>
								<td>16.5</td>
								<td>17</td>
								<td>17.5</td>
								<td>18</td>
							</tr>
							<tr>
								<td>frecuencia</td>
								<td><input  class="only_float form-control" id="8" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia8; }else{ echo '0';}  ?>" name="frecuencia8" ></td>
								<td><input  class="only_float form-control" id="8_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia8_5;}else{ echo '0';}  ?>" name="frecuencia8_5"></td>
								<td><input  class="only_float form-control" id="9" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia9; } else{ echo '0';}  ?>" name="frecuencia9"   ></td>
								<td><input  class="only_float form-control" id="9_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia9_5; }else{ echo '0';}   ?>" name="frecuencia9_5"></td>
								<td><input  class="only_float form-control" id="10" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia10; }else{ echo '0';}   ?>" name="frecuencia10" "  ></td>
								<td><input  class="only_float form-control" id="10_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia10_5;}else{ echo '0';}    ?>" name="frecuencia10_5"></td>
								<td><input  class="only_float form-control" id="11" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia11; }else{ echo '0';}   ?>" name="frecuencia11" "  ></td>
								<td><input  class="only_float form-control" id="11_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia11_5;}else{ echo '0';}    ?>" name="frecuencia11_5"></td>
								<td><input  class="only_float form-control" id="12" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia12; }else{ echo '0';}   ?>" name="frecuencia12" "  ></td>
								<td><input  class="only_float form-control" id="12_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia12_5;}else{ echo '0';}    ?>" name="frecuencia12_5"></td>
								<td><input  class="only_float form-control" id="13" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia13; }else{ echo '0';}   ?>" name="frecuencia13" "  ></td>
								<td><input  class="only_float form-control" id="13_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia13_5;}else{ echo '0';}    ?>" name="frecuencia13_5"></td>
								<td><input  class="only_float form-control" id="14" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia14; }else{ echo '0';}   ?>" name="frecuencia14" "  ></td>
								<td><input  class="only_float form-control" id="14_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia14_5;}else{ echo '0';}    ?>" name="frecuencia14_5"></td>
								<td><input  class="only_float form-control" id="15" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia15; }else{ echo '0';}   ?>" name="frecuencia15" "  ></td>
								<td><input  class="only_float form-control" id="15_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia15_5;}else{ echo '0';}    ?>" name="frecuencia15_5"></td>
								<td><input  class="only_float form-control" id="16" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia16; }else{ echo '0';}   ?>" name="frecuencia16" "  ></td>
								<td><input  class="only_float form-control" id="16_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia16_5;}else{ echo '0';}    ?>" name="frecuencia16_5"></td>
								<td><input  class="only_float form-control" id="17" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia17; }else{ echo '0';}   ?>" name="frecuencia17" "  ></td>
								<td><input  class="only_float form-control" id="17_5" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia17_5;}else{ echo '0';}    ?>" name="frecuencia17_5"></td>
								<td><input  class="only_float form-control" id="18" value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia18; }else{ echo '0';}   ?>" name="frecuencia18" "  ></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Total de Ejemplares</label>
					<input name="totalEjemplares" id="totalEjemplares" type="text" class="form-control block" readonly value="<?php if($muestreo != NUll){ echo $muestreo->totalEjemplares; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Moda</label>
					<input name="moda" id="moda" type="text" class="form-control block" readonly value="<?php if($muestreo != NUll){ echo $muestreo->moda; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Frecuencia</label>
					<input name="frecuencia" id="frecuencia" type="text" class="form-control block" readonly value="<?php if($muestreo != NUll){ echo $muestreo->frecuencia; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Porcentaje de Juveniles</label>
					<input name="porcJuveniles" id="porcJuveniles" type="text" class="form-control block" readonly value="<?php if($muestreo != NUll){ echo $muestreo->porcJuveniles; } ?>"  maxlength="255" autocomplete="off">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Observaciones</label>
					<textarea name="observaciones" id="observaciones" type="text" class="form-control" maxlength="255" autocomplete="off"><?php if($muestreo != NUll){ echo $muestreo->observaciones; } ?></textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<label>Observación Inusual</label>
					<select name="obsInusual" id="obsInusual" class="form-control" autocomplete="off">
						<option value="0">Seleccione su observación</option> 
						<?php
				          $list= CmsParameterLang::getList(2, 1); //Observacion0es Inusuales
				          foreach ($list as $obj) {
				          	echo "<option value=\"".$obj->parameterID."\"";
				          	if($muestreo != NULL){if($obj->parameterName==$muestreo->obsInusual) echo " selected";}
				          	echo ">".$obj->parameterName."</option>";
				          }
				          ?>   
				      </select>
				  </div>
				</div> 
				<div class="col-md-2">
				</div>
				<div class="col-md-1">
					<div class="form-group">
						<label>Certificacion</label>
						<button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target=".bs-modal-muestreo">Lista</button>
					</div>
				</div>
				<input type="hidden" value="<?php echo $oUser->userID; ?>" name="userID" id="userID" > 
				<input type="hidden" value="<?php echo $chiID; ?>" name="ID" id="ID" > 
				<div class="col-md-2">
					<label></label>
					<div class="btn btn-info btn-block" name="btnCrear" id="back_muestreo"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;regresar</div>
				</div>
				<div class="col-md-2">
					<label></label>
					<div class="btn btn-primary btn-block" name="btnCrear" id="send_tolva">Siguiente&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></div>
				</div>
			</div>
			<div class="modal fade bs-modal-muestreo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
										<label>Porcentaje de juveniles es menor o igual al máximo permitido.</label>
										<br>
										<div class="radio radio-primary radio-inline">
											<input type="radio" value="1" class="radio-primary" name="pregunta11" id="pregunta11Y" <?php if($muestreo != NUll){ echo ($muestreo->pregunta11 == 1) ? 'checked':''; }?>> 
											<label for="pregunta11Y">Si</label>
										</div>
										<div class="radio radio-primary radio-inline">
											<input type="radio" value="0" class="radio-primary" name="pregunta11" id="pregunta11N" <?php if($muestreo != NUll){ echo ($muestreo->pregunta11 == 0) ? 'checked':''; }?>> 
											<label for="pregunta11N">No</label>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Tomar tres (03) muestras teniendo en cuenta la pesca declarada, la primera toma se efectuará dentro del 30% de iniciada la descarga y las otras dos (02) tomas dentro del 70% restante.</label>
										<br>
										<div class="radio radio-primary radio-inline">
											<input type="radio" value="1" class="radio-primary" name="pregunta12" id="pregunta12Y" <?php if($muestreo != NUll){ echo ($muestreo->pregunta12 == 1) ? 'checked':''; }?>> 
											<label for="pregunta12Y">Si</label>
										</div>
										<div class="radio radio-primary radio-inline">
											<input type="radio" value="0" class="radio-primary" name="pregunta12" id="pregunta12N" <?php if($muestreo != NUll){ echo ($muestreo->pregunta12 == 0) ? 'checked':''; }?>> 
											<label for="pregunta2N">No</label>
										</div>
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
				prepareForm('#form_muestreo');
				$('#send_tolva').click(function(){
					bootbox.confirm({
						title: "Produce - Bureau Veritas",
						message: "Estas seguro de guardar los datos de Muestreo?",
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
								if (!isValidate('#form_muestreo')){ alertify.error('Porfavor ingrese datos validos.'); return false; }
								var fields3=$('#form_muestreo').serialize();
								<?php if($cmd!='update'){ ?>
									$.getJSON('<?php echo $URL_ROOT;?>ajax/form_muestreo.php?cmd=insert&'+fields3, function(data) {
										if(data.retval==1){
											alertify.success(data.message);
											$('.sombra').show();
											setTimeout(function(){
												location.href='<?php echo $URL_ROOT;?>chi/cala.html?action=insert&ID='+data.chiID;
											}, 3000);
										}else{
											alertify.error(data.message);
										}
									});
									<?php }else{ ?>
										$.getJSON('<?php echo $URL_ROOT;?>ajax/form_muestreo.php?cmd=update&ID=<?php echo $chiID;?>&'+fields3, function(data) {
											if(data.retval==1){
												$('.sombra').show();
												alertify.success(data.message);
												setTimeout(function(){
													location.href='<?php echo $URL_ROOT;?>chi/cala.html?action=update&ID='+data.chiID;
												}, 3000);
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

			$('#back_muestreo').click(function(){
				location.href='<?php echo $URL_ROOT;?>chi/tolva.html?action=update&ID=<?php echo $chiID; ?>';
			});
		</script>




	</section>