 <!-- Portfolio Grid Section -->
 <section id="<?php echo trim($oItemss->title); ?>" class="bg-light-gray producto">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo $oItemss->title; ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $oItemss->description; ?></h3>
            </div>
        </div>
        <div class="row">
            <?php $lcat=CmsContentLang::getWebList($oItemss->contentID, $sectionID, $langID); 
            foreach ($lcat as $categoria) { 
                $url=XMLParser::getValue($categoria->media, 'imagen');
                $imagen=!empty($url)? $URL_ROOT.'/userfiles/'.$url: NULL;
                ?>
                <div class="col-md-4 col-sm-6 portfolio-item">
                    <a href="#modal<?php echo $categoria->contentID ?>" class="portfolio-link" data-toggle="modal">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-plus fa-3x"></i>
                            </div>
                        </div>
                        <img src="<?php echo $imagen; ?>" class="img-responsive" alt="">
                    </a>
                    <div class="portfolio-caption">
                        <h4><?php echo $categoria->title; ?></h4>
                        <p class="text-muted"><?php echo $categoria->subTitle; ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!--FANCYBOX-->
    <?php $lcat2=CmsContentLang::getWebList($oItemss->contentID, $sectionID, $langID); 
    foreach ($lcat2 as $categoria2) { 
        $url=XMLParser::getValue($categoria2->media, 'imagen2');
        $imagen2=!empty($url)? $URL_ROOT.'/userfiles/'.$url: NULL;

        ?>
        <div class="portfolio-modal modal fade" id="modal<?php echo $categoria2->contentID; ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="modal-body">
                                    <!-- Project Details Go Here -->
                                    <h2><?php echo $categoria2->title; ?></h2>
                                    <p class="item-intro text-muted"><?php echo $categoria2->subTitle; ?></p>
                                    <img class="img-responsive img-centered" src="<?php echo $imagen2; ?>" alt="">
                                    <p><?php echo $categoria2->description; ?></p>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar Ventana</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>
