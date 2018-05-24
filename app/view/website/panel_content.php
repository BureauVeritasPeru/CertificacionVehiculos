
<header style="background-image:url('<?php echo $URL_ROOT.'/userfiles/fondo2.jpg'; ?>');padding-top:125px">
    <div class="container-fluid center_div" >
        <?php
        $file_view ='../app/view/website/' . $PAGE->getFormView() ;
        if( file_exists( $file_view ) )
            include $file_view ;
        else
            $PAGE->addError("No se puede cargar el archivo => ".$file_view) ;
        ?>
    </div>
    <div class="space" style="margin-top: 1px !important"></div>
</header>
