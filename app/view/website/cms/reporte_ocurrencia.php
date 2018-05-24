<?php
$action  = OWASP::RequestString('action');
$chiID  = OWASP::RequestString('ID');
$ro1 = NULL;
$ro2 = NULL;
$ro3 = NULL;
$inspector1 = NULL;
$inspector2 = NULL;
$inspector3 = NULL;
for ($i=1; $i < 4; $i++) { 
	for ($j=1; $j< 4 ; $j++) { 
		${'infraccion'.$i.'_'.$j} = NULL;
	}
}
if($action == 'insert'){
	$cmd = 'insert';
	$chata = CrmChata::getItem($chiID);
	if($chata->plantaID != NULL){
		$planta = CrmPlanta::getItem($chata->plantaID);
	}
}else{ 
	$cmd = 'update';
	$ro1 = CrmReporteOcurrencia::getItemCHI($chiID,1);
	$chata = CrmChata::getItem($chiID);
	if($chata->plantaID != NULL){
		$planta = CrmPlanta::getItem($chata->plantaID);
	}
	if($ro1 == NULL){
		$cmd = 'insert';
	}else
	{ 
		$count = 0;
		$countdet=0;
		$ro = CrmReporteOcurrencia::getList($chiID);
		foreach ($ro as $valor) {
			$count++;
			${'ro'.$count} = new eCrmReporteOcurrencia();
			${'ro'.$count} = $valor;
			if(${'ro'.$count}->inspectorID != NUlL){
				${'inspector'.$count} = CrmInspector::getItem(${'ro'.$count}->inspectorID); 
			}
			$fraccion = CrmInfraccion::getList(${'ro'.$count}->reporteOcurrenciaID);
			foreach ($fraccion as $detail) {
				$countdet++;
				${'infraccion'.$count.'_'.$countdet} = new eCrmInfraccion();
				${'infraccion'.$count.'_'.$countdet}       = $detail;
			}
		}
	} 

}


?>



