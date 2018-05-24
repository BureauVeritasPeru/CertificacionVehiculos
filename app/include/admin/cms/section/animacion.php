<?php
if(!isset($oItem->parameter['video'])) $oItem->parameter['video']=NULL;
if(!isset($oItem->parameter['enlaceID'])) $oItem->parameter['enlaceID']=NULL;
?>
<tr>
  <td>Video (url)</td>
  <td><input type="text" name="parameter[video]" id="parameter_video" size="70" maxlength="255" value="<?php echo $oItem->parameter['video'];?>" />
  <br />(ej. http://www.youtube.com/embed/5FlQSQuv_mg)
  </td>
</tr>
<tr>
 <td>Enlace<br /> (Detalle)</td>
 <td>
    <select name="parameter[enlaceID]" id="parameter_enlaceID" style="width:235px;">
        <option value="0">Sin Enlace</option>
<?php
$list=CmsContentLang::getList(0, $oItem->sectionID, $oItem->langID);
foreach($list as $obj){
?>
        <option value="<?php echo  $obj->contentID; ?>" <?php if($oItem->parameter['enlaceID']==$obj->contentID) echo "selected"; ?>><?php echo  $obj->title; ?></option>
<?php
}
?>
    </select>
 </td>
</tr>
