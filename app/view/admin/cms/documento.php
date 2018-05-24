<?php
$documento=XMLParser::getValue($oItem->media, 'documento');
?>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="documento">Documento</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[documento]" id="documento" value="<?php echo $documento;?>" class="form-control fmanager" rel="<?php echo $media_group["pagina_documento"];?>" required="true" type="text" />
    </div>
  </div>
</div>
