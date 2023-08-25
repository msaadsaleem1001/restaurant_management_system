<?php
session_start();
$all_orders = true;
$contact = false;
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
<h2>All Orders</h2>

<?php
if  (isset($_POST['Delete_Canceled_row']))
{
	require 'partials/db_connect.php';
	$serial_del = $_POST['Delete_Canceled_row'];
	$sql = "DELETE FROM `confirm_orders` WHERE `confirm_orders`.`S_No` = '$serial_del';";
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
						<strong>Success!</strong> Selected order has been deleted successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_del_error()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong> Selected order has not been deleted due to internal server Error.
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
      					<th scope='col'>Order No</th>
      					<th scope='col'>Date</th>
      					<th scope='col'>Method</th>
						<th scope='col'>Status</th>
						<th scope='col'>Actions</th>
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
            			$sno = $sno + 1;
    					echo "<tr>
      						<td scope='row' style='padding-top:20px;'>".$sno."</td>
      						<td style='padding-top:20px;'>".$row['order_no']."</td>
      						<td style='padding-top:20px;'>".$row['Date']."</td>
      						<td style='padding-top:20px;'>".$row['Method']."</td>
							<td style='padding-top:20px;'>".$row['Status']."</td>
							<td>";if($row['Status']=="Canceled"){ 
                                        echo "<button class='btn btn-sm btn-danger delete_the_canceled_order'><i class='fa fa-trash'></i> Delete</button>";
                                  }
                                  else{
                                                if($row['Status']=="Delivered"){ 
                                                    echo "<button class='btn btn-sm btn-info Invoice_order'><i class='fa-solid fa-file-invoice'></i>Invoice</button>"; 
                                                }
                                                else{ 
                                                echo "<button class='btn btn-sm btn-info' disabled><i class='fa-solid fa-file-invoice'></i>Invoice</button>"; 
                                                }
                                    }
                            echo "</td>
							<td style='display:none;'>".$row['S_No']."</td>
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
<form id="delete_order_form" action="admin_all_orders.php" method="POST" style="display:none;">
			<input type="number" id="Delete_Canceled_row" name="Delete_Canceled_row">
</form>

<form id="Invoice_order_form" action="invoice.php" method="POST" style="display:none;">
			<input type="number" id="Invoice_id_order" name="Invoice_id_order">
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

	delete_order = document.getElementsByClassName('delete_the_canceled_order');
    Array.from(delete_order).forEach((element) => {
      element.addEventListener("click", (e) => {
		tr = e.target.parentNode.parentNode;
		Delete_Canceled_row.value = Number(tr.getElementsByTagName("td")[6].innerText);
        if (confirm("Are you sure you want to delete the order permanently!")) {	
			let form = document.getElementById("delete_order_form");
            form.submit();
        }
        else {
        //   console.log("no");
        }
      })
    })
    Invoice = document.getElementsByClassName('Invoice_order');
    Array.from(Invoice).forEach((element) => {
      element.addEventListener("click", (e) => {
		tr = e.target.parentNode.parentNode;
		Invoice_id_order.value = Number(tr.getElementsByTagName("td")[6].innerText);	
			let form = document.getElementById("Invoice_order_form");
            form.submit();
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