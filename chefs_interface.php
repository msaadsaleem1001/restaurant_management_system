<?php
session_start();
if(isset($_SESSION['loggedin_Chef']) && $_SESSION['loggedin_Chef'] == true){

}
else{
  header("location: emp_dec.php");
}
$pass_err = false;
$internal = false;
$pass_error = false;
$success = false;
if(isset($_POST['Verify_order'])){
  require 'partials/db_connect.php';
  $user_name_chef = $_POST["username_chef"];
  $pass_word_chef = $_POST["password_of_chef"]; 
  $confirm_order_id = $_POST["order_id_chef"]; 
  $sql_u = "SELECT * FROM staff WHERE username='$user_name_chef'";
  $result_u = mysqli_query($conn, $sql_u);
  $num_u = mysqli_num_rows($result_u);
  if ($num_u == 1){
      $row_u=mysqli_fetch_assoc($result_u);
          if (password_verify($pass_word_chef, $row_u['password'])){ 
              $sql_update = "UPDATE `confirm_orders` SET `Status` = 'Ready' WHERE `confirm_orders`.`S_No` = '$confirm_order_id';";
              if ($conn->query($sql_update) === TRUE) {
                $success = true;
              } else {
                $internal = true;
              }
          }
          else{
            $pass_err = true;
          }
        
  }
  $conn->close();
}

if(isset($_POST['profile_submit'])){
	require 'partials/db_connect.php';
	$Profile_Name = $_POST['profile_username'];
	$Profile_pass = $_POST['profile_password'];
  $sql_p = "SELECT * FROM staff WHERE username='$Profile_Name'";
  $result_p = mysqli_query($conn, $sql_p);
  $num_p = mysqli_num_rows($result_p);
      if ($num_p == 1){
          $row_=mysqli_fetch_assoc($result_p);
            if (password_verify($Profile_pass, $row_['password'])){ 
              $_SESSION['username_emp'] = $Profile_Name;
              header("location: /FYP/emp_profile.php");
            }
            else{
               $pass_error = true;
            }
      }
      else{
          // echo "Not Found";
      }
}


if(isset($_POST['logout_submit'])){
	require 'partials/db_connect.php';
	$Logout_Name = $_POST['logout_username'];
	$Logout_pass = $_POST['logout_password'];
  $sql_p = "SELECT * FROM staff WHERE username='$Logout_Name'";
  $result_p = mysqli_query($conn, $sql_p);
  $num_p = mysqli_num_rows($result_p);
      if ($num_p == 1){
          $row_=mysqli_fetch_assoc($result_p);
            if (password_verify($Logout_pass, $row_['password'])){ 
              $_SESSION['username_emp'] = $Logout_Name;
              header("location: /FYP/partials/logout_emp.php");
            }
            else{
               $pass_error = true;
            }
      }
      else{
          // echo "Not Found";
      }
}
?>
<!doctype html>
<html lang="en">
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/6f3c4e01cb.js" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="style/design.css?v=<?php echo time(); ?>">
  <link rel="icon" href="images/Icon.png" type="image/png">
  <title>DineOut/Chef's</title>
</head>
<body>
<?php
if($internal){
  echo "<div class='container' style = 'position:relative; display: flex; justify-content: center; align-items: center;'>
  <div style = 'position:absolute; top:40%; z-index:2000; width:300px; height:100px; position: fixed;'>
    <div class='toast fade show'>
        <div class='toast-header'>
            <strong class='me-auto' style = 'color:red;'><i class='fa-solid fa-triangle-exclamation' style = 'color:red; font-size:20px;'></i> <b>Error!</b></strong>
            <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
        </div>
        <div class='toast-body' style = 'text-align:center;'>
            <b>Internal Server error!</b><br>
            Order not updated successfully.
        </div>
    </div>
</div>
</div>
</div>";
}
if($success){
  echo "<div class='container' style = 'position:relative; display: flex; justify-content: center; align-items: center;'>
  <div style = 'position:absolute; top:40%; z-index:2000; width:300px; height:100px; position: fixed;'>
     <div class='toast fade show'>
         <div class='toast-header'>
            <strong class='me-auto' style = 'color:green;'><i style='font-size:20px;' class='fa fa-clipboard-check'></i> <b>Success!</b></strong>
            <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
         </div>
         <div class='toast-body' style = 'text-align:center;'>
             <b>Order status updated successfully.</b><br>
         </div>
     </div>
  </div>
  </div>
</div>";
}
if($pass_err){
  echo "<div class='container' style = 'position:relative; display: flex; justify-content: center; align-items: center;'>
  <div style = 'position:absolute; top:40%; z-index:2000; width:300px; height:100px; position: fixed;'>
    <div class='toast fade show'>
        <div class='toast-header'>
            <strong class='me-auto' style = 'color:red;'><i class='fa-solid fa-triangle-exclamation' style = 'color:red; font-size:20px;'></i> <b>Error!</b></strong>
            <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
        </div>
        <div class='toast-body' style = 'text-align:center;'>
            <b>Invalid Password!</b><br>
            Please make sure the correct password.
        </div>
    </div>
    </div>
</div>
</div>";
}
if($pass_error){
  echo "<div class='container' style = 'position:relative; display: flex; justify-content: center; align-items: center;'>
  <div style = 'position:absolute; top:40%; z-index:2000; width:300px; height:100px; position: fixed;'>
    <div class='toast fade show'>
        <div class='toast-header'>
            <strong class='me-auto' style = 'color:red;'><i class='fa-solid fa-triangle-exclamation' style = 'color:red; font-size:20px;'></i> <b>Error!</b></strong>
            <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
        </div>
        <div class='toast-body' style = 'text-align:center;'>
            <b>Invalid Password!</b><br>
            Please make sure the correct password.
        </div>
    </div>
    </div>
</div>
</div>";
}
?>
<nav class="navbar navbar-expand navbar-dark bg-dark" style = "height:50px;" >
<div class="container-fluid">
    <a class="navbar-brand" style="font-size: 30px; color:orange;"><i class="fa-solid fa-spoon" style="margin-right:20px; margin-left:20px;"> DineOut</i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style = "padding-top:55px;" >
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style = "padding-bottom:40px;">
        <li class="nav-item">
          <a class="Chefs_logout_click nav-link logout_chef"><i class="fa-solid fa-power-off"></i> Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link logout_chef Chefs_profile_click"><i class="fa-solid fa-user"></i> Profile</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container" style = "height:400px;">
<img src="images/chefs_interface.webp" alt="img" style = "height:400px; width:100%;">
<hr style = "height:3px;">
</div>


<div class = 'container mt-4'>
  <div class="cards_chef">

<?php
require 'partials/db_connect.php';
$sql_chef = "SELECT * FROM `confirm_orders`";
$result_chef = mysqli_query($conn, $sql_chef);
      while($row_chef = mysqli_fetch_assoc($result_chef)){
						if($row_chef['Status'] == "In process"){
              $I_explode = explode(",", $row_chef['Dishes']);
              $Q_explode = explode(",", $row_chef['quantities']);
                        echo "<div class='card mb-3' style='max-width: 540px;'>
                        <input type='number' value = ".$row_chef['S_No']." style = 'display:none;'>
                        <input type='text'  value = ".$row_chef['chef_username']." style = 'display:none;'>
                              <div class='row g-0'>
                                <div class='col-md-4'>
                                  <img src='images/processing_order.webp' class='img-fluid rounded-start' alt='img'>
                                </div>
                                <div class='col-md-8'>
                                  <div class='card-body'>
                                  <p class='card-title' style = 'position:absolute; right:14px; margin-top:-10px;'><img src='images/chef.jpeg' alt='img' style = 'width:25px; height:25px;'><b>Chef : ".$row_chef['chef_username']."</b></p><hr>
                                    <h6 class='card-title'><b>Order no : ".$row_chef['order_no']."</b></h6>
                                    <p class='card-text'>Order in Process: <i class='fa-solid fa-spinner'></i></p>
                                    <table class='table'>
                                    <thead class = 'table-dark'>
                                    <tr>
                                      <th scope='col'>Items</th>
                                      <th scope='col'>Quantities</th>
                                    </tr>
                                    </thead>
                                    <tbody> 
                                    <tr>
                                            <td>";for ($i=0; $i < count($I_explode)-1; $i++){echo $I_explode[$i]; echo "<br>";} echo"</td>
                                            <td>";for ($i=0; $i < count($Q_explode)-1; $i++){echo $Q_explode[$i]; echo "<br>";} echo"</td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    <button data-bs-toggle='tooltip' data-bs-placement='top' title='Click if the Order ready and only the chef can check it who is assign to this order.' type='button' class='btn btn-success btn-sm order_ready_btn' style = 'float:right; margin-bottom:8px;'> <i class='fa-solid fa-check'></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>";
            }
          }
?>
<div class="modal fade" id="chef_pass_verify" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Please enter your password.</h5>
        <button type="button" class="btn2 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="chefs_interface.php" method = "post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input type="text" class="form-control" name ="username_chef" readonly id ="username_chef" aria-describedby="emailHelp" required>
              <input type="text" style = "display:none;" class="form-control" name ="order_id_chef" readonly id ="order_id_chef" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <input type="password" name = "password_of_chef" placeholder = "Password" class="form-control" id="exampleInputPassword1" required>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
              <label class="form-check-label" for="exampleCheck1">Confirm.</label>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="Verify_order" class="btn btn-success">Verify <i class='fa-solid fa-check'></i></button>
      </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>




<!-- Modal for profile -->
<div class="modal fade" id="profile_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Select Username</h5>
        <button type="button" class="btn2 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="chefs_interface.php" method = "post">
    <?php   require 'partials/db_connect.php';
						$sql_e = 'SELECT * FROM `staff`';
						$result_e = mysqli_query($conn, $sql_e);
              echo "<select class='form-select mb-4' name='profile_username' aria-label='Default select example' required>";
              while($row_e = mysqli_fetch_assoc($result_e))
              {
                if($row_e['post'] == "Chef"){		
                    echo "<option>".$row_e['username']."</option>";
                }
              }
              $conn->close();
    ?>
              </select>
              <div class="mb-3">
                <input type="password" class="form-control" name="profile_password" placeholder='Password' required>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" required>
                <label class="form-check-label" for="exampleCheck1">Confirm</label>
              </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="profile_submit" class="btn btn-info">Proceed <i class="fa fa-right-from-bracket"></i></button>
      </form>
      </div>
    </div>
  </div>
</div>





<!-- Modal for logout -->
<div class="modal fade" id="logout_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Select Username</h5>
        <button type="button" class="btn2 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="chefs_interface.php" method = "post">
   <?php    require 'partials/db_connect.php';
						$sql_e = 'SELECT * FROM `staff`';
						$result_e = mysqli_query($conn, $sql_e);
              echo "<select class='form-select mb-4' name='logout_username' aria-label='Default select example' required>";
              while($row_e = mysqli_fetch_assoc($result_e))
              {
                if($row_e['post'] == "Chef"){		
                    echo "<option>".$row_e['username']."</option>";
                }
              }
              $conn->close();
    ?>
              </select>   
              <div class="mb-3">
                <input type="password" class="form-control" name="logout_password" placeholder='Password' required>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" required>
                <label class="form-check-label" for="exampleCheck1">Confirm</label>
              </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="logout_submit" class="btn btn-info">Proceed <i class="fa fa-right-from-bracket"></i></button>
      </form>
      </div>
    </div>
  </div>
</div>



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
order_ready_btn_c = document.getElementsByClassName('order_ready_btn');
     Array.from(order_ready_btn_c).forEach((element) => {
       element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode.parentNode.parentNode.parentNode;
        let serial_no  = tr.getElementsByTagName("input")[0].value;
        let username_chef = tr.getElementsByTagName("input")[1].value;
        document.getElementById("username_chef").value = username_chef;
        document.getElementById("order_id_chef").value = serial_no;
		 	$("#chef_pass_verify").modal('show');

			$(".btn2").click(function(){
            $("#chef_pass_verify").modal('hide');
        	});
	   })
	})

  profile = document.getElementsByClassName('Chefs_profile_click');
    Array.from(profile).forEach((element) => {
      element.addEventListener("click", (e) => {
        $("#profile_modal").modal('show');

			  $(".btn2").click(function(){
            $("#profile_modal").modal('hide');
        });
      })
    })

  logout = document.getElementsByClassName('Chefs_logout_click');
    Array.from(logout).forEach((element) => {
      element.addEventListener("click", (e) => {
        $("#logout_modal").modal('show');

			  $(".btn2").click(function(){
            $("#logout_modal").modal('hide');
        });
      })
    })


// Button for navigate to top.
// When the user scrolls down 20px from the top of the document, show the button.
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