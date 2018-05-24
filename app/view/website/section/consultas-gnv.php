<?php
$oUser=WebLogin::getUserSession();
$usuarioID = $oUser->userID;
$filtroID=isset($_REQUEST['filtroID'])? intval($_REQUEST['filtroID']):'';
$filtro=isset($_REQUEST['filtro'])? $_REQUEST['filtro']:'';
$startDate=isset($_REQUEST['startDate'])? $_REQUEST['startDate']:'';
$endDate=isset($_REQUEST['endDate'])? $_REQUEST['endDate']:'';

$list2 = GnvCertificado::getList_Paging($usuarioID, $filtroID, $filtro, $startDate, $endDate);

?>
<section class="content">
	<form name="frmMain" id="frmMain" class="form-horizontal" method="post" autocomplete="off" >
		<div class="box box-default">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-inbox"></i>&nbsp; Consulta de Certificados GNV</h3>
			</div>
			<br>
			<div class="box-body">
        <div class="row">
          <div class="col-sm-3">
           <div class="form-group">
            <label>Buscar por:</label>
            <select name="filtroID" id="filtroID" class="form-control" autocomplete="off">
              <option value="0">[TODOS]</option>
              <option value="1">NRO. CERTIFICADO</option>
              <option value="2">NRO. FORMATO</option>
              <option value="3">PLACA</option>	 
            </select>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Filtro: </label>
            <input name="filtro" type="text" class="form-control" id="filtro" placeholder="Ingrese aqui el filtro (opcional)" maxlength="50" autocomplete="off">
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label>Fecha Inicio: </label>
            <div class="input-group date">
              <input type="text" class="form-control" id="startDate" name="startDate" placeholder="yyyy/mm/dd" readonly="true">
              <div class="input-group-addon ">
                <span class="glyphicon glyphicon-calendar fa fa-calendar"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label>Fecha Fin</label>
            <div class="input-group date">
              <input type="text" class="form-control" id="endDate" name="endDate" placeholder="yyyy/mm/dd" readonly="true">
              <div class="input-group-addon ">
                <span class="glyphicon glyphicon-calendar fa fa-calendar"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-2">
          <label>&nbsp;</label>
          <div class="form-group">
            <div  id="btnBuscar" type="button" class="btn btn-primary" value="Buscar" autocomplete="off">Buscar</div>
          </div>
        </div>
      </div>
      <table class="table table-striped table-hover table-condensed table-bordered table-responsive">
        <thead>
          <tr>
            <th>&nbsp;</th>
            <th style="text-align:center;"><a>N° Certificado</a></th>
            <th style="text-align:center;"><a>Fecha Emisión</a></th>
            <th style="text-align:center;"><a>N° Formato</a></th>
            <th style="text-align:center;"><a>Placa</a></th>
            <th style="text-align:center;"><a>Cliente</a></th>
            <th style="text-align:center;">Taller</th>
            <th style="text-align:center;"><a>Inspector</a></th>
            <th style="text-align:center;"><a>Estado</a></th>
          </tr>
        </thead>
        <tbody id="list-cert">
          <?php
          foreach ($list2 as $oItem){
            $oTaller = CrmTaller::getItem($oItem->tallerID);
            ?>
            <tr>
              <td nowrap="nowrap">
                <a href="<?php echo $URL_ROOT.'certificados-gnv.html?action=update&certificadoID='.$oItem->certificadoID; ?>" title="Editar" id="btnEdit"><i class="fa fa-eye"></i></a>
              </td>
              <td><?php echo $oItem->certificadoID; ?></td>
              <td><?php echo $oItem->fechaEmi; ?></td>
              <td><?php echo $oItem->formatoID; ?></td>
              <td><?php echo $oItem->placa; ?></td>
              <td><?php echo $oItem->cliente; ?></td>
              <td><?php echo $oTaller->razonSocial; ?></td>
              <td><?php echo $oItem->usuario; ?></td>
              <td><?php if($oItem->estado != 0){echo 'Activo';}else{echo 'Inactivo';}; ?></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
      <div class="holder"></div>
    </div>
    <div class="box-footer">
      <div class="btn btn-primary" name="btnExport" id="send_export">Exportar Listado</div>
    </div>
  </div>                     
</form>
</section>
<script>
  $(function(){
    $('#send_export').click(function(){
      location.href = '<?php echo $URL_ROOT;?>ajax/export_gnv.php?filtroID='+$('#filtroID').val()+'&filtro='+$('#filtro').val()+'&startDate='+$('#startDate').val()+'&endDate='+$('#endDate').val();
    });


    $('#startDate').datepicker({
      orientation: "bottom auto",
      autoclose: true,
      todayHighlight: true
    });

    $('#endDate').datepicker({
      orientation: "bottom auto",
      autoclose: true,
      todayHighlight: true
    });

    $('#btnBuscar').on('click', function(){
      filtroID =  $('#filtroID').val();
      filtro = $('#filtro').val();
      startDate = $('#startDate').val();
      endDate   = $('#endDate').val();
      location.href='<?php echo SEO::get_URLROOT(); ?>consultas-gnv.html?filtroID='+filtroID+'&filtro='+filtro+'&startDate='+startDate+'&endDate='+endDate;
    });

    $("div.holder").jPages({
      containerID : "list-cert",
      perPage : 10,
      delay : 20
    });
  }); 
</script>