<?php
session_start();
if(isset($_POST['category_selected'])){
  $category = $_POST['category_selected'];
  $_SESSION['category'] = $category;
}

if(isset($_SESSION['category'])){

}
else{
  header("location: home.php");
}

if(isset($_POST['submit_quantity'])){
      if(isset($_SESSION['loggedin_user']) && $_SESSION['loggedin_user']==true){
          require 'partials/db_connect.php';
          // get the form data 
          $subtotal = 0;
          $Inventory_item_serial = $_POST['inventory_item_id'];
          $Quantity = $_POST['quantity_cart_item'];
          // print_r($Inventory_item_serial);
          // print_r($Quantity);
          $sql = 'SELECT * FROM `inventory_items`';
						$resul_t = mysqli_query($conn, $sql);
          				while($row_f = mysqli_fetch_assoc($resul_t))
					        {
                        if($row_f['Serial_no']==$Inventory_item_serial){
                          $Image = $row_f['Image'];
                          $Dish_type = $row_f['Dish_Type'];
                          $Dish_name = $row_f['Dish_Name'];
                          $Dish_price = $row_f['Price'];
                          $subtotal = $row_f['Price']*$Quantity;
                          $user_name = $_SESSION['username_user'];

                          $sql_order = "INSERT INTO `orders_in_process` (`username`, `image`, `dish_type`, `dish`, `price`, `quantity`, `subtotal`) VALUES ('$user_name', '$Image', '$Dish_type', '$Dish_name', '$Dish_price', '$Quantity', ' $subtotal');";
                             if ($conn->query($sql_order) === TRUE) {
                              header("location: cart_items.php");
                              }
                              else{
                              // echo "false";
                              }
                              break;
                        }
                  }

          $conn->close(); 
      }
      else{
          header("location: login.php");
      }
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
    <title>DineOut/Home</title>
  </head>
  <body>
  <?php require 'partials/nav_bar.php'; ?>

    <div class="slide-container">

            <div class="slide">
                <img src="images/poboy.jpg" alt="Image">
                <div class="caption">Crispy Burger!</div>
            </div>

            <div class="slide">
                <img src="images/hmbrger.jpg" alt="Image">
                <div class="caption">Zinger berger and Finger's.</div>
            </div>

            <div class="slide">
                <img src="images/mldessert.jpeg" alt="Image">
                <div class="caption">Our special Dessert's item and you should must try it.</div>
            </div>

            <div class="slide">
                <img src="images/turkey-fajitas.jpg" alt="Image" >
                <div class="caption">Special paratha roll!</div>
            </div>
    </div>
<!-- Body Content -->


<div class="container" style = "margin-bottom:20px;">
<div class = "decide_cart">Put items in your cart!</div>
<div class="cards">
<?php
      if(isset($_SESSION['category'])){
            require 'partials/db_connect.php';
						$sql = 'SELECT * FROM `inventory_items`';
						$result = mysqli_query($conn, $sql);
          				while($row = mysqli_fetch_assoc($result))
					{
            $item_id = $row['Serial_no'];
            if($row['category']==$_SESSION['category'])
            {
              echo "<div class='card home_cards' style='width: 18rem;'>
                    <img src=".$row['Image']." class='card-img-top' alt='img' style ='height:200px;'>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>".$row['Dish_Name']."</h5>
                        <p>
                        <h5>Rs.".$row['Price']."</h5> 
                        </p>
                        <input type='number' class='form-control id_of_item' value = '$item_id' style = 'display:none;'>
                        <button type='submit' class=' nav-link btn btn-success add_to_cart_by_click' >Add to Cart<i class='fa-solid fa-cart-arrow-down' style = 'margin-left: 20px;'></i></button>
                    </div>
                    </div>";
            }
          }
            $conn->close();
      }
?>
</div>
</div>
</div>

<?php require 'partials/footer.php'; ?>  
<!-- Button At the bottom to navigate at top: -->
<button onclick="topFunction()" id="top_button"><i class="fa-solid fa-arrow-up"></i></button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Please choose the Quantity of specific deal.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align:center;">
      <form action="customer.php" method="post">
          <input type="number" class="form-control" id="inventory_item_serial" name="inventory_item_id" required style="display:none;"/>
          <input type="number" class="form-control" value = "1" name = "quantity_cart_item" min="1" max="50" required />
      </div>
      <div class="modal-footer">
      <button type="submit" name = "submit_quantity" class="btn btn-success">Add to Cart</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </form> 
      </div>
    </div>
  </div>
</div>

<script src="style/function.js"></script>
<script>
  Get_item_id = document.getElementsByClassName('add_to_cart_by_click');
     Array.from(Get_item_id).forEach((element) => {
       element.addEventListener("click", (e) => {
        tr = e.target.parentNode;
			  var serial_no = tr.getElementsByTagName("input")[0].value;
        // console.log(serial_no);
        inventory_item_serial.value = serial_no;
        $("#staticBackdrop").modal('show');

	   })
	})
  </script>

  </body>
</html>





