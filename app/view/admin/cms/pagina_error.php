<?php

?>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="subTitle">Texto</label>
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
