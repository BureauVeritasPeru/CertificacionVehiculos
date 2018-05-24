<?php
$imagen=XMLParser::getValue($oItem->media, 'imagen');
$imagen2=XMLParser::getValue($oItem->media, 'imagen2');
?>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="subTitle">Texto 1 </label>
  <div class="col-sm-9 col-lg-11">
    <input name="subTitle" type="text" id="subTitle" required="true" class="form-control" value="<?php echo $oItem->subTitle; ?>" maxlength="255">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="description">Descripci&oacute;n</label>
  <div class="col-sm-9 col-lg-11">
    <textarea class="ckeditor" name="description" id="description"><?php echo $oItem->description; ?></textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="imagen">Imagen</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[imagen]" id="imagen" value="<?php echo $imagen;?>" class="form-control fmanager" rel="<?php echo $media_group["pagina_imagen"];?>" required="true" type="text" />
    </div>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="imagen2">Imagen Grande</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[imagen2]" id="imagen2" value="<?php echo $imagen2;?>" class="form-control fmanager" rel="<?php echo $media_group["pagina_imagen"];?>" required="true" type="text" />
    </div>
  </div>
</div>
