<?php
if( isset($arrSitemap) && count($arrSitemap)>0 ){
?>
<!-- section-mapa -->
<div class="mapa">
  <span>Mapa de sitio</span>
    <div class="mapa-contenido">
<?php
	foreach( $arrSitemap as $arrSection ){
    if(!isset($arrSection['submenu'])) continue;
?>
      <div class="caja">
        <h3><?php echo TextParser::UpperCase($arrSection['title']);?></h3>
        <ul>
<?php
		foreach( $arrSection['submenu'] as $link ){
			echo '<li>'.$link.'</li>';
		}
?>
        </ul>
      </div>
<?php			
	}
?>
    </div>
</div>
<?php
}
?>
