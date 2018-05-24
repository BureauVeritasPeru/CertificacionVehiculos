<?php
$userAdmin=AdmLogin::getUserSession();
?>

<div class="row visible-md visible-lg">
<div class="col-xs-12">
        <div class="callout callout-info">
            <h4>Info</h4>
            <p>
                En la siguiente lista se muestran todos los m&oacute;dulos del sistema. Estas opciones tambi&eacute;n estar&aacute;n disponibles en el men&uacute; superior.
                Recuerde que en las p&aacute;ginas interiores s&oacute;lo se podr&aacute; acceder usando el menu superior.
            </p>
        </div>
        </div>
        </div>
        
<div class="row">
<?php
$lMenu=AdmMenu::getList_ParentMenu(0, $userAdmin->userMenu );
foreach($lMenu as $oMenu){
$menuID=$oMenu->menuID;
$menuName=$oMenu->menuName;
$lSMenu=AdmMenu::getList_ParentMenu($menuID, $userAdmin->userMenu );
if($lSMenu->getLength()==0) continue;
?>
<div class="col-xs-12 col-sm-6 col-md-4">
    <div class="box">
        <div class="box-header bg-primary"><h3 class="bg-primary"><i class="fa <?php echo ($oMenu->menuIcon=='')?"fa-circle-o":$oMenu->menuIcon; ?>"></i> <?php echo $menuName;?></h3></div>
        <?php
        foreach($lSMenu as $oSMenu){
        $submenuID=$oSMenu->menuID;
        $menuName =$oSMenu->menuName;
        $lModulo=AdmModule::getList_UserModule($submenuID, $userAdmin->userModule );
        if($lModulo->getLength()==0) continue;
        ?>
        <div class="box-body">
           <h4><i class="fa <?php echo ($oSMenu->menuIcon=='')?"fa-circle-o":$oSMenu->menuIcon; ?>"></i> <?php echo $menuName;?></h4>
            <table class="table">
                <tr>
                    <td>
                        <?php
                        foreach($lModulo as $oModule){
                        $moduleID=$oModule->moduleID;
                        $moduleName=$oModule->moduleName;
                        $moduleURL =$URL_ADMIN."?moduleID=$moduleID".($oModule->moduleParams!="" ? ("&".$oModule->moduleParams) : "");
                        ?>
                        <div>
                            <a href="<?php echo $moduleURL;?>"><i class="fa <?php echo ($oModule->moduleIcon=='')?"fa-list":$oModule->moduleIcon; ?>"></i> <?php echo $moduleName;?></a>
                        </div>
                        <?php
                        }
                        ?>
                    </td></tr>
                </table>
            </div>
            
            <?php
            }
            ?>
        </div>
    </div>
    
    <?php
    }
    ?>

        </div>