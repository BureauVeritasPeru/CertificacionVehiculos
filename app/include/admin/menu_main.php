<?php
$userAdmin=AdmLogin::getUserSession();

?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
	<!-- Sidebar user panel -->
	<div class="user-panel">
		<div class="pull-left image">
			<img src="<?php echo $URL_BASE;?>dist/img/user.jpg" class="img-circle" alt="User Image">
		</div>
		<div class="pull-left info">
			<p><?php echo strtolower($userAdmin->fullName);?></p>
			<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	</div>
	<!-- search form 
	<form action="#" method="get" class="sidebar-form">
		<div class="input-group">
			<input type="text" name="q" class="form-control" placeholder="Search...">
			<span class="input-group-btn">
				<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
				</button>
			</span>
		</div>
	</form>
	-->
	<!-- /.search form -->
	<!-- sidebar menu: : style can be found in sidebar.less -->
	<ul class="sidebar-menu">
		<?php
		$lMenu=AdmMenu::getList_ParentMenu(0, $userAdmin->userMenu );
		foreach($lMenu as $oMenu){
				$menuID=$oMenu->menuID;
				$menuName=$oMenu->menuName;
				$lSMenu=AdmMenu::getList_ParentMenu($menuID, $userAdmin->userMenu );
				if($lSMenu->getLength()==0) continue;
		?>
		
		<li class="header"><?php echo strtoupper($menuName) ?></li>
		<?php
		foreach($lSMenu as $oSMenu){
		$submenuID=$oSMenu->menuID;
		$menuName =$oSMenu->menuName;
		$lModulo=AdmModule::getList_UserModule($submenuID, $userAdmin->userModule );
		if($lModulo->getLength()==0) continue;
		

		?>

		<li class="treeview <?php echo ($MODULE->menuID==$submenuID)?"active":""; ?>">
			<a href="#">
				<i class="fa <?php echo $oSMenu->menuIcon;?>"></i> <span><?php echo $menuName;?></span> <i class="fa fa-angle-left pull-right"></i>
			</a>
			<ul class="treeview-menu">
				<?php
				foreach($lModulo as $oModule){
				$moduleID=$oModule->moduleID;
				$moduleName=$oModule->moduleName;
				$moduleURL =$URL_ADMIN."?moduleID=$moduleID".($oModule->moduleParams!="" ? ("&".$oModule->moduleParams) : "");
				
				?>
				<li class="<?php echo ($MODULE->moduleID==$oModule->moduleID)?"active":""; ?>"><a href="<?php echo $moduleURL;?>"><i class="fa <?php echo ($oModule->moduleIcon=='')?"fa-list":$oModule->moduleIcon; ?>"></i> <?php echo $moduleName; ?></a></li>
				<?php
				}
				?>
			</ul>
		</li>
		<?php
		}
		?>
		
		<?php
		}
		?>
	</ul>
</section>