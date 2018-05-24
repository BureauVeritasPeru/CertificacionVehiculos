<!DOCTYPE html>
<html ng-app="crud">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="title" content="<?php echo $PAGE->metaTag['title']; ?>">
    <meta name="keywords" content="<?php echo $PAGE->metaTag['keywords']; ?>">
    <meta name="description" content="<?php echo $PAGE->metaTag['description']; ?>">
    <meta name="distribution" content="Global">
    <meta name="city" content="Lima">
    <meta name="country" content="Peru">
    <meta property="og:title" content="<?php echo $PAGE->metaTag['title']; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?php echo SEO::get_HTTPAssets();?>images/logo.png" />
    <meta property="og:description" content="<?php echo $PAGE->metaTag['description']; ?>" />
    <title><?php echo $PAGE->pageTitle;?></title>
    <link href='<?php echo $URL_BASE;?>images/favicon.ico' rel='shortcut icon' type='image/x-icon'>
    <!-- jQuery -->
    <script src="<?php echo $URL_BASE;?>js/jquery.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $URL_BASE;?>css/bootstrap.css" rel="stylesheet"> <!--bootstrap -->
    <!-- <link href="<?php echo $URL_BASE;?>css/bootstrap-modal.css" rel="stylesheet"> <!--bootstrap --> -->

    <!-- Custom Fonts en Web-->
    <link href="<?php echo $URL_BASE;?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- Theme CSS -->
    <link href="<?php echo $URL_BASE;?>css/freelancer.css" rel="stylesheet">
    <!-- JPages -->
    <link href="<?php echo $URL_BASE;?>css/jPages.css" rel="stylesheet">    <!--paginado-->
    <link href="<?php echo $URL_BASE;?>css/bootstrap-datepicker.css" rel="stylesheet">  <!-- datepicker -->
    <link href="<?php echo $URL_BASE;?>css/awesome-bootstrap-checkbox.css" rel="stylesheet"> <!--  radio y checkbox-->
    <link href="<?php echo $URL_BASE;?>css/bootstrap.vertical-tabs.min.css" rel="stylesheet"> <!--  radio y checkbox-->
    <script src="<?php echo $URL_BASE;?>js/angular.min.js"></script>
    <script src="<?php echo $URL_BASE;?>js/angular-route.js"></script>
    <!-- CSS  alertas --> 
    <link rel="stylesheet" href="<?php echo $URL_BASE;?>css/alertify.min.css"/>

</head>
<body id="page-top" class="index">
    <div id="skipnav"><a href="#maincontent">Skip to main content</a></div>
    <?php
    include '../app/view/website/panel_top.php';
    ?>
    
    <?php
    if(isset($oContentLang))
        include '../app/view/website/panel_content.php';
    else{
        if(isset($oSectionLang))
            include '../app/view/website/panel_section.php';
        else
            include '../app/view/website/panel_home.php';
    }
    ?>
    
    <?php
    include '../app/view/website/panel_footer.php';
    ?>   
    <?php
    $msgErr=$PAGE->getErrorMessage();
    if($msgErr!="" && $WEBSITE["DEBUG_MODE"]) echo '<div style="color: #FF0000; padding:10px; background-color: #FFFAB5; font: 10px tahoma;">Error:<br />'.$msgErr.'</div>';
        ?>
        <script type="text/javascript">
            URL_BASE='<?php echo $URL_BASE;?>';
        </script>
        <script type="text/javascript">
