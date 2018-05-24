<div class="form-group">
  <label class="col-sm-3 col-md-2 col-lg-1 control-label" for="enlace">Enlace</label>
  <div class="col-sm-4 col-lg-2">
    <div class="input-group">
      <select name="linkType" id="linkType" class="form-control">
          <option value="0">Sin Enlace</option>
          <option value="1" <?php if($oItem->linkType==1) echo "selected"; ?>>Enlace Interno</option>
          <option value="2" <?php if($oItem->linkType==2) echo "selected"; ?>>Enlace Externo</option>
      </select>
    </div>
  </div>
  <div class="col-sm-5 col-lg-8" id="pick_target">
    <div class="input-group">
      <select name="linkTarget" id="linkTarget" class="form-control">
          <option value="1" <?php if($oItem->linkTarget==1) echo "selected"; ?>>Misma Ventana</option>
          <option value="2" <?php if($oItem->linkTarget==2) echo "selected"; ?>>Nueva Ventana</option>
      </select>
    </div>
  </div>
</div>
<div class="form-group" id="pick_internal">
  <div class="col-sm-9 col-md-10 col-lg-11 col-sm-offset-3 col-lg-offset-1">
    <div class="input-group">
      <select name="linkContentID" id="linkContentID" class="form-control">
        <option value="0">Seleccionar enlace:</option>
        <?php
        $list=CmsContentLang::getList_All($oItem->langID);
        foreach($list as $obj){
        ?>
          <option value="<?php echo  $obj->contentID; ?>" <?php if($oItem->linkContentID==$obj->contentID) echo "selected"; ?>><?php echo  $obj->title; ?></option>
        <?php
        }
        ?>
      </select>
    </div>
  </div>
</div>
<div class="form-group" id="pick_external">
  <div class="col-sm-9 col-md-10 col-lg-11 col-sm-offset-3 col-lg-offset-1">
    <div class="input-group">
      <input name="linkURL" id="linkURL" placeholder="http://" type="text" size="45" value="<?php echo $oItem->linkURL; ?>" class="form-control">
    </div>
  </div>
</div>

<script type="text/javascript">
function showCtl_Options(opt){
  $('#linkTarget').show();
  switch(opt){
    case '0':
      $('#linkTarget').hide();
      $('#pick_internal').hide();
      $('#pick_external').hide();
      break;
    case '1':
      $('#pick_internal').show();
      $('#pick_external').hide();
      break;
    case '2':
      $('#pick_internal').hide();
      $('#pick_external').show();
      break;
  }
}
$(document).ready(function(){
  $('#pick_internal').hide();
  $('#pick_external').hide();
  
  $('#linkType').change(function(){
    showCtl_Options($('#linkType').val());
  });
  
  showCtl_Options($('#linkType').val());
});
</script>