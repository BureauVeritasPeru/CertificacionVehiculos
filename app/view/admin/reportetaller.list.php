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

			location.href = '<?php echo $URL_ROOT;?>ajax/reporte_taller.php?fechaIni='+$('#fechaIni').val() + '&fechaFin='+$('#fechaFin').val()+'&taller='+$('#tallerID').val()+'&inspector='+$('#usuarioID').val();
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
			
			<div class="col-sm-1">            
				<label>&nbsp;</label>
				<div class="form-group">
					<input name="btnSearch" id="btnSearch" type="button" class="btn btn-primary" value="Buscar" />            
				</div>
			</div>
		</div>
	</div>
</div>

