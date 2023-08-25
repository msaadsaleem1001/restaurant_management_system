<?php
session_start();
if(isset( $_SESSION['loggedin_delivery_boy']) &&  $_SESSION['loggedin_delivery_boy'] == true){

}
else{
  header("location: emp_dec.php");
}
$success = false;
$err = false;
if(isset($_POST['id_of_order_form_php'])){
	require 'partials/db_connect.php';
	$Orser_No_id = $_POST['id_of_order_form_php'];
	$sql_update = "UPDATE `confirm_orders` SET `Status` = 'Delivered', `paid` = 'Paid' WHERE `confirm_orders`.`S_No` = '$Orser_No_id';";
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
    <title>DineOut/Delivery Boy</title>
    <link rel="icon" href="images/Icon.png" type="image/png">
	</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark" style = "height:50px;" >
<div class="container-fluid">
    <a class="navbar-brand" style="font-size: 30px; color:orange;"><i class="fa-solid fa-spoon" style="margin-right:20px; margin-left:20px;"> DineOut</i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style = "padding-top:55px;" >
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style = "padding-bottom:40px;">
	  <li class="nav-item">
          <?php echo "<a class='nav-link' style = 'text-decoration:none;' ><i class='fa-regular fa-face-dotted'></i> ".$_SESSION['username_emp']."</a>"; ?>
        </li>
        <li class="nav-item">
          <a class="nav-link logout_chef" href="emp_profile.php"><i class="fa-solid fa-user"></i> Profile</a>
        </li>
		<li class="nav-item">
          <a class="logout_delivery_boy nav-link logout_chef"> <i class="fa-solid fa-power-off"></i> Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container" style = "height:400px; margin-bottom:50px;">
<img src="images/delivery_boy.webp" alt="img" style = "height:400px; width:100%;">
</div>

<div class="container" style="margin-bottom:80px;">
<?php	
if($success){
	echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong>Order status updated successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
}
if($err){
	echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong>Order status has not been updated sucessfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
}
        echo "<h2>Home Delivery Orders</h2>
        <hr style='width:100%; height:1px;'>
			<table class='table table-bordered table-striped table-hover table-responsive' id = 'tbl_table'>
  				<thead class='bg-dark text-white'>
    				<tr>
      			<th scope='col'>#</th>
						<th style = 'display:none;'></th>
      			<th scope='col'>Order no</th>
            <th scope='col'>Order Date</th>
						<th scope='col'>Items</th>
      			<th scope='col'>Quantities</th>
						<th scope='col'>Address</th>
						<th scope='col'>Status</th>
						<th scope='col'>Action</th>
    				</tr>
  				</thead>
  					<tbody>";
					  	require 'partials/db_connect.php';
						$sql = 'SELECT * FROM `confirm_orders`';
						$result = mysqli_query($conn, $sql);
          				$sno = 0;
          				while($row = mysqli_fetch_assoc($result))
						{
						if($row['Status'] == "Dispatched"){
										$sno = $sno + 1;
										$d_explode = explode(",", $row['Dishes']);
										$Q_explode = explode(",", $row['quantities']);
										$T_explode = explode(",", $row['Order_type']);
										echo "<tr>
											<th scope='row' style='padding-top:20px;'>".$sno."</th>
											<td style='display:none;'>".$row['S_No']."</td>
											<td>".$row['order_no']."</td>
											<td>".$row['Date']."</td>
											<td>"; for ($i=0; $i < count($d_explode)-1; $i++){ echo $d_explode[$i]; echo "<br>"; } echo "</td>
											<td>"; for ($i=0; $i < count($d_explode)-1; $i++){ echo $Q_explode[$i]; echo "<br>"; } echo "</td>
                      <td>".$row['Method']."</td>
											<td style = 'width:125px;'><button class='btn btn-secondary'><i class='fa fa-bars'></i> Dispached</button</td>
											<td style = 'width:125px;'><button class='assign_to_chef btn btn-success'>Delivered <i class='fa fa-clipboard-check'></i></button</td>
										</tr>";
						}
						}
						$conn->close();
					
  					echo "</tbody>
			</table>
</div>
</div>";

?>			
<form style = "display:none;" id = "submit_Served" action="delivery_boy.php" method="post">
	  <input type='number' class='form-control' id='number_serialvcr' name='id_of_order_form_php' aria-describedby='emailHelp' required>
 </form>

<?php
echo "<div class='copyright'>
@DineOut ".date("Y")." Food Ordering System.
</div>";
?>   
    <!-- Button At the bottom to navigate at top: -->   
    <button onclick="topFunction()" id="top_button"><i class="fa-solid fa-arrow-up"></i></button>

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
<script>
assign_to_chef_modal = document.getElementsByClassName('assign_to_chef');
     Array.from(assign_to_chef_modal).forEach((element) => {
       element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode;
		let id_of_order = tr.getElementsByTagName("td")[0].innerText;
    // console.log(id_of_order);
		document.getElementById('number_serialvcr').value = id_of_order;
		if (confirm("Are you sure to change the status as Delivered!")) {	
			let form = document.getElementById("submit_Served");
            form.submit();
        }
        else {
        //   console.log("no");
        }
	   })
	})

	logout = document.getElementsByClassName('logout_delivery_boy');
    Array.from(logout).forEach((element) => {
      element.addEventListener("click", (e) => {
        if (confirm("Are you sure to logout!")) {	
			    window.location.href = '/fyp/partials/logout_emp.php';
        }
        else {
          
        }
      })
    })

var mybutton = document.getElementById("top_button");
window.onscroll = function(){scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
  </body>
</html>