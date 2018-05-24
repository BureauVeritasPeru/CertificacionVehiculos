<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php
    $parentMenu=AdmMenu::getItem($MODULE->parentMenuID);
    $menu=AdmMenu::getItem($MODULE->menuID);
    ?>
    <i class="fa <?php echo $menu->menuIcon; ?>"></i>
    <?php echo $menu->menuName; ?>
    <small>
    
    <?php
    echo $MODULE->moduleName;
    ?>
    </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $URL_ADMIN?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php
            echo $parentMenu->menuName;
        ?></li>
    </ol>
</section>