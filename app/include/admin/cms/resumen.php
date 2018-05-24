<script type="text/javascript">
$(document).ready(function() {
    CMSFileManager('seccion_icono', {title: 'Seleccione una imagen', groupID: <?php echo $media_group["seccion_icono"];?>, fileExt: '*.jpg;*.gif;*.png'} ); });
</script>
<tr>
  <td>P&aacute;gina de Secci&oacute;n</td>
  <td><br />
  <table class="tblForm" width="450">
    <tr>
      <td>&iacute;cono (imagen)</td>
      <td><input name="media[seccion_icono]" type="text" id="seccion_icono" value="<?php echo $oItem->media['seccion_icono']['Id']; ?>"></td>
    </tr>
    <tr>
      <td>Resumen</td>
      <td><textarea name="resumen" cols="53" rows="3" id="resumen"><?php echo $oItem->resumen; ?></textarea></td>
    </tr>
  </table>
  </td>
</tr>
