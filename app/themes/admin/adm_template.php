<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="no-js ie6" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" dir="ltr" lang="es"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" dir="ltr" lang="es"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" dir="ltr" lang="es">
<!--<![endif]-->
<head>
    <title><?php echo $MODULE->moduleName;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo $URL_BASE;?>favicon.ico" type="image/x-icon" />
    <link rel="icon" href="<?php echo $URL_BASE;?>favicon.ico" type="image/ico" />

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/font-awesome.min.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>admin-plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>dist/css/skins/skin-black-light.min.css">
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/custom.css">
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/fileinput.css">
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/alertify.min.css"/>    
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/bootstrap-datetimepicker.css"/>

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>admin-plugins/iCheck/all.css">

    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/dataTables.bootstrap.css">

    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/dataTables.responsive.css">

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $URL_BASE;?>admin-plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo $URL_BASE;?>admin-plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo $URL_BASE;?>admin-plugins/iCheck/icheck.min.js"></script>

    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo $URL_BASE;?>admin-plugins/daterangepicker/daterangepicker.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $URL_BASE;?>dist/js/app.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo $URL_BASE;?>admin-plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        //$.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="<?php echo $URL_BASE;?>js/navigate.js" type="text/javascript"></script>
    <script src="<?php echo $URL_BASE;?>js/custom.js" type="text/javascript"></script>
    <script src="<?php echo $URL_BASE;?>js/fileinput.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $URL_BASE;?>js/jquery.validation.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $URL_BASE;?>bootstrap/js/bootstrap.min.js"></script>
    <!-- JavaScript -->
    <script src="<?php echo $URL_BASE;?>js/alertify.min.js"></script>

    <script src="<?php echo $URL_BASE;?>js/moment-with-locales.js"></script>
    
    <script src="<?php echo $URL_BASE;?>js/bootstrap-datetimepicker.js"></script>

    <script src="<?php echo $URL_BASE;?>js/jquery.dataTables.js"></script>

    <script src="<?php echo $URL_BASE;?>js/dataTables.bootstrap.min.js"></script>

    <script src="<?php echo $URL_BASE;?>js/dataTables.responsive.js"></script>

    


    <script type="text/javascript">
        <?php echo $MODULE->clientScript; ?>
    </script>
</head>
<body class="hold-transition skin-black-light sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <?php require_once('../app/include/admin/panel_head.php'); ?>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <?php require_once('../app/include/admin/menu_main.php'); ?>
        </aside>
            <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php require_once('../app/include/admin/content_header.php'); ?>
                <!-- Main content -->
                <section class="content">
                   <?php
                   $file_view="../app/view/admin/".$MODULE->getFormView();
                   if(!file_exists($file_view))
                    $MODULE->addError("No se puede localizar el archivo: ".$file_view);

                if($MODULE->msgError!=""){

                 ?>
                 <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"> </h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="remove" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body"><ul><?php echo $MODULE->msgError;?></ul></div>
                </div>

                <?php }?>
                <?php if($MODULE->msgAlert!=""){ ?>
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"> </h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="remove" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body"><ul><?php echo $MODULE->msgAlert;?></ul></div>
                </div>
                <?php }?>

                <form name="frmMain" id="frmMain" class="form-horizontal" action="<?php echo $MODULE->getURL();?>" method="post" autocomplete="off">
                    <input type="hidden" name="Command" id="Command" />
                    <input type="hidden" name="moduleID" id="moduleID" value="<?php echo $MODULE->moduleID; ?>" />
                    <input type="hidden" name="FormView" id="FormView" value="<?php echo $MODULE->FormView; ?>" />
                    <input type="hidden" name="kID" id="kID" value="<?php echo $kID;?>" />
                    <input type="hidden" name="Page" id="Page" value="<?php echo $MODULE->Page;?>" />
                    <input type="hidden" name="OrderBy" id="OrderBy" value="<?php echo $MODULE->OrderBy;?>" />
                    <?php
                    $file_view="../app/view/admin/".$MODULE->getFormView();
                    if(file_exists($file_view))
                        include($file_view.'');

                    ?>

                </form>

                <?php 
                if($MODULE->moduleID == 38){
                    include("../app/view/admin/formato.add.php"); 
                    include("../app/view/admin/formato.readd.php");
                    include("../app/view/admin/formato.del.php");
                }
                else if($MODULE->moduleID == 39){
                    include("../app/view/admin/calcomania.add.php");
                    include("../app/view/admin/calcomania.readd.php");
                    include("../app/view/admin/calcomania.del.php");
                }
                else if($MODULE->moduleID == 46){
                    include("../app/view/admin/formatognv.add.php");
                    include("../app/view/admin/formatognv.readd.php");
                    include("../app/view/admin/formatognv.del.php");
                }
                else if($MODULE->moduleID == 47){
                    include("../app/view/admin/calcomaniagnv.add.php");
                    include("../app/view/admin/calcomaniagnv.readd.php");
                    include("../app/view/admin/calcomaniagnv.del.php");
                }
                ?>

                <div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;
                                    </span>
                                </button>
                                <h4>Seleccione un archivo de csv (csv):</h4>
                            </div>
                            <form id="myForm">
                                <div class="modal-body">
                                    <input type="file" name="fleImport" id="fleImport" class="file"  />
                                </div>

                                <div class="modal-footer">
                                    <input type="button" onclick="myFunction()" value="demo" id="btnDemo" name="btnDemo" class="btn btn-primary" data-dismiss="modal" />
                                    <input type="button" value="continuar" id="btnSelect" name="btnSelect" class="btn btn-success" />
                                    <input type="button" value="cancelar" id="btnClose" name="btnClose" class="btn btn-primary" data-dismiss="modal" />
                                </div>
                            </form>
                            <div class="modal-footer FiltroImport" style="text-align:left !important;overflow-y: scroll;height:250px;">
                                <h4>Respuesta</h4>
                                <div class="RespuestaImport">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </section>
        </div>
        <script>
            function myFunction() {
                location.href = "<?php echo $URL_ROOT; ?>assets/website/xls/demo.csv";
            }
        </script>
        <footer class="main-footer">


            <div class="pull-right hidden-xs">
                <b>Versión</b>
                <?php echo CMS_VERSION; ?>
            </div>
            <strong>
                Copyright © 
                <a href="http://bureauveritas.com" target="_blank">Bureau Veritas</a>
                .
            </strong>
            Todos los derechos reservados. 



        </footer>
    </div>
</body>
</html>