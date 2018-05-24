<script type="text/javascript">
	$(function(){
		$('#btnSearch').click(function(){
			if($("#fechaIni").val() ==""){
				alertify.error("Por favor, ingrese una Fecha de Inicio");
				$("#fechaIni").focus();
				return false;
			}
			if($("#fechaFin").val() ==""){
				alertify.error("Por favor, ingrese una Fecha de Fin");
				$("#fechaFin").focus();
				return false;
			}

			Search(document.forms[0]);
		});

		$('#datetimepicker1').datetimepicker({
			locale: 'es',
			format: 'YYYY/MM/DD'
		});
		$('#datetimepicker2').datetimepicker({
			locale: 'es',
			format: 'YYYY/MM/DD',
        useCurrent: false //Important! See issue #1075
    });
		$("#datetimepicker1").on("dp.change", function (e) {
			$('#datetimepicker2').data("DateTimePicker").minDate(e.date);
		});
		$("#datetimepicker2").on("dp.change", function (e) {
			$('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
		});
	});


</script>
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
	</div>
	<div class="box-body">
		<div>
			<div class="col-sm-3">
				<div class="form-group padding-right-10">
					<label>Fecha Inicio: </label>
					<div class='input-group date' id='datetimepicker1'>
						<input type="text" class="form-control" name="fechaIni" id="fechaIni" value="<?php echo $fechaIni;?>" placeholder="yyyy/mm/dd" maxlength="10"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar fa fa-calendar"></span>
						</span>
					</div>
				</div>
			</div>        
			<div class="col-sm-3">
				<div class="form-group padding-right-10">
					<label>Fecha Fin: </label>
					<div class='input-group date' id='datetimepicker2'>
						<input type="text" class="form-control" name="fechaFin" id="fechaFin" value="<?php echo $fechaFin;?>" placeholder="yyyy/mm/dd" maxlength="10"/>
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-calendar fa fa-calendar"></span>
						</span>
					</div>
				</div>
			</div>        
			<div class="col-sm-3">
				<div class="form-group padding-right-10">
					<label >Taller: </label>
					<select name="tallerID" id="tallerID" class="form-control" autocomplete="off" value="<?php echo $tallerID;?>">
						<option value="0">[TODOS]</option>
						<?php
						$list= CrmTaller::getWebList();
						foreach ($list as $obj) {
							echo "<option value=\"".$obj->tallerID."\"";
							if($obj->tallerID==$tallerID) print ' selected';
							echo ">".$obj->razonSocial."</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group padding-right-10">
					<label >Inspector: </label>
					<select name="usuarioID" id="usuarioID" class="form-control" autocomplete="off" value="<?php echo $usuarioID;?>">
						<option value="0">[TODOS]</option>
						<?php
						$list= CrmUser::getWebList();
						foreach ($list as $obj) {
							echo "<option value=\"".$obj->userID."\"";
							if($obj->userID==$usuarioID) print 'selected';
							echo ">".$obj->firstName." ".$obj->lastName."</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group padding-right-10">
					<label >Tipo de Servicio: </label>
					<select name="tiposervID" id="tiposervID" class="form-control" autocomplete="off" value="<?php echo $tiposervID;?>">
						<option value="0">[TODOS]</option>  
						<?php 
						$list= CmsParameterLang::getWebList(11, 1); 
						foreach ($list as $obj) { 
							echo "<option value=\"".$obj->parameterID."\""; 
							if($obj->parameterID==$tiposervID) print 'selected';
							echo ">".$obj->parameterName."</option>"; 
						} 
						?>   
					</select>
				</div>
			</div>
			<div class="col-sm-1">            
				<label>&nbsp;</label>
				<div class="form-group">
					<input name="btnSearch" id="btnSearch" type="button" class="btn btn-primary" value="Buscar" />            
				</div>
			</div>

			<table class="table table-bordered table-hover">
				<tr>   
					<th width="20"><input type="checkbox" id="select_all"/></th>                 
					<th width="120"><?php echo $MODULE->getSortingHeader("fechaEmi", "Fecha Emisión");?></th>
					<th width="120"><?php echo $MODULE->getSortingHeader("certificadoID", "N° Certificado");?></th>
					<th width="120"><?php echo $MODULE->getSortingHeader("formatoID", "N° Formato");?></th>
					<th width="120"><?php echo $MODULE->getSortingHeader("calcomaniaID", "N° Calcomanía");?></th>
					<th width="120"><?php echo $MODULE->getSortingHeader("razonSocial", "Taller");?></th>
					<th width="120"><?php echo $MODULE->getSortingHeader("placa", "Placa");?></th>
					<th width="120"><?php echo $MODULE->getSortingHeader("tipoServicio", "Tipo Servicio");?></th>
					<th width="120"><?php echo $MODULE->getSortingHeader("tipo", "Tipo Certificado");?></th>
					<th width="120"><?php echo $MODULE->getSortingHeader("usuario", "Inspector");?></th>
					<th width="20">&nbsp;</th>
				</tr>
				<?php
				$list=CrmReportes::getItemCertIncomp($fechaIni,$fechaFin,$usuarioID,$tallerID,$tiposervID);
				$count= 0;
				foreach ($list as $oItem){
					$count+=1;
					?>
					<tr>
						<td><input type="checkbox" value="<?php echo $oItem->certificadoID; ?>"/></td> 
						<?php                         
						$fechaEmi = new DateTime($oItem->fechaEmi);
						?>
						<td><?php echo $fechaEmi->format('d/m/Y'); ?></td>
						<td><?php echo $oItem->certificadoID; ?></td>
						<td><?php echo $oItem->formatoID; ?></td>
						<td><?php echo $oItem->calcomaniaID; ?></td>
						<td><?php echo $oItem->razonSocial; ?></td>
						<td><?php echo $oItem->placa; ?></td>
						<td><?php echo $oItem->tipoServicio; ?></td>
						<td><?php echo $oItem->tipo; ?></td>
						<td><?php echo $oItem->usuario; ?></td>
						<input type="hidden" name="tipoServicioID" value="<?php echo $oItem->tipoServicioID; ?>">
						<input type="hidden" name="inspectorID" value="<?php echo $oItem->userID; ?>">
						<td>
							<a href="#gb<?php echo $count; ?>" data-toggle="modal" data-backdrop="static" title="Editar"><i class="fa fa-edit"></i></a>
						</td>                        
						<div class="portfolio-modal modal fade" id="gb<?php echo $count; ?>" tabindex="-1" role="dialog" aria-hidden="false">
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
										<h4 class="modal-title">Cambio de formato y calcomanía</h4>
									</div>
									<form name="login" id="grabar_cert" class="login">
										<div class="modal-body">
											<p>Tipo Servicio:</p>
											<input type="hidden" class="form-control" id="tipo_servicioID<?= $count ?>" name="tipo_servicioID" value="<?php echo $oItem->tipoServicioID; ?>" >
											<input type="hidden" class="form-control" id="tipo<?= $count ?>" name="tipo" value="<?php echo $oItem->tipo; ?>" >
											<input type="text" class="form-control" id="tipo_servicio" name="tipo_servicio" value="<?php echo $oItem->tipoServicio; ?>" readonly="true">
											<br/>
											<p>N° Certificado:</p>
											<input type="text" class="form-control" id="nro_certificado<?= $count ?>" name="nro_certificado" value="<?php echo $oItem->certificadoID; ?>" readonly="true">
											<br/>
											<p>Inspector:</p>
											<input type="hidden" class="form-control" id="inspectorID<?= $count ?>" name="inspectorID" value="<?php echo $oItem->userID; ?>">
											<input type="text" class="form-control" id="inspector" name="inspector" value="<?php echo $oItem->usuario; ?>" readonly="true">
											<br/>                 
											<p>N° Formato:</p>
											<input type="text" class="form-control" placeholder="Ingrese N° Formato" id="nro_formato<?= $count ?>" name="nro_formato">
											<br/>
											<p>N° Calcomanía:</p>
											<input type="text" class="form-control" placeholder="Ingrese N° Calcomanía" id="nro_calcomania<?= $count ?>" name="nro_calcomania">                    
										</div>
										<div class="modal-footer">
											<div class="btn btn-primary" id="grabar<?php echo $count; ?>">Grabar
											</div></br></br>
											<div class="btn btn-danger" id="imprimir<?php echo $count; ?>" style="display:none;">Imprimir
											</div></br>
											<p class="text-danger" id="alert"></p>
										</div>
									</form>
									<script type="text/javascript">
										$(function(){
											$('#grabar<?php echo $count; ?>').click(function(){
												console.log('<?php echo $URL_ROOT;?>ajax/certincomp.php?action=updateCertIncomp&tipo_servicioID='+$('#tipo_servicioID<?= $count ?>').val() + '&nro_certificado='+$('#nro_certificado<?= $count ?>').val() + '&inspectorID='+$('#inspectorID<?= $count ?>').val()+'&nro_formato='+$('#nro_formato<?= $count ?>').val()+'nro_calcomania='+$('#nro_calcomania<?= $count ?>').val());
												$.getJSON('<?php echo $URL_ROOT;?>ajax/certincomp.php?action=updateCertIncomp&tipo_servicioID='+$('#tipo_servicioID<?= $count ?>').val() + '&nro_certificado='+$('#nro_certificado<?= $count ?>').val() + '&inspectorID='+$('#inspectorID<?= $count ?>').val()+'&nro_formato='+$('#nro_formato<?= $count ?>').val()+'&nro_calcomania='+$('#nro_calcomania<?= $count ?>').val(), function(data) {
													if(data.retval==1){                                
														alertify.success(data.message);
                                                    //location.href= '<?php echo SEO::get_URLAdmin(); ?>?moduleID=57';
                                                    $('#imprimir<?php echo $count; ?>').show();
                                                    $('#grabar<?php echo $count; ?>').hide();
                                                }else{
                                                	$('#alert').html(data.message);
                                                }
                                            }).error(function(jqXHR, textStatus, errorThrown) {
                                            	alertify.error("Error interno");
                                            	console.log("error: " + textStatus);
                                            	console.log("error thrown: " + errorThrown);
                                            	console.log("incoming Text: " + jqXHR.responseText);
                                            });
                                        });

											$('#imprimir<?php echo $count; ?>').click(function(){
												if($('#tipo_servicio').val() != 'SERV. GNV'){
													window.open('<?php echo $URL_ROOT;?>ajax/impresionCert.php?tipo='+$('#tipo<?= $count ?>').val() + '&nro_certificado='+$('#nro_certificado<?= $count ?>').val(),'_blank');
												}else{
													window.open('<?php echo $URL_ROOT;?>ajax/impresionCertgnv.php?tipo='+$('#tipo<?= $count ?>').val() + '&nro_certificado='+$('#nro_certificado<?= $count ?>').val(),'_blank');
												}
											});
										});
									</script>
								</div>
							</div>
						</div>
					</tr>
					<?php                    
				}
				?>
			</table>
			<div id="divViewForm" style="display:none; height:420px; width:550px;">
				<img src="../assets/admin/images/i_loading.gif" align="absbottom" /> Cargando...
			</div>
		</div>
		<script type="text/javascript">
			$('#select_all').change(function() {
				var checkboxes = $(this).closest('form').find(':checkbox');
				checkboxes.prop('checked', $(this).is(':checked'));
			});
		</script>
		<div class="box-footer">
			<button class="btn btn-primary" name="btnExport" onClick="Export(this.form)">Exportar</button>        
			<?php echo $MODULE->getPaging();?>      
			<a class="btn btn-primary" href="#masiva" data-toggle="modal" data-backdrop="static" >Generacion Masiva</a>  
		</div>
	</div>
</div>

<div class="portfolio-modal modal fade" id="masiva" tabindex="-1" role="dialog" aria-hidden="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title">Cambio de formato y calcomanía (Masivo)</h4>
			</div>
			<form name="login" id="grabar_cert" class="login">
				<div class="modal-body">         
					<p>N° Formato:</p>
					<input type="text" class="form-control" placeholder="Ingrese N° Formato Inicial" id="nro_formatoInicial" name="nro_formatoInicial">
					<br/>
					<input type="text" class="form-control" placeholder="Ingrese N° Formato Final" id="nro_formatoFinal" name="nro_formatoFinal">
					<br/>
					<p>N° Calcomanía:</p>
					<input type="text" class="form-control" placeholder="Ingrese N° Calcomanía Inicial" id="nro_calcomaniaInicial" name="nro_calcomaniaInicial">           
					<br/>
					<input type="text" class="form-control" placeholder="Ingrese N° Calcomanía Final" id="nro_calcomaniaFinal" name="nro_calcomaniaFinal">         
				</div>
				<div class="modal-footer">
					<div class="btn btn-primary" id="grabarMasivo">Grabar
					</div>
					<p class="text-danger" id="alert"></p>
				</div>
			</form>
			<script type="text/javascript">


				function DescargaMasiva(tipoServicio,tipo,nro_certificado){
					setTimeout(function(){	
						if(tipoServicio != 'SERV. GNV'){
							window.open('<?php echo $URL_ROOT;?>ajax/impresionCert.php?tipo='+tipo+ '&nro_certificado='+nro_certificado,'_blank');
						}else{
							window.open('<?php echo $URL_ROOT;?>ajax/impresionCertgnv.php?tipo='+tipo + '&nro_certificado='+nro_certificado,'_blank');
						}	
					}, 12000);
				}


				$(function(){
					
					var checkboxChecker = function() {
						var countF  = $('#nro_formatoInicial').val();
						var countC  = $('#nro_calcomaniaInicial').val();
						$('table tr').not(':first').each(function(i) {
							console.log($(this).find('input[name="tipoServicioID"]'));
							var $chkbox = $(this).find('input[type="checkbox"]');
							if ($chkbox.length) {
								var status = $chkbox.prop('checked');
								if(status){
									var tipoServicioID = $(this).find('input[name="tipoServicioID"]');
									var inspectorID = $(this).find('input[name="inspectorID"]');
									var nro_certificado = $(this).find('td:nth-child(3)');
									var tipo_servicio = $(this).find('td:nth-child(8)');
									var tipo = $(this).find('td:nth-child(9)');
									var f = parseFloat(countF) + i;
									var c = parseFloat(countC) + i;
									$.getJSON('<?php echo $URL_ROOT;?>ajax/certincomp.php?action=updateCertIncomp&tipo_servicioID='+tipoServicioID.val() + '&nro_certificado='+ nro_certificado.text() + '&inspectorID='+inspectorID.val()+'&nro_formato='+f+'&nro_calcomania='+c, function(data) {
										if(data.retval==1){                                
											alertify.success(data.message);
											DescargaMasiva(tipo_servicio.text(),tipo.text(),nro_certificado.text());
										}else{
											$('#alert').html(data.message);
										}
									}).error(function(jqXHR, textStatus, errorThrown) {
										alertify.error("Error interno");
										console.log("error: " + textStatus);
										console.log("error thrown: " + errorThrown);
										console.log("incoming Text: " + jqXHR.responseText);
									});
									
								}
							}

						});
					};

					$('#grabarMasivo').click(function(){
						var conteo = 0;
						$('table tr').not(':first').each(function(i) {
							var $chkbox = $(this).find('input[type="checkbox"]');
							if ($chkbox.length) {
								var status = $chkbox.prop('checked');
								if(status){
									conteo++;
								}
							}
						});

						var ValorInicialF  = $('#nro_formatoInicial').val();
						var ValorFinalF  = $('#nro_formatoFinal').val();

						var ValorInicialC  = $('#nro_calcomaniaInicial').val();
						var ValorFinalC  = $('#nro_calcomaniaFinal').val();

						var RestadoF = parseFloat(ValorFinalF) - parseFloat(ValorInicialF) + 1;
						var RestadoC = parseFloat(ValorFinalC) - parseFloat(ValorInicialC) + 1;
						console.log(RestadoC);console.log(RestadoF);console.log(conteo);
						if(conteo == RestadoF && conteo == RestadoC  && RestadoC  == RestadoF ){
							checkboxChecker();
						}else{
							alertify.error('Por favor ingrese la cantidad de formatos o calcomanias para la cantidad seleccionada.')
							return false;
						}

					});
				});
			</script>
		</div>
	</div>
</div>