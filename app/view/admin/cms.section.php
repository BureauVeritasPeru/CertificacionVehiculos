<?php 
//Get MediaGroup
$media_group=array();
$list=CmsMediaGroup::getList();
foreach($list as $obj) $media_group["$obj->alias"]=$obj->groupID;

$oItem->title=($oItem->title!="") ? $oItem->title : $oItem->sectionName;

$imagen_seccion=XMLParser::getValue($oItem->media, 'imagen_seccion');
?>
<script type="text/javascript" src='<?php echo $URL_BASE;?>plugins/ckeditor/ckeditor.js'></script>
<script type="text/javascript">
$(document).ready(function(){
  CKEDITOR.config.filebrowserBrowseUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';
  CKEDITOR.config.filebrowserUploadUrl = '<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=2&editor=ckeditor&fldr=misc';

  $("#title").blur(function(){
      if($("#staticURL").val() ==""){
          $("#staticURL").val($("#title").val());
      }
  });

  $("#Command").val("update");

});
</script>
<input type="hidden" name="langID" value="<?php echo $oItem->langID; ?>" />
<div class="box">
  <div class="box-header">
    <h2 class="box-title"><i class="fa fa-edit"></i> <?php echo ($MODULE->FormView=="edit")?$oItem->title:"nuevo"; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Contenido</a></li>
        <li><a href="#tab_2" data-toggle="tab">Meta-Tags</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          
          <div class="form-group">
            <label class="col-sm-3 col-lg-1 control-label " for="title">T&iacute;tulo</label>
            <div class="col-sm-9 col-lg-11">
              <input name="title" type="text" id="title" placeholder="Ingrese un t&iacute;tulo" required="true" class="form-control" value="<?php echo $oItem->title; ?>" maxlength="255">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 col-lg-1 control-label " for="description">Descripci&oacute;n</label>
            <div class="col-sm-9 col-lg-11">
              <textarea class="ckeditor" name="description" id="description"><?php echo $oItem->description; ?></textarea>
            </div>
          </div>
<?php if($oItem->isEditable){ ?>
          <div class="form-group">
            <label class="col-sm-3 col-lg-1 control-label " for="imagen">Imagen</label>
            <div class="col-sm-9 col-lg-11">
              <div class="input-group">
                <input name="media[imagen]" id="imagen" value="<?php echo $imagen_seccion;?>" class="form-control fmanager" rel="<?php echo $media_group["seccion_imagen"];?>" type="text" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-3 col-lg-1">&nbsp;</div>
            <label class="col-sm-9 col-lg-11">
              <input type="checkbox" class="flat-blue form-control" name="showContent" value="1" <?php if($oItem->showContent==1 || $oItem->showContent==NULL) echo "checked";?>>
              Ver como p&aacute;gina de inicio
            </label>
          </div>
<?php } ?>

        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          
          <div class="form-group">
            <label class="col-sm-3 col-lg-1 control-label "><strong>Title</strong></label>
            <div class="col-sm-9 col-lg-11"><textarea name="metaTag[title]" rows="4" class="form-control"><?php echo XMLParser::getValue($oItem->metaTag, "title");?></textarea>
              <div class="tagleyend">(*) T&iacute;tulo de la p&aacute;gina</div>
              
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label  col-lg-1"><strong>Description</strong></label>
            <div class="col-sm-9 col-lg-11"><textarea name="metaTag[description]" rows="4" class="form-control"><?php echo XMLParser::getValue($oItem->metaTag, "description");?></textarea>
              <div class="tagleyend">(*) Breve resumen de la p&aacute;gina</div>
              
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 col-lg-1 control-label "><strong>Keywords</strong></label>
            <div class="col-sm-9 col-lg-11"><textarea name="metaTag[keywords]" rows="4"  class="form-control"><?php echo XMLParser::getValue($oItem->metaTag, "keywords");?></textarea>
              <div class="tagleyend">(*) Palabras relacionadas a la p&aacute;gina, separadas por comas</div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 col-lg-1 control-label ">
              URL Est&aacute;tica
            </label>
            <div class="col-sm-9 col-lg-11">
              <input type="text" name="staticURL" id="staticURL" placeholder="Ingrese url est&aacute;tica" class="required form-control" value="<?php echo $oItem->staticURL;?>" maxlength="255" />
              <div>(*) Nombre de ruta amigable, sin espacios ni caracteres especiales.</div>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <div class="box-footer">
    <button type="submit" class="btn btn-success" id="btnSave" name="btnSave"><span class="fa fa-check"></span> guardar</button>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('.fmanager').each(function(idx, item){
    var rel=$(item).attr('rel');
    var id=$(item).attr('id');
    var btn=$('<span class="input-group-btn"><button class="btn btn-info btn-flat" type="button"><i class="fa fa-camera"></i></button></span>');
    var pnl=$('<div class="fpanel"><iframe width="100%" height="400" frameborder="0" src="<?php echo $URL_BASE;?>plugins/filemanager/dialog.php?type=1&field_id='+id+'&relative_url=1&fldr='+rel+'"></iframe></div>');
    $(this).parent().append(btn);
    $(this).parent().parent().append(pnl);
    $(btn).click(function(){
      $(pnl).toggle();
    });
  });
  $(".fpanel").hide();

  CKEDITOR.replace( 'resumen',
  {
    toolbar : 'Basic',
    height : "100"
  });

});
</script>