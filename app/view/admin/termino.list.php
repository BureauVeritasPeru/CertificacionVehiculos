<?php
$lGroup=CmsTerminoGroup::getList();
if(CmsTerminoGroup::getErrorMsg()!="") $MODULE->addError(CmsTerminoGroup::getErrorMsg());

$lLang=CmsLang::getList_Active();
if(CmsLang::getErrorMsg()!="") $MODULE->addError(CmsLang::getErrorMsg());
?>


<div class="box box-default">
    <div class="box-header">
        <h2 class="box-title"><i class="fa <?php echo ($MODULE->moduleIcon=='')?"fa-list":$MODULE->moduleIcon; ?>"></i> <?php echo $MODULE->moduleName; ?></h2>
    </div>
    <div class="box-body">

  
    <div class="col-sm-5">
      <div class="form-group padding-right-10">
        <label>Grupo:</label>        
        <select name="groupID" class="form-control" onChange="this.form.submit();">
        <?php
        foreach ($lGroup as $obj) {
            if(!isset($oItem->groupID)) $oItem->groupID=$obj->groupID;
            echo "<option value=\"$obj->groupID\"";
            if($obj->groupID==$oItem->groupID) print " selected";
            echo ">$obj->groupName</option>";
        }
        ?>
            </select>
        
      </div>
    </div>

            
            
    
            <div class="col-sm-5">
      <div class="form-group">
                <label class="col-sm-2 control-label ">Idioma:</label>
                
            <select name="langID" onChange="this.form.submit();" class="form-control">
        <?php
        foreach ($lLang as $obj) {
            if(!isset($oItem->langID)) $oItem->langID=$obj->langID;
            echo "<option value=\"$obj->langID\"";
            if($obj->langID==$oItem->langID) print " selected";
            echo ">$obj->alias</option>";
        }
        ?>
            </select>  
            </div>
            </div>
     
            



<table class="table table-bordered table-hover">
    <tr> 
      <th>&nbsp;</th>
      <th><?php echo $MODULE->getSortingHeader("terminoName", "Nombre");?></th>
    </tr>
    <?php
    $DAO=$MODULE->StaticDAO;//CmsTerminoLang
    $list=$DAO::getList_Paging($oItem->groupID, $oItem->langID);
    
    foreach ($list as $oItem) {
    ?>
    <tr>
      <td><a href="<?php echo "javascript:Edit(".$oItem->terminoID.");"; ?>"><i class="fa fa-edit"></i></a>
          <a href="<?php echo "javascript:Delete(".$oItem->terminoID.");"; ?>"><i class="fa fa-remove"></i></a>
      </td>
      <td><?php echo $oItem->terminoName; ?></td>
    </tr>
    <?php } ?>
</table>


</div>
<div class="box-footer">
  <button class="btn btn-primary" name="btnNew" onClick="addNew(this.form)">nuevo &iacute;tem</button>
  
  <?php echo $MODULE->getPaging();?>
    
</div>
</div>