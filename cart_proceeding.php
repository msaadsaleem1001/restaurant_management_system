<?php
session_start();
if(isset($_SESSION['loggedin_user']) && $_SESSION['loggedin_user']==true){

}
else{
  header("location: login.php");
}
$cart_exists = 0;
$Din_e_here = "Dine Here and table no: ";
$space = ", ";
$Dishes_names = "";
$Dish_type = "";
$prices = "";
$quantities = "";
$subtotals = "";
$order_no ="#";
$grand_total = 0;

if  (isset($_POST['submit_confirm_order_dine_here'])){
  require 'partials/db_connect.php';
  $table_no = $_POST['table_no'];
  $D_names = $_POST['Dishes_name'];
  $D_prices = $_POST['prices'];
  $D_quantities = $_POST['quantities'];
  $D_subtotals = $_POST['subtotals'];
  $D_G_total = $_POST['G_total'];
  $D_type = $_POST['Dish_type'];
  $Dine_here = "Dine Here";
  $sql = 'SELECT * FROM `tbl_for_tables`';
  $resul_t = mysqli_query($conn, $sql);
        while($row_t = mysqli_fetch_assoc($resul_t)){
            if($row_t['table_no']== $table_no){
                  $serial = $row_t['Sr_no'];
                  $sql_u = "UPDATE `tbl_for_tables` SET `status_tbl` = 'Reserved' WHERE `tbl_for_tables`.`Sr_no` = '$serial';";
                  if ($conn->query($sql_u) === TRUE) {
                    $sql_order_no = "SELECT * FROM `confirm_orders` WHERE S_No=(SELECT MAX(S_No) FROM `confirm_orders`);";
                    $result_order_no = mysqli_query($conn, $sql_order_no);
                    $row_order_no =  mysqli_fetch_assoc($result_order_no);
                    if(isset($row_order_no['S_No'])){
                      $order_no .= $row_order_no['S_No']+1;
                    }
                    else{
                      $order_no .= 1;
                    }
                    $Din_e_here .= $table_no;
                    $user_info = $_SESSION['username_user'];
                    $sql_c = "INSERT INTO `confirm_orders` (`username`, `Dishes`, `prices`, `quantities`, `subtotals`, `grand_total`, `Date`, `Order_type`, `Status`, `Method`, `order_no`) VALUES ('$user_info', '$D_names', '$D_prices', '$D_quantities', '$D_subtotals', '$D_G_total', current_timestamp(), '$D_type', 'Pending', '$Din_e_here', '$order_no');";
                        if ($conn->query($sql_c) === TRUE) {
                                $sql_d = 'SELECT * FROM `orders_in_process`';
                                $result_d = mysqli_query($conn, $sql_d);
                                    while($del_cart = mysqli_fetch_assoc($result_d)){
                                        if($del_cart['username'] == $_SESSION['username_user']){
                                          $del_cart_item = $del_cart['S_No'];
                                          $sql_cart_empty = "DELETE FROM `orders_in_process` WHERE `orders_in_process`.`S_No` =  '$del_cart_item';";
                                          if($conn->query($sql_cart_empty) === True){
                                            // noting
                                          }
                                          else{
                                            // echo "Error";
                                          }
                                        }
                                    }
                                header("location: cart_preview.php");                                      
                        }
                        else{
                          // hello
                        }
                  }
                  else{
                    // can not
                  }
            }
        }
  $conn->close(); 
}





