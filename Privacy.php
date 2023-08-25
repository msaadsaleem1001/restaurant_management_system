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
    <title>DineOut/Privacy</title>
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


    
    <div class = "privacy">
        <h2>Our privacy policy</h2>
        <br><br>
        <p>When you visit the Site, we automatically collect certain information about your device, including information about your web browser, IP address, time zone, and some of the cookies that are installed on your device. Additionally, as you browse the Site, we collect information about the individual web pages or products that you view, what websites or search terms referred you to the Site, and information about how you interact with the Site. We refer to this automatically-collected information as "Device Information".

            We collect Device Information using the following technologies:
            
            "Cookies" are data files that are placed on your device or computer and often include an anonymous unique identifier. For more information about cookies, and how to disable cookies, visit http://www.allaboutcookies.org.
            "Log files", and User Accounts, track actions occurring on the Site, and collect data including your IP address, browser type, Internet service provider, referring/exit pages, and date/time stamps.
            "Web beacons", "tags", and "pixels" are electronic files used to record information about how you browse the Site.
            Additionally when you make a purchase or attempt to make a purchase through the Site, we collect certain information from you, including your name, billing address, shipping address, payment information (including credit card numbers, email address, and phone number. We refer to this information as "Order Information".</p>
            <br><br>
        <h2>Personal user information</h2>
        <br><br>
        <p> When we talk about "Personal Information" in this Privacy Policy, we are talking both about Device Information and Order Information.
            
            How do we use your personal information?
            
            We use the Order Information that we collect generally to fulfill any orders placed through the Site (including processing your payment information, arranging for shipping, and providing you with invoices and/or order confirmations). Additionally, we use this Order Information to:
            
            Communicate with you;
            Screen our orders for potential risk or fraud; and
            When in line with the preferences you have shared with us, provide you with information or advertising relating to our products or services.
            We use the Device Information that we collect to help us screen for potential risk and fraud (in particular, your IP address), and more generally to improve and optimize our Site (for example, by generating analytics about how our customers browse and interact with the Site, and to assess the success of our marketing and advertising campaigns).
            
            We use your account information that we collect generally to generate statistics for you, and provide personalized roadmaps. Additionally, we use this information to:
            
            Communicate with you;
            When in line with the preferences you have shared with us, provide you with information or advertising relating to our products or services.</p>
        </div>



<?php require 'partials/footer.php'; ?>
    

    <!-- Button At the bottom to navigate at top: -->
    <button onclick="topFunction()" id="top_button"><i class="fa-solid fa-arrow-up"></i></button>



    
<script src="style/function.js"></script>
  </body>
</html>