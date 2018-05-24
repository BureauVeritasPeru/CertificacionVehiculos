<?php
$schemaID = 22;
$langID = $PAGE->langID;
$lSector = CmsContentLang::getWebList_Schema($schemaID, $langID);

$oLink=SEO::get_ContentLink($oWidget);
?>        
<div class="our_history">
  <h3><?php echo $oWidget->title;?></h3>
  <div class="tipo_proy_sector">
<?php
if($lSector->getLength()>0){?>
	<ul>
	<?php
	foreach($lSector as $oItem){
		$url=SEO::get_URLRedirect($oItem->parentContentID, $oItem->langID).'?sectorID='.$oItem->contentID;
	?>
		<li><a href="<?php echo $url;?>"><?php echo $oItem->title;?></a></li>
	<?php }?>
	</ul>
<?php
}?>
  </div>
</div>