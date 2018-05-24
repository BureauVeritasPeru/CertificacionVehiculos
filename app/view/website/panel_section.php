
<header style="background-color:#ece9e4;">
    <div class="container-fluid center_div" >
        <?php

        switch ($oSectionLang->sectionID) {
            case 5:
            include("../app/view/website/section/certificados.php");
            break;
            case 6:
            include("../app/view/website/section/certificados-gnv.php");
            break;
            case 7:
            include("../app/view/website/section/consultas.php");
            break;
            case 8:
            include("../app/view/website/section/consultas-gnv.php");
            break;
            case 9:
            include("../app/view/website/section/reportes.php");
            break;
            default:
            include("../app/view/website/section/index.php");
            break;
        }
        ?>
    </div>
    <div class="space"></div>
</header>
