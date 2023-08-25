<div id="top-nav-bar">
			<div id="sticky-left-controls">
				<div id="toggle-sidebar" class="toggle-left-navbar">
					<i class="fa fa-bars"></i>
				</div>
				<div id="logo" title="Admin/Dine out">
					Admin Panel
				</div>
			</div>
		</div>
				
		<div id="left-nav-bar" class="left-nav-dropdown" style = "z-index:1000;">
			<div id="person-info">
				<div id="person-image">
					<div id="person-photo">
						<img src="images/A1.jpg" alt="Profile picture">
					</div>
					<div id="person-name">
						<h6>Abd-ur-Rehman</h6>
						<h6>abd@mukdi.com</h6>
					</div>
				</div>
				<div id="extra-settings">
					<a href="emp_profile.php" data-bs-toggle="tooltip" data-bs-placement="left" title="Profile" ><i class="fa-solid fa-user"></i></a>
					<a class = "emp_admin_logout" data-bs-toggle="tooltip" data-bs-placement="right" title="Logout"><i class="fa fa-power-off"></i></a>
				</div>
			</div>
			<div id="list-all" style="height: 100%;">
				<h6>Administrative Tasks</h6>
					<ul>
						<li>
							<div class="dropdown-list"><i class="fa-brands fa-windows"></i> Operational Window
							<i class="fa fa-angle-right"></i></div>
							<ul class="list-all-subtypes">
							<?php
							if($home){
								echo "<li><a href='admin_home.php' target='_self' style='color: #f8be3f;'>Home</a></li>
								<li><a href='admin_menu.php' target='_self'>Menu Items</a></li>
								<li><a href='admin_staff.php' target='_self'>Staff</a></li>
								<li><a href='admin_all_orders.php' target='_self'>All Orders</a></li>
								<li><a href='admin_issues.php' target='_self'>Reported Issues</a></li>
								<li><a href='admin_contact.php' target='_self'>Contacting Info</a></li>";
							}
							else if($menu){
								echo "<li><a href='admin_home.php' target='_self'>Home</a></li>
								<li><a href='admin_menu.php' target='_self' style='color: #f8be3f;'>Menu Items</a></li>
								<li><a href='admin_staff.php' target='_self'>Staff</a></li>
								<li><a href='admin_all_orders.php' target='_self'>All Orders</a></li>
								<li><a href='admin_issues.php' target='_self'>Reported Issues</a></li>
								<li><a href='admin_contact.php' target='_self'>Contacting Info</a></li>";
							}
							else if($staff){
								echo "<li><a href='admin_home.php' target='_self'>Home</a></li>
								<li><a href='admin_menu.php' target='_self'>Menu Items</a></li>
								<li><a href='admin_staff.php' target='_self' style='color: #f8be3f;'>Staff</a></li>
								<li><a href='admin_all_orders.php' target='_self'>All Orders</a></li>
								<li><a href='admin_issues.php' target='_self'>Reported Issues</a></li>
								<li><a href='admin_contact.php' target='_self'>Contacting Info</a></li>";
							}
							else if($all_orders){
								echo "<li><a href='admin_home.php' target='_self'>Home</a></li>
								<li><a href='admin_menu.php' target='_self'>Menu Items</a></li>
								<li><a href='admin_staff.php' target='_self'>Staff</a></li>
								<li><a href='admin_all_orders.php' target='_self' style='color: #f8be3f;'>All Orders</a></li>
								<li><a href='admin_issues.php' target='_self'>Reported Issues</a></li>
								<li><a href='admin_contact.php' target='_self'>Contacting Info</a></li>";
							}
							else if($issues){
								echo "<li><a href='admin_home.php' target='_self'>Home</a></li>
								<li><a href='admin_menu.php' target='_self'>Menu Items</a></li>
								<li><a href='admin_staff.php' target='_self'>Staff</a></li>
								<li><a href='admin_all_orders.php' target='_self'>All Orders</a></li>
								<li><a href='admin_issues.php' target='_self' style='color: #f8be3f;'>Reported Issues</a></li>
								<li><a href='admin_contact.php' target='_self'>Contacting Info</a></li>";
							}
							else if($contact){
								echo "<li><a href='admin_home.php' target='_self'>Home</a></li>
								<li><a href='admin_menu.php' target='_self'>Menu Items</a></li>
								<li><a href='admin_staff.php' target='_self'>Staff</a></li>
								<li><a href='admin_all_orders.php' target='_self'>All Orders</a></li>
								<li><a href='admin_issues.php' target='_self'>Reported Issues</a></li>
								<li><a href='admin_contact.php' target='_self' style='color: #f8be3f;'>Contacting Info</a></li>";
							}
							else{
								// nothing
							}
							?>
							</ul>
						</li>
					</ul>
			</div>
		</div>