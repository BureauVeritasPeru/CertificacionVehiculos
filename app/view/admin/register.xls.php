<?php

$contactGroupID =0; //Initialized
?>
<table>
      <tr>
        <th>Fecha</th>
        <th>Nombre</th>
        <th>Apellido P.</th>
        <th>Apellido M.</th>
        <th>Estado</th>
      </tr>
    <?php 
        $list=CrmRegisterForm::getList_Paging($oItem->formID, $oItem->contactID, $txtsearch);
        foreach ($list as $oItem){
    ?>
        <tr>
          <td><?php echo $oItem->registerDate; ?></td>
          <td><?php echo $oItem->name; ?></td>
          <td><?php echo $oItem->lastname; ?></td>
          <td><?php echo $oItem->surname; ?></td>
          <td><?php echo CrmRegisterForm::getState($oItem->state);?></td>
        </tr>
    <?php } ?>
</table>
