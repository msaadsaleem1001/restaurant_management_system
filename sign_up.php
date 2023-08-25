<?php
    $showError_username = false;
    $showError_password = false;
    $showSuccess_alert = false;
    $showError_length_pass = false;

    if  (isset($_POST['sign_up_form'])){
                
      require 'partials/db_connect.php';
      // get the form data
      $f_name = $_POST['fname'];
      $last_name = $_POST['l_name'];
      $user_name = $_POST['user__name'];
      $pass_word = $_POST['Password_1'];
      $re_password = $_POST['Password_2'];
      $email = $_POST['E_mail'];
      $addres_ = $_POST['adress_user'];

       // Check whether this username exists
      $existSql = "SELECT * FROM `users` WHERE user_name = '$user_name'";
      $result = mysqli_query($conn, $existSql);
      $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            $showError_username = "Username Already Exists";
        }
        else{
          if(strlen($pass_word) >= 8){
            if(($pass_word == $re_password )){
                $hash = password_hash($pass_word, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`first_name`, `last_name`, `user_name`, `pass_word`, `e_mail`, `add_ress`) VALUES ('$f_name', '$last_name', '$user_name', '$hash', '$email', '$addres_');";
                $result = mysqli_query($conn, $sql);
                  if ($result){
                      $showSuccess_alert = true;
                   }
            }
            else{
                $showError_password= "Passwords do not match";
            }
          }
          else{
            $showError_length_pass = True;
          }
        }                 
    $conn->close();
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/design.css?v=<?php echo time(); ?>">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="icon" href="images/Icon.png" type="image/png">
    <title>DineOut/Sign up</title>
  </head>
  <body>
    <?php
    if($showSuccess_alert){
    echo "
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
						<strong>Success!</strong> Your account has been created successfully. To proceed as our <b>customer</b> please <b><a href='login.php' class = 'sign_up_login'>Click Here</a></b>
						<button type='button' onclick=\"this.parentElement.style.display='none';\" class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    ?>
  <div class="container mt-4 padd_sign">
        <div class="hold_s">
                <form action = "sign_up.php" method = "post">
                <h2>Create your Account</h2>
                <div class="row">
              <div class="col">
              <label for="exampleInputEmail1" class="form-label">First name</label>
              <input type="text" class="form-control" name ="fname" required maxlength="30" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
              </div>
              <div class="col">
              <label for="exampleInputEmail1" class="form-label">Last name</label>
              <input type="text" class="form-control" name = "l_name" required maxlength="30" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
              </div>
              </div>

              <div class="row">
              <div class="col">
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input type="text" class="form-control" name = "user__name" required  maxlength="30"/>
              <?php
              if($showError_username){
              echo "<label for='exampleInputEmail1' class='form-label alert_label'>Username already exists try another one.</label>"; 
              }
              ?>
              </div>
              </div>

              <div class="row">
              <div class="col">
              <label for="exampleInputEmail1" class="form-label">Password</label>
              <input type="password" class="form-control" id = "fpass" name = "Password_1" required minlength="8"/>
              <?php
              if($showError_length_pass){
                echo "<label for='exampleInputEmail1' class='form-label alert_label'>Password must be consist of 8 or more characters.</label>"; 
                }
              if($showError_password){
              echo "<label for='exampleInputEmail1' class='form-label alert_label'>Please enter the same password.</label>"; 
              }
              ?>
              </div>
              <div class="col">
              <label for="exampleInputEmail1" class="form-label">Re-enter-Password.</label>
              <input type="password" class="form-control" id = "rpass" name = "Password_2" required minlenght="8" />
              <label for='exampleInputEmail1' class='form-label alert_label_pass' id = "mlabel" >Matched.</label>
              </div>
              <div class="col">
              <label for="exampleInputEmail1" class="form-label">E-mail</label>
              <input type="email" class="form-control" name = "E_mail" required />
              </div>
              </div>

              <div class="row">
              <div class="col">
              <textarea rows = "2" cols = "25" name = "adress_user" placeholder="Address" class="form-control" required maxlength="250"></textarea>
              </div>
              </div>

              <div class="row">
              <div class="col">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" name = "Check_box" required>
                <label class="form-check-label" for="exampleCheck1">I am not a robot.</label>
              </div>
              </div>

              <div class="row">
              <div class="col">
              <button type="submit" class="btn btn-primary sign_up_btn" name = "sign_up_form">Sign up</button>
              </div>
              </div>            
            </form>
            <p>Already have account? <b><a href="login.php" class = "sign_up_login">Login</a></b></p>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>