<?php
session_start();
$all_orders = false;
$contact = false;
$home = false;
$issues = false;
$menu = false;
$staff = true;
if(isset($_SESSION['loggedin_admin']) && $_SESSION['loggedin_admin'] == true){

}
else{
  header("location: emp_dec.php");
}
$username_already_exist = false;
$contact_lenght_error = false;
$post_alredy_exist = false;
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/5bb0aa3c76.js"></script>
	<script src="https://kit.fontawesome.com/6f3c4e01cb.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style/design.css">
    <title>Admin/DineOut</title>
    <link rel="icon" href="images/Icon.png" type="image/png">
	</head>
	<body>
<?php require 'partials/admin_panel.php'; ?>

<div class= "content-bar">
<div class="container" style="width:100%;">
<h2><b>Add Employ</b></h2>
<hr style = "width:100%; height:2px;">
<?php
if  (isset($_POST['add_mc']))
{
	require 'partials/db_connect.php';
	$Fname = $_POST['fname'];
	$Lname = $_POST['lname'];
	$Uname = $_POST['username'];
	$Pass_emp = $_POST['pass'];
	$contact_no = $_POST['contact_no'];
	$emial_emp = $_POST['e_mail_emp'];
	$emp_post = $_POST['emp_post'];
	$speciallity = $_POST['emp_speciality'];

	if($emp_post == "Admin" || $emp_post == "Manager" || $emp_post == "Head Chef"){
			$exist_post = "SELECT * FROM `staff` WHERE post = '$emp_post'";
			$result_post = mysqli_query($conn, $exist_post);
			$numExistRows_post = mysqli_num_rows($result_post);
	  		if($numExistRows_post == 0){

				if(strlen($contact_no) >= 11 && strlen($contact_no) <= 15){
				$existSql_emp = "SELECT * FROM `staff` WHERE username = '$Uname'";
      			$result_emp_usernames = mysqli_query($conn, $existSql_emp);
      			$numExistRows_emp = mysqli_num_rows($result_emp_usernames);
        			if($numExistRows_emp > 0){
            			$username_already_exist = true;
        			}
					else{
						$hash_pass_emp = password_hash($Pass_emp, PASSWORD_DEFAULT);
						$sql_add_emp = "INSERT INTO `staff` (`username`, `password`, `first_name`, `Last_Name`, `contact_no`, `e_mail`, `post`, `Speciality`, `Date_of_join`) VALUES ('$Uname', '$hash_pass_emp', '$Fname', '$Lname', '$contact_no', '$emial_emp', '$emp_post', '$speciallity', current_timestamp());";
							if ($conn->query($sql_add_emp) === TRUE) {
								Alert_display_for_success_emp();
							}
							else {
								Alert_display_for_error_emp();
							}
					}
				}
				else{
					$contact_lenght_error = True; 
				}
			}
			else{
				$post_alredy_exist = true;
			}
	}
	else{
		if(strlen($contact_no) >= 11 && strlen($contact_no) <= 15){
			$existSql_emp = "SELECT * FROM `staff` WHERE username = '$Uname'";
			  $result_emp_usernames = mysqli_query($conn, $existSql_emp);
			  $numExistRows_emp = mysqli_num_rows($result_emp_usernames);
				if($numExistRows_emp > 0){
					$username_already_exist = true;
				}
				else{
					$hash_pass_emp = password_hash($Pass_emp, PASSWORD_DEFAULT);
					$sql_add_emp = "INSERT INTO `staff` (`username`, `password`, `first_name`, `Last_Name`, `contact_no`, `e_mail`, `post`, `Speciality`, `Date_of_join`) VALUES ('$Uname', '$hash_pass_emp', '$Fname', '$Lname', '$contact_no', '$emial_emp', '$emp_post', '$speciallity', current_timestamp());";
						if ($conn->query($sql_add_emp) === TRUE) {
							Alert_display_for_success_emp();
						}
						else {
							Alert_display_for_error_emp();
						}
				}
			}
			else{
				$contact_lenght_error = True; 
			}
	}
		
$conn->close();
}


// Del the person info from table
if  (isset($_POST['Delete_id_emp']))
{
	require 'partials/db_connect.php';
	$serial_delete = $_POST['Delete_id_emp'];
	// print_r($Item_del);
	$sql = "DELETE FROM `staff` WHERE `staff`.`serial_no` = '$serial_delete';";
	if ($conn->query($sql) === TRUE) {
		Alert_display_for_person_info_success_Del();
	} else {
		Alert_display_person_info_error_del();
	}
	$conn->close();
}

