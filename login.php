<?php
$showError = false;
$usenotfound = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require 'partials/db_connect.php';
    $user_name = $_POST["user_name"];
    $pass_word = $_POST["pass_word"]; 
    $sql = "Select * from users where user_name='$user_name'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($pass_word, $row['pass_word'])){ 
                session_start();
                $_SESSION['loggedin_user'] = true;
                $_SESSION['customer'] = true;
                $_SESSION['username_user'] = $user_name;
                header("location: home.php");
            } 
            else{
                $showError = True;
            }
        }
        
    } 
    else{
        $usenotfound = true;
    }
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
    <title>DineOut/login</title>
  </head>
  <body>
    <div class="container padd_login">
        <div class="hold">
                <form action="login.php" method = "post">
                <?php
                if($showError){
                echo "
                <label for='exampleInputEmail1' class='form-label alert_label'>Invalid Credentials! Please try again.</label>";
                }
                if($usenotfound){
                    echo "
                    <label for='exampleInputEmail1' class='form-label alert_label'>User not found! Please try again.</label>";
                    }
                ?>
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" id="un" name = "user_name" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="pw" name = "pass_word" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">I am not a robot.</label>
            </div>
            <button type="submit" class="btn btn-primary btn_login ">Login</button>
            <a href="sign_up.php">Sign up now</a>
            </form>
        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>