if  (isset($_POST['parcel_method_submit'])){
  require 'partials/db_connect.php';
  $sql_order_no = "SELECT * FROM `confirm_orders` WHERE S_No=(SELECT MAX(S_No) FROM `confirm_orders`);";
  $result_order_no = mysqli_query($conn, $sql_order_no);
  $row_order_no =  mysqli_fetch_assoc($result_order_no);
  if(isset($row_order_no['S_No'])){
    $order_no .= $row_order_no['S_No']+1;
  }
  else{
    $order_no .= 1;
  }
  $D_names = $_POST['Dishes_name'];
  $D_prices = $_POST['prices'];
  $D_quantities = $_POST['quantities'];
  $D_subtotals = $_POST['subtotals'];
  $D_G_total = $_POST['G_total'];
  $D_type = $_POST['Dish_type'];
  $Parcel = "Parcel";
  $user_info = $_SESSION['username_user'];
      $sql_c = "INSERT INTO `confirm_orders` (`username`, `Dishes`, `prices`, `quantities`, `subtotals`, `grand_total`, `Date`, `Order_type`, `Status`, `Method`, `order_no`) VALUES ('$user_info', '$D_names', '$D_prices', '$D_quantities', '$D_subtotals', '$D_G_total', current_timestamp(), '$D_type', 'Pending', '$Parcel', '$order_no');";
          if ($conn->query($sql_c) === TRUE) {
                      $sql_d = 'SELECT * FROM `orders_in_process`';
                      $result_d = mysqli_query($conn, $sql_d);
                            while($del_cart = mysqli_fetch_assoc($result_d)){
                                if($del_cart['username'] == $_SESSION['username_user']){
                                      $del_cart_item = $del_cart['S_No'];
                                      $sql_cart_empty = "DELETE FROM `orders_in_process` WHERE `orders_in_process`.`S_No` =  '$del_cart_item';";
                                          if($conn->query($sql_cart_empty) === True){
                                            // noting
                                          }
                                          else{
                                            // echo "Error";
                                          }
                                  }
                            }
              header("location: cart_preview.php");                                      
          }
  $conn->close(); 
}




