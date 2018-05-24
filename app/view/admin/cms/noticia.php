<?php
$date=date("Y-m-d", strtotime($oItem->date));
if($date=="1969-12-31") $date="";

$icono=XMLParser::getValue($oItem->media, 'icono');
$imagen=XMLParser::getValue($oItem->media, 'imagen');
?>
<script type="text/javascript" src="../assets/plugins/datepick/jquery.datepick.js"></script>
<style type="text/css">
@import url('../app/plugins/datepick/jquery.datepick.css');
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#date").datepick({dateFormat: 'yyyy-mm-dd', showTrigger: '<img src="../assets/plugins/datepick/calendar.gif" alt="calendario"  align="absmiddle" >'});
});
</script>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="description">Descripci&oacute;n</label>
  <div class="col-sm-9 col-lg-11">
    <textarea class="ckeditor" name="description" id="description"><?php echo $oItem->description; ?></textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="date">Fecha</label>
  <div class="col-sm-9 col-lg-11">
    <input name="date" type="text" id="date" placeholder="Ingrese una fecha" required="true" class="form-control" value="<?php echo $date; ?>" maxlength="10">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="icono">Imagen (Portada)</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[icono]" id="icono" value="<?php echo $icono;?>" class="form-control fmanager" rel="<?php echo $media_group["noticia_icono"];?>" required="true" type="text" />
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="imagen">Imagen (grande)</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[imagen]" id="imagen" value="<?php echo $imagen;?>" class="form-control fmanager" rel="<?php echo $media_group["noticia_imagen"];?>" required="true" type="text" />
    </div>
  </div>
</div>

<div class="form-group">
  <div class="col-sm-3 col-lg-1">&nbsp;</div>
  <label class="col-sm-9 col-lg-11"><input type="checkbox" class="flat-blue form-control" name="showInHome" value="1" <?php if($oItem->showInHome==1 || $oItem->showInHome==NULL) echo "checked";?>> Ver en Home</label>
</div>

<script type="text/javascript">
$(document).ready(function(){
CKEDITOR.replace( 'resumen',
    {
        toolbar : 'Basic',
        height:"100"
    });
});
</script>
