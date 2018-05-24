<?php
$userName = isset($_REQUEST['userName'])? $_REQUEST['userName']: NULL;
$startDate = isset($_REQUEST['startDate'])? $_REQUEST['startDate']: date('Y-m-d');
$endDate = isset($_REQUEST['endDate'])? $_REQUEST['endDate']: date('Y-m-d');
        
?>
<table>
<tr> 
  <th>Fecha</th>
  <th>Usuario</th>
  <th>Evento</th>
</tr>
<?php
$list=AdmLog::getList_Paging($userName, $startDate, $endDate.' 23:59:59');
foreach ($list as $oItem){
?>
    <tr> 
      <td><?php echo $oItem->logDate; ?></td>
      <td><?php echo $oItem->userName;?></td>
      <td><?php echo $oItem->eventName;?></td>
    </tr>
<?php } ?>
</table>