<script>
	$(function() {
		$('.carousel').carousel('pause');

		<?php for ($i = 1; $i < 4; $i++) { ?>
			<?php if(${'ro'.$i} != NUlL){ ?>
				$('#subCodigoNumeroDecomiso<?php echo $i;?> option').each(function() {
					if($(this).val() == '<?php echo ${'ro'.$i}->subCodigoNumeroDecomiso; ?>') {
						$(this).prop("selected", true);
					}
				});
				<?php } ?>
			// Edicion de Numero de Acta con el codigo de Planta
			$("#numReporteOcurrencia<?php echo $i; ?>").keydown(function(e) {
				if ( event.key == "Tab" || event.which == 13 ) {
					var val = $("#numReporteOcurrencia<?php echo $i; ?>").val();
					var planta = '<?php echo $planta->codigoPlanta; ?>';
					if(planta != "" && val != ""){
						$("#numReporteOcurrencia<?php echo $i; ?>").val(planta + "-" + formatted_string('000000',val,'l'));
					}else{
						$("#numReporteOcurrencia<?php echo $i; ?>").val();
					}
				}
			});
			// Codigo para que con enter o tab funcione la busqueda interna de los inspectores
			$("#codigoInspector<?php echo $i; ?>").keydown(function(e) {
				if ( event.which == 13 || event.key == "Tab" ) {
					var dol = $("#codigoInspector<?php echo $i; ?>").val();
					$.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_inspector.php?cod='+ dol, function(data) {
						if(data.retval==1){
							$("#nombreInspector<?php echo $i; ?>").val(data.nombre);
						}else{
							alertify.error(data.message);
						}
					});
				}
			});
			<?php for ($j = 0; $j < 4; $j++) { ?>
				$( "#codigoInfraccion<?php echo $i ?>_<?php echo $j ?>" ).change(function() {
					var dol = $("#codigoInfraccion<?php echo $i ?>_<?php echo $j ?>").val();
					$.getJSON('<?php echo $URL_ROOT;?>ajax/consulta_infraccion.php?cod='+ dol, function(data) {
						if(data.retval==1){
							$("#detalleInfraccion<?php echo $i ?>_<?php echo $j ?>").val(data.nombre);
						}else{
							alertify.error(data.message);
						}
					});
				});

				<?php } 
			} ?>		


			
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
	<form name="form_ro" id="form_ro" > 
		<div class="row">
			<div class="col-md-12"><h2 class="box-title"><i class="fa fa-inbox"></i>&nbsp; Reporte De Ocurrencia</h2></div>
		</div>
		<div class="row">
			<div class="col-md-12"><h2 class="box-title"></h2></div> <!--espaciado -->
		</div>
		<div class="row">
			<fieldset class="scheduler-border">
				<div class="col-md-12"> 
					<div class="form-group">
						<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
							<div class="carousel-inner" role="listbox">
								<div class="item active" style="padding: 30px;">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label> Número de Reporte de Ocurrencia 1</label>
												<input name="numReporteOcurrencia1" id="numReporteOcurrencia1" type="text" class="form-control" value="<?php if($ro1 != NUll){ echo $ro1->numReporteOcurrencia; } ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-8">
										</div>
									</div>
									<div class="row">	
										<div class="col-md-12 ">
											<!-- Nav tabs -->
											<div class="col-xs-3" style="padding-right: 0px;">
												<ul class="nav nav-tabs tabs-left" style="padding-top: 0px;">
													<li role="presentation" class="active"><a href="#infraccion1_1"  data-toggle="tab" id="tab1_1" >Infraccion 1</a></li>
													<li role="presentation"><a href="#infraccion1_2" data-toggle="tab" id="tab1_2" >Infraccion 2</a></li>
													<li role="presentation"><a href="#infraccion1_3" data-toggle="tab" id="tab1_3" >Infraccion 3</a></li>
												</ul>
											</div>
											<div class="col-xs-9" style="padding-left: 0px;">
												<div class="tab-content">
													<div  class="tab-pane active" id="infraccion1_1">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>Código</label>
																	<select name="codigoInfraccion1_1" id="codigoInfraccion1_1" class="form-control" autocomplete="off">
																		<option value="0">Seleccione su Codigo</option> 
																		<?php
															          $list= CmsParameterLang::getList(5, 1); //Observaciones Inusuales
															          foreach ($list as $obj) {
															          	echo "<option value=\"".$obj->parameterID."\"";
															          	if($infraccion1_1 != NULL){if($obj->parameterID==$infraccion1_1->codigoInfraccion) echo " selected";}
															          	echo ">".$obj->parameterName."</option>";
															          }
															          ?>   
															      </select>
															  </div>
															</div>
															<div class="col-md-8">
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Detalle</label>
																	<textarea name="detalleInfraccion1_1" id="detalleInfraccion1_1" type="text" class="form-control" autocomplete="off"><?php if($infraccion1_1 != NUll){ echo $infraccion1_1->detalleInfraccion; } ?></textarea> 
																</div>
															</div>
														</div>
													</div>
													<div  class="tab-pane" id="infraccion1_2">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>Código</label>
																	<select name="codigoInfraccion1_2" id="codigoInfraccion1_2" class="form-control" autocomplete="off">
																		<option value="0">Seleccione su Codigo</option> 
																		<?php
															          $list= CmsParameterLang::getList(5, 1); //Observaciones Inusuales
															          foreach ($list as $obj) {
															          	echo "<option value=\"".$obj->parameterID."\"";
															          	if($infraccion1_2 != NULL){if($obj->parameterID==$infraccion1_2->codigoInfraccion) echo " selected";}
															          	echo ">".$obj->parameterName."</option>";
															          }
															          ?>   
															      </select>
															  </div>
															</div>
															<div class="col-md-8">
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Detalle</label>
																	<textarea name="detalleInfraccion1_2" id="detalleInfraccion1_2" type="text" class="form-control" autocomplete="off"><?php if($infraccion1_2 != NUll){ echo $infraccion1_2->detalleInfraccion; } ?></textarea> 
																</div>
															</div>
														</div>
													</div>
													<div  class="tab-pane" id="infraccion1_3">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>Código</label>
																	<select name="codigoInfraccion1_3" id="codigoInfraccion1_3" class="form-control" autocomplete="off">
																		<option value="0">Seleccione su Codigo</option> 
																		<?php
															          $list= CmsParameterLang::getList(5, 1); //Observaciones Inusuales
															          foreach ($list as $obj) {
															          	echo "<option value=\"".$obj->parameterID."\"";
															          	if($infraccion1_3 != NULL){if($obj->parameterID==$infraccion1_3->codigoInfraccion) echo " selected";}
															          	echo ">".$obj->parameterName."</option>";
															          }
															          ?>   
															      </select>
															  </div>
															</div>
															<div class="col-md-8">
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Detalle</label>
																	<textarea name="detalleInfraccion1_3" id="detalleInfraccion1_3" type="text" class="form-control" autocomplete="off"><?php if($infraccion1_3 != NUll){ echo $infraccion1_3->detalleInfraccion; } ?></textarea> 
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12"><h2 class="box-title"></h2></div> <!--espaciado -->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Acta Decomiso</label>
												<input name="actaDecomiso1" id="actaDecomiso1" type="text" class="form-control" value="<?php if($ro1 != NUll){ echo $ro1->actaDecomiso; } ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>TM Decomisado</label>
												<input name="tmDecomisado1" id="tmDecomisado1" type="text" class="form-control" value="<?php if($ro1 != NUll){ echo $ro1->tmDecomisado; } ?>" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Sub - Código del Numeral de Decomiso</label>
												<select name="subCodigoNumeroDecomiso1" id="subCodigoNumeroDecomiso1" class="form-control" autocomplete="off">
													<option value="0">Seleccione su subCodigo</option> 
													<option value="1.1">1.1</option> 
													<option value="1.3">1.3</option> 
													<option value="1.4">1.4</option> 
													<option value="1.5">1.5</option> 
													<option value="1.11">1.11</option> 
													<option value="1.12">1.12</option> 
													<option value="2.1">2.1</option> 
													<option value="2.2">2.2</option> 
													<option value="3">3</option> 
													<option value="4">4</option> 
													<option value="6.1">6.1</option> 
													<option value="6.2">6.2</option> 
													<option value="6.3">6.3</option> 
													<option value="6.5">6.5</option> 
													<option value="6.7">6.7</option> 
													<option value="13.1">13.1</option> 
													<option value="13.2">13.2</option> 
													<option value="13.3">13.3</option> 
													<option value="20.1">20.1</option> 
													<option value="20.2">20.2</option> 
													<option value="20.3">20.3</option> 
													<option value="24.1">24.1</option> 
													<option value="24.2">24.2</option> 
													<option value="26.1">26.1</option> 
													<option value="26.2">26.2</option> 
													<option value="26.3">26.3</option> 
													<option value="26.4">26.4</option> 
													<option value="26.5">26.5</option> 
													<option value="26.7">26.7</option> 
													<option value="26.8">26.8</option> 
													<option value="26.9">26.9</option> 
													<option value="26.13">26.13</option> 
													<option value="26.14">26.14</option> 
													<option value="26.15">26.15</option> 
													<option value="26.16">26.16</option> 
													<option value="26.17">26.17</option> 
													<option value="38">38</option> 
													<option value="39">39</option> 
													<option value="41">41</option> 
													<option value="42">42</option> 
													<option value="44">44</option> 
													<option value="45.1">45.1</option> 
													<option value="45.2">45.2</option> 
													<option value="45.2">45.2</option> 
													<option value="45.3">45.3</option> 
													<option value="45.4">45.4</option> 
													<option value="75.1">75.1</option> 
													<option value="75.2">75.2</option> 
													<option value="76.1">76.1</option> 
													<option value="76.2">76.2</option> 
													<option value="77.1">77.1</option> 
													<option value="77.2">77.2</option> 
													<option value="78">78</option> 
													<option value="79.1">79.1</option> 
													<option value="79.2">79.2</option> 
													<option value="79.3">79.3</option> 
													<option value="79.4">79.4</option> 
													<option value="79.5">79.5</option> 
													<option value="79.6">79.6</option> 
													<option value="79.7">79.7</option> 
													<option value="79.8">79.8</option> 
													<option value="79.9">79.9</option> 
													<option value="79.10">79.10</option> 
													<option value="80">80</option> 
													<option value="81">81</option> 
													<option value="82">82</option> 
													<option value="83">83</option> 
													<option value="95">95</option> 
													<option value="97">97</option> 
													<option value="98">98</option> 
													<option value="99">99</option> 
													<option value="100.1">100.1</option> 
													<option value="100.2">100.2</option> 
													<option value="102">102</option> 
													<option value="104">104</option> 
													<option value="113">113</option> 
													<option value="114">114</option> 
													<option value="115">115</option> 
													<option value="116">116</option> 
													<option value="117">117</option> 
													<option value="123.1">123.1</option> 
													<option value="124.1">124.1</option> 
													<option value="125.1">125.1</option> 
													<option value="126">126</option> 
													<option value="127">127</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>% Decomisado</label>
												<input name="porcDecomisado1" id="porcDecomisado1" type="text" class="form-control" value="<?php if($ro1 != NUll){ echo $ro1->porcDecomisado; } ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Acta de Retención de Pago</label>
												<input name="actaRetencionPago1" id="actaRetencionPago1" type="text" class="form-control" value="<?php if($ro1 != NUll){ echo $ro1->actaRetencionPago; } ?>" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Infractor</label>
												<select name="infractor1" id="infractor1" class="form-control" autocomplete="off">
													<option value="0">Seleccione su infractor</option> 
													<?php
										          $list= CmsParameterLang::getList(6, 1); //Observaciones Inusuales
										          foreach ($list as $obj) {
										          	echo "<option value=\"".$obj->parameterID."\"";
										          	if($ro1 != NULL){if($obj->parameterID==$ro1->infractor) echo " selected";}
										          	echo ">".$obj->parameterName."</option>";
										          }
										          ?>   
										      </select>
										  </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Codigo del inspector</label>
												<input name="codigoInspector1" id="codigoInspector1" type="text" class="form-control" value="<?php if($inspector1 != NUll){ echo $inspector1->codigoInspector; } ?>"  maxlength="255" autocomplete="off"> 
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label>Nombre del Inspector</label>
												<input name="nombreInspector1" id="nombreInspector1" type="text" class="form-control" value="<?php if($ro1 != NUll){ echo $ro1->nombreInspector; } ?>"  maxlength="255" autocomplete="off">
											</div>
										</div>
									</div>
								</div>	
								<div class="item" style="padding: 30px;">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label> Número de Reporte de Ocurrencia 2</label>
												<input name="numReporteOcurrencia2" id="numReporteOcurrencia2" type="text" class="form-control" value="<?php if($ro2 != NUll){ echo $ro2->numReporteOcurrencia; } ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-8">
										</div>
									</div>
									<div class="row">	
										<div class="col-md-12 ">
											<!-- Nav tabs -->
											<div class="col-xs-3" style="padding-right: 0px;">
												<ul class="nav nav-tabs tabs-left" style="padding-top: 0px;">
													<li role="presentation" class="active"><a href="#infraccion2_1"  data-toggle="tab" id="tab2_1" >Infraccion 1</a></li>
													<li role="presentation"><a href="#infraccion2_2" data-toggle="tab" id="tab2_2" >Infraccion 2</a></li>
													<li role="presentation"><a href="#infraccion2_3" data-toggle="tab" id="tab2_3" >Infraccion 3</a></li>
												</ul>
											</div>
											<div class="col-xs-9" style="padding-left: 0px;">
												<div class="tab-content">
													<div  class="tab-pane active" id="infraccion2_1">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>Código</label>
																	<select name="codigoInfraccion2_1" id="codigoInfraccion2_1" class="form-control" autocomplete="off">
																		<option value="0">Seleccione su Codigo</option> 
																		<?php
															          $list= CmsParameterLang::getList(5, 1); //Observaciones Inusuales
															          foreach ($list as $obj) {
															          	echo "<option value=\"".$obj->parameterID."\"";
															          	if($infraccion2_1 != NULL){if($obj->parameterID==$infraccion2_1->codigoInfraccion) echo " selected";}
															          	echo ">".$obj->parameterName."</option>";
															          }
															          ?>   
															      </select>
															  </div>
															</div>
															<div class="col-md-8">
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Detalle</label>
																	<textarea name="detalleInfraccion2_1" id="detalleInfraccion2_1" type="text" class="form-control" autocomplete="off"><?php if($infraccion2_1 != NUll){ echo $infraccion2_1->detalleInfraccion; } ?></textarea> 
																</div>
															</div>
														</div>
													</div>
													<div  class="tab-pane" id="infraccion2_2">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>Código</label>
																	<select name="codigoInfraccion2_2" id="codigoInfraccion2_2" class="form-control" autocomplete="off">
																		<option value="0">Seleccione su Codigo</option> 
																		<?php
															          $list= CmsParameterLang::getList(5, 1); //Observaciones Inusuales
															          foreach ($list as $obj) {
															          	echo "<option value=\"".$obj->parameterID."\"";
															          	if($infraccion2_2 != NULL){if($obj->parameterID==$infraccion2_2->codigoInfraccion) echo " selected";}
															          	echo ">".$obj->parameterName."</option>";
															          }
															          ?>   
															      </select>
															  </div>
															</div>
															<div class="col-md-8">
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Detalle</label>
																	<textarea name="detalleInfraccion2_2" id="detalleInfraccion2_2" type="text" class="form-control" autocomplete="off"><?php if($infraccion2_2 != NUll){ echo $infraccion2_2->detalleInfraccion; } ?></textarea> 
																</div>
															</div>
														</div>
													</div>
													<div  class="tab-pane" id="infraccion2_3">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>Código</label>
																	<select name="codigoInfraccion2_3" id="codigoInfraccion2_3" class="form-control" autocomplete="off">
																		<option value="0">Seleccione su Codigo</option> 
																		<?php
															          $list= CmsParameterLang::getList(5, 1); //Observaciones Inusuales
															          foreach ($list as $obj) {
															          	echo "<option value=\"".$obj->parameterID."\"";
															          	if($infraccion2_3 != NULL){if($obj->parameterID==$infraccion2_3->codigoInfraccion) echo " selected";}
															          	echo ">".$obj->parameterName."</option>";
															          }
															          ?>   
															      </select>
															  </div>
															</div>
															<div class="col-md-8">
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Detalle</label>
																	<textarea name="detalleInfraccion2_3" id="detalleInfraccion2_3" type="text" class="form-control" autocomplete="off"><?php if($infraccion2_3 != NUll){ echo $infraccion2_3->detalleInfraccion; } ?></textarea> 
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12"><h2 class="box-title"></h2></div> <!--espaciado -->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Acta Decomiso</label>
												<input name="actaDecomiso2" id="actaDecomiso2" type="text" class="form-control" value="<?php if($ro2 != NUll){ echo $ro2->actaDecomiso; } ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>TM Decomisado</label>
												<input name="tmDecomisado2" id="tmDecomisado2" type="text" class="form-control" value="<?php if($ro2 != NUll){ echo $ro2->tmDecomisado; } ?>" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Sub - Código del Numeral de Decomiso</label>
												<select name="subCodigoNumeroDecomiso2" id="subCodigoNumeroDecomiso2" class="form-control" autocomplete="off">
													<option value="0">Seleccione su subCodigo</option> 
													<option value="1.1">1.1</option> 
													<option value="1.3">1.3</option> 
													<option value="1.4">1.4</option> 
													<option value="1.5">1.5</option> 
													<option value="1.11">1.11</option> 
													<option value="1.12">1.12</option> 
													<option value="2.1">2.1</option> 
													<option value="2.2">2.2</option> 
													<option value="3">3</option> 
													<option value="4">4</option> 
													<option value="6.1">6.1</option> 
													<option value="6.2">6.2</option> 
													<option value="6.3">6.3</option> 
													<option value="6.5">6.5</option> 
													<option value="6.7">6.7</option> 
													<option value="13.1">13.1</option> 
													<option value="13.2">13.2</option> 
													<option value="13.3">13.3</option> 
													<option value="20.1">20.1</option> 
													<option value="20.2">20.2</option> 
													<option value="20.3">20.3</option> 
													<option value="24.1">24.1</option> 
													<option value="24.2">24.2</option> 
													<option value="26.1">26.1</option> 
													<option value="26.2">26.2</option> 
													<option value="26.3">26.3</option> 
													<option value="26.4">26.4</option> 
													<option value="26.5">26.5</option> 
													<option value="26.7">26.7</option> 
													<option value="26.8">26.8</option> 
													<option value="26.9">26.9</option> 
													<option value="26.13">26.13</option> 
													<option value="26.14">26.14</option> 
													<option value="26.15">26.15</option> 
													<option value="26.16">26.16</option> 
													<option value="26.17">26.17</option> 
													<option value="38">38</option> 
													<option value="39">39</option> 
													<option value="41">41</option> 
													<option value="42">42</option> 
													<option value="44">44</option> 
													<option value="45.1">45.1</option> 
													<option value="45.2">45.2</option> 
													<option value="45.2">45.2</option> 
													<option value="45.3">45.3</option> 
													<option value="45.4">45.4</option> 
													<option value="75.1">75.1</option> 
													<option value="75.2">75.2</option> 
													<option value="76.1">76.1</option> 
													<option value="76.2">76.2</option> 
													<option value="77.1">77.1</option> 
													<option value="77.2">77.2</option> 
													<option value="78">78</option> 
													<option value="79.1">79.1</option> 
													<option value="79.2">79.2</option> 
													<option value="79.3">79.3</option> 
													<option value="79.4">79.4</option> 
													<option value="79.5">79.5</option> 
													<option value="79.6">79.6</option> 
													<option value="79.7">79.7</option> 
													<option value="79.8">79.8</option> 
													<option value="79.9">79.9</option> 
													<option value="79.10">79.10</option> 
													<option value="80">80</option> 
													<option value="81">81</option> 
													<option value="82">82</option> 
													<option value="83">83</option> 
													<option value="95">95</option> 
													<option value="97">97</option> 
													<option value="98">98</option> 
													<option value="99">99</option> 
													<option value="100.1">100.1</option> 
													<option value="100.2">100.2</option> 
													<option value="102">102</option> 
													<option value="104">104</option> 
													<option value="113">113</option> 
													<option value="114">114</option> 
													<option value="115">115</option> 
													<option value="116">116</option> 
													<option value="117">117</option> 
													<option value="123.1">123.1</option> 
													<option value="124.1">124.1</option> 
													<option value="125.1">125.1</option> 
													<option value="126">126</option> 
													<option value="127">127</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>% Decomisado</label>
												<input name="porcDecomisado2" id="porcDecomisado2" type="text" class="form-control" value="<?php if($ro2 != NUll){ echo $ro2->porcDecomisado; } ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Acta de Retención de Pago</label>
												<input name="actaRetencionPago2" id="actaRetencionPago2" type="text" class="form-control" value="<?php if($ro2 != NUll){ echo $ro2->actaRetencionPago; } ?>" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Infractor</label>
												<select name="infractor2" id="infractor2" class="form-control" autocomplete="off">
													<option value="0">Seleccione su infractor</option> 
													<?php
										          $list= CmsParameterLang::getList(6, 1); //Observaciones Inusuales
										          foreach ($list as $obj) {
										          	echo "<option value=\"".$obj->parameterID."\"";
										          	if($ro2 != NULL){if($obj->parameterID==$ro2->infractor) echo " selected";}
										          	echo ">".$obj->parameterName."</option>";
										          }
										          ?>   
										      </select>
										  </div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Codigo del inspector</label>
												<input name="codigoInspector2" id="codigoInspector2" type="text" class="form-control" value="<?php if($inspector2 != NUll){ echo $inspector2->codigoInspector; } ?>"  maxlength="255" autocomplete="off"> 
											</div>
										</div>
										<div class="col-md-5">
											<div class="form-group">
												<label>Nombre del Inspector</label>
												<input name="nombreInspector2" id="nombreInspector2" type="text" class="form-control" value="<?php if($ro2 != NUll){ echo $ro2->nombreInspector; } ?>"  maxlength="255" autocomplete="off">
											</div>
										</div>
									</div>
								</div>
								<div class="item" style="padding: 30px;">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label> Número de Reporte de Ocurrencia 3</label>
												<input name="numReporteOcurrencia3" id="numReporteOcurrencia3" type="text" class="form-control" value="<?php if($ro3 != NUll){ echo $ro3->numReporteOcurrencia; } ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-8">
										</div>
									</div>
									<div class="row">	
										<div class="col-md-12 ">
											<!-- Nav tabs -->
											<div class="col-xs-3" style="padding-right: 0px;">
												<ul class="nav nav-tabs tabs-left" style="padding-top: 0px;">
													<li role="presentation" class="active"><a href="#infraccion3_1"  data-toggle="tab" id="tab3_1" >Infraccion 1</a></li>
													<li role="presentation"><a href="#infraccion3_2" data-toggle="tab" id="tab3_2" >Infraccion 2</a></li>
													<li role="presentation"><a href="#infraccion3_3" data-toggle="tab" id="tab3_3" >Infraccion 3</a></li>
												</ul>
											</div>
											<div class="col-xs-9" style="padding-left: 0px;">
												<div class="tab-content">
													<div  class="tab-pane active" id="infraccion3_1">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>Código</label>
																	<select name="codigoInfraccion3_1" id="codigoInfraccion3_1" class="form-control" autocomplete="off">
																		<option value="0">Seleccione su Codigo</option> 
																		<?php
															          $list= CmsParameterLang::getList(5, 1); //Observaciones Inusuales
															          foreach ($list as $obj) {
															          	echo "<option value=\"".$obj->parameterID."\"";
															          	if($infraccion3_1 != NULL){if($obj->parameterID==$infraccion3_1->codigoInfraccion) echo " selected";}
															          	echo ">".$obj->parameterName."</option>";
															          }
															          ?>   
															      </select>
															  </div>
															</div>
															<div class="col-md-8">
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Detalle</label>
																	<textarea name="detalleInfraccion3_1" id="detalleInfraccion3_1" type="text" class="form-control" autocomplete="off"><?php if($infraccion3_1 != NUll){ echo $infraccion3_1->detalleInfraccion; } ?></textarea> 
																</div>
															</div>
														</div>
													</div>
													<div  class="tab-pane" id="infraccion3_2">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>Código</label>
																	<select name="codigoInfraccion3_2" id="codigoInfraccion3_2" class="form-control" autocomplete="off">
																		<option value="0">Seleccione su Codigo</option> 
																		<?php
															          $list= CmsParameterLang::getList(5, 1); //Observaciones Inusuales
															          foreach ($list as $obj) {
															          	echo "<option value=\"".$obj->parameterID."\"";
															          	if($infraccion3_2 != NULL){if($obj->parameterID==$infraccion3_2->codigoInfraccion) echo " selected";}
															          	echo ">".$obj->parameterName."</option>";
															          }
															          ?>   
															      </select>
															  </div>
															</div>
															<div class="col-md-8">
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Detalle</label>
																	<textarea name="detalleInfraccion3_2" id="detalleInfraccion3_2" type="text" class="form-control" autocomplete="off"><?php if($infraccion3_2 != NUll){ echo $infraccion3_2->detalleInfraccion; } ?></textarea> 
																</div>
															</div>
														</div>
													</div>
													<div  class="tab-pane" id="infraccion3_3">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>Código</label>
																	<select name="codigoInfraccion3_3" id="codigoInfraccion3_3" class="form-control" autocomplete="off">
																		<option value="0">Seleccione su Codigo</option> 
																		<?php
															          $list= CmsParameterLang::getList(5, 1); //Observaciones Inusuales
															          foreach ($list as $obj) {
															          	echo "<option value=\"".$obj->parameterID."\"";
															          	if($infraccion3_3 != NULL){if($obj->parameterID==$infraccion3_3->codigoInfraccion) echo " selected";}
															          	echo ">".$obj->parameterName."</option>";
															          }
															          ?>   
															      </select>
															  </div>
															</div>
															<div class="col-md-8">
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Detalle</label>
																	<textarea name="detalleInfraccion3_3" id="detalleInfraccion3_3" type="text" class="form-control" autocomplete="off"><?php if($infraccion3_3 != NUll){ echo $infraccion3_3->detalleInfraccion; } ?></textarea> 
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12"><h2 class="box-title"></h2></div> <!--espaciado -->
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Acta Decomiso</label>
												<input name="actaDecomiso3" id="actaDecomiso3" type="text" class="form-control" value="<?php if($ro3 != NUll){ echo $ro3->actaDecomiso; } ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>TM Decomisado</label>
												<input name="tmDecomisado3" id="tmDecomisado3" type="text" class="form-control" value="<?php if($ro3 != NUll){ echo $ro3->tmDecomisado; } ?>" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Sub - Código del Numeral de Decomiso</label>
												<select name="subCodigoNumeroDecomiso3" id="subCodigoNumeroDecomiso3" class="form-control" autocomplete="off">
													<option value="0">Seleccione su subCodigo</option> 
													<option value="1.1">1.1</option> 
													<option value="1.3">1.3</option> 
													<option value="1.4">1.4</option> 
													<option value="1.5">1.5</option> 
													<option value="1.11">1.11</option> 
													<option value="1.12">1.12</option> 
													<option value="2.1">2.1</option> 
													<option value="2.2">2.2</option> 
													<option value="3">3</option> 
													<option value="4">4</option> 
													<option value="6.1">6.1</option> 
													<option value="6.2">6.2</option> 
													<option value="6.3">6.3</option> 
													<option value="6.5">6.5</option> 
													<option value="6.7">6.7</option> 
													<option value="13.1">13.1</option> 
													<option value="13.2">13.2</option> 
													<option value="13.3">13.3</option> 
													<option value="20.1">20.1</option> 
													<option value="20.2">20.2</option> 
													<option value="20.3">20.3</option> 
													<option value="24.1">24.1</option> 
													<option value="24.2">24.2</option> 
													<option value="26.1">26.1</option> 
													<option value="26.2">26.2</option> 
													<option value="26.3">26.3</option> 
													<option value="26.4">26.4</option> 
													<option value="26.5">26.5</option> 
													<option value="26.7">26.7</option> 
													<option value="26.8">26.8</option> 
													<option value="26.9">26.9</option> 
													<option value="26.13">26.13</option> 
													<option value="26.14">26.14</option> 
													<option value="26.15">26.15</option> 
													<option value="26.16">26.16</option> 
													<option value="26.17">26.17</option> 
													<option value="38">38</option> 
													<option value="39">39</option> 
													<option value="41">41</option> 
													<option value="42">42</option> 
													<option value="44">44</option> 
													<option value="45.1">45.1</option> 
													<option value="45.2">45.2</option> 
													<option value="45.2">45.2</option> 
													<option value="45.3">45.3</option> 
													<option value="45.4">45.4</option> 
													<option value="75.1">75.1</option> 
													<option value="75.2">75.2</option> 
													<option value="76.1">76.1</option> 
													<option value="76.2">76.2</option> 
													<option value="77.1">77.1</option> 
													<option value="77.2">77.2</option> 
													<option value="78">78</option> 
													<option value="79.1">79.1</option> 
													<option value="79.2">79.2</option> 
													<option value="79.3">79.3</option> 
													<option value="79.4">79.4</option> 
													<option value="79.5">79.5</option> 
													<option value="79.6">79.6</option> 
													<option value="79.7">79.7</option> 
													<option value="79.8">79.8</option> 
													<option value="79.9">79.9</option> 
													<option value="79.10">79.10</option> 
													<option value="80">80</option> 
													<option value="81">81</option> 
													<option value="82">82</option> 
													<option value="83">83</option> 
													<option value="95">95</option> 
													<option value="97">97</option> 
													<option value="98">98</option> 
													<option value="99">99</option> 
													<option value="100.1">100.1</option> 
													<option value="100.2">100.2</option> 
													<option value="102">102</option> 
													<option value="104">104</option> 
													<option value="113">113</option> 
													<option value="114">114</option> 
													<option value="115">115</option> 
													<option value="116">116</option> 
													<option value="117">117</option> 
													<option value="123.1">123.1</option> 
													<option value="124.1">124.1</option> 
													<option value="125.1">125.1</option> 
													<option value="126">126</option> 
													<option value="127">127</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>% Decomisado</label>
												<input name="porcDecomisado3" id="porcDecomisado3" type="text" class="form-control" value="<?php if($ro3 != NUll){ echo $ro3->porcDecomisado; } ?>" autocomplete="off">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Acta de Retención de Pago</label>
												<input name="actaRetencionPago3" id="actaRetencionPago3" type="text" class="form-control" value="<?php if($ro3 != NUll){ echo $ro3->actaRetencionPago; } ?>" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Infractor</label>
												<select name="infractor3" id="infractor3" class="form-control" autocomplete="off">
													<option value="0">Seleccione su infractor</option> 
													<?php
											          $list= CmsParameterLang::getList(6, 1); //Observaciones Inusuales
											          foreach ($list as $obj) {
											          	echo "<option value=\"".$obj->parameterID."\"";
											          	if($ro3 != NULL){if($obj->parameterID==$ro3->infractor) echo " selected";}
											          	echo ">".$obj->parameterName."</option>";
											          }
											          ?>   
											      </select>
											  </div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Codigo del inspector</label>
													<input name="codigoInspector3" id="codigoInspector3" type="text" class="form-control" value="<?php if($inspector3 != NUll){ echo $inspector3->codigoInspector; } ?>"  maxlength="255" autocomplete="off"> 
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<label>Nombre del Inspector</label>
													<input name="nombreInspector3" id="nombreInspector3" type="text" class="form-control" value="<?php if($ro3 != NUll){ echo $ro3->nombreInspector; } ?>"  maxlength="255" autocomplete="off">
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
				<div class="col-md-8">
				</div> 
				<input type="hidden" value="<?php echo $oUser->userID; ?>" name="userID" id="userID" > 
				<input type="hidden" value="<?php echo $chiID; ?>" name="ID" id="ID" > 
				<div class="col-md-2">
					<label></label>
					<div class="btn btn-info btn-block" name="btnCrear" id="back_ro"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;regresar</div>
				</div>
				<div class="col-md-2">
					<label></label>
					<div class="btn btn-primary btn-block" name="btnCrear" id="send_chata">Siguiente&nbsp;&nbsp;<i class="fa fa-chevron-right"></i></div>
				</div>
			</div>

		</form>

		<script type="text/javascript">

		// <?php 	
		// 			for ($j = 1; $j<4; $j++){ 
		// 				if($j=1){
		// 					echo '$("#tab'.$i.'_'.$j.'").click(function(){$(".tab-pane").hide(); $("#infraccion'.$i.'_'.$j.'").show(); $(".nav-tabs li").removeClass("active");$(this).parent().addClass("active");});';
		// 				}else{
							
		// 					echo '$("#tab'.$i.'_'.$j.'").click(function(){var allValid = true;$("#infraccion'.$i.'_'.$j.'").find(".form-control").each(function(i,e){ var len = $(e).val().length;if (len>0){allValid = true;} else {allValid = false;}});if (allValid) { $(".tab-pane").hide();  $("#infraccion'.$i.'_'.$j.'").show(); $(".nav-tabs li").removeClass("active"); $(this).parent().addClass("active")}});';
		// 				}
					
		// 	  		} 

		// 	  	} 
		// ?>

		$(function(){
			prepareForm('#form_ro');
			$('#send_chata').click(function(){
				bootbox.confirm({
					title: "Produce - Bureau Veritas",
					message: "Estas seguro de guardar los datos de RO?",
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
							if (!isValidate('#form_ro')){ 
								alertify.error('Porfavor ingrese datos validos.'); 
								return false; 
							}
							var fields3=$('#form_ro').serialize();
							<?php if($cmd!='update'){ ?>
								$.getJSON('<?php echo $URL_ROOT;?>ajax/form_ro.php?cmd=insert&'+fields3, function(data) {
									if(data.retval==1){
										alertify.success(data.message);
										$('.sombra').show();
										setTimeout(function(){
											location.href='<?php echo $URL_ROOT;?>chi.html';
										}, 2000);
									}else{
										alertify.error(data.message);
									}
								});
								<?php }else{ ?>
									$.getJSON('<?php echo $URL_ROOT;?>ajax/form_ro.php?cmd=update&ID=<?php echo $chiID;?>&'+fields3, function(data) {
										if(data.retval==1){
											alertify.success(data.message);
											$('.sombra').show();
											setTimeout(function(){
												location.href='<?php echo $URL_ROOT;?>chi.html';
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

		$('#back_ro').click(function(){
			location.href='<?php echo $URL_ROOT;?>chi/muestreo.html?action=update&ID=<?php echo $chiID; ?>';
		});
	</script>




</section>