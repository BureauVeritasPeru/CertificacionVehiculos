<?php
$lnkEditParent="EditSection(".$oItem->sectionID.")";
$parentSchemaID =null;
$parentContentID=null;
$parentContentTitle=null;
$topContentID   =null;
$oSection=CmsSection::getItem($oItem->sectionID);

if($oItem->parentContentID>0){
    $obj=CmsContentLang::getItem($oItem->parentContentID, $oItem->langID);
    if($obj!=null){
        $parentSchemaID=$obj->schemaID;
        $parentContentID=$obj->contentID;
        $parentContentTitle=$obj->title;
        $topContentID=$obj->parentContentID;
    }
    $lnkEditParent="Edit(".$parentContentID.")";
}
$url_lightbox='lightbox?moduleID='.$MODULE->moduleID.'&sectionID='.$oItem->sectionID.'&parentContentID='.$parentContentID.'&FormView=sort';
//Get Lang List
$lLang=CmsLang::getList_Active();
if(CmsLang::getErrorMsg()!="") $MODULE->addError(CmsLang::getErrorMsg());
if(!isset($oItem->langID) && $lLang->getLength()>0) $oItem->langID=$lLang->getItem(0)->langID;
//echo "($parentContentID, $oItem->sectionID, $oItem->langID)";
$lContent=CmsContentLang::getList_Paging($parentContentID, $oItem->sectionID, $oItem->langID, $filtro);
?>
<script type="text/javascript">
jQuery(function ($) {
    // Load dialog on click
    xform=document.forms[0];

    $('#btnNew').click(function (e) {
        schemaID = document.getElementsByName('schemaID');
        console.info(schemaID);
        if(schemaID.length==1 && !schemaID[0].disabled){
            schemaID[0].checked=true;
            addNew(xform);
            console.info("add");
        }else{
            $('#myModal').modal('show');
        }
        return false;
    });

    $('#btnSort').click(function (e) {
        //$('#sort_modal div.modal-body').html('<iframe frameborder="0" marginwidth="0" marginheight="0" src="<?php echo $url_lightbox;?>" width="100%" height="100%"></iframe>');
        $('#sort_modal').modal("show") ;
        return false;
    });

    $('#btnClose').click(function (e) {
        $.modal.close();
        return true;
    });

    $('#btnSelect').click(function(e){
        schemaID = document.getElementsByName('schemaID');
        if(typeof(schemaID)=="object"){
            valid=false;
            for(i=0;i<schemaID.length;i++){
                if(schemaID[i].checked) valid=true;
            }
        }
        if(!valid){
            alert("Debe seleccionar una plantilla");
            return false;
        }
        //$.modal.close();
        addNew(xform);
        return true;
    });
});

var set_reload=false;
function LB_Close(){
    if(set_reload) Search();
    //if(set_reload){ location.href="<?php echo $_SERVER['REQUEST_URI'];?>"; }
    //$.modal.close();
}
function selectParent(parentID){
    $("#Page").val('');
    $("#parentContentID").val(parentID);

    $('#frmMain').submit();
}
function EditSection(sectionID){
    $("#kID").val(sectionID);
    $("#FormView").val("section");

    $('#frmMain').submit();
}
</script>
<input type="hidden" id="parentContentID" name="parentContentID" value="<?php echo $parentContentID; ?>" />
<div class="row">
    <div class="col-xs-12">
        <div class="callout callout-info visible-lg visible-md">
            <h4>Info</h4>
            <p>
                Seleccione un art&iacute;culo de la lista para editar su contenido o haga clic en el menu lateral para seleccionar otra secci&oacute;n.
                <br />
                Si desea editar el contenido del nivel superior, haga <a href="<?php echo "javascript:$lnkEditParent"; ?>;"><strong>clic aqu&iacute;</strong></a>.
            </p>
        </div>
    </div>
</div>
<div class="box box-default">
    <div class="box-header">
        <h2 class="box-title"><i class="fa fa-list"></i>  <?php echo (empty($parentContentTitle))?$MODULE->moduleName:$parentContentTitle; ?>  </h2>
    </div>
    <div class="box-body">
        <div class="form-group">
            
            
            <div class="col-sm-4">
                <label class="col-sm-4">Idioma:</label>
                <div class="col-sm-8">
                    <select name="langID" class="form-control" onChange="Search(this.form);">
                        <?php
                        foreach($lLang as $obj){
                        echo "<option value=\"$obj->langID\"";
                            if($obj->langID==$oItem->langID) echo " selected";
                        echo ">$obj->alias</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                
                <input name="filtro" class="form-control" type="text" id="filtro" placeholder="Buscar por t&iacute;tulo" value="<?php echo $filtro;?>" />
            </div>
            <div class="col-sm-2">
                <input name="btnSearch" type="button" class="btn btn-success" value="Buscar" onclick="Search(this.form);"  />
            </div>
        </div>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th><?php echo $MODULE->getSortingHeader("title", "T&iacute;tulo");?></th>
                    <th><?php echo $MODULE->getSortingHeader("registerDate", "Fecha Registro");?></th>
                    <th><?php echo $MODULE->getSortingHeader("active", "Estado");?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($lContent as $oItem) {
                $title=($oItem->title=="" ? $oItem->contentName : $oItem->title);
                $delete='<a href="javascript:Delete('.$oItem->contentID.');"><i class="fa fa-remove"></i>';
                    if($oItem->childSchema>0){
                    $title="<a href=\"javascript:selectParent(".$oItem->contentID.")\">".$title."</a>";
                    if($oItem->childContentLang>0) $delete='';
                    }
                    if($oItem->langID==0) $delete='<img title="Incompleto" src="../assets/admin/images/i_broken.gif" border="0" />';
                    ?>
                    <tr>
                        <td><a href="<?php echo "javascript:Edit(".$oItem->contentID.");"; ?>"><i class="fa fa-edit"></i></a>
                    <?php echo $delete; ?></a>
                </td>
                <td><?php echo $title;?></td>
                <td><?php echo CmsContentLang::getFormatDate($oItem->registerDate, "d/m/Y"); ?></td>
                <td><?php echo CmsContentLang::getActive($oItem->active);?></td>
       
            </tr>
            <?php
            $bMoveUp=true;
            } ?>
        </tbody>
    </table>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Seleccione una plantilla</h4>
                </div>
                <div class="modal-body">
                    
                    <?php
                    $lSchema=CmsSchema::getList($parentSchemaID, $oItem->sectionID, $oItem->langID);
                    if(CmsSchema::getErrorMsg()!="") $MODULE->addError(CmsSchema::getErrorMsg());
                    foreach ($lSchema as $obj) {
                    $enabled="";
                    $style="";
                    $cnt=CmsContentLang::getCount_ChildSchema($obj->schemaID, $oItem->parentContentID, $oItem->langID);
                    if($obj->iterations>0 && $cnt>=$obj->iterations){
                    $enabled="disabled='true'";
                    $style="class='option-disabled'";
                    }
                    echo "<div class=\"form-group\"><div class=\"col-sm-12\"><div class=\"col-sm-1\"><input type=\"radio\" class=\"flat-blue\" name=\"schemaID\" id=\"schema_".$obj->schemaID."\" value=\"".$obj->schemaID."\" ".$enabled." /></div><label class=\"col-sm-11\" for=\"schema_".$obj->schemaID."\">".$obj->alias."</label></div></div>\n";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <input type="button" value="continuar" id="btnSelect" name="btnSelect" class="btn btn-success" />
                    <input type="button" value="cancelar" id="btnClose" name="btnClose" class="btn btn-primary" data-dismiss="modal" />
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sort_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ordena los elementos</h4>
                </div>
                <div class="modal-body">
                    
     
  

<script type="text/javascript">
$(function(){
    $('#btnClose').click(function () {
        parent.$.modal.close();
        return true;
    }); 

    $('#btnSubmit').click(function () {
        if(userReadOnly) { alert(msgUserError); return;}
        
        var kIDs='';
        $('.container .vertical li').each(function(){
            if(kIDs!='') kIDs+=',';
            kIDs+=$(this).attr('rel');
        });

        $('#kIDs').val(kIDs);
        $('#FormView').val('sort');
        $('#Command').val('reorder');
        submitForm();

        return true;
    }); 
});
</script>
<style type="text/css">
@import url('../assets/admin/css/sortable.css');
</style>
<p>Para ordenar la lista, presione sobre un art&iacute;culo y arrastrelo para subir o bajar de posici&oacute;n.<br />
    Finalmente guarde sus preferencias para refrescar la pantalla anterior.</p>
<div class="container">
    <ol class='vertical simple_with_animation'>
<?php
$lContent=CmsContentLang::getList_Paging($parentContentID, $oItem->sectionID, $oItem->langID);
foreach ($lContent as $oItem) {
        $title=($oItem->title=="" ? $oItem->contentName : $oItem->title);
?>
        <li rel="<?php echo $oItem->contentID; ?>">&Colon; <?php echo $title;?></li>
<?php 
}
?>
    </ol>
</div>
<script src='../assets/admin/js/jquery-sortable.js'></script>
<script>
var adjustment;

$("ol.vertical").sortable({
  group: 'vertical',
  pullPlaceholder: false,
  // animation on drop
  onDrop: function  (item, targetContainer, _super) {
    var clonedItem = $('<li/>').css({height: 0})
    item.before(clonedItem)
    clonedItem.animate({'height': item.height()})
    
    item.animate(clonedItem.position(), function  () {
      clonedItem.detach()
      _super(item)
    })
  },

  // set item relative to cursor position
  onDragStart: function ($item, container, _super) {
    var offset = $item.offset(),
    pointer = container.rootGroup.pointer

    adjustment = {
      left: pointer.left - offset.left,
      top: pointer.top - offset.top
    }

    _super($item, container)
  },
  onDrag: function ($item, position) {
    $item.css({
      left: position.left - adjustment.left,
      top: position.top - adjustment.top
    })
  }
})
</script>

      
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kIDs" id="kIDs" />
                    <input type="button" value="guardar" id="btnSubmit" name="btnSubmit" class="btn btn-success" />
                    <input type="button" value="cancelar" id="btnClose" name="btnClose" class="btn btn-primary" data-dismiss="modal" />
                    
                </div>
            </div>
        </div>
    </div>


    
</div>
<div class="box-footer">
    
    <?php
    if($lSchema->getLength()>0){
    ?>
    <button type="button" class="btn btn-warning" id="btnNew" name="btnNew">nuevo &iacute;tem </button>
    <?php
    }
    ?>
    <?php
    if($lSchema->getLength()>0){
    ?>
    <button type="button" class="btn btn-primary" id="btnSort"  name="btnSort">ordenar &iacute;tems </button>
    <?php
    }
    ?>
    <?php
    if($parentContentID>0){
    ?>
    <input type="button" value="regresar" class="btn btn-primary" id="btnBack" name="btnBack" onclick="<?php echo "selectParent($topContentID)";?>">
    <?php
    }
    ?>
    
    <?php echo $MODULE->getPaging();?>
    
</div>
</div>