<?php
session_start();
if(isset($_SESSION['loggedin_Head_Chef']) && $_SESSION['loggedin_Head_Chef'] == true){

}
else{
  header("location: emp_dec.php");
}
$ready = false;
$pending = true;
$home = false;
$success = false;
$err = false;
if(isset($_POST['submit_first_modal'])){
	require 'partials/db_connect.php';
	$Orser_No_id = $_POST['id_of_order_form_php'];
	$Chef_mix = $_POST['selected_chef'];
	$Chef_username = explode("-", $Chef_mix);
	$real_username  = $Chef_username[0];
	// print_r($real_username);
	$sql_update = "UPDATE `confirm_orders` SET `Status` = 'In process', `chef_username` = '$real_username' WHERE `confirm_orders`.`S_No` = '$Orser_No_id';";
	if ($conn->query($sql_update) === TRUE) {
		$success = true;
	} else {
		$err = true;
	}
$conn->close();
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
        <title>Head Chef/DineOut</title>
        <link rel="icon" href="images/Icon.png" type="image/png">
	</head>
	<body>
	<?php require 'partials/head_pannel.php'; ?>
<!-- code for the add the table-->
<div class= "content-bar">
<div class="container" style="margin-bottom:50px;">
<?php	
if($success){
	echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong>Successfully order assinged.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
}
if($err){
	echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong>Internal server error. 
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
}
        echo "<h2>Pending Orders</h2>
        <hr style='width:100%; height:3px;'>
			<table class='table table-bordered table-striped table-hover table-responsive' id = 'tbl_table'>
  				<thead class='bg-dark text-white'>
    				<tr>
      					<th scope='col'>#</th>
						<th style = 'display:none;'></th>
      					<th scope='col'>Order no</th>
						<th scope='col'>Method</th>
      					<th scope='col'>Items</th>
						<th scope='col'>Quantities</th>
						<th scope='col'>Order Type</th>
						<th scope='col'>Status</th>
						<th scope='col'>Action</th>
						<th scope='col' style='display:none;'></th>
    				</tr>
  				</thead>
  					<tbody>";
					  	require 'partials/db_connect.php';
						$sql = 'SELECT * FROM `confirm_orders`';
						$result = mysqli_query($conn, $sql);
          				$sno = 0;
          				while($row = mysqli_fetch_assoc($result))
						{
						if($row['Status'] == "Pending"){
            			$sno = $sno + 1;
								$d_explode = explode(",", $row['Dishes']);
                                $Q_explode = explode(",", $row['quantities']);
                                $T_explode = explode(",", $row['Order_type']);
    					echo "<tr>
      						<th scope='row' style='padding-top:20px;'>".$sno."</th>
							<td style='display:none;'>".$row['S_No']."</td>
      						<td style='padding-top:20px;'>".$row['order_no']."</td>
							<td style='padding-top:20px;'>".$row['Method']."</td>
      						<td style='padding-top:20px;'>"; for ($i=0; $i < count($d_explode); $i++){ echo $d_explode[$i]; echo "<br>"; } echo "</td>
							<td style='padding-top:20px;'>"; for ($i=0; $i < count($d_explode); $i++){ echo $Q_explode[$i]; echo "<br>"; } echo "</td>
      						<td style='padding-top:20px;'>"; for ($i=0; $i < count($d_explode); $i++){ echo $T_explode[$i]; echo "<br>"; } echo "</td>
							<td style='padding-top:20px;'>".$row['Status']."</td>
							<td style = 'text-align:center;'> <button class='assign_to_chef btn btn-sm btn-info'>Assign to Chef <i class='fa-solid fa-arrow-right-to-bracket'></i></button</td>
							<td style='display:none;'></td>
						</tr>";
						}
						}
						$conn->close();
					
  					echo "</tbody>
			</table>
</div>
</div>";

?>


			
		<div class='modal fade' id='assign_to_chef_order' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
			  <div class='modal-dialog'>
				<div class='modal-content'>
				  <div class='modal-header'>
					<h5 class='modal-title' id='exampleModalLabel'>Select from the active chefs</h5>
					<button type='button' class='btn2 btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
				  </div>
				  <div class='modal-body'>
				  <form action="head_chef_pending_orders.php" method="post">
				  <input type='number' style = "display:none;" class='form-control' id='number_serialvcr' name='id_of_order_form_php' aria-describedby='emailHelp' required>
				  <label class='form-control' style = 'font-weight:bold;'>Username-----> Speciality</lable>
				  <?php
				  		require 'partials/db_connect.php';
						$sql_e = 'SELECT * FROM `staff`';
						$result_e = mysqli_query($conn, $sql_e);
				  echo "<select class='form-select' name ='selected_chef' aria-label='Default select example'>";
				  while($row_e = mysqli_fetch_assoc($result_e))
				  {
					  if($row_e['post'] == "Chef"){		
				  			echo "<option>".$row_e['username']."----->".$row_e['Speciality']."</option>";
					  }
				  }
				echo "</select>
				  </div>
				  <div class='modal-footer'>
					<button type='submit' name = 'submit_first_modal' class='proceed_to_chef btn btn-info'>Proceed <i class='fa-solid fa-arrow-right'></i></button>
				  </form>
					</div>
				</div>
			  </div>
			</div>";
						$conn->close();
			?>

	


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
      $('#tbl_table').DataTable();
	});
  </script>
<script src="style/main.js"></script>
<script>
	assign_to_chef_modal = document.getElementsByClassName('assign_to_chef');
     Array.from(assign_to_chef_modal).forEach((element) => {
       element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode;
		let id_of_order = tr.getElementsByTagName("td")[0].innerText;
		number_serialvcr.value = id_of_order;

			$("#assign_to_chef_order").modal('show');

			$(".btn2").click(function(){
            $("#assign_to_chef_order").modal('hide');
        	});
	   })
	})

	logout = document.getElementsByClassName('emp_head_chef_logout');
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