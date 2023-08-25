<?php
session_start();
if(isset($_SESSION['loggedin_manager']) && $_SESSION['loggedin_manager'] == true){

}
else{
  header("location: emp_dec.php");
}
$home = false;
$table = true;
$delivery = false;
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://use.fontawesome.com/5bb0aa3c76.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style/design.css?v=<?php echo time(); ?>">
    <title>Manager/DineOut</title>
    <link rel="icon" href="images/Icon.png" type="image/png">
	</head>
	<body>
	<?php require 'partials/manager_pannel.php'; ?>

<!-- Modal -->
<div class="modal fade" id="Table_Edit_tbl" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editModalLabel">Update the table Status.</h4>
        <button type="button" class="btn2 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  <form action='manager_table.php' method='POST'>
	  <input type="hidden" name="snoEdit_tbl" id="snoEdit_tbl">
	  <div class='form-group'>
                    <label for='title'>Table no.</label>
                    <input type='number' class='form-control' name='Edit_tbl_no' id="Edit_tbl_no" required>
                </div>
				<div class='form-group'>
                    <label for='title'>Status</label>
                    <select type='text' class='form-control' name='edit_tbl_status' id="edit_tbl_status">
                            <option>Available</option>
      						<option>Reserved</option>
    				</select>
                </div>
                <div class='form-group'>
                    <label for='title'>Capacity</label>
                    <select type='number' class='form-control' name='Edit_tbl_cap' id="Edit_tbl_cap">
                            <option>2</option>
      						<option>4</option>
							<option>6</option>
      						<option>8</option>
							<option>10</option>
      						<option>12</option>
    				</select>
                </div>
                <br>
                    <button type='submit' class='btn btn-warning' value='submit' name='Edit_table_Info'>Save Changes</button>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn2 btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<!-- code for the add the table-->
<div class= "content-bar">
<div class="container" style="width:100%;">
        	<h2>Add Table</h2>
<?php
if  (isset($_POST['add_tbl']))
{
	require 'partials/db_connect.php';
	$tbl_no = $_POST['tbl_no'];
	$tbl_status = $_POST['table_status'];
	$tbl_capacity = $_POST['tbl_capacity'];
		$sql = "INSERT INTO `tbl_for_tables` (`table_no`, `status_tbl`, `tbl_capacity`) VALUES ('$tbl_no', '$tbl_status', '$tbl_capacity');";
		if ($conn->query($sql) === TRUE) {
			Alert_display_for_success_table();
		} else {
			Alert_display_for_error_table();
		}
		$conn->close();
}
// end



// Edit/update code for Edit table info
if  (isset($_POST['Edit_table_Info']))
{
	require 'partials/db_connect.php';
	$tbl_no = $_POST['Edit_tbl_no'];
	$tbl_capacity = $_POST['Edit_tbl_cap'];
	$tbl_status = $_POST['edit_tbl_status'];
	$tbl_serial = $_POST['snoEdit_tbl'];
	$sql = "UPDATE `tbl_for_tables` SET `table_no` = '$tbl_no', `status_tbl` = '$tbl_status', `tbl_capacity` = '$tbl_capacity' WHERE `tbl_for_tables`.`Sr_no` = '$tbl_serial';";
			 if ($conn->query($sql) === TRUE) {
				Alert_display_for_table_success_edit();
			} else {
				Alert_display_for_table_error_edit();
			}
	$conn->close();
}


// Del the person info from table
if  (isset($_POST['Delete_tbl_n_id']))
{
	require 'partials/db_connect.php';
	$serial_delete = $_POST['Delete_tbl_n_id'];
	// print_r($serial_delete);
	$sql = "DELETE FROM `tbl_for_tables` WHERE `tbl_for_tables`.`Sr_no` = '$serial_delete';";
	if ($conn->query($sql) === TRUE) {
		Alert_display_for_table_success_del();
	} else {
		Alert_display_for_table_error_del();
	}
	$conn->close();
}

