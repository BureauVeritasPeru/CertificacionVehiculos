<?php
$pg=OWASP::RequestInt('pg', 1);

$imagen=isset($oContentLang->media['imagen']['Url'])? '<figure><img src="'.$URL_ROOT.$oContentLang->media['imagen']['Url'].'"></figure>': NULL;

$oParent=CmsContentLang::GetItem($oContentLang->parentContentID, $oContentLang->langID);
?>
<h1 class="border_title"><?php echo $oParent->title;?></h1>
<a href="<?php echo SEO::get_URLContent($oParent); ?>?pg=<?php echo $pg;?>" class="regresar">Regresar</a>
<div class="conten_proyectos">
	<h4><?php echo $oContentLang->title;?></h4>
	<?php echo $imagen;?>
	<blockquote>
		<p><?php echo $oContentLang->description;?></p>
	</blockquote>
</div>
