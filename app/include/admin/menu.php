<?php
$oAdmUser = AdmLogin::getUserSession();
        
class menu_top{
var $userID ;
var $curMenuID;
var $curSelected;
var $curMenuName;
var $userAdmin;

	function printMenu($parentMenuID){
	global $MODULE, $oAdmUser;
        
		$list=AdmMenu::getList_ParentMenu($parentMenuID, $oAdmUser->userMenu );
		foreach ($list as $obj) {
			$menuID	=$obj->menuID;
			if($parentMenuID==0){
				$this->curMenuName=$obj->menuName;
				$this->curSelected=($MODULE->parentMenuID==$menuID ? "selected" : "");
			}

			if($this->curMenuID!=$parentMenuID){
					$this->printModule($menuID);
					$this->curMenuID=$parentMenuID;
			}
			$this->printMenu($menuID);
		}
	}

	function printModule($menuID){
	global $oAdmUser;
        $URL_ADMIN=SEO::get_URLAdmin();
        
		$list=AdmModule::getList_UserModule($menuID, $oAdmUser->userModule );
		if($list->getLength()>0){
			$obj=$list->getItem(0);
			$moduleID=$obj->moduleID;
			$url=$URL_ADMIN."?moduleID=$moduleID".($obj->moduleParams!="" ? ("&".$obj->moduleParams) : "");
			echo "<li><a href=\"".$url."\" class=\"". $this->curSelected . "\">".$this->curMenuName."</a></li>\n";
		}
	}

}

$cMenuTop=new menu_top();
?>

<div id="menu" class="droplinetabs">
        <ul><?php echo $cMenuTop->printMenu(0);?></ul>
</div>
