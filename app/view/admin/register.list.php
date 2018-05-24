<?php
$contactGroupID =0; //Initialized
?>
<script type="text/javascript">
$(function(){
$('#formID').change(function(){
if($('#contactID').length>0){
$('#contactID').val('0');
$("select#contactID")[0].selectedIndex = -1;
}
Search(document.forms[0]);
});
$('#contactID').change(function(){
Search(document.forms[0]);
});
});
function ViewModal(id){
var url=document.forms[0].action+"&kID="+id+"&FormView=edit&callback=true";
$('#divViewForm').modal();
$.ajax({
url: url,
success: function(data) {
$('#divViewForm').html('<h2 class="subtitulo"><?php echo $MODULE->moduleName.": Detalle";?></h2>'+data);
}
});
}
</script>
<style type="text/css">
.trPendiente td{ font-weight:bold;}
</style>
<div class="box box-default">
    <div class="box-header">
        <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
    </div>
    <div class="box-body">
        
        <div class="col-sm-3">
            <div class="form-group padding-right-10">
                <label>Formulario: </label>
                <select name="formID" id="formID" class="form-control">
                    <?php
                    $list=CrmForm::getList();
                    foreach ($list as $obj) {
                    if(empty($oItem->formID)) $oItem->formID=$obj->formID;
                    echo "<option value=\"".$obj->formID."\"";
                        if($obj->formID==$oItem->formID){
                        $contactGroupID=$obj->contactGroupID;
                        echo " selected";
                        }
                    echo ">".$obj->formName."</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <?php
        if($contactGroupID>0){
        ?>
        
        <div class="col-sm-3">
            <div class="form-group padding-right-10">
                <label>Parámetro: </label>
                <select name="contactID" id="contactID" class="form-control">
                    <?php
                    $list= CmsParameterLang::getList($contactGroupID, 1); //default language
                    foreach ($list as $obj) {
                    $selected=NULL;
                    if(!isset($oItem->contactID)) $oItem->contactID=$obj->parameterID;
                    if($obj->parameterID==$oItem->contactID) $selected =" selected";
                    echo "<option value=\"".$obj->parameterID."\"".$selected.">".$obj->parameterName."</option>";
                    }
                    if($selected==NULL && $list->getLength()>0) $oItem->contactID=$list->getItem(0)->parameterID;
                    ?>
                </select>
            </div>
        </div>
        <?php
        }
        ?>
        
        <div class="col-sm-3">
            <div class="form-group padding-right-10">
                <label >Palabra: </label>
                
                <input name="txtsearch" type="text" class="form-control" value="<?php echo $txtsearch?>" placeholder="Nombres / Apellidos / Email" maxlength="255">
                
            </div>
        </div>
        
        <div class="col-sm-2 col-lg-1">
            
                <label>&nbsp;</label>
            <div class="form-group">
            <input name="btnSearch" type="button" class="btn btn-primary" onclick="Search(this.form)" value="Buscar" />
            
        </div>
        </div>
        
        <table class="table table-bordered table-hover">
            <tr>
                <th width="35">&nbsp;</th>
                <th width="120"><?php echo $MODULE->getSortingHeader("registerDate", "Fecha");?></th>
                <th width="120"><?php echo $MODULE->getSortingHeader("name", "Nombre");?></th>
                <th width="120"><?php echo $MODULE->getSortingHeader("phone", "Tel&eacute;fono");?></th>
                <th width="120"><?php echo $MODULE->getSortingHeader("email", "E-mail");?></th>
                <th width="60"><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
            </tr>
            <?php
                $list=CrmRegisterForm::getList_Paging($oItem->formID, $txtsearch);
                foreach ($list as $oItem){
            ?>
            <tr class="<?php echo ($oItem->state==2)?'trPendiente': ''; ?>">
                <td nowrap="nowrap">
                    <a href="<?php echo "javascript:View(".$oItem->registerID.");"; ?>"><i class="fa fa-eye"></i></a>
                    <a href="<?php echo "javascript:Delete(".$oItem->registerID.");"; ?>"><i class="fa fa-remove"></i></a>
                </td>
                <td><?php echo $oItem->registerDate; ?></td>
                <td><?php echo $oItem->name; ?></td>
                <td><?php echo $oItem->phone; ?></td>
                <td><?php echo $oItem->email; ?></td>
                <td align="center"><?php echo CrmRegisterForm::getState($oItem->state);?></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <div id="divViewForm" style="display:none; height:420px; width:550px;">
            <img src="../assets/admin/images/i_loading.gif" align="absbottom" /> Cargando...
        </div>
    </div>
    <div class="box-footer">
        <button class="btn btn-primary" name="btnExport" onClick="Export(this.form)">exportar</button>
        <input type="hidden" name="OrderBy" value="<?php echo $OrderBy?>">
        
        <?php echo $MODULE->getPaging();?>
        
    </div>
</div>