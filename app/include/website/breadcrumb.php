<?php
$linkParent=NULL;
$bp=isset($bp) ? $bp : NULL ;
?>
<div class="barra_navegador">
	<a href="<?php echo SEO::get_URLHome()?>"><?php echo isset($arrTerm['inicio'])? $arrTerm['inicio']: "Home";?></a>
	<?php 
	if ($oSectionLang->parentSectionID==4 || $oSectionLang->parentSectionID==5) {
		echo ' / <a href="' .SEO::get_URLSection($oSectionLang). '">' . $oSectionLang->title . '</a>';
	}
	if(isset($PAGE->lContentPath) && ($PAGE->lContentPath->getLength()>0 || isset($oContentLang))){
		foreach($PAGE->lContentPath as $oParent){
			echo ' / <a href="' .SEO::get_URLContent($oParent) . '">' . $oParent->title . '</a>';
		}
		echo ' / <a href="' .SEO::get_URLContent($oContentLang) . '">' . $oContentLang->title . '</a>';
	}
	?>
   
      <div class="btn_regresar">
          <?php if( $linkParent!= NULL )  ?>  
           <a href="<?php echo $linkParent . $bp;?>" class="full">Regresar</a>
       </div>
      
</div>
