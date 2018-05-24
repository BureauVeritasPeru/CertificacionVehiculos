<?php
$oAdmUser = AdmLogin::getUserSession();

?>

<!-- Logo -->
<a href="<?php echo $URL_ADMIN?>" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>GLP</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>GLP - GNV</b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->



      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo $URL_BASE;?>dist/img/user.jpg" class="user-image" alt="User Image">
          <span class="hidden-xs"><?php echo strtolower($oAdmUser->fullName);?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="<?php echo $URL_BASE;?>dist/img/user.jpg" class="img-circle" alt="User Image">

            <p>
              <?php echo strtolower($oAdmUser->fullName);?>
              <small>Administrador</small>
            </p>
          </li>

          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
            </div>
            <div class="pull-right">
              <a href="<?php echo $URL_ADMIN?>?Command=logoff" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>

    </ul>
  </div>
</nav>