if  (isset($_POST['submit_address'])){
  require 'partials/db_connect.php';
  $sql_order_no = "SELECT * FROM `confirm_orders` WHERE S_No=(SELECT MAX(S_No) FROM `confirm_orders`);";
  $result_order_no = mysqli_query($conn, $sql_order_no);
  $row_order_no =  mysqli_fetch_assoc($result_order_no);
  if(isset($row_order_no['S_No'])){
    $order_no .= $row_order_no['S_No']+1;
  }
  else{
    $order_no .= 1;
  }
  $Add_ress = $_POST['order_address'];
  $D_names = $_POST['Dishes_name'];
  $D_prices = $_POST['prices'];
  $D_quantities = $_POST['quantities'];
  $D_subtotals = $_POST['subtotals'];
  $D_G_total = $_POST['G_total']+100;
  $D_type = $_POST['Dish_type'];
  $home_delivery = "Home Delivery at: ".$Add_ress;
  $user_info = $_SESSION['username_user'];
  $D_subtotals .= "Home Delivery Charges: Rs.100";
      $sql_c = "INSERT INTO `confirm_orders` (`username`, `Dishes`, `prices`, `quantities`, `subtotals`, `grand_total`, `Date`, `Order_type`, `Status`, `Method`, `order_no`) VALUES ('$user_info', '$D_names', '$D_prices', '$D_quantities', '$D_subtotals', '$D_G_total', current_timestamp(), '$D_type', 'Pending', '$home_delivery', '$order_no');";
          if ($conn->query($sql_c) === TRUE) {
                      $sql_d = 'SELECT * FROM `orders_in_process`';
                      $result_d = mysqli_query($conn, $sql_d);
                            while($del_cart = mysqli_fetch_assoc($result_d)){
                                if($del_cart['username'] == $_SESSION['username_user']){
                                      $del_cart_item = $del_cart['S_No'];
                                      $sql_cart_empty = "DELETE FROM `orders_in_process` WHERE `orders_in_process`.`S_No` =  '$del_cart_item';";
                                          if($conn->query($sql_cart_empty) === True){
                                            // noting
                                          }
                                          else{
                                            // echo "Error";
                                          }
                                  }
                            }
              header("location: cart_preview.php");                                      
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
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link rel="stylesheet" href="style/design.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6f3c4e01cb.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/Icon.png" type="image/png">
    <title>DineOut/Cart</title>
  </head>
  <body>
  <?php require 'partials/nav_bar.php'; ?>

   
<div class="container mt-4">
<h3><b>Shopping Cart:</b></h3><hr>
                    <table class="table table-hover table-secondary">
                    <thead>
                        <tr>
                        <th scope="col">Dishes</th>
                        <th scope="col">Prices</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Sub Totals</th>
                        <th scope="col" style = 'font-size:25px; font-weight: bold; text-align:center;'>Grand Toatal</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
require 'partials/db_connect.php';
$sql = 'SELECT * FROM `orders_in_process`';
  $resul_t = mysqli_query($conn, $sql);
        while($row_f = mysqli_fetch_assoc($resul_t))
        {
          if($_SESSION['username_user']==$row_f['username']){
           $cart_exists = 1;
           $grand_total = $grand_total+$row_f['subtotal'];
                        $Dishes_names .= $row_f['dish'].$space;
                        $Dish_type .= $row_f['dish_type'].$space;
                        $prices .= $row_f['price'].$space;
                        $quantities .= $row_f['quantity'].$space;
                        $subtotals .= $row_f['subtotal'].$space;
                        echo "<tr>
                        <th scope='row'>".$row_f['dish']."</th>
                        <td>".$row_f['price']."</td>
                        <td>".$row_f['quantity']."</td>
                        <td>".$row_f['subtotal']."</td>
                        <td style = 'font-size:20px; font-weight: bold; text-align:center;'>.</td>
                        </tr>";
                      }
                    }
                    echo "<tr>
                        <th scope='row'></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style = 'font-size:25px; font-weight: bold; text-align:center;'>$grand_total</td>
                        </tr>";
                    $conn->close();
?>                      
                    </tbody>
                    <a type='button' class='btn btn-warning' href='cart_items.php'><i class='fa-solid fa-angles-left'></i>  Back to Cart</a>
                    </table>
<?php
if($cart_exists == 1){
echo "<div class='d-grid gap-2' style = 'width:30%; text-align:center; margin:auto;'>
<h5><b>Select the relevent method.</b></h5>
  <button class='btn btn-info Dine_here' type='button'><i class='fa fa-utensils'></i> Dine Here</button>
  <button class='btn btn-info Parcel' type='button'><i class='fa-solid fa-box'></i> Parcel</button>
  <button class='btn btn-info Home_delivery' type='button'><i class='fa fa-house-chimney-window'></i> Home Delivery</button>
</div>";}
else{
echo "<div class='d-grid gap-2' style = 'width:30%; text-align:center; margin:auto;'>
<h5><b>Select the relevent method.</b></h5>
  <button class='btn btn-info Dine_here' disabled type='button'><i class='fa fa-utensils'></i> Dine Here</button>
  <button class='btn btn-info Parcel' disabled type='button'><i class='fa-solid fa-box'></i> Parcel</button>
  <button class='btn btn-info Home_delivery' disabled type='button'><i class='fa fa-house-chimney-window'></i> Home Delivery</button>
</div>";}


?>
</div>

</div>
<div class="copyright">
<?php echo "@DineOut ".Date("Y")." Food Ordering System.";?>
</div>
    

    <!-- Button At the bottom to navigate at top: -->
    <button onclick="topFunction()" id="top_button"><i class="fa-solid fa-arrow-up"></i></button>


<?php
      echo "<div class='modal fade' id='Dine_here' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='staticBackdropLabel'>Choose the table by no.</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body' style='text-align:center;'>
      <form action='cart_proceeding.php' method='post'>
      <div class='form-group'>
      <input type='text' class='form-control' value='$Dishes_names' name='Dishes_name' style = 'display:none;'>
      <input type='text' class='form-control' value='$prices' name='prices' style = 'display:none;'>
      <input type='text' class='form-control' value='$quantities' name='quantities' style = 'display:none;'>
      <input type='text' class='form-control' value='$subtotals' name='subtotals' style = 'display:none;'>
      <input type='text' class='form-control' value='$grand_total' name='G_total' style = 'display:none;'>
      <input type='text' class='form-control' value='$Dish_type' name='Dish_type' style = 'display:none;'>";
      
       
          require 'partials/db_connect.php';
          $sql = 'SELECT * FROM `tbl_for_tables`';
            $resul_t = mysqli_query($conn, $sql);
                echo "<select type='text' class='form-control' id='title' name='table_no' aria-describedby='emailHelp' required>";
                while($row_f = mysqli_fetch_assoc($resul_t))
                {
                    if($row_f['status_tbl']=="Available"){
                            echo "<option>".$row_f['table_no']."</option>";
                    }
                }
                $conn->close();
                ?>
                    </select>
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
          <label class="form-check-label" for="exampleCheck1">Confirm Order.</label>
                  </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" name = "submit_confirm_order_dine_here" class="btn btn-success">Place Order</button>
      </form> 
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="Parcel_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">You have to wait for 20 minutes in waiting room.</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="text-align:center;">
      <form action="cart_proceeding.php" method="post">
    <?php
      echo "<input type='text' class='form-control' value='$Dishes_names' name='Dishes_name' style = 'display:none;'>
      <input type='text' class='form-control' value='$prices' name='prices' style = 'display:none;'>
      <input type='text' class='form-control' value='$quantities' name='quantities' style = 'display:none;'>
      <input type='text' class='form-control' value='$subtotals' name='subtotals' style = 'display:none;'>
      <input type='text' class='form-control' value='$grand_total' name='G_total' style = 'display:none;'>
      <input type='text' class='form-control' value='$Dish_type' name='Dish_type' style = 'display:none;'>";
    ?>
              <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                <label class="form-check-label" for="exampleCheck1">Confirm Order.</label>
              
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" name = "parcel_method_submit" class="btn btn-success">Place Order</button>
      </form> 
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="Home_Delivery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Enter Address to proceed</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <label class="form-check-label" for="exampleCheck1" style="font-weight:bold; font-size:10px; background-color:white; color:red;">Cation: Delivery Charges Rs:100 will be added seperately in the bill.</label>
      <div class="modal-body" style="text-align:center;">
      <form action="cart_proceeding.php" method="post">
      <?php
      echo "<input type='text' class='form-control' value='$Dishes_names' name='Dishes_name' style = 'display:none;'>
      <input type='text' class='form-control' value='$prices' name='prices' style = 'display:none;'>
      <input type='text' class='form-control' value='$quantities' name='quantities' style = 'display:none;'>
      <input type='text' class='form-control' value='$subtotals' name='subtotals' style = 'display:none;'>
      <input type='text' class='form-control' value='$grand_total' name='G_total' style = 'display:none;'>
      <input type='text' class='form-control' value='$Dish_type' name='Dish_type' style = 'display:none;'>";
    ?>
      
          <label class="form-check-label" for="exampleCheck1" style="font-weight:bold; font-sine:30px; background-color:black; color:orange;">Payment method: Cash on Delivery.</label>
          <input type="text" class="form-control" placeholder="Enter Address Here" name = "order_address" required />

          <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
          <label class="form-check-label" for="exampleCheck1">Confirm Order.</label>
      </div>
      <div class="modal-footer">
      
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" name = "submit_address" class="btn btn-success">Place Order</button>
      </form> 
      </div>
    </div>
  </div>
</div>

    
<script>
  Dine_here = document.getElementsByClassName('Dine_here');
     Array.from(Dine_here).forEach((element) => {
       element.addEventListener("click", (e) => {
			$("#Dine_here").modal('show');
	   })
	})

  Parcel = document.getElementsByClassName('Parcel');
     Array.from(Parcel).forEach((element) => {
       element.addEventListener("click", (e) => {
			$("#Parcel_modal").modal('show');
	   })
	})

  Home_Delivery = document.getElementsByClassName('Home_delivery');
     Array.from( Home_Delivery).forEach((element) => {
       element.addEventListener("click", (e) => {
			$("#Home_Delivery").modal('show');
	   })
	})

  </script>
  </body>
</html>


