<?php
session_start();
if(isset($_SESSION['employer']) && $_SESSION['employer']==true){

}
else{
  header("location: emp_dec.php");
}
$user_name_exist = 0;
$update_profile_success = false;
$update_profile_error = False;
$current_pass_match_error = false;
$New_pass_check_pass = false;

if(isset($_POST['save_info_changes'])){
                
  require 'partials/db_connect.php';
  // get the form data
  $f_name_new = $_POST['f_n_new'];
  $last_name_new = $_POST['l_n_new'];
  $user_name_new = $_POST['user_name_new'];
  $email_new = $_POST['new_e_mail'];
  $contact_new = $_POST['new_contactno'];
  $id_of_user = $_POST['update_id'];
      if($_SESSION['username_emp'] == $user_name_new){
        $sql_update_profile = "UPDATE `staff` SET `first_name` = '$f_name_new', `Last_Name` = '$last_name_new', `e_mail` = ' $email_new', `contact_no` = '$contact_new' WHERE `staff`.`serial_no` = '$id_of_user';";
            if ($conn->query($sql_update_profile) === TRUE) {
                  $update_profile_success = True;
            } else {
                  $update_profile_error = True;
            }
            $conn->close();
      }
      else{
        // Check whether the new user name exists already or not.
        $new_username = "SELECT * FROM `staff` WHERE username = '$user_name_new'";
                  $result_rows_exist = mysqli_query($conn, $new_username);
                  $num_of_ExistRows = mysqli_num_rows($result_rows_exist);
                    if($num_of_ExistRows == 0){
                      $sql_update_profile = "UPDATE `staff` SET `first_name` = '$f_name_new', `Last_Name` = '$last_name_new', `username` = '$user_name_new', `e_mail` = ' $email_new', `contact_no` = '$contact_new' WHERE `staff`.`serial_no` = '$id_of_user';";
                      if ($conn->query($sql_update_profile) === TRUE) {
                            if (isset($_SESSION['username_emp'])) {
                                  session_unset();
                                  session_destroy();
                                    $update_profile_success = True;
                                    $SQL_Re_create_session_by_post = "SELECT * FROM `staff` WHERE username = '$user_name_new'";
                                    $run_query = mysqli_query($conn, $SQL_Re_create_session_by_post);
                                    $fetched_no_of_rows = mysqli_num_rows($run_query);
                                    $fetched_data_by_new_username = mysqli_fetch_assoc($run_query);
                                        if($fetched_no_of_rows == 1){
                                                        if($fetched_data_by_new_username['post'] == "Admin"){
                                                                session_start();
                                                                $_SESSION['employer'] = true;
                                                                $_SESSION['loggedin_admin'] = true;
                                                                $_SESSION['username_emp'] = $user_name_new;
                                                        }
                                                        elseif($fetched_data_by_new_username['post'] == "Manager"){
                                                                session_start();
                                                                $_SESSION['employer'] = true;
                                                                $_SESSION['loggedin_manager'] = true;
                                                                $_SESSION['username_emp'] = $user_name_new;
                                                        }
                                                        elseif($fetched_data_by_new_username['post'] == "Head Chef"){
                                                                session_start();
                                                                $_SESSION['employer'] = true;
                                                                $_SESSION['loggedin_Head_Chef'] = true;
                                                                $_SESSION['username_emp'] =$user_name_new;
                                                        }
                                                        elseif($fetched_data_by_new_username['post'] == "Chef"){
                                                                session_start();
                                                                $_SESSION['employer'] = true;
                                                                $_SESSION['loggedin_Chef'] = true;
                                                                $_SESSION['username_emp'] =$user_name_new;
                                                        }
                                                        elseif($fetched_data_by_new_username['post'] == "Delivery Boy"){
                                                                session_start();
                                                                $_SESSION['employer'] = true;
                                                                $_SESSION['loggedin_delivery_boy'] = true;
                                                                $_SESSION['username_emp'] =$user_name_new;
                                                        }
                                                        else{
                                                                // nothing
                                                        }
                                        }
                                  
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
        $user_name_pass = $_SESSION['username_emp'];
          $sql_pass = "SELECT * FROM `staff` WHERE username = '$user_name_pass'";
          $result_rowexist = mysqli_query($conn, $sql_pass);
          $pass_change = mysqli_fetch_assoc($result_rowexist);
          $num_of_row_Exist = mysqli_num_rows($result_rowexist);
            if($num_of_row_Exist > 0){
                    if(password_verify($Current_pass,  $pass_change['password'])){
                          if($New_pass == $re_new_pass){
                                $new_pass_hash = password_hash($New_pass, PASSWORD_DEFAULT);
                                $sql_update_pass = "UPDATE `staff` SET `password` = '$new_pass_hash' WHERE `staff`.`serial_no` = '$serial_pass';";
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
  <title>DineOut/Emp/Profile</title>
  </head>
  <body>
  <button type="button" class="back-css-class" data-bs-toggle="tooltip" data-bs-placement="left" title="Back" ><i class="fa fa-arrow-left"></i></button>
<?php
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
$current_user =  $_SESSION['username_emp'];
$Sql_profile = "SELECT * FROM `staff` WHERE username = '$current_user'";
$profile_result = mysqli_query($conn, $Sql_profile);
$row_emp = mysqli_fetch_assoc($profile_result);
// print_r($row_user);
$Post_value = $row_emp['post'];
$Post_special = $row_emp['Speciality'];
echo "
  <div class='row'>
            <div class='col' style = 'border-right: 3px solid black;'>
            <h4><b><label for='exampleInputEmail1' class='form-label'>Account setting</label></b></h4>
              <form action='emp_profile.php' method = 'post'>
              <div class='row'>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>First name</label>
              <input type='text' class='form-control' maxlength = '30' required name = 'f_n_new' value = ".$row_emp['first_name']." onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
              </div>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>Last name</label>
              <input type='text' class='form-control' maxlength = '30' required name = 'l_n_new' value = ".$row_emp['Last_Name']." onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
              </div>
              </div>

              <div class='row'>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>Username</label>
              <input type='text' class='form-control' maxlength = '30' required name = 'user_name_new' value = ".$row_emp['username']." >";
              if($user_name_exist == 1){
                echo "<label for='exampleInputEmail1' class='form-label alert_label'>Username Already exists try with another one.</label>"; 
              }
              echo "</div>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>Post</label>
              <input type='text' class='form-control' readonly id ='back_btn_by_post' value='$Post_value'>
              </div>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>Status</label>
              <input type='text' class='form-control' readonly value = ".$row_emp['Status']." >
              </div>
              </div>

              <div class = 'row'>
              <div class='col' style = 'margin-top:10px;'>
              <label for='exampleInputEmail1' class='form-label'>E-mail</label>
              <input type='email' class='form-control' required name = 'new_e_mail' value = ".$row_emp['e_mail'].">
              </div>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>Speciality</label>
              <input type='text' class='form-control' readonly value ='$Post_special'>
              </div>
              </div>

              <div class='row'>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>Contact No.</label>
              <input type = 'text' required minlenght='11' placeholder='Contact No' class='form-control' name ='new_contactno' value =".$row_emp['contact_no'].">
              </div>
              <div class='col'>
              <label for='exampleInputEmail1' class='form-label'>Joining Date</label>
              <input type='text' class='form-control' readonly value = ".$row_emp['Date_of_join']." >
              </div>
              </div>

              <div class='row'>
              <div class='col'>
              <button type='submit' class='btn btn-primary sign_up_btn' name='save_info_changes'>Save Changes</button>
              <input type ='number' style = 'display:none;' readonly class='form-control' name ='update_id' value = ".$row_emp['serial_no']." required >
              </div>
              </div>            
            </form>
            </div>

            

            <div class='col'>
            <h4><b><label for='exampleInputEmail1' class='form-label'>Password</label></b></h4>
                <form action='emp_profile.php' method = 'post'>
            <div class='mb-4'>
                <input type='password' class='form-control' name = 'current_pass' placeholder = 'Current password' minlength='8' required><br>";
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
            <input type ='number' style = 'display:none;' class='form-control' name ='update_pass_id' value = ".$row_emp['serial_no']." required >
            <button type='submit' name = 'Change_pass_user' class='btn btn-primary sign_up_btn'>Save new password</button>
            </form>
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
  
  Back = document.getElementsByClassName('back-css-class');
    Array.from(Back).forEach((element) => {
      element.addEventListener("click", (e) => {
        let back = document.getElementById('back_btn_by_post').value;
        // console.log(back);
        if(back == "Admin"){
            window.location.href = '/fyp/admin_home.php';
        }
        else if(back == "Manager"){
            window.location.href = '/fyp/manager_home.php';
        }
        else if(back == "Head Chef"){
            window.location.href = '/fyp/head_chef_home.php';
        }
        else if(back == "Chef"){
            window.location.href = '/fyp/chefs_interface.php';
        }
        else if(back == "Delivery Boy"){
            window.location.href = '/fyp/delivery_boy.php';
        }
        else{
            // nothing
        }
      })
    })
</script>   
  </body>
</html>