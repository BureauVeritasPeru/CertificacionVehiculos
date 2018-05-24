<?php
$userAdmin	=AdmLogin::getUserSession();

function Print_TreeModule($menuID, $profileID){
	$lModulo=AdmModule::getList_Profile($menuID);
	foreach($lModulo as $oModule){
		$moduleID	=$oModule->moduleID;
		$list=AdmEvent::getList_Profile($moduleID, $profileID);
		if($list->getLength()==0) continue;
		echo "<li class=\"open\"><span>$oModule->moduleName</span><ul>";
		foreach ($list as $obj) {
			echo "<li><input type=\"checkbox\" class=\"flat-blue\" name=\"events[]\" id=\"ev_".$obj->eventID."\" value=\"".$obj->eventID."\"";
			if($obj->profileID==$profileID) echo " checked";
			echo "> <label for=\"ev_".$obj->eventID."\">".$obj->eventName."</label></li>";
		}
		echo "</ul></li>";
	}
}

?>
<link rel="stylesheet" href="<?php echo $URL_BASE;?>plugins/treeview/jquery.treeview.css" /> 
<script src="<?php echo $URL_BASE;?>plugins/treeview/lib/jquery.cookie.js" type="text/javascript"></script> 
<script src="<?php echo $URL_BASE;?>plugins/treeview/jquery.treeview.js" type="text/javascript"></script> 
<script type="text/javascript"> 
$(function() {
    $("#tree").treeview({
        collapsed: true,
        animated: "medium",
        control:"#sidetreecontrol",
        persist: "location"
    });
})
</script> 
<script type="text/javascript">
function on_submit(xform){
	if(xform.profileName.value ==""){
		alert("Please, enter [Name]");
		xform.profileName.focus(); return false;}

	xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
	xform.submit();
}
</script>

<div class="box box-default">
  <div class="box-header"><h2 class="box-title"><i class="fa fa-edit"></i> <?php echo ($MODULE->FormView=="edit")?$oItem->profileName:$MODULE->moduleName; ?></h2><i class="fa fa-close pull-right"  onClick="javascript:Back();"></i>
  </div>
  <div class="box-body">
    <div class="form-group">
      <label class="col-sm-2 control-label ">Nombre</label>
      <div class="col-sm-10">
        <input name="profileName" type="text" class="form-control" id="profileName" value="<?php echo $oItem->profileName; ?>" size="30" maxlength="30">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label ">Permisos</label>
      <div class="col-sm-10">
        
                     <div id="sidetreecontrol" style="float:right"><a href="#">Contraer items</a> | <a href="#">Expandir items</a></div> 
                        <ul id="tree">
<?php
	$lMenu=AdmMenu::getList_Profile(0);
	foreach($lMenu as $oMenu){
		$menuID=$oMenu->menuID;
		Print_TreeModule($menuID, $oItem->profileID);
		echo "<li class=\"open\"><span>$oMenu->menuName</span><ul>";
		$lSMenu=AdmMenu::getList_Profile($menuID);
		foreach($lSMenu as $oSMenu){
			$submenuID=$oSMenu->menuID;
			echo "<li class=\"open\"><span>$oSMenu->menuName</span><ul>";
			Print_TreeModule($submenuID, $oItem->profileID);
			echo "</ul></li>";
		}
		echo "</ul></li>";
	}
?>
                          </ul>
      </div>
    </div>



  </div>


    <div class="box-footer">
      <input type="button" class="btn btn-primary" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
      <input type="button" class="btn btn-primary" name="btnCancel" value="cancelar" onClick="javascript:Back();">
    </div>

</div>
