<div id="top-nav-bar">
			<div id="sticky-left-controls">
				<div id="toggle-sidebar" class="toggle-left-navbar">
					<i class="fa fa-bars"></i>
				</div>
				<div id="logo" title="Admin/Dine out">
					Manager Panel
				</div>
			</div>
			<div id="sticky-right-controls" >
<nav class="navbar navbar-expand-sm navbar-light bg-light" style ="height:30px; padding-top:35px; float:right;">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d_d_noti" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		  <i class="fa fa-bell bell_notify"><span id ="span_value" class="no_noti">0</span></i>Requests by order no
          </a>
          <ul class="dropdown-menu" id="noti_list" aria-labelledby="navbarDropdown">
          </ul>
        </li>
        
      </ul>
      
    </div>
  </div>
</nav>


			</div>
		</div>
		<div id="left-nav-bar" class="left-nav-dropdown" style = "z-index:1000;">
			<div id="person-info">
				<div id="person-image">
					<div id="person-photo">
						<img src="images/manager.jfif" alt="Profile picture">
					</div>
					<div id="person-name">
						<h6>Muhammad Bilal</h6>
						<h6>bilal10@mukdi.com</h6>
					</div>
				</div>
				<div id="extra-settings">
					<a href="emp_profile.php" data-bs-toggle="tooltip" data-bs-placement="left" title="Profile" ><i class="fa fa-user"></i></a>
					<a class = "emp_manager_logout" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout"><i class="fa fa-power-off"></i></a>
				</div>
			</div>
			<div id="list-all" style="height: 100%;">
				<h6>Mangerial Tasks</h6>
					<ul>
						<li>
							<div class="dropdown-list"><i class="fa fa-th-large"></i>Operational Window
							<i class="fa fa-angle-right"></i></div>
							<ul class="list-all-subtypes">
<?php
							if($home){
                             	echo "<li><a href='manager_home.php' target='_self' style='color: #f8be3f;' >Home</a></li>
								<li><a href='manager_table.php' target='_self'>Manage Tables</a></li>
								<li><a href='manager__home_delivery_orders.php' target='_self'>Ready home delivery orders</a></li>";
							}
							if($table){
								echo "<li><a href='manager_home.php' target='_self'>Home</a></li>
							   	<li><a href='manager_table.php' target='_self' style='color: #f8be3f;' >Manage Tables</a></li>
							   	<li><a href='manager__home_delivery_orders.php' target='_self'>Ready home delivery orders</a></li>";
						    }
						   if($delivery){
								echo "<li><a href='manager_home.php' target='_self'>Home</a></li>
						   		<li><a href='manager_table.php' target='_self'>Manage Tables</a></li>
						   		<li><a href='manager__home_delivery_orders.php' target='_self' style='color: #f8be3f;'>Ready home delivery orders</a></li>";
					   	    }
?>								
							</ul>
						</li>
					</ul>
			</div>
		</div>










