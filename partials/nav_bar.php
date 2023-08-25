<?php 
    if(isset($_SESSION['loggedin_user']) && $_SESSION['loggedin_user']==true){
        $loggedin= true;
      }
      else{
        $loggedin = false;
      }
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <div class="container-fluid">
    <a class="navbar-brand" href="customer.php"style="font-size: 30px; color:orange;"><i class="fa-solid fa-spoon" style="margin-right:20px; margin-left:20px;"> DineOut</i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav nav justify-content-end">
         <li class="nav-item">
          <a class="nav-link active nav_hover" aria-current="page" href="home.php">Home</a>
        </li>
        
     
<?php
if(!$loggedin){
    echo '<li class="nav-item">
        <a class="nav-link active nav_hover" href="sign_up.php">Sign up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active nav_hover" href="login.php">Login</a>
        </li>';
}
?>
<?php
    if($loggedin){
        echo '<li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle nav_hover" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i> ';
          echo $_SESSION['username_user'];
        echo '</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item nav_hover" href="profile.php"><i class="fa-solid fa-user"></i> Profile</a></li>
            <li><a class="dropdown-item nav_hover" href="cart_preview.php"><i class="fa-solid fa-arrow-down-short-wide"></i> Orders</a> </li>
            <li><a class="dropdown-item nav_hover" href="/fyp/partials/logout.php"><i class="fa-solid fa-power-off"></i> Logout</a></li>
          </ul>
        </li>';
    }
    ?>
        <li><a class="nav-link active nav_hover" href="contact_us.php">Contact us</a></li>
        <li><a class="nav-link active nav_hover" href="About_us.php">About us</a></li>
        <li><a class="nav-link active nav_hover" href="Privacy.php">Privacy policy</a></li>
    <?php
        if($loggedin){
       echo '<li class="nav-item">
          <a class="nav-link active nav_hover" href="cart_items.php">My Cart<i class="fa-solid fa-cart-arrow-down cart_color" style = "margin-left: 2px;"></i></a>
        </li>';
    }
    else{
       echo '<li class="nav-item">
          <a class="nav-link disabled nav_hover" href="cart_items.php">My Cart<i class="fa-solid fa-cart-arrow-down cart_color" style = "margin-left: 2px;"></i></a>
        </li>';
    }
?>
        </ul>
    </div>
  </div>
</nav>