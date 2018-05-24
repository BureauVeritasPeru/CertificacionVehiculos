<table>
  <tr>
    <th>Nro Certificado</th>
    <th>Nro Formato</th>
    <th>Taller</th>
    <th>Sede del Taller</th>
    <th>Placa</th>
    <th>Fecha de Emisi&oacute;n</th>
    <th>Tipo de Certificado</th>
    <th>Costo</th>
    <th>Inspector</th>
  </tr>
  <?php 
  if($tipoServicio != 70){
    $list=CrmReportes::getItemReporteGeneralGNVA($fechaIni,$fechaFin,$usuarioID,$tallerID,$placa);
  }else{
    $list=CrmReportes::getItemReporteGeneralGLPA($fechaIni,$fechaFin,$usuarioID,$tallerID,$placa);
  }
  foreach ($list as $oItem){
    ?>
    <tr>
      <td><?php echo $oItem->certificadoID; ?></td>
      <td><?php echo $oItem->formatoID; ?></td>
      <td><?php echo htmlentities($oItem->razonSocial, ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo htmlentities($oItem->sede, ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo $oItem->placa; ?></td>
      <td><?php echo $oItem->fechaEmi; ?></td>
      <td><?php echo htmlentities($oItem->tipo, ENT_QUOTES, "UTF-8"); ?></td>
      <td><?php echo $oItem->costo; ?></td>
      <td><?php echo htmlentities($oItem->usuario, ENT_QUOTES, "UTF-8"); ?></td>
    </tr>
    <?php } ?>
  </table>
