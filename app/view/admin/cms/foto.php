<?php
$icono=XMLParser::getValue($oItem->media, 'icono');
$imagen=XMLParser::getValue($oItem->media, 'imagen');
?>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="icono">Imagen (&iacute;cono)</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[icono]" id="icono" value="<?php echo $icono;?>" class="form-control fmanager" rel="<?php echo $media_group["galeria_icono"];?>" required="true" type="text" />
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="imagen">Imagen (grande)</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[imagen]" id="imagen" value="<?php echo $imagen;?>" class="form-control fmanager" rel="<?php echo $media_group["galeria_imagen"];?>" required="true" type="text" />
    </div>
  </div>
</div>
