<?php
$oAdmUser = AdmLogin::getUserSession();

class menu_left{

    function printMenu($parentmenuID) {
        global $MODULE, $oAdmUser;
        $list=AdmMenu::getList_ParentMenu($parentmenuID, $oAdmUser->userMenu );

        foreach ($list as $obj) {
            $menuID=$obj->menuID;
            echo "<div class=\"headerbar ". ($MODULE->menuID==$menuID ? "selected" : ""). "\">".$obj->menuName."</div>";
            $this->printModule($menuID);
        }
    }

    function printModule($menuID){
        global $MODULE, $oAdmUser;
        $URL_ADMIN=SEO::get_URLAdmin();

        $list=AdmModule::getList_UserModule($menuID, $oAdmUser->userModule );
        if($list->getLength()>0){
            echo "<ul>\n";
            foreach ($list as $obj) {
                    $moduleID=$obj->moduleID;
                    $url=$URL_ADMIN."?moduleID=$moduleID".($obj->moduleParams!="" ? ("&".$obj->moduleParams) : "");
                    echo "<li><a href=\"".$url."\" class=\"". ($MODULE->moduleID==$moduleID ? "selected" : ""). "\">".$obj->moduleName."</a></li>\n";
            }
            echo "</ul>\n";
        }
    }
}

$cMenu=new menu_left();

if($MODULE->menuID>0) echo $cMenu->printMenu($MODULE->parentMenuID);
?>