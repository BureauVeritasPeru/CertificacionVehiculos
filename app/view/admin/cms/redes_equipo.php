
<div class="form-group">
  <label class="col-sm-3 col-lg-1 control-label " for="subTitle">Icono</label>
  <div class="col-sm-9 col-lg-10">
    <input name="subTitle" type="text" id="subTitle" required="true" class="form-control" value="<?php echo $oItem->subTitle; ?>" maxlength="255">
  </div>
  <div class="col-sm-3 col-lg-1  ">
  <button class="btn btn-primary" onClick="window.open('http://fontawesome.io/icons/', '_blank')"><span class="fa fa-black-tie"></span> Iconos </button>
  </div>
</div>

<?php include("../app/include/admin/cms/enlace.php");?>