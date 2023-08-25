<?php
session_start();
if(isset($_SESSION['loggedin_user']) && $_SESSION['loggedin_user']==true){

}
else if(isset($_SESSION['loggedin_admin']) && $_SESSION['loggedin_admin'] == true){

}
else{
  header("location: login.php");
}

if(isset($_POST['ivoice_order_id'])){
    $serial_confirm_order = $_POST['ivoice_order_id'];
    $_SESSION['user_order_invoice'] = $serial_confirm_order;
    $_SESSION['interface'] = "user";
}
if(isset($_POST['Invoice_id_order'])){
    $serial_by_admin = $_POST['Invoice_id_order'];
    $_SESSION['user_order_invoice'] = $serial_by_admin;
    $_SESSION['interface'] = "admin";
}
$current_interface = $_SESSION['interface'];
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
    <title>DineOut/Cart</title>
  </head>
  <body>
   
<div class="container mt-4">
        <div class="box_invoice">
            <div class="row">
                <div class="col">
                    <h4><b>DineOut FoodOrdering system.</b></h4>
<?php
echo "<input type='text' style = 'display:none;' id = 'current_interface' value='$current_interface'/>";
require 'partials/db_connect.php';
$sqli = 'SELECT * FROM `confirm_orders`';
     $result_I = mysqli_query($conn, $sqli);
          while($row_I = mysqli_fetch_assoc($result_I)){
              if($row_I['S_No'] == $_SESSION['user_order_invoice']){     
                  $Dish = explode(",", $row_I['Dishes']);    
                  $prices = explode(",", $row_I['prices']);  
                  $quantities = explode(",", $row_I['quantities']);
                  $subtotals = explode(",", $row_I['subtotals']);
          
                echo "</div>
                <div class='col'>
                    <h3>Invoice</h3>
                    
                </div>
                </div>

                <div class='row'>
                <div class='col'>
                    
                </div>
                <div class='col'>
                    <h6><b>Username:</b> ".$row_I['username']."</h6>
                    <h6><b>Order Status:</b>  ".$row_I['Status']."</h6>
                    <h6><b>Order No:</b>  ".$row_I['order_no']."</h6>
                    <h6><b>Order Date:</b>  ".$row_I['Date']."</h6>
                    <h6><b>Payment Method:</b>  ".$row_I['Method']."</h6>
                </div>
                </div>
                    <table class='table table-success'>
                    <thead class='table-dark'>
                        <tr>
                        <th scope='col'>Dishes</th>
                        <th scope='col'>Prices</th>
                        <th scope='col'>Quantities</th>
                        <th scope='col'>Sutotals</th>
                        <th scope='col' style = 'text-align:center;'>Grand Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>";for ($i=0; $i < count($Dish); $i++) { 
                                    echo $Dish[$i];
                                    echo "<br>";
                        }echo "</td>
                        <td>";for ($i=0; $i < count($prices); $i++) { 
                                    echo $prices[$i];
                                    echo "<br>";
                        }echo "</td>
                        <td>";for ($i=0; $i < count($quantities); $i++) { 
                            echo $quantities[$i];
                            echo "<br>";
                        }echo "</td>
                        <td>";for ($i=0; $i < count($subtotals); $i++) { 
                            echo $subtotals[$i];
                            echo "<br>";
                        }echo"</td>
                        <td style = 'text-align:center;'>";for ($i=0; $i < count($subtotals)-1; $i++) { 
                            echo "<b>.</b><br>";
                        }echo "</td>
                        </tr>

                        <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style = 'text-align:center;'><b>".$row_I['grand_total']."</b></td>
                        </tr>
                    </tbody>
                    </table>
<div style = 'text-align:center;'>
    <p><b>Thank you</b> for choosing us!<br>
    We hope to see you again.</p>
</div>
</div>";
              }
            }
?>
<div style = "text-align:center; margin-top:5px;">
<a type="button" class="btn btn-warning back_to_interface"><i class="fa-solid fa-angles-left"></i> Back</a>
</div>
</div>
<script>
      back = document.getElementsByClassName('back_to_interface');
        Array.from(back).forEach((element) => {
        element.addEventListener("click", (e) => {
		let inter = document.getElementById("current_interface").value;
            if(inter == "admin"){
                window.location.href = '/fyp/admin_all_orders.php';
            }
            else if(inter == "user"){
                window.location.href = '/fyp/cart_preview.php';
            }
            else{
                // Nothing
            }
      })
    })
</script>
  </body>
</html>