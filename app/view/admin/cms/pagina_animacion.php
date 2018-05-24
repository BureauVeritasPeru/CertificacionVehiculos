<?php
$imagen=XMLParser::getValue($oItem->media, 'imagen');
?>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="subTitle">Texto 1 </label>
  <div class="col-sm-9 col-lg-11">
    <input name="subTitle" type="text" id="subTitle" required="true" class="form-control" value="<?php echo $oItem->subTitle; ?>" maxlength="255">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="subTitle2">Texto 2</label>
  <div class="col-sm-9 col-lg-11">
    <input name="subTitle2" type="text" id="subTitle2" required="true" class="form-control" value="<?php echo $oItem->subTitle2; ?>" maxlength="255">
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="imagen">Imagen</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[imagen]" id="imagen" value="<?php echo $imagen;?>" class="form-control fmanager" rel="<?php echo $media_group["animacion_home"];?>" required="true" type="text" />
    </div>
  </div>
</div>
