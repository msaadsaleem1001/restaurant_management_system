<?php
session_start();
$all_orders = false;
$contact = false;
$home = false;
$issues = false;
$menu = true;
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

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editModalLabel">Update Current Inventory Item.</h4>
        <button type="button" class="btn1 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <form action="admin_menu.php" method="POST">
	  <input type="hidden" name="snoEdit" id="snoEdit">
                <div class="form-group">
                    <label for="title">Dish Name</label>
                    <input type="text" class="form-control" id="Dish_Name_edit" name="Dish_Name_edit" aria-describedby="emailHelp" placeholder="e.g:...Chiken Karahi" required onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)'>
                </div>
                <div class="form-group">
                    <label for="title">Dish type</label>
                    <select type="text" class="form-control" id="type_dish_edit" name="type_dish_edit" aria-describedby="emailHelp">
                            <option>Meal</option>
      						<option>Fast Food</option>
							<option>Desserts</option>
							<option>Drinks</option>
    				</select>
                </div>
				<div class="form-group">
                    <label for="title">Select Category</label>
                    <select type="text" class="form-control" id="category_edit" name="category_edit" aria-describedby="emailHelp">
                            <option>Beaf</option>
							<option>Mutton</option>
							<option>Chicken</option>
							<option>Bread</option>
							<option>Fish</option>
							<option>Rice</option>
							<option>Salad</option>
      						<option>Fast Food</option>
							<option>Desserts</option>
							<option>Drinks</option>
    				</select>
                </div>
                <div class="form-group">
                    <label for="title">Price</label>
                    <input type="number" class="form-control" id="Rs_edit" name="Rs_edit" aria-describedby="emailHelp" required placeholder="In rupees">
                </div>
                    <button type='submit' class='btn btn-warning' value='submit' name="Edit_Item">Save Changes</button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn1 btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- code for the add the inventory item -->
<div class= "content-bar">
<div class="container" style="width:100%;">
        	<h2>Add a Item in Menu</h2>
<?php
if  (isset($_POST['Add_Item']))
{
	require 'partials/db_connect.php';
	$Dish_type = $_POST['type-of-dish'];
	$Dish_name = $_POST['Dish_Name'];
	$category = $_POST['category'];
	$Price = $_POST['Rs'];
	$file = $_FILES['image'];

	$filename = $file['name'];
	$filerror = $file['error'];
	$filetemp = $file['tmp_name'];

	$fileext = explode('.', $filename);
	$filecont_low = strtolower (end($fileext));

	$file_extention_stord = array('jpg', 'jpeg', 'png', 'webp', 'jfif', 'avif');

	if(in_array($filecont_low, $file_extention_stord)){
		$destination_file = 'uploaded_images/'.$filename;
		move_uploaded_file($filetemp, $destination_file);

		$sql = "INSERT INTO `inventory_items` (`Dish_Type`, `category`, `Dish_Name`, `Price`, `Image`) VALUES ('$Dish_type', '$category', '$Dish_name', '$Price', '$destination_file');";
		if ($conn->query($sql) === TRUE) {
			Alert_display_for_menu_success();
		} else {
			Alert_display_for_menu_error();
		}
		$conn->close();
	}
}
// end



// Edit/update code
if  (isset($_POST['Edit_Item']))
{
	require 'partials/db_connect.php';
				$Dish_type_edit = $_POST['type_dish_edit'];
				$Dish_name_edit = $_POST['Dish_Name_edit'];
				$category_edit = $_POST['category_edit'];
				$Price_edit = $_POST['Rs_edit'];
				$serial_edit = $_POST['snoEdit'];
	// print_r($serial_edit);
	$sql = "UPDATE `inventory_items` SET `Dish_Type` = '$Dish_type_edit', `category`='$category_edit', `Dish_Name` = '$Dish_name_edit', `Price` = '$Price_edit' WHERE `inventory_items`.`Serial_no` = '$serial_edit';";
			 if ($conn->query($sql) === TRUE) {
				Alert_display_for_menu_success_edit();
			} else {
				Alert_display_for_menu_error_edit();
			}
$conn->close();
}

// Del the item from table
if  (isset($_POST['Delete_id']))
{
	require 'partials/db_connect.php';
	$Item_del = $_POST['Delete_id'];
	// print_r($Item_del);
	$sql = "DELETE FROM `inventory_items` WHERE `inventory_items`.`Serial_no` = '$Item_del';";
	if ($conn->query($sql) === TRUE) {
		Alert_display_for_menu_Item_Del();
	} else {
		Alert_display_for_menu_error_del();
	}
	$conn->close();
}



