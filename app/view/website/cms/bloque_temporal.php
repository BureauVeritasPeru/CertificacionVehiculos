 <!-- About Section -->
 <section id="<?php echo trim($oItemss->title); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo $oItemss->title; ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $oItemss->description; ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    <?php $lcat3=CmsContentLang::getWebList($oItemss->contentID, $sectionID, $langID); 
                    $count = 0;?>
                    <?php foreach ($lcat3 as $categoria3) {
                        $count++;
                       $url=XMLParser::getValue($categoria3->media, 'imagen');
                       $imagen=!empty($url)? $URL_ROOT.'/userfiles/'.$url: NULL;?>
                       <li  <?php echo ($count%2 == 0) ?  'class="timeline-inverted"' : ''; ?> >
                        <div class="timeline-image">
                        <img class="img-circle img-responsive" src="<?php echo $imagen; ?> " alt="">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4><?php echo $categoria3->subTitle; ?></h4>
                                <h4 class="subheading"><?php echo $categoria3->title; ?></h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted"><?php echo $categoria3->description; ?></p>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
           <!--          <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>Be Part
                                <br>Of Our
                                <br>Story!
                            </h4>
                        </div>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
</section>