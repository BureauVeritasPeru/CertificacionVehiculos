<?php
$imagen=XMLParser::getValue($oItem->media, 'imagen');
?>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label" for="resumen">Resumen</label>
  <div class="col-sm-9 col-lg-11">
    <textarea name="resumen" cols="40" id="resumen"><?php echo $oItem->resumen; ?></textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label" for="imagen">Imagen</label>
  <div class="col-sm-9 col-lg-11">
    <div class="input-group">
      <input name="media[imagen]" id="imagen" value="<?php echo $imagen;?>" class="form-control fmanager" rel="<?php echo $media_group["widget_imagen"];?>" required="true" type="text" />
    </div>
  </div>
</div>
<?php include("../app/include/admin/cms/enlace.php");?>

<script type="text/javascript">
$(document).ready(function(){
CKEDITOR.replace( 'resumen',
    {
        toolbar : 'Basic',
        height:"100"
    });
});
</script>
