<?php
session_start();
if(isset($_SESSION['loggedin_user']) && $_SESSION['loggedin_user']==true){

}
else{
  header("location: login.php");
}
$user_name_exist = 0;
$update_profile_success = false;
$update_profile_error = False;
$current_pass_match_error = false;
$New_pass_check_pass = false;

if(isset($_POST['serial_of_user_profile'])){
    require 'partials/db_connect.php';
    $id_of_user_row = $_POST['serial_of_user_profile'];
    $sql_del_user = "DELETE FROM `users` WHERE `users`.`user_id` = '$id_of_user_row';";
      if ($conn->query($sql_del_user) === TRUE) {
        session_unset();
        session_destroy();  
        header("location: /FYP/customer.php");
        exit;
      }
      else {
          // Error
      }
    $conn->close();
}

if(isset($_POST['save_info_changes'])){
                
  require 'partials/db_connect.php';
  // get the form data
  $f_name_new = $_POST['f_n_new'];
  $last_name_new = $_POST['l_n_new'];
  $user_name_new = $_POST['user_name_new'];
  $email_new = $_POST['new_e_mail'];
  $addres_new = $_POST['new_address'];
  $id_of_user = $_POST['update_id'];
      if($_SESSION['username_user'] == $user_name_new){
        $sql_update_profile = "UPDATE `users` SET `first_name` = '$f_name_new', `last_name` = '$last_name_new', `e_mail` = ' $email_new', `add_ress` = '$addres_new' WHERE `users`.`user_id` = '$id_of_user';";
            if ($conn->query($sql_update_profile) === TRUE) {
                  $update_profile_success = True;
            } else {
                  $update_profile_error = True;
            }
            $conn->close();
      }
      else{
        // Check whether the new user name exists already or not.
        $new_username = "SELECT * FROM `users` WHERE user_name = '$user_name_new'";
                  $result_rows_exist = mysqli_query($conn, $new_username);
                  $num_of_ExistRows = mysqli_num_rows($result_rows_exist);
                    if($num_of_ExistRows == 0){
                      $sql_update_profile = "UPDATE `users` SET `first_name` = '$f_name_new', `last_name` = '$last_name_new', `user_name` = '$user_name_new', `e_mail` = ' $email_new', `add_ress` = '$addres_new' WHERE `users`.`user_id` = '$id_of_user';";
                      if ($conn->query($sql_update_profile) === TRUE) {
                            if (isset($_SESSION['username_user'])) {
                                  session_unset();
                                  session_destroy();
                                  
                                  session_start();
                                  $_SESSION['loggedin_user'] = true;
                                  $_SESSION['customer'] = true;
                                  $_SESSION['username_user'] = $user_name_new;
                                  $update_profile_success = True;
                            }
                      }
                      else {
                          $update_profile_error = True;
                      }
                      $conn->close();
                    }
                    else{
                      $user_name_exist = 1;
                      $conn->close();
                    }
      }
}
if  (isset($_POST['Change_pass_user'])){
        require 'partials/db_connect.php';
        $Current_pass = $_POST['current_pass'];
        $New_pass = $_POST['new_pass_user'];
        $re_new_pass = $_POST['re_new_pass'];
        $serial_pass = $_POST['update_pass_id'];
        $user_name_pass = $_SESSION['username_user'];
          $sql_pass = "SELECT * FROM `users` WHERE user_name = '$user_name_pass'";
          $result_rowexist = mysqli_query($conn, $sql_pass);
          $pass_change = mysqli_fetch_assoc($result_rowexist);
          $num_of_row_Exist = mysqli_num_rows($result_rowexist);
            if($num_of_row_Exist > 0){
                    if(password_verify($Current_pass,  $pass_change['pass_word'])){
                          if($New_pass == $re_new_pass){
                                $new_pass_hash = password_hash($New_pass, PASSWORD_DEFAULT);
                                $sql_update_pass = "UPDATE `users` SET `pass_word` = '$new_pass_hash' WHERE `users`.`user_id` = '$serial_pass';";
                                if ($conn->query( $sql_update_pass) === TRUE) {
                                  $update_profile_success = True;
                                }
                                else{
                                  $update_profile_error = True;
                                }
                          }
                          else{
                              $New_pass_check_pass = true;
                          }
                    }
                    else{
                      $current_pass_match_error = true;
                    }

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
    <link rel="stylesheet" href="style/design.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6f3c4e01cb.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/Icon.png" type="image/png">
    <title>DineOut/Profile</title>
  </head>
  <body>
  <?php require 'partials/nav_bar.php';
echo "<div class='container mt-4'>
<h4><b>Profile Info</b></h4>";
if($update_profile_success){
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your changes has been updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
if($update_profile_error){
  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Error!</strong> Changes has not been updated due to internal server error.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
echo"<hr>";

require 'partials/db_connect.php';
$current_user = $_SESSION['username_user'];
$Sql_profile = "SELECT * FROM `users` WHERE user_name = '$current_user'";
$profile_result = mysqli_query($conn, $Sql_profile);
$row_user = mysqli_fetch_assoc($profile_result);
// print_r($row_user);
echo "
  <div class='row'>
            <div class='col' style = 'border-right: 3px solid black;'>
            <h4><b><label for='exampleInputEmail1' class='form-label'>Account setting</label></b></h4>
              <form action='profile.php' method = 'post'>
              <div class='row'>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>First name</label>
              <input type='text' class='form-control' maxlength = '50' required name = 'f_n_new' value = ".$row_user['first_name']." onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
              </div>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>Last name</label>
              <input type='text' class='form-control' maxlength = '50' required name = 'l_n_new' value = ".$row_user['last_name']." onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
              </div>
              </div>

              <div class='row'>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>Username</label>
              <input type='text' class='form-control' maxlength = '50' required name = 'user_name_new' value = ".$row_user['user_name']." >";
              if($user_name_exist == 1){
                echo "<label for='exampleInputEmail1' class='form-label alert_label'>Username Already exists try with another one.</label>"; 
              }
              
              
              echo "</div>
              </div>

              <div class = 'row'>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>E-mail</label>
              <input type='email' class='form-control' required name = 'new_e_mail' value = ".$row_user['e_mail'].">
              </div>
              </div>

              <div class='row'>
              <div class='col'>
              <textarea rows = '2' cols = '25' required placeholder='Address' class='form-control' name ='new_address' >".$row_user['add_ress']."</textarea>
              </div>
              </div>

              <div class='row'>
              <div class='col'>
              <button type='submit' class='btn btn-primary sign_up_btn' name = 'save_info_changes' >Save Changes</button>
              <input type ='number' style = 'display:none;' class='form-control' name ='update_id' value = ".$row_user['user_id']." required >
              </div>
              </div>            
            </form>
            </div>

            

            <div class='col'>
            <h4><b><label for='exampleInputEmail1' class='form-label'>Password</label></b></h4>
                <form action='profile.php' method = 'post'>
            <div class='mb-4'>
                <input type='password' class='form-control' name = 'current_pass' placeholder = 'Current password' required><br>";
                if($current_pass_match_error){
                  echo "<label for='exampleInputEmail1' class='form-label alert_label'><b>Wrong password!</b> and please enter correct password.</label>"; 
                }
                echo "<input type='password' class='form-control' name = 'new_pass_user' placeholder = 'New password' required  minlength='8'><br>";
                if($New_pass_check_pass){
                  echo "<label for='exampleInputEmail1' class='form-label alert_label'>Both passwords must be same.</label>"; 
                }
                echo "<input type='password' class='form-control' name = 're_new_pass' placeholder = 'Re-enter new password' required  minlength='8'>";
                if($New_pass_check_pass){
                  echo "<label for='exampleInputEmail1' class='form-label alert_label'>Both passwords must be same.</label>"; 
                }
            echo "</div>
            <input type ='number' style = 'display:none;' class='form-control' name ='update_pass_id' value = ".$row_user['user_id']." required >
            <button type='submit' name = 'Change_pass_user' class='btn btn-primary sign_up_btn'>Save new password</button>
            </form>
            </div>
            
            <form id='Delete_user_profile_form' action='profile.php' method='POST' style='display:none;'>
			            <input type='number' name='serial_of_user_profile'  value = ".$row_user['user_id']." required >
            </form>";
            $conn->close();    
            
?>      
   </div>
   <button type="button" class="btn btn-danger delete_profile" style = float:right;><i class="fa-solid fa-user"></i> Delete Profile</button>
</div>
<script>
  
  delete_profile_user = document.getElementsByClassName('delete_profile');
    Array.from(delete_profile_user).forEach((element) => {
      element.addEventListener("click", (e) => {
        if (confirm("Are you sure you want to delete your Profile!")) {	
			      // console.log("yes");
			      let form = document.getElementById("Delete_user_profile_form");
            form.submit();
        }
        else {
            // console.log("no");
        }
      })
    })
</script>   
  </body>
</html>