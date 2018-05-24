<?php
$icono=XMLParser::getValue($oItem->media, 'icono');
?>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="icono">Imagen</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[icono]" id="icono" value="<?php echo $icono;?>" class="form-control fmanager" rel="<?php echo $media_group["acceso_icono"];?>" required="true" type="text" />
    </div>
  </div>
</div>
<?php include("../app/include/admin/cms/enlace.php");?>