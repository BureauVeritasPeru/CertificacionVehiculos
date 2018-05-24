<script type="text/javascript">
function on_submit(xform){
    if($("#codigo").val() ==""){
        alert("Por favor, ingrese el campo [Codigo]");
        $("#codigo").focus();
        return false;
    }
	if($("#listaNombre").val() ==""){
		alert("Por favor, ingrese el campo [Nombre]");
		$("#listaNombre").focus();
		return false;
	}

	xform.Command.value="<?php echo ($MODULE->FormView=="edit") ?"update":"insert";?>";
	xform.submit();
}
</script>
<input type="hidden" name="grupoID" value="<?php echo $oItem->grupoID?>">
<table class="tblForm" width="500">
      <tr>
        <td>C&oacute;digo</td>
        <td><input name="codigo" type="text" class="text" id="codigo" value="<?php echo $oItem->codigo; ?>" size="15" maxlength="20"></td>
      </tr>
      <tr>
        <td>Nombre</td>
        <td><input name="listaNombre" type="text" class="text" id="listaNombre" value="<?php echo $oItem->listaNombre; ?>" size="80" maxlength="255"></td>
      </tr>
      <tr> 
        <td>Estado</td>
        <td><input type="checkbox" name="activo" value="1" <?php if($oItem->activo==1) print "checked";?>> Activo</td>
      </tr>
      <tr> 
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr> 
        <td colspan="2"><input type="button" value="guardar" id="sbmSave" name="btnSave" onClick="javascript:on_submit(this.form);">
                                <input type="button" name="btnCancel" value="cancelar" onClick="javascript:Back();"></td>
      </tr>
</table>