function Alert_display_for_menu_success()
			{
			echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Inventory Item has been added successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_menu_error()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong> Inventory Item has not been added due to internal server Error.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_menu_success_edit()
			{
			echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Inventory Item has been updated successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_menu_error_edit()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong> Inventory Item has not been updated due to internal server Error.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_menu_Item_Del()
			{
			echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Inventory Item has been deleted successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_menu_error_del()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong> Inventory Item has not been deleted due to internal server Error.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
	if(1)
	{ echo "<form action='admin_menu.php' method='POST' enctype='multipart/form-data'>
                <div class='form-group'>
                    <label for='title'>Dish Name</label>
                    <input type='text' class='form-control' id='title' name='Dish_Name' aria-describedby='emailHelp' placeholder='e.g:...Chiken Karahi' required onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)'>
                </div>
                <div class='form-group'>
                    <label for='title'>Dish type</label>
                    <select type='text' class='form-control' required id='title' name='type-of-dish' aria-describedby='emailHelp'>
                            <option selected>Meal</option>
      						<option>Fast Food</option>
							<option>Desserts</option>
							<option>Drinks</option>
    				</select>
                </div>
				<div class='form-group'>
                    <label for='title'>Select Category</label>
                    <select type='text' class='form-control' required name='category' aria-describedby='emailHelp'>
                            <option selected>Beaf</option>
							<option>Mutton</option>
							<option>Chicken</option>
							<option>Bread</option>
							<option>Fish</option>
							<option>Rice</option>
							<option>Salad</option>
      						<option>Fast Food</option>
							<option>Desserts</option>
							<option>Drinks</option>
    				</select>
                </div>
                <div class='form-group'>
                    <label for='title'>Price</label>
                    <input type='number' class='form-control' id='title' name='Rs' aria-describedby='emailHelp' required placeholder='In rupees'>
                </div>
                <div class='form-group'>
                    <label for='title'>Specific image of Dish</label>
                    <input type='file' class='form-control' required id='title' name='image' aria-describedby='emailHelp'>
                </div><br>
                    <button type='submit' class='btn btn-warning' value='submit' name='Add_Item'>Add Inventory</button>
            </form>
    </div>
<br>

        <div class='container' style='margin-bottom:30px;'>
        <h2>Menu Display</h2>
        <hr style='width:100%; height:3px;'>
			<table class='table table-bordered text-center table-hover table-responsive' id='myTable'>
  				<thead class='bg-dark text-white'>
    				<tr>
      					<th scope='col'>S.no</th>
      					<th scope='col'>Dish Type</th>
      					<th scope='col'>Dish Name</th>
						<th scope='col'>Price</th>
						<th scope='col'>Images</th>
						<th scope='col'>Actions</th>
						<th scope='col' style='display:none;'></th>
    				</tr>
  				</thead>
  					<tbody>";
					  	require 'partials/db_connect.php';
						$sql = 'SELECT * FROM `inventory_items`';
						$result = mysqli_query($conn, $sql);
          				$sno = 0;
          				while($row = mysqli_fetch_assoc($result))
						{
            			$sno = $sno + 1;
    					echo "<tr>
      						<th scope='row' style='padding-top:45px;'>".$sno."</th>
      						<td style='padding-top:45px;'>".$row['Dish_Type']."</td>
      						<td style='padding-top:45px;'>".$row['Dish_Name']."</td>
							<td style='padding-top:45px;'>".$row['Price']."</td>
      						<td><div  id='dimg'><img src=".$row['Image']." style='height: 100px; width:100px;'></div></td>
							<td style='padding-top:33px;'> <button class='edit btn btn-lg btn-primary'><i class='fa fa-pen-to-square'></i></button> <button class='delete btn btn-lg btn-danger'><i class='fa fa-trash'></i></button></td>
							<td style='display:none;'>".$row['Serial_no']."</td>
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
<form id="Delete_Item" action="admin_menu.php" method="POST" style="display:none;">
			<input type="number" id="Delete_id" name="Delete_id">
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
      $('#myTable').DataTable();
	});
  </script>
<script src="style/main.js"></script>
<script>
	edits = document.getElementsByClassName('edit');
     Array.from(edits).forEach((element) => {
       element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode.parentNode;
			dtype_edit = tr.getElementsByTagName("td")[0].innerText;
        	dname_edit = tr.getElementsByTagName("td")[1].innerText;
			d_category = tr.getElementsByTagName("td")[2].innerText;
        	d_price = tr.getElementsByTagName("td")[3].innerText;
			snoEdit.value = Number(tr.getElementsByTagName("td")[6].innerText);
			Dish_Name_edit.value = dname_edit;
			type_dish_edit.value = dtype_edit;
			Rs_edit.value = d_price;
			category_edit.value = d_category;
			// console.log(snoEdit);
			$("#editModal").modal('show');

			$(".btn1").click(function(){
            $("#editModal").modal('hide');
        	});
	   })
	})

	deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
		tr = e.target.parentNode.parentNode.parentNode;
		let del = document.getElementById('Delete_id');
		del.value = Number(tr.getElementsByTagName("td")[6].innerText);
		// console.log(del.value);
        if (confirm("Are you sure you want to delete this Item!")) {	
			// console.log(Delete_id);
			let form = document.getElementById("Delete_Item");
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
</body>
</html>