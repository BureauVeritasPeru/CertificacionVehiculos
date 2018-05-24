<?php
?>
<script type="text/javascript" src="../assets/admin/js/popcalendar.js"></script>
<fieldset id="fldFiltro" style="text-align: right; width:490px;">
<legend accesskey="F">Filtros</legend>
    <table width="100%">
    <tr>
      <td nowrap align="right">N&uacute;mero OC:</td>
      <td><input name="customerPO" type="text" class="text" value="<?php echo $customerPO?>" size="8" maxlength="10"></td>
      <td nowrap align="right">Fecha Inicio:</td>
      <td><input name="startDate" readonly="readonly" type="text" class="text" value="<?php echo $startDate?>" size="6" maxlength="10"><a href="javascript:;"><img src="../assets/admin/images/calendar.jpg" border="0" onClick="popUpCalendar(this, document.forms[0].startDate, 'yyyy-mm-dd')"></a></td>
      <td nowrap align="right">Fecha Fin: </td>
      <td><input name="endDate" readonly="readonly" type="text" class="text" value="<?php echo $endDate?>" size="6" maxlength="10"><a href="javascript:;"><img src="../assets/admin/images/calendar.jpg" border="0" onClick="popUpCalendar(this, document.forms[0].endDate, 'yyyy-mm-dd')"></a></td>
      <td width="60" align="right"><input name="btnSearch" type="submit" value="Buscar"></td>
        </tr>
      </table>
</fieldset>
<table width="500" class="tblList" cellpadding="0" cellspacing="0">
      <tr> 
        <th width="60"><?php echo $MODULE->getSortingHeader("id_order", "N&uacute;mero");?></th>
        <th><?php echo $MODULE->getSortingHeader("registerDate", "Fecha Emisi&oacute;n");?></th>
        <th><?php echo $MODULE->getSortingHeader("name", "Cliente");?></th>
        <th><?php echo $MODULE->getSortingHeader("total", "Total");?></th>
        <th><?php echo $MODULE->getSortingHeader("state", "Estado");?></th>
      </tr>
    <?php
	$DAO=$MODULE->StaticDAO;//ShopOrder
	$list=$DAO::getList_Paging($customerPO, $startDate, $endDate);
	foreach ($list as $oItem) {
	?>
        <tr class="TRList" height="20">
          <td nowrap="nowrap"><a href="<?php echo "javascript:Edit(".$oItem->id_order.");"; ?>"><?php echo str_pad($oItem->id_order,6,"0", STR_PAD_LEFT); ?></a></td>
          <td><?php echo $oItem->registerDate; ?></td>
          <td><?php echo $oItem->Name; ?></td>
          <td align="right"><?php echo number_format($oItem->total,2,'.',','); ?></td>
          <td><?php echo $DAO::getState($oItem->state);?></td>
        </tr>
        <?php } ?>
  </table>
  <table width="500" align="center">
    <tr height="30">
            <td>&nbsp;</td>
            <td align="right">&nbsp;<?php echo $MODULE->getPaging();?></td>
    </tr>
  </table>