/*  
	GOOGLE ANALYTICS CODE HERE 
    */

    var app = angular.module('crud',['ngRoute']);  
    app.controller('pJuridica', function($scope,$http) {


                                        // Al cargar la pagina, ejecutamos la funcion get() para rellenar la tabla
                                        angular.element(document).ready(function () {
                                            $scope.get("");

                                        });

                                        // La funcion get() que hace la solicitud para obtener los datos
                                        $scope.get = function(id){
                                                // Si la Id esta en blanco, entonces la solicitud es general
                                                if(id=="") {
                                                    $http.get("http://app.bureauveritas.com.pe/rest_juridica/api/pJuridica").then(function (response) {
                                                        $scope.lista = response.data.data;
                                                        //Materialize.toast(response.data.statusMessage, 4000);

                                                    }, function(response) {
                                                        // Aqui va el codigo en caso de error
                                                    });
                                                // Si la Id no esta en blanco, la solicitud se hace a un elemento especifico
                                            } else {
                                                $http.get("http://app.bureauveritas.com.pe/rest_juridica/api/pJuridica/" + id).then(function (response) {
                                                    $scope.nuevo = response.data.data[0];
                                                    $('#razon').val($scope.nuevo['razonSocial']);
                                                    $('#ruc').val($scope.nuevo['ruc']);
                                                    $('#rlegal').val($scope.nuevo['representanteLegal']);
                                                    $('#actividad').val($scope.nuevo['actividad']);
                                                    $('#telefono').val($scope.nuevo['telefono']);
                                                    $('#dirEnvio').val($scope.nuevo['direccionEnvio']);
                                                    $('#dirFiscal').val($scope.nuevo['direccionFiscal']);
                                                    $('#observ').val($scope.nuevo['observaciones']);
                                                    $('#email').val($scope.nuevo['email']);
                                                    //Materialize.toast(response.data.statusMessage, 4000);
                                                }, function(response) {
                                                    
                                                });
                                            }
                                        }

                                        // La funcion post() que hace la solicitud para publicar un nuevo elemento
                                        $scope.post = function() {
                                            $http.post("http://app.bureauveritas.com.pe/rest_juridica/api/pJuridica", $scope.nuevo)
                                            .then(function (response){
                                                //Materialize.toast(response.data.statusMessage, 4000);
                                                $scope.nuevo = null;
                                                $scope.get("");                 
                                            }, 
                                            function(response) {
                                                Materialize.toast('ok', 4000);
                                                $scope.nuevo = null;
                                                $scope.get("");     
                                            });
                                        }

                                        // La funcion put() que hace la solicitud para modificar un elemento especifico
                                        $scope.put = function(id) {

                                            $http.put("http://app.bureauveritas.com.pe/rest_juridica/api/pJuridica/" + id, $scope.nuevo)
                                            .then(
                                                function (response){
                                                    //Materialize.toast(response.data.statusMessage, 4000);
                                                    $scope.nuevo = null;
                                                    $scope.get("");
                                                }, 
                                                function(response) {
                                                    Materialize.toast('ok', 4000);
                                                    $scope.nuevo = null;
                                                    $scope.get(""); 
                                                });

                                        }

                                        // La funcion delete() que hace la solicitud para eliminar un elemeto esepecifico
                                        $scope.delete = function(id) {
                                            $http.delete("http://app.bureauveritas.com.pe/rest_juridica/api/pJuridica/" + id)
                                            .then(
                                                function (response){
                                                    console.log(response);
                                                    //Materialize.toast(response.data.statusMessage, 4000);
                                                    $scope.nuevo = null;
                                                    $scope.get("");
                                                }, 
                                                function (response){
                                                     // Aqui va el codigo en caso de error
                                                 }
                                                 );
                                        }

                                    }); 
$(function () {
    $("input[class*='only_float']").keydown(function (event) {


        if (event.shiftKey == true) {
            event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }

        if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault();

    });
});

</script>

<!-- Script -->


<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $URL_BASE;?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $URL_BASE;?>js/jquery.validation.js"></script>
<!-- Plugin JavaScript -->
<script src="<?php echo $URL_BASE;?>js/jquery.easing.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="<?php echo $URL_BASE;?>js/jqBootstrapValidation.js"></script>
<script src="<?php echo $URL_BASE;?>js/contact_me.js"></script>

<!-- Theme JavaScript -->
<script src="<?php echo $URL_BASE;?>js/freelancer.min.js"></script>


<!-- Jpages -->
<script src="<?php echo $URL_BASE;?>js/jPages.js"></script>
<script src="<?php echo $URL_BASE;?>js/bootstrap-datepicker.js"></script>
<script src="<?php echo $URL_BASE;?>js/bootbox.min.js"></script>


<!-- JavaScript -->
<script src="<?php echo $URL_BASE;?>js/alertify.min.js"></script> 


</body>
</html>