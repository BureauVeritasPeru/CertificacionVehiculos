<?php
$lListaGrupo=CrmListaGrupo::getList_Activo();
if(CrmListaGrupo::getErrorMsg()!="") $MODULE->addError(CrmListaGrupo::getErrorMsg());
?>
<input type="hidden" name="grupoID" value="<?php echo $grupoID?>">

<fieldset id="fldFiltro" style="text-align: right; width:490px;">
    <legend accesskey="F">Filtros</legend>
    <table width="100%">
      <tr> 
        <td align="right" width="130">Grupo de Lista: 
            <select name="grupoID" onChange="this.form['Page'].value='';this.form.submit();">
        <?php
        foreach ($lListaGrupo as $obj) {
            if(!isset($grupoID)) $grupoID=$obj->grupoID;
            echo "<option value=\"$obj->grupoID\"";
            if($obj->grupoID==$grupoID) print " selected";
            echo ">$obj->grupoNombre</option>";
        }
        ?>
            </select>
         </td>
      </tr>
    </table>
</fieldset>

<table width="500" class="tblList" cellpadding="0" cellspacing="0">
  <tr> 
    <th width="35">&nbsp;</th>
    <th width="390"><?php echo $MODULE->getSortingHeader("listaNombre", "Nombre");?></th>
    <th width="60"><?php echo $MODULE->getSortingHeader("activo", "Estado");?></th>
  </tr>
<?php

$DAO=$MODULE->StaticDAO;//CmsParameterLang
$list=$DAO::getList_Paging($grupoID);
foreach ($list as $oItem) {
?>
    <tr>
      <td nowrap="nowrap"><a href="<?php echo "javascript:Edit(".$oItem->listaID.");"; ?>"><img title="Editar" src="../assets/admin/images/i_edit.gif" border="0" /></a>
          <a href="<?php echo "javascript:Delete(".$oItem->listaID.");"; ?>"><img title="Eliminar" src="../assets/admin/images/i_delete.gif" border="0" /></a>
                              </td>
      <td><?php echo $oItem->listaNombre; ?></td>
      <td align="center"><?php echo $DAO::getActive($oItem->activo);?></td>
    </tr>
    <?php } ?>
  </table>
  <table width="500">
    <tr height="30">
      <td align="left"><input type="button" value="nuevo &iacute;tem" name="btnNew" onClick="addNew(this.form)"></td>
        <td align="right">&nbsp;<?php echo $MODULE->getPaging();?></td>
    </tr>
  </table>
