<?php
if(!isset($oItem->parameter['error'])) $oItem->parameter['error']=NULL;
$arrErr=array(400, 401, 403, 404, 500, 503, 504, 505);
?>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label" for="description">Descripci&oacute;n</label>
  <div class="col-sm-9 col-lg-11">
    <textarea class="ckeditor" name="description" id="description"><?php echo $oItem->description; ?></textarea>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label" for="description">C&oacute;digo de Error</label>
  <div class="col-sm-9 col-lg-11">
    <select name="parameter[error]" id="error" class="form-control">
      <?php
      foreach ($arrErr as $err){
          echo '<option value="'.$err.'" '.($err==$oItem->parameter['error']? 'selected="true"':'').' >'.$err.'</option>';
      }
      ?>
    </select>
  </div>
</div>
