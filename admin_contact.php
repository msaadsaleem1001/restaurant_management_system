<?php
session_start();
$all_orders = false;
$contact = true;
$home = false;
$issues = false;
$menu = false;
$staff = false;
if(isset($_SESSION['loggedin_admin']) && $_SESSION['loggedin_admin'] == true){

}
else{
  header("location: emp_dec.php");
}
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
<div class= 'content-bar'>
<div class='container' style='margin-bottom:30px;'>
<h2>Contacting Peoples</h2>

<?php
// Del the contact info from table
if  (isset($_POST['Delete_Contact']))
{
	require 'partials/db_connect.php';
	$serial_del = $_POST['Delete_Contact'];
	// print_r($Item_del);
	$sql = "DELETE FROM `contacttbl` WHERE `contacttbl`.`Serial` = '$serial_del';";
	if ($conn->query($sql) === TRUE) {
		Alert_display_for_del_success();
	} else {
		Alert_display_for_del_error();
	}
	$conn->close();
}
function Alert_display_for_del_success()
			{
			echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Selected contact has been deleted successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_del_error()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong> Selected contact has not been deleted due to internal server Error.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
	if(1)
	{ 
	echo "
        <hr style='width:100%; height:3px;'>
			<table class='table table-bordered text-center table-hover table-responsive' id='myTable'>
  				<thead class='bg-dark text-white'>
    				<tr>
      					<th scope='col'>S.no</th>
      					<th scope='col'>First Name</th>
      					<th scope='col'>Last Name</th>
      					<th scope='col'>Email Address</th>
						<th scope='col'>City</th>
						<th scope='col'>Description</th>
						<th scope='col'>Date</th>
						<th scope='col'>Actions</th>
						<th scope='col' style='display:none;'></th>
    				</tr>
  				</thead>
  					<tbody>";
					  	require 'partials/db_connect.php';
						$sql = 'SELECT * FROM `contacttbl`';
						$result = mysqli_query($conn, $sql);
          				$sno = 0;
          				while($row = mysqli_fetch_assoc($result))
						{
            			$sno = $sno + 1;
    					echo "<tr>
      						<td scope='row' style='padding-top:20px;'>".$sno."</td>
      						<td style='padding-top:20px;'>".$row['First Name']."</td>
      						<td style='padding-top:20px;'>".$row['Last Name']."</td>
      						<td style='padding-top:20px;'>".$row['E-Mail']."</td>
							<td style='padding-top:20px;'>".$row['City Name']."</td>
							<td style='padding-top:20px;'>".$row['Description']."</td>
							<td style='padding-top:20px;'>".$row['Date']."</td>
							<td><button class='delete_contact btn btn-lg btn-danger'><i class='fa fa-trash'></i></button></td>
							<td style='display:none;'>".$row['Serial']."</td>
						</tr>";
						}
						$conn->close();
					
  					echo "</tbody>
			</table>
		</div>
	</div>
	</div>";
	}
?>
<!-- Delete the record on button click -->
<form id="delete_contact_form" action="admin_contact.php" method="POST" style="display:none;">
			<input type="number" id="Delete_Contact" name="Delete_Contact">
</form>
<!-- End = Delete the record on button click -->


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
      $('#myTable').DataTable();
	});

	deletes = document.getElementsByClassName('delete_contact');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
		tr = e.target.parentNode.parentNode.parentNode;
		Delete_Contact.value = Number(tr.getElementsByTagName("td")[8].innerText);
        if (confirm("Are you sure you want to delete this Item!")) {	
			// console.log(Delete_Contact.value);
			let form = document.getElementById("delete_contact_form");
            form.submit();
        }
        else {
        //   console.log("no");
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
<script src="style/main.js"></script>
</body>
</html>