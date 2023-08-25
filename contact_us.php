<?php
session_start();
$success = false;
$err = false;
if (isset($_POST['contact-info'])){
    require 'partials/db_connect.php';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['e-mail'];
    $city = $_POST['city'];
    $desc = $_POST['desc'];
    
    $sql = "INSERT INTO `contacttbl`(`First Name`, `Last Name`, `E-Mail`, `City Name`, `Description`, `Date`) VALUES ('$fname', '$lname', '$email', '$city', '$desc', current_timestamp());";
    
    if ($conn->query($sql) === TRUE) {
        $success = true;
    } else {
        $err = true;
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

    <title>DineOut/Contact_Us</title>
  </head>
  <body>
  <?php require 'partials/nav_bar.php'; ?>

    <div class="slide-container">

            <div class="slide">
                <img src="images/img1.jpg" alt="Image">
                <div class="caption">Interior.</div>
            </div>

            <div class="slide">
                <img src="images/img2.jpg" alt="Image">
                <div class="caption">Pizza with cheese.</div>
            </div>

            <div class="slide">
                <img src="images/img3.jfif" alt="Image">
                <div class="caption">Please visit and try it.</div>
            </div>

            <div class="slide">
                <img src="images/img4.jpg" alt="Image" >
                <div class="caption">Burger with Cheese and Finger chips</div>
            </div>

            <span class="arrow left" onclick="Controller (-1)">&larr;</span>
            <span class="arrow right" onclick="Controller (1)">&rarr;</span>
    </div>


<?php
    if($success){
        echo "<div class='alertS'>
        <span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
        <strong>Success!</strong> Your data inserted successfully.
    </div>";
    }
    if($err){
        echo "<div class='alertE'>
        <span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
        <strong>Error!</strong> Internal server error.
    </div>";
    }
?>


    <div style = "width: 100%; height: 70px; background-color: white; text-align: center; font-weight: bold;  padding-top: 10px;">
          <h1>Contact_Us</h1>
          <p>Leave a message for us and connect with us:</p>
        </div>


    
    <div class="container_contact">
        
            <div class="content1">
                    <img src="images/contactimg.png" alt="location picture">
            </div>
            
            
            <div class="content2" style = "margin-bottom:70px;">
                    <form action="contact_us.php" method="post">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" maxlength="30" placeholder="Your name.." required onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" maxlength="30" placeholder="Your last name.." required onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
                        <label for="email">E-Mail</label>
                        <input type="email" id="email" name="e-mail" placeholder="E-Mail" required>
                        <label for="city">City</label>
                        <input type="text" id="City" name="city" maxlength="30" placeholder="Enter city name.." required required onkeypress='return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)'>
                        <label for="subject">Subject</label>
                        <textarea id="subject" name="desc" placeholder="Write something.." style="height:170px" required></textarea>
                        <button type="submit" value="Submit" name="contact-info" >Submit</button>
                    </form>
            </div>
    </div>



<?php require 'partials/footer.php'; ?>
    

    <!-- Button At the bottom to navigate at top: -->
    <button onclick="topFunction()" id="top_button"><i class="fa-solid fa-arrow-up"></i></button>



    
<script src="style/function.js"></script>
  </body>
</html>