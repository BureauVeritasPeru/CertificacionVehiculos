<?php
$script=XMLParser::getValue($oItem->parameter, 'script');
?>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="script">Script-Embed</label>
  <div class="col-sm-9 col-lg-11">
    <textarea class="ckeditor" name="parameter[script]" cols="40" id="script"><?php echo $script; ?></textarea>
  </div>
</div>
