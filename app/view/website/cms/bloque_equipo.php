<!-- Team Section -->
<section id="<?php echo trim($oItemss->title); ?>" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo trim($oItemss->title); ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $oItemss->subTitle; ?></h3>
            </div>
        </div>
        <div class="row">
           <?php $lcat4=CmsContentLang::getWebList($oItemss->contentID, $sectionID, $langID); 
           $oValor = 12/$lcat4->getLength();
           foreach ($lcat4 as $categoria4) { 
            $url4=XMLParser::getValue($categoria4->media, 'imagen');
            $imagen=!empty($url4)? $URL_ROOT.'/userfiles/'.$url4: NULL;
            ?>
            <div class="col-sm-<?php echo $oValor; ?>">
                <div class="team-member">
                    <img src="<?php echo $imagen; ?>" class="img-responsive img-circle" alt="">
                    <h4><?php echo $categoria4->title; ?></h4>
                    <p class="text-muted"><?php echo $categoria4->subTitle; ?></p>
                    <ul class="list-inline social-buttons">
                      <?php $ldetail=CmsContentLang::getWebList($categoria4->contentID, $sectionID, $langID); 
                      foreach ($ldetail as $detail) {
                         $oLink=SEO::get_ContentLink($detail); 
                       ?>   
                      <li><a href="<?php echo $oLink->url; ?>" target="<?php echo $oLink->target; ?>"><i class="fa fa-<?php echo $detail->subTitle; ?>"></i></a>
                      </li>
                      <?php } ?>
                  </ul>
              </div>
          </div>
          <?php } ?>


      </div>
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 text-center">
            <p class="large text-muted"><?php echo $oItemss->description; ?></p>
        </div>
    </div>
</div>
</section>