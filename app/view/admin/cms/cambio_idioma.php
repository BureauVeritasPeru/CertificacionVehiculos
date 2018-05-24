<?php
if(!isset($oItem->parameter['langID'])) $oItem->parameter['langID']=NULL;
$lLang = CmsLang::getList_Active();
?>
<tr>
 <td>Cambiar a Idioma</td>
 <td>
     <select name="parameter[langID]">
<?php foreach ($lLang as $obj){?>
         <option value="<?php echo $obj->langID;?>" <?php if($oItem->parameter['langID']== $obj->langID)echo 'selected="true"';?>><?php echo $obj->langName;?></option>
<?php }?>
     </select>
 </td>
</tr>