 <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Manager </h3>
                <?php if($postm=='admin'){?>
                <ul class="nav side-menu">
                  <li><a href="calendar"> <i class="fa fa-calendar"></i>Calendar</a></li>
                  <li><a href="registrations"> <i class="fa fa-users"></i>Registrations</a></li>
                  <li><a href="inscriptions"> <i class="fa fa-pencil"></i>Inscription</a></li>
                  <li><a href="presence"> <i class="fa fa-users"></i>Presence</a></li>
                  <li><a href="group"> <i class="fa fa-users"></i>Group</a></li>
                  <li><a href="prof"> <i class="fa fa-user"></i>Prof</a></li>
                  <li><a href="certificates"> <i class="fa fa-users"></i>Certificates</a></li>
                  <li><a href="formations"> <i class="fa fa-book"></i>Formations</a></li>
                          <li><a href="centres"> <i class="fa fa-building"></i>Centres</a></li>
                          <li><a href="classroom"> <i class="fa fa-users"></i>Classroom</a></li>
                          <li><a href="modules"> <i class="fa fa-cubes"></i>Modules</a></li>
                          <li><a href="payments"> <i class="fa fa-paypal"></i>Payment Inscription</a></li>
                          <li><a href="expenses"> <i class="fa fa-credit-card"></i>Expenses</a></li>
                          <li><a href="sh"> <i class="fa fa-money"></i>Salary History</a></li>
                          <li><a href="report"> <i class="fa fa-file"></i>Report</a></li>

                  <li><a><i class="fa fa-users"></i> User Manager <span class="icon-circle-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="users">Users </a></li>
                    </ul>
                  </li>
                   <li><a><i class="fa fa-gear"></i>Settings <span class="icon-circle-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="general"> <i class="fa fa-gear"></i> General Settings </a></li>
                       <li><a href="options"> <i class="fa fa-ellipsis-v"></i>Options</a></li>
                       <li><a href="more"> <i class="fa fa-ellipsis-v"></i>More</a></li>
                    </ul>
                  </li>
                    </ul>
                  <?php }  else if($postm=='user') {?>
                     <ul class="nav side-menu">
    <li><a href="registrations"><i class="fa fa-users"></i>Registrations</a></li>
    <li><a href="prof"><i class="fa fa-user"></i>Prof</a></li>
    <li><a href="classroom"><i class="fa fa-users"></i>Classroom</a></li>
    <li><a href="group"><i class="fa fa-users"></i>Group</a></li>
    <li><a href="inscriptions"><i class="fa fa-pencil"></i>Inscription</a></li>
    <li><a href="certificates"><i class="fa fa-certificate"></i>Certificates</a></li>
    <li><a href="modules"><i class="fa fa-book"></i>Modules</a></li>
    <li><a href="presence"><i class="fa fa-users"></i>Presence</a></li>
    <li><a href="sh"><i class="fa fa-money"></i>Salary History</a></li>
    <li><a href="expenses"><i class="fa fa-credit-card"></i>Expenses</a></li>
    <li><a href="payments"><i class="fa fa-credit-card"></i>Payment Inscription</a></li>
    <li><a href="report"><i class="fa fa-file"></i>Report</a></li>
    <li><a href="calendar"> <i class="fa fa-calendar"></i>Calendar</a></li>
</ul>


                 <?php } 
                  else if($postm=='employee')
                  {
                 ?>
                  <ul class="nav side-menu">
<li><a href="registrations">
<i class="fa fa-users"></i>Registrations
</a></li>
<li><a href="classroom">
<i class="fa fa-clock-o"></i>Classroom
</a></li>
<li><a href="group">
<i class="fa fa-users"></i>Group
</a></li>
<li><a href="inscriptions">
<i class="fa fa-pencil-square-o"></i>Inscription
</a></li>
<li><a href="certificates">
<i class="fa fa-certificate"></i>Certificates
</a></li>
<li><a href="modules">
<i class="fa fa-cubes"></i>Modules
</a></li>
<li><a href="presence">
<i class="fa fa-clock-o"></i>Presence
</a></li>
<li><a href="sh">
<i class="fa fa-money"></i>Salary History
</a></li>
<li><a href="expenses">
<i class="fa fa-credit-card"></i>Expenses
</a></li>
<li><a href="payments">
<i class="fa fa-credit-card"></i>Payment Inscription
</a></li>
</ul>


               <?php }  else if($postm=='prof') {
                ?>
                  <ul class="nav side-menu">
 <li><a href="group"> <i class="fa fa-graduation-cap"></i>Group</a></li>
</ul>

              <?php }?> 


                  </li>
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
           
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
              <a id="menu_toggle" style="display: inline-block;">
  <i class="icon-menu"></i>
  <?php if(!isset($back_hide)){?>
  <i class="fa fa-arrow-left" onclick="goBack()" style="color:#0065C3;"></i>
<?php } ?>
</a>
<script>
function goBack() {
  window.history.back();
}
</script>

              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    Admin 
                  </a>

                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                 
                       
                      </a>
                  
                    <a class="dropdown-item"  href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>