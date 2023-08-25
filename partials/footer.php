<?php
if(isset($_POST['report-issue'])){
  require 'db_connect.php'; 
  $describe = $_POST['description'];
  $email = $_POST['email'];
  // Insertion query
  $sql = "INSERT INTO `reported-issues` (`Description-report`, `Adress-mail`, `Date`) VALUES ('$describe', '$email', current_timestamp());";
  // check the inserted query and print msg acordingly.
  if ($conn->query($sql) === TRUE) {
    header("location: /fyp/home.php");
  } else {
    //   nothig
  }
  $conn->close();
}
?>
<footer>
        <div class="row">
            <div class="col">
                <h2>DineOut</h2>
                <p>Our first priority is that to satisfy the customer.If you face any issue with our staff or web-site then report us, And feel free its the pleasure for us.</p>
            </div>

            <div class="col">
                    <h2>Links</h2>
                    <ul>
                        <li><a href="home.php" target="_self"><i class="fa fa-house"></i> Home</a></li>
                        <li><a href="About_us.php" target="_self"><i class="fa fa-address-card"></i> About-Us</a></li>
                        <li><a href="contact_us.php" target="_self"><i class="fa fa-phone"></i> Contact-us</a></li>
                        <li><a href="Privacy.php" target="_self"><i class="fa fa-lock"></i> Privacy Policy</a></li>
                    </ul>
            </div>

            <div class="col">
                <h2>Follow us</h2>
                <ul>
                    <li><p><i class="fab fa-facebook"></i> dineout1001</p></li>
                    <li><p><i class="fab fa-twitter"></i> @dineout133</p></li>
                    <li><p><i class="far fa-envelope"></i> dineout123@gmail.com</p></li>
                    <li><p><i class="fa-brands fa-whatsapp"></i> +92 311 9686101</p></li>
                </ul>
            </div>

            <div class="col">
                    <h2>Report Issues</h2>
                    <form action="/fyp/partials/footer.php" method="post">
                        <textarea rows = "5" cols = "25" name = "description" required placeholder="Write here report!"></textarea><br>
                        <i class="far fa-envelope"></i>
                        <input type="email" id="mail" name="email" placeholder="Enter Email" required >
                        <button type="submit"name="report-issue"><i class="fa fa-arrow-right"></i></button>
                  </form>
            </div>
            <hr class="horizontal-Line">
            <h6>Support: dineout@mukdi.com</h6>
        </div>
    </footer>