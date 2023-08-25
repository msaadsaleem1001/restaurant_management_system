<?php
session_start();
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
    <title>DineOut/About_Us</title>
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


   

    <div class="about-section">
        <h1>About Us Page</h1>
        <p>We are inspired by the development of internet in a few previous years, So our restaurant already in running process on the offline platform. That's why we create our own Web-Site of Restaurant Management System (RMS) to target the audiance which is also inspired by internet, that aims to digitalize the day-to-day processes of various restaurant operations including ordering, billing, kitchen, hall and inventory management.
        </p>
      </div>
      
      <h2 style="text-align:center">Our Some Employee</h2>
      <div class="row">
        <div class="column">
          <div class="card">
            <img src="images/A1.jpg" alt="Admin" style="width:100%">
            <div class="container">
              <h2>Abd-ur-Rehman</h2>
              <p class="title">Administrator</p>
              <p>He has been with us for ten years!</p>
            </div>
          </div>
        </div>
      
        <div class="column">
            <div class="card">
              <img src="images/A2.jfif" alt="Waiter" style="width:100%">
              <div class="container">
                <h2>Muhammad Abad</h2>
                <p class="title">Senior Waiter</p>
                <p>He has been with us for Seven years!</p>
              </div>
            </div>
          </div>
      
          <div class="column">
            <div class="card">
              <img src="images/A3.jpg" alt="Waiter" style="width:100%">
              <div class="container">
                <h2>Muhammad Bilal</h2>
                <p class="title">Voice Senior Waiter</p>
                <p>He has been with us for 4 years!</p>
              </div>
            </div>
          </div>
      </div>



      <div class="row">
        <div class="column">
          <div class="card">
            <img src="images/A4.jfif" alt="Waiter" style="width:100%">
            <div class="container">
              <h2>Imran Jaleel</h2>
              <p class="title">Waiter</p>
              <p>He has been with us for 2 years!</p>
            </div>
          </div>
        </div>
      
        <div class="column">
            <div class="card">
              <img src="images/A5.jfif" alt="Waiter" style="width:100%">
              <div class="container">
                <h2>Faizan Sagheer</h2>
                <p class="title">Waiter</p>
                <p>He has been with us for 2 years!</p>
              </div>
            </div>
          </div>
      
          <div class="column">
            <div class="card">
              <img src="images/A6.jpg" alt="Waiter" style="width:100%">
              <div class="container">
                <h2>Nabeel</h2>
                <p class="title">Waiter</p>
                <p>He has been with us for 10 years!</p>
              </div>
            </div>
          </div>
      </div>


      <div class="row">
        <div class="column">
          <div class="card">
            <img src="images/A7.jfif" alt="Chef" style="width:100%">
            <div class="container">
              <h2>Ahsan-Mustafa</h2>
              <p class="title">Senior-Chef</p>
              <p>He has been with us for 12 years!</p>
            </div>
          </div>
        </div>
      
        <div class="column">
            <div class="card">
              <img src="images/A8.jpg" alt="Chef" style="width:100%">
              <div class="container">
                <h2>Group Picture</h2>
                <p class="title">Chefs</p>
                <p>They has been with us for 3 years!</p>
              </div>
            </div>
          </div>
      
          <div class="column">
            <div class="card">
              <img src="images/A9.jpg" alt="Chef" style="width:100%">
              <div class="container">
                <h2>Group Picture</h2>
                <p class="title">Chefs</p>
                <p>They has been with us for 1.2 years!</p>
              </div>
            </div>
          </div>
      </div>





<?php require 'partials/footer.php'; ?>
    

    <!-- Button At the bottom to navigate at top: -->
    <button onclick="topFunction()" id="top_button"><i class="fa-solid fa-arrow-up"></i></button>



    
<script src="style/function.js"></script>
  </body>
</html>