function Alert_display_for_success_emp()
			{
			echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Employee has been added successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_error_emp()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong> Employee has not been added due to internal server Error.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_person_info_success_Del()
			{
			echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Current person Info has been deleted successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_person_info_error_del()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong> Current person Info has not been deleted due to internal server Error.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
	if(1)
	{ echo "<form action='admin_staff.php' method='POST'>
                <div class='form-group'>
                    <label for='title'>First Name</label>
                    <input type='text' class='form-control' name='fname' required maxlength = '30' onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
                </div>
				<div class='form-group'>
                    <label for='title'>Last Name</label>
                    <input type='text' class='form-control' name='lname' required maxlength = '30' onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
                </div>
				<div class='form-group'>
                    <label for='title'>Username for login</label>
                    <input type='text' class='form-control' name='username' required maxlength = '30'>";
					if($username_already_exist){
					echo "<label for='exampleInputEmail1' class='form-label alert_label'>Username already exists try another one.</label>";
					}
				echo " </div>
				<div class='form-group'>
                    <label for='title'>Password</label>
                    <input type='password' class='form-control' name='pass' required minlength = '8' >
                </div>
				<div class='form-group'>
                    <label for='title'>Contact No:</label>
                    <input type='number' class='form-control' name='contact_no' required >";
					if($contact_lenght_error){
						echo "<label for='exampleInputEmail1' class='form-label alert_label'>Contact length must be 11-15 or greater.</label>";
					}
                echo "</div>
				<div class='form-group'>
                    <label for='title'>Email</label>
                    <input type='email' class='form-control' name='e_mail_emp' required>
                </div>
				<div class='form-group'>
                    <label for='title'>Select Post</label>
                    <select type='text' class='form-control' name='emp_post' required >
							<option>Admin</option>
                            <option>Manager</option>
      						<option>Head Chef</option>
							<option selected>Chef</option>
      						<option>Delivery Boy</option>
    				</select>";
				if($post_alredy_exist){
						echo "<label for='exampleInputEmail1' class='form-label alert_label'>This post alredy reserved you must have to delete the previous one.</label>";
				}
                echo "</div>
                <div class='form-group'>
                    <label for='title'>Select Speciality</label>
                    <select type='text' class='form-control' name='emp_speciality' required >
                            <option selected>Meal</option>
      						<option>Fast Food</option>
							<option>Desserts</option>
      						<option>Drinks</option>
							<option>Meal and Fast Food</option>
      						<option>Meal and Desserts</option>
							<option>Meal and Drinks</option>
      						<option>Fast Food and Desserts</option>
							<option>Dessets and Drinks</option>
      						<option>Fast Food and Drnks</option>
							<option>Administrate</option>
							<option>Mangement</option>
							<option>Fast Delivery Service</option>
    				</select>
                </div>
                <br>
                    <button type='submit' class='btn btn-warning' value='submit' name='add_mc'>Add Employ <i class='fa fa-arrow-down-short-wide'></i></button>
            </form>
    </div>
<br>
        <div class='container' style='margin-bottom:30px;'>
		<h2>Added Employees</h2>
        <hr style='width:100%; height:3px;'>
			<table class='table table-bordered text-center table-hover table-responsive  table-striped' id = 'emp_tbl_jqry'>
  				<thead class='bg-dark text-white'>
    				<tr>
      					<th scope='col'>S.no</th>
      					<th scope='col'>Username</th>
      					<th scope='col'>First Name</th>
      					<th scope='col'>Last Name</th>
						<th scope='col'>Post</th>
						<th scope='col'>Date of Joining</th>
						<th scope='col'>Speciality</th>
						<th scope='col'>Status</th>
						<th scope='col'>Actions</th>
						<th scope='col' style='display:none;'></th>
    				</tr>
  				</thead>
  					<tbody>";
					  	require 'partials/db_connect.php';
						$sql = 'SELECT * FROM `staff`';
						$result = mysqli_query($conn, $sql);
          				$sno = 0;
          				while($row = mysqli_fetch_assoc($result))
						{
            			$sno = $sno + 1;
    					echo "<tr>
      						<th scope='row' style='padding-top:20px;'>".$sno."</th>
      						<td style='padding-top:20px;'>".$row['username']."</td>
      						<td style='padding-top:20px;'>".$row['first_name']."</td>
      						<td style='padding-top:20px;'>".$row['Last_Name']."</td>
							<td style='padding-top:20px;'>".$row['post']."</td>
							<td style='padding-top:20px;'>".$row['Date_of_join']."</td>
							<td style='padding-top:20px;'>".$row['Speciality']."</td>
							<td style='padding-top:20px;'>".$row['Status']."</td>
							<td><button class='delete_emp btn btn-lg btn-danger'><i class='fa fa-trash'></i></button></td>
							<td style='display:none;'>".$row['serial_no']."</td>
						</tr>";
						}
						$conn->close();
					
  					echo "</tbody>
			</table>

		</div>
	</div>";
}
?>
<!-- Delete the record on button click -->
<form id="Delete_emp" action="admin_staff.php" method="POST" style="display:none;">
			<input type="number" id="Delete_id_emp" name="Delete_id_emp">
</form>
<!-- End = Delete the record on button click -->

<!-- UPDATE `inventory items` SET `Image` = 'uploaded_images/cartoon.png' WHERE `inventory items`.`S.No` = 69;UPDATE `inventory items` SET `Image` = 'uploaded_images/cartoon.png' WHERE `inventory items`.`S.No` = 69; -->

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
   <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script> 
  <script>
	$(document).ready(function () {
      $('#emp_tbl_jqry').DataTable();
	});
  </script>
<script src="style/main.js"></script>
<script>
	deletes_emp = document.getElementsByClassName('delete_emp');
    Array.from(deletes_emp).forEach((element) => {
      element.addEventListener("click", (e) => {
		tr = e.target.parentNode.parentNode.parentNode;
		Delete_id_emp.value = Number(tr.getElementsByTagName("td")[7].innerText);
        if (confirm("Are you sure you want to delete current person info!")) {
			// console.log(Delete_id_emp.value);
			let form = document.getElementById("Delete_emp");
            form.submit();
        }
        else {
          	// console.log("no");
        }
      })
    })

	logout = document.getElementsByClassName('emp_admin_logout');
    Array.from(logout).forEach((element) => {
      element.addEventListener("click", (e) => {
        if (confirm("Are you sure to logout!")) {	
			window.location.href = '/fyp/partials/logout_emp.php';
        }
        else {
          
        }
      })
    })
	
</script>
</body>
</html>