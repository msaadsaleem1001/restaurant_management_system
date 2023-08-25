<div id="top-nav-bar">
			<div id="sticky-left-controls">
				<div id="toggle-sidebar" class="toggle-left-navbar">
					<i class="fa fa-bars"></i>
				</div>
				<div id="logo" title="Head Chef/Dine out">
					Head Chefs Panel
				</div>
			</div>
		</div>
				
		<div id="left-nav-bar" class="left-nav-dropdown" style = "z-index:1000;">
			<div id="person-info">
				<div id="person-image">
					<div id="person-photo">
						<img src="images/k4.jfif" alt="Profile picture">
					</div>
					<div id="person-name">
						<h6>Ahsan mustafa</h6>
						<h6>ahsan1@mukdi.com</h6>
					</div>
				</div>
				<div id="extra-settings">
					<a href="emp_profile.php" data-bs-toggle="tooltip" data-bs-placement="left" title="Profile" ><i class="fa fa-user"></i></a>
					<a class = "emp_head_chef_logout" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout"><i class="fa fa-power-off"></i></a>
				</div>
			</div>
			<div id="list-all" style="height: 100%;">
				<h6>Head Chefs Tasks</h6>
					<ul>
						<li>
							<div class="dropdown-list"><i class="fa-brands fa-windows"></i> Operational Window
							<i class="fa fa-angle-right"></i></div>
							<ul class="list-all-subtypes">
<?php								
							if($home){
                                echo" <li><a href='head_chef_home.php' target='_self' style='color: #f8be3f;'>Home</a></li>
								<li><a href='head_chef_pending_orders.php' target='_self'>Pending Orders</a></li>
								<li><a href='head_chef_ready_orders.php' target='_self'>Ready Orders</a></li>";
							}
							if($ready){
                                echo" <li><a href='head_chef_home.php' target='_self'>Home</a></li>
								<li><a href='head_chef_pending_orders.php' target='_self'>Pending Orders</a></li>
								<li><a href='head_chef_ready_orders.php' target='_self'  style='color: #f8be3f;'>Ready Orders</a></li>";
							}
							if($pending){
                                echo" <li><a href='head_chef_home.php' target='_self'>Home</a></li>
								<li><a href='head_chef_pending_orders.php' target='_self' style='color: #f8be3f;'>Pending Orders</a></li>
								<li><a href='head_chef_ready_orders.php' target='_self'>Ready Orders</a></li>";
							}
?>								
							</ul>
						</li>
					</ul>
			</div>
		</div>