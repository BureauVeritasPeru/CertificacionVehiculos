<section id="<?php echo trim($oItemss->title); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading"><?php echo $oItemss->title; ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $oItemss->description; ?></h3>
            </div>
        </div>
        <div class="row text-center">
            <?php $lcat=CmsContentLang::getWebList($oItemss->contentID, $sectionID, $langID); ?>
            <?php $oValor = 12/$lcat->getLength(); ?>
            <?php foreach ($lcat as $categoria) {
            ?>
                    <div class="col-md-<?php echo $oValor; ?>">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-<?php echo $categoria->subTitle; ?> fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="service-heading"><?php echo $categoria->title; ?></h4>
                        <p class="text-muted"><?php echo $categoria->description; ?></p>
                    </div>
            <?php } ?>
            </div>
        </div>
    </section>