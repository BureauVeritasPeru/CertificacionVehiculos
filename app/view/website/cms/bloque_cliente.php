 <!-- Clients Aside -->
 <aside class="clients">
    <div class="container">
        <div class="row">
           <?php $lcat5=CmsContentLang::getWebList($oItemss->contentID, $sectionID, $langID); 
           $oValor = 12/$lcat5->getLength();
           foreach ($lcat5 as $categoria5) { 
            
            $oLink=SEO::get_ContentLink($categoria5);

            $url5=XMLParser::getValue($categoria5->media, 'imagen');
            $imagen=!empty($url5)? $URL_ROOT.'/userfiles/'.$url5: NULL;
            ?>
            <div class="col-md-<?php echo $oValor; ?> col-sm-6">
                <a href="<?php echo $oLink->url; ?>" target="<?php echo $oLink->target; ?>">
                    <img src="<?php echo $imagen; ?>" class="img-responsive img-centered" alt="">
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</aside>