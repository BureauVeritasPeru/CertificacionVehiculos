<?php
$userAdmin = AdmLogin::getUserSession();
$lDepartamento = CrmUbigeo::getDepartamento_List();
?>
<script type="text/javascript">
	function on_submit(xform){

		if($("#ruc").val() ==""){
			alertify.error("Por favor, ingrese el campo [RUC]");
			$("#ruc").focus();
			return false;
		}

		if($("#razonSocial").val() ==""){
			alertify.error("Por favor, ingrese el campo [Razon Social]");
			$("#razonSocial").focus();
			return false;
		}

		if($("#per").val() ==""){
			alertify.error("Por favor, ingrese el campo [PER]");
			$("#per").focus();
			return false;
		}

		if($("#descripcion").val() ==""){
			alertify.error("Por favor, ingrese el campo [Descripcion]");
			$("#descripcion").focus();
			return false;
		}

		if($("#nombreCompleto").val() ==""){
			alertify.error("Por favor, ingrese el campo [Nombre Completo]");
			$("#nombreCompleto").focus();
			return false;
		}

		xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
		xform.submit();
	}
</script>
<div class="box box-default">
	<div class="box-header">
		<h2 class="box-title"><i class="fa fa-edit"></i>  <?php echo ($MODULE->FormView=="edit")?$oItem->razonSocial:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
	</div>
	<div class="box-body">
		<?php 
		if($MODULE->FormView=="edit"){      
			?>
			<div class="form-group">
				<label class="col-sm-2 control-label ">Código</label>      
				<div class="col-sm-10">
					<input name="tallerID" autocomplete="off" type="text" id="tallerID" class="form-control" value="<?php echo $oItem->tallerID; ?>" disabled="true" maxlength="10">
				</div>
			</div>
			<?php } ?>

			<div class="form-group">
				<label class="col-sm-2 control-label ">RUC</label>      
				<div class="col-sm-10">
					<input name="ruc" type="text" id="ruc" class="form-control" value="<?php echo $oItem->ruc; ?>" maxlength="11">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label ">Razón Social</label>
				<div class="col-sm-10">
					<input name="razonSocial" type="text" class="form-control" id="razonSocial" value="<?php echo $oItem->razonSocial; ?>" maxlength="200">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label ">PER</label>
				<div class="col-sm-10">
					<input name="per" type="text" class="form-control" id="per" value="<?php echo $oItem->per; ?>" maxlength="20">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label ">Validado</label>
				<div class="col-sm-10">
					<label for="radio1">
						<input type="radio" class="flat-blue" id="radio1" name="valid" value="1" <?php if($oItem->valid==1) echo "checked";?>>          
						Si
					</label>        
					<label for="radio2">
						<input type="radio" class="flat-blue" id="radio2" name="valid" value="0" <?php if($oItem->valid==0) echo "checked";?>>          
						No
					</label>        
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					Sedes
				</div>
				<div class="panel-body" id="sedes">
					<div class="form-group">
						<label class="col-sm-3 control-label ">DESCRIPCIÓN</label>
						<label class="col-sm-3 control-label ">DIRECCIÓN</label>
						<label class="col-sm-2 control-label ">TELÉFONO</label>
						<label class="col-sm-2 control-label ">DEPARTAMENTO</label>
						<label class="col-sm-1 control-label ">ESTADO</label>
						<a class="col-sm-1 btn btn-link" href='javascript:void(0);' id="addMore"><strong>Agregar</strong></a>
					</div>        
					<?php
					if ($oItem->tallerID=="") {
						?>
						<div class="form-group">
							<div class="col-sm-3">
								<input style="display:none" name="sedeID[]" id="sedeID" type="text" value="">
								<input name="descripcion[]" type="text" id="descripcion" class="form-control" value="" maxlength="150" placeholder="Descripción">
							</div>
							<div class="col-sm-3">
								<input name="direccion[]" type="text" id="direccion" class="form-control" value="" maxlength="150" placeholder="Dirección">
							</div>
							<div class="col-sm-2">
								<input name="telefono[]" type="text" id="telefono" class="form-control" value="" maxlength="50" placeholder="Teléfono">
							</div>
							<div class="col-sm-2">
								<select name="ubigeo[]" id="ubigeo" class="form-control">
									<option value="00">SELECCIONE</option>
									<?php
									foreach ($lDepartamento as $obj){
										echo '<option value="' . $obj->cod_dpto . '">' . $obj->nombre . '</option>';
									}
									?>
								</select>
							</div>
							<div class="col-sm-1">
								<select name="estadoSede[]" id="estadoSede" class="form-control">
									<option value="1">ACTIVO</option>
									<option value="0">INACTIVO</option>
								</select>
							</div>
							<div class="col-sm-1">
								<a href='javascript:void(0);' class='remove btn btn-link'><strong>Remover</strong></a>
							</div>
						</div>
						<?php
					} else {
						$lSedes  =CrmSede::getListByTaller($oItem->tallerID);
						foreach ($lSedes as $oItemSede) {
							?>
							<div class="form-group">
								<div class="col-sm-3">
									<input style="display:none" name="sedeID[]" id="sedeID" type="text" value="<?php echo $oItemSede->sedeID;?>">
									<input name="descripcion[]" type="text" id="descripcion" class="form-control" value="<?php echo $oItemSede->descripcion;?>" maxlength="150" placeholder="Descripción">
								</div>
								<div class="col-sm-3">
									<input name="direccion[]" type="text" id="direccion" class="form-control" value="<?php echo $oItemSede->direccion;?>" maxlength="150" placeholder="Dirección">
								</div>
								<div class="col-sm-2">
									<input name="telefono[]" type="text" id="telefono" class="form-control" value="<?php echo $oItemSede->telefono;?>" maxlength="50" placeholder="Teléfono">
								</div>
								<div class="col-sm-2">
									<select name="ubigeo[]" id="ubigeo" class="form-control">
										<option value="00">SELECCIONE</option>
										<?php
										foreach ($lDepartamento as $obj) {
											echo '<option value="' . $obj->cod_dpto . '"';
											if($obj->cod_dpto==$oItemSede->ubigeo) print ' selected';
											echo '>' . $obj->nombre . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-sm-1">
									<select name="estadoSede[]" id="estadoSede" class="form-control">
										<option value="1"<?php if($oItemSede->estado==1) print ' selected';?>>ACTIVO</option>
										<option value="0"<?php if($oItemSede->estado==0) print ' selected';?>>INACTIVO</option>
									</select>
								</div>
								<div class="col-sm-1">
									<a href='javascript:void(0);' class='remove btn btn-link'><strong>Remover</strong></a>
								</div>
							</div>
							<?php
						}
					}
					?>        
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Contactos
				</div>
				<div class="panel-body" id="contactos">
					<div class="form-group">
						<label class="col-sm-4 control-label ">NOMBRE</label>
						<label class="col-sm-3 control-label ">CORREO</label>
						<label class="col-sm-2 control-label ">TELÉFONO</label>
						<label class="col-sm-2 control-label ">ESTADO</label>
						<a class="col-sm-1 bt btn-link" href='javascript:void(0);' id="addMoreCont"><strong>Agregar</strong></a>
					</div>        
					<?php
					if ($oItem->tallerID=="") {
						?>
						<div class="form-group">
							<div class="col-sm-4">
								<input style="display:none" name="contactoID[]" id="contactoID" type="text" value="">
								<input name="nombreCompleto[]" type="text" id="nombreCompleto" class="form-control" value="" maxlength="150" placeholder="Nombre Completo">
							</div>
							<div class="col-sm-3">
								<input name="direccionCont[]" type="text" id="direccionCont" class="form-control" value="" maxlength="150" placeholder="Correo contacto">
							</div>
							<div class="col-sm-2">
								<input name="telefonoCont[]" type="text" id="telefonoCont" class="form-control" value="" maxlength="50" placeholder="Teléfono contacto">
							</div>
							<div class="col-sm-2">
								<select name="estadoCont[]" id="estadoCont" class="form-control">
									<option value="1">ACTIVO</option>
									<option value="0">INACTIVO</option>
								</select>
							</div>
							<div class="col-sm-1">
								<a href='javascript:void(0);' class='remove btn btn-link'><strong>Remover</strong></a>
							</div>
						</div>
						<?php
					} else {
						$lContactos  =CrmContacto::getListByTaller($oItem->tallerID);
						foreach ($lContactos as $oItemContacto) {
							?>
							<div class="form-group">
								<div class="col-sm-4">
									<input style="display:none" name="contactoID[]" id="contactoID" type="text" value="<?php echo $oItemContacto->contactoID;?>">
									<input name="nombreCompleto[]" type="text" id="nombreCompleto" class="form-control" value="<?php echo $oItemContacto->nombreCompleto;?>" maxlength="150" placeholder="Nombre Completo">
								</div>
								<div class="col-sm-3">
									<input name="direccionCont[]" type="text" id="direccionCont" class="form-control" value="<?php echo $oItemContacto->direccion;?>" maxlength="150" placeholder="correo contacto">
								</div>
								<div class="col-sm-2">
									<input name="telefonoCont[]" type="text" id="telefonoCont" class="form-control" value="<?php echo $oItemContacto->telefono;?>" maxlength="50" placeholder="Teléfono contacto">
								</div>
								<div class="col-sm-2">
									<select name="estadoCont[]" id="estadoCont" class="form-control">
										<option value="1"<?php if($oItemContacto->estado==1) print ' selected';?>>ACTIVO</option>
										<option value="0"<?php if($oItemContacto->estado==0) print ' selected';?>>INACTIVO</option>
									</select>
								</div>
								<div class="col-sm-1">
									<a href='javascript:void(0);' class='removeCont btn btn-link'><strong>Remover</strong></a>
								</div>
							</div>
							<?php
						}
					}
					?>        
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					Servicios
				</div>
				<div class="panel-body" id="precios">
					<div class="form-group">
						<label class="col-sm-4 control-label ">SERVICIO</label>
						<label class="col-sm-3 control-label ">TIPO CERTIFICADO</label>
						<label class="col-sm-2 control-label ">COSTO</label>
						<a class="col-sm-1 bt btn-link" href='javascript:void(0);' id="addMorePrecio"><strong>Agregar</strong></a>
					</div>        
					<?php
					if ($oItem->tallerID=="") {
						?>
						<div class="form-group">
							<div class="col-sm-4">
								<input style="display:none" name="precioID[]" id="precioID" type="text" value="">
								<select name="tipoServicio[]" id="tipoServicio" class="form-control" autocomplete="off">
									<option value="0">[SELECCIONE]</option> 
									<?php $list= CmsParameterLang::getWebList(11, 1); foreach ($list as $obj) {
										echo "<option value=\"".$obj->parameterID."\"";
										echo ">".$obj->parameterName."</option>";
									}
									?>   
								</select>
							</div>
							<div class="col-sm-3">
								<select name="tipoCertificado[]" id="tipoCertificado" class="form-control" autocomplete="off">
									<option value="0">[SELECCIONE]</option> 
									<?php $list= CmsParameterLang::getWebListParent(12, 70, 1); foreach ($list as $obj) {
										echo "<option value=\"".$obj->parameterID."\"";
										echo ">".$obj->parameterName."</option>";
									}
									?>   
								</select>
							</div>
							<div class="col-sm-2">
								<input name="costo[]" type="number" id="costo" class="form-control" value="" maxlength="50" placeholder="Costo">
							</div>

							<div class="col-sm-1">
								<a href='javascript:void(0);' class='removePrecio btn btn-link'><strong>Remover</strong></a>
							</div>
						</div>
						<?php
					} else {
						$lPrecioTalleres =NULL;
						$lPrecioTalleres  =CrmPrecioTaller::getListByTaller($oItem->tallerID);
						if(!empty($lPrecioTalleres)){
							?>
							<div class="form-group">
								<div class="col-sm-4">
									<input style="display:none" name="precioID[]" id="precioID" type="text" value="">
									<select name="tipoServicio[]" id="tipoServicio" class="form-control" autocomplete="off">
										<option value="0">[SELECCIONE]</option> 
										<?php $list= CmsParameterLang::getWebList(11, 1); foreach ($list as $obj) {
											echo "<option value=\"".$obj->parameterID."\"";
											echo ">".$obj->parameterName."</option>";
										}
										?>   
									</select>
								</div>
								<div class="col-sm-3">
									<select name="tipoCertificado[]" id="tipoCertificado" class="form-control" autocomplete="off">
										<option value="0">[SELECCIONE]</option> 
										<?php $list= CmsParameterLang::getWebListParent(12, 70, 1); foreach ($list as $obj) {
											echo "<option value=\"".$obj->parameterID."\"";
											echo ">".$obj->parameterName."</option>";
										}
										?>   
									</select>
								</div>
								<div class="col-sm-2">
									<input name="costo[]" type="number" id="costo" class="form-control" value="" maxlength="50" placeholder="Costo">
								</div>

								<div class="col-sm-1">
									<a href='javascript:void(0);' class='removePrecio btn btn-link'><strong>Remover</strong></a>
								</div>
							</div>


							<?php  } 
							foreach ($lPrecioTalleres as $oItemPrecioTaller) {
								?>
								<div class="form-group">
									<div class="col-sm-4">
										<input style="display:none" name="precioID[]" id="precioID" type="text" value="<?php echo $oItemPrecioTaller->precioID;?>">
										<select name="tipoServicio[]" id="tipoServicio" class="form-control" autocomplete="off">
											<option value="0">[SELECCIONE]</option> 
											<?php $list= CmsParameterLang::getWebList(11, 1); foreach ($list as $obj) {
												echo "<option value=\"".$obj->parameterID."\"";
												if($oItemPrecioTaller != NULL){ if($obj->parameterID==$oItemPrecioTaller->tipoServicio) echo 'selected="true"';}
												echo ">".$obj->parameterName."</option>";
											}
											?>   
										</select>
									</div>
									<div class="col-sm-3">
										<select name="tipoCertificado[]" id="tipoCertificado" class="form-control" autocomplete="off">
											<option value="0">[SELECCIONE]</option> 
											<?php $list= CmsParameterLang::getWebListParent(12, 70, 1); foreach ($list as $obj) {
												echo "<option value=\"".$obj->parameterID."\"";
												if($oItemPrecioTaller != NULL){ if($obj->parameterID==$oItemPrecioTaller->tipoCertificado) echo 'selected="true"';}
												echo ">".$obj->parameterName."</option>";
											}
											?>   
										</select>
									</div>
									<div class="col-sm-2">
										<input name="costo[]" type="text" id="costo" class="form-control" value="<?php echo $oItemPrecioTaller->costo;?>" maxlength="50" placeholder="costo">
									</div>

									<div class="col-sm-1">
										<a href='javascript:void(0);' class='removePrecio btn btn-link'><strong>Remover</strong></a>
									</div>
								</div>
								<?php
							}
						}
						?>        
					</div>
				</div>


				<script>
					$(function(){
						$('#addMore').on('click', function() {
							var data = $("#sedes div:eq(1)").clone(true).appendTo("#sedes");
							data.find("input").val('');
							data.find("#estadoSede").val('1');
							data.find("#ubigeo").val('00');

						});
						$(document).on('click', '.remove', function() {
							var trIndex = $(this).closest(".form-group").index();
							if(trIndex>1) {
								$(this).closest(".form-group").remove();
							} else {
								alertify.error("No puede removerse la primera fila");
							}
						});
						$('#addMoreCont').on('click', function() {
							var data = $("#contactos div:eq(1)").clone(true).appendTo("#contactos");
							data.find("input").val('');
							data.find("#estadoCont").val('1');

						});
						$(document).on('click', '.removeCont', function() {
							var trIndex = $(this).closest(".form-group").index();
							if(trIndex>1) {
								$(this).closest(".form-group").remove();
							} else {
								alertify.error("No puede removerse la primera fila");
							}
						});
						$('#addMorePrecio').on('click', function() {
							if($("#precios div:eq(1)").html() != ''){
								var data = $("#precios div:eq(1)").clone(true).appendTo("#precios");
								data.find("input").val('');
							}else{
								console.log('no hay data')
							} 

						});
						$(document).on('click', '.removePrecio', function() {
							var trIndex = $(this).closest(".form-group").index();
							if(trIndex>1) {
								$(this).closest(".form-group").remove();
							} else {
								alertify.error("No puede removerse la primera fila");
							}
						});
					});      
				</script>

				<div class="form-group">
					<label class="col-sm-2 control-label ">Autorizado en GLP (Impresion)</label>
					<div class="col-sm-10">
						<label for="radio1">
							<input type="radio" class="flat-blue" id="radio1" name="glpAut" value="1" <?php if($oItem->glpAut==1) echo "checked";?>>          
							Si
						</label>        
						<label for="radio2">
							<input type="radio" class="flat-blue" id="radio2" name="glpAut" value="0" <?php if($oItem->glpAut==0) echo "checked";?>>          
							No
						</label>        
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label ">Autorizado en GNV (Impresion)</label>
					<div class="col-sm-10">
						<label for="radio3">
							<input type="radio" class="flat-blue" id="radio3" name="gnvAut" value="1" <?php if($oItem->gnvAut==1) echo "checked";?>>          
							Si
						</label>        
						<label for="radio4">
							<input type="radio" class="flat-blue" id="radio4" name="gnvAut" value="0" <?php if($oItem->gnvAut==0) echo "checked";?>>          
							No
						</label>        
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label ">Estado</label>
					<div class="col-sm-10">
						<?php 
						if($MODULE->FormView!="edit"){
							?>
							<input type="checkbox" class="flat-blue form-control" name="estado" value="1" checked> Activo
							<?php 
						}else{
							?>
							<input type="checkbox" class="flat-blue form-control" name="estado" value="1" <?php if($oItem->estado==1) print "checked";?>> Activo
							<?php 
						} ?>        
					</div>
				</div>
			</div>
			<div class="box-footer">
				<input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
				<input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
			</div>
		</div>