function Alert_display_for_success_table()
			{
			echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Table has been added successfully added.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_error_table()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong> Table has not been added due to internal server Error.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_table_success_edit()
			{
			echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Current table info has been updated successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_table_error_edit()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong>  Current table info  has not been updated due to internal server Error.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_table_success_del()
			{
			echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Current table info has been deleted successfully.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
function Alert_display_for_table_error_del()
			{
			echo "
			<div class='alert alert-danger alert-dismissible fade show' role='alert'>
						<strong>Error!</strong>  Current table info  has not been deleted due to internal server Error.
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>";
			}
	if(1)
	{ echo "<form action='manager_table.php' method='POST'>
                <div class='form-group'>
                    <label for='title'>Enter table no.</label>
                    <input type='number' class='form-control' name='tbl_no' required>
                </div>
				<div class='form-group'>
                    <label for='title'>Status</label>
                    <select type='text' class='form-control' name='table_status'>
                            <option>Available</option>
      						<option>Reserved</option>
    				</select>
                </div>
                <div class='form-group'>
                    <label for='title'>Capacity</label>
                    <select type='number' class='form-control' name='tbl_capacity'>
                            <option>2</option>
      						<option>4</option>
							<option>6</option>
      						<option>8</option>
							<option>10</option>
      						<option>12</option>
    				</select>
                </div>
                <br>
                    <button type='submit' class='btn btn-warning' value='submit' name='add_tbl'>Add Table</button>
            </form>
    </div>
<br>
        <div class='container' style='margin-bottom:30px;'>
        <h2>Added Tables</h2>
        <hr style='width:100%; height:3px;'>
			<table class='table table-bordered text-center table-hover table-responsive' id = 'tbl_table'>
  				<thead class='bg-dark text-white'>
    				<tr>
      					<th scope='col'>S.no</th>
      					<th scope='col'>Table no.</th>
      					<th scope='col'>Status</th>
      					<th scope='col'>Capacity</th>
						<th scope='col'>Actions</th>
						<th scope='col' style='display:none;'></th>
    				</tr>
  				</thead>
  					<tbody>";
					  	require 'partials/db_connect.php';
						$sql = 'SELECT * FROM `tbl_for_tables`';
						$result = mysqli_query($conn, $sql);
          				$sno = 0;
          				while($row = mysqli_fetch_assoc($result))
						{
            			$sno = $sno + 1;
    					echo "<tr>
      						<th scope='row' style='padding-top:20px;'>".$sno."</th>
      						<td style='padding-top:20px;'>".$row['table_no']."</td>
      						<td style='padding-top:20px;'>".$row['status_tbl']."</td>
      						<td style='padding-top:20px;'>".$row['tbl_capacity']."</td>
							<td> <button class='edit_tbl btn btn-lg btn-primary'><i class='fa fa-pen-to-square'>&#xf044;</i></button> <button class='delete_tbl btn btn-lg btn-danger'><i class='fa fa-trash'></i></button></td>
							<td style='display:none;'>".$row['Sr_no']."</td>
						</tr>";
						}
						$conn->close();
					
  					echo "</tbody>
			</table>";		
	}
?>



<!-- Delete the record on button click -->
<form id="delete_table_fr" action="manager_table.php" method="POST" style="display:none;">
			<input type="number" id="Delete_tbl_n_id" name="Delete_tbl_n_id">
</form>
<!-- End = Delete the record on button click -->

<div id = "modal_parent">

</div>




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
<script src="style/main.js"></script>
<script>
var span = document.getElementById('span_value');
  var prev = span.textContent;
$(document).ready(function(){
  const interval = setInterval(function() {
    $.get("get_request_for_bills.php", function(data){
        const fetchedata = data.split(" ");
        let len =fetchedata.length;
        let bellno =fetchedata[len-1];
              if(bellno > prev){
                  span.textContent = bellno;
                  prev = bellno;
              }
              else{
                  span.textContent = bellno;
              }
              const remove_list = document.getElementById("noti_list");
              while (remove_list.hasChildNodes()) {
                remove_list.removeChild(remove_list.firstChild);
              }
              for(i=0; i<=len-2; i++){
                    const item_list = document.createElement("li");
                    const anchor = document.createElement("a");
                    anchor.classList.add('dropdown-item', 'list_pointer');
                    const textnode = document.createTextNode(fetchedata[i]);
                    item_list.appendChild(anchor);
                    anchor.appendChild(textnode);
                    document.getElementById("noti_list").appendChild(item_list);
              }
    });
  }, 1000);


  $('#noti_list').on('click', '.list_pointer', function() {
    let current_no = $(this).text();
    $.get("get_request_bill.php",
        {
          Order_no: current_no
        },
        function(data,status){
          if(data != "false"){
            document.getElementById("modal_parent").innerHTML=data;
            $("#bill_modal").modal('show');
          }
        });
  });
});

$('#modal_parent').on('click', '#paid_order_btn', function() {
      $("#bill_modal").modal('show');
      let bill = $("#print_modal").html();
        let id_no = document.getElementById("paid_order_id").value;
        $.post("user_post_request.php",
        {
          primary_no: id_no
        },
        function(data,status){
          if(data == "True"){
            var mywindow = window.open('', 'PRINT', '');
            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(bill);
            mywindow.document.write('</body></html>');
            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/
            mywindow.print();
            mywindow.close();
          }  
        });
});


	$(document).ready(function () {
      $('#tbl_table').DataTable();
	});


	edits_tbl = document.getElementsByClassName('edit_tbl');
     Array.from(edits_tbl).forEach((element) => {
       element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode.parentNode;

			table_number = tr.getElementsByTagName("td")[0].innerText;
			table_status = tr.getElementsByTagName("td")[1].innerText;
			Capacity = tr.getElementsByTagName("td")[2].innerText;
			serial = Number(tr.getElementsByTagName("td")[4].innerText);

			Edit_tbl_no.value = table_number;
			edit_tbl_status.value = table_status;
			Edit_tbl_cap.value= Capacity;
			snoEdit_tbl.value = serial;
			$("#Table_Edit_tbl").modal('show');

			$(".btn2").click(function(){
            $("#Table_Edit_tbl").modal('hide');
        	});
	   })
	})

	deletes_tbl = document.getElementsByClassName('delete_tbl');
    Array.from(deletes_tbl).forEach((element) => {
      element.addEventListener("click", (e) => {
		tr = e.target.parentNode.parentNode.parentNode;
		tbl_delete_id = tr.getElementsByTagName("td")[4].innerText;
		Delete_tbl_n_id.value = tbl_delete_id;
        if (confirm("Are you sure you want to delete current person info!")) {
			console.log(Delete_tbl_n_id.value);
			let form = document.getElementById("delete_table_fr");
            form.submit();
        }
        else {
          	console.log("no");
        }
      })
    })

	logout = document.getElementsByClassName('emp_manager_logout');
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