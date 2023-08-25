<?php
$error_toast = false;
if(isset($_POST['submit_employ_login'])){
    require 'partials/db_connect.php';
    $user_name_emp = $_POST["user_name_employ"];
    $pass_word_emp = $_POST["password_employ"]; 
    $sql_emp = "Select * from staff where username='$user_name_emp'";
    $result_of_sql = mysqli_query($conn, $sql_emp);
    $num_of_rows = mysqli_num_rows($result_of_sql);
    if ($num_of_rows == 1){
        while($row_user = mysqli_fetch_assoc($result_of_sql)){
            if (password_verify($pass_word_emp, $row_user['password'])){
              $current_emp_id = $row_user['serial_no'];
              $sql_status = "UPDATE `staff` SET `Status` = 'Active' WHERE `staff`.`serial_no` = '$current_emp_id';";
                        if ($conn->query($sql_status) === TRUE) {
                                if($row_user['post'] == "Admin"){
                                      session_start();
                                      $_SESSION['employer'] = true;
                                      $_SESSION['loggedin_admin'] = true;
                                      $_SESSION['username_emp'] = $user_name_emp;
                                      header("location: admin_home.php");
                                }
                                elseif($row_user['post'] == "Manager"){
                                      session_start();
                                      $_SESSION['employer'] = true;
                                      $_SESSION['loggedin_manager'] = true;
                                      $_SESSION['username_emp'] = $user_name_emp;
                                      header("location: manager_home.php");
                                }
                                elseif($row_user['post'] == "Head Chef"){
                                      session_start();
                                      $_SESSION['employer'] = true;
                                      $_SESSION['loggedin_Head_Chef'] = true;
                                      $_SESSION['username_emp'] = $user_name_emp;
                                      header("location: head_chef_home.php");
                                }
                                elseif($row_user['post'] == "Chef"){
                                      session_start();
                                      $_SESSION['employer'] = true;
                                      $_SESSION['loggedin_Chef'] = true;
                                      header("location: chefs_interface.php");
                                }
                                elseif($row_user['post'] == "Delivery Boy"){
                                      session_start();
                                      $_SESSION['employer'] = true;
                                      $_SESSION['loggedin_delivery_boy'] = true;
                                      $_SESSION['username_emp'] = $user_name_emp;
                                      header("location: delivery_boy.php");
                                }
                                else{
                                      // nothing
                                }
                        } 
                        else {
                              // nothing
                        } 
            }
            else{
              $error_toast = true;
            }   
        } 
            
    }     
    else{
     $error_toast = true;
    }
$conn->close();
}

?> 
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="style/design.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6f3c4e01cb.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/Icon.png" type="image/png">
    <title>DineOut/Employ</title>
  </head>
  <body>
  <?php
  if($error_toast){
    echo "<div class='container' style = 'position:relative; display: flex; justify-content: center; align-items: center;'>
    <div style = 'position:absolute; top:40%; z-index:2000; width:300px; height:100px; position: fixed;'>
      <div class='toast-container row justify-content-center align-items-center'>
        <div class='toast fade show'>
            <div class='toast-header'>
                <strong class='me-auto' style = 'color:red;' ><i class='fa-solid fa-triangle-exclamation' style = 'color:red; font-size:20px;'></i> <b>Login Error!</b></strong>
                <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
            </div>
            <div class='toast-body' style = 'text-align:center;'>
                <b>Invalid Credentials!</b><br>
                Please make sure the correct username and password.
            </div>
        </div>
    </div>
    </div>
  </div>";
  }
  ?>
  <?php require 'partials/nav_bar.php'; ?>
    <div class="slide-container">

            <div class="slide">
                <img src="images/K1.jpg" alt="Image">
                <div class="caption">Kichen.</div>
            </div>

            <div class="slide">
                <img src="images/K2.jpg" alt="Image">
                <div class="caption">Working in Kichen.</div>
            </div>

            <div class="slide">
                <img src="images/K3.jpg" alt="Image">
                <div class="caption">Special Dish.</div>
            </div>

            <div class="slide">
                <img src="images/K4.jfif" alt="Image" >
                <div class="caption">Senior Chef</div>
            </div>
    </div>

    <h1 class="btn-group-text">Choose the employ inter-face!</h1>
    <div id="btn-group" style = "margin-bottom:50px;">
        <button class = "btn_group_button admin_modal_hidden"><a style = "text-decoration:none; color:white;">Administrator</a></button>
        <button class = "btn_group_button admin_modal_hidden"><a style = "text-decoration:none; color:white;">Manager</a></button>
        <button class = "btn_group_button admin_modal_hidden"><a style = "text-decoration:none; color:white;">Head Chef</a></button>
        <button class = "btn_group_button admin_modal_hidden"><a style = "text-decoration:none; color:white;">Chef</a></button>
        <button class = "btn_group_button admin_modal_hidden"><a style = "text-decoration:none; color:white;">Delievery Boy.</a></button>
      </div>

<?php require 'partials/footer.php'; ?>
    

    <!-- Button At the bottom to navigate at top: -->
    <button onclick="topFunction()" id="top_button"><i class="fa-solid fa-arrow-up"></i></button>


<!-- Modal -->
<div class="modal fade" id="admin_login_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><b>Login as an Employer</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="emp_dec.php" method = "post">
  <div class="mb-3">
    <input type="text" name = "user_name_employ" required placeholder = "Username" class="form-control" maxlength = "50" id="exampleInputEmail1" aria-describedby="emailHelp" style = margin-bottom:20px; >
  <div class="mb-3">
    <input type="password" name = "password_employ" required placeholder = "Password" maxlength = "50" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" required class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Confirm</label>
  </div>
</div>
      <div class="modal-footer">     
      <button type="submit" name = "submit_employ_login" class="btn btn-warning"><b>Login</b></button>
</form>  
    </div>
    </div>
  </div>
</div>

    
<script src="style/function.js"></script>
<script>
  admin_modal = document.getElementsByClassName('admin_modal_hidden');
     Array.from(admin_modal).forEach((element) => {
       element.addEventListener("click", (e) => {
        $("#admin_login_modal").modal('show');

	   })
	})
</script>
  </body>
</html>