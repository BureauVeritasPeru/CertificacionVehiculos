
<input type="hidden" name="Command" id="Command">
<input type="hidden" name="moduleID" id="moduleID" value="<?php echo $MODULE->moduleID; ?>">
<input type="hidden" name="FormView" id="FormView" value="<?php echo $MODULE->FormView; ?>">
<input type="hidden" name="kID" id="kID" value="<?php echo $kID;?>">
<input type="hidden" name="Page" id="Page" value="<?php echo $MODULE->Page;?>">
<input type="hidden" name="OrderBy" id="OrderBy" value="<?php echo $MODULE->OrderBy;?>">

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

	frm=resetForm(document.forms[0]);
	frm.kIDs.value=kIDs;
	frm.Command.value="reorder";
	frm.FormView.value="sort";
	frm.submit();

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
$lContent=CmsContentLang::getList($parentContentID, $oItem->sectionID, $oItem->langID);
foreach ($lContent as $oItem) {
        $title=($oItem->title=="" ? $oItem->contentName : $oItem->title);
?>
        <li rel="<?php echo $oItem->contentID; ?>">&Colon; <?php echo $title;?></li>
<?php 
}
?>
    </ol>
</div>
<input type="hidden" name="kIDs" />
<input type="hidden" name="parentContentID" value="<?php echo $parentContentID; ?>" />

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
