<?php
session_start();
if(isset($_SESSION['loggedin_user']) && $_SESSION['loggedin_user']==true){

}
else{
  header("location: login.php");
}
if  (isset($_POST['cancel_item']))
{
  require 'partials/db_connect.php';
	
	$Item_cancel = $_POST['cancel_item'];
	// print_r($Item_del);
	$sql = "DELETE FROM `orders_in_process` WHERE `orders_in_process`.`S_No` = '$Item_cancel';";
	if ($conn->query($sql) === TRUE) {
		// print_r($Item_del);
	} else {
// print_r($Item_del);
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
    <title>DineOut/Cart</title>
  </head>
  <body>
  <?php require 'partials/nav_bar.php'; ?>

   
<div class="container mt-4">
<h1><b>Shopping Cart:</b></h1><hr>
                    <table class="table table-hover table-striped">
                    <thead style = "text-align:center;">
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Dish</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col" style = "display:none;"></th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
     require 'partials/db_connect.php';
     $sql = 'SELECT * FROM `orders_in_process`';
       $resul_t = mysqli_query($conn, $sql);
          $grand_total = 0;
          $null_r = 0;
             while($row_f = mysqli_fetch_assoc($resul_t))
             {
               if($_SESSION['username_user']==$row_f['username']){
                $grand_total = $grand_total+$row_f['subtotal'];
                $null_r = $null_r + 1;
                     echo"<tr style = 'text-align:center;'>
                        <th scope='row'><div  id='dimg'><img src=".$row_f['image']." style='height: 100px; width:100px;'></div></th>
                        <td style = 'padding-top:45px;'>".$row_f['dish']."</td>
                        <td style = 'padding-top:45px;'>".$row_f['price']."</td>
                        <td style = 'padding-top:40px;'>".$row_f['quantity']."</td>
                        <td style = 'padding-top:45px;'>".$row_f['subtotal']."</td>
                        <td style = 'padding-top:45px; display:none;'> ".$row_f['S_No']." </td>
                        <td style = 'padding-top:35px;'><button class='delete_cart btn btn-danger'><i class='fa fa-trash'></i>Cancel</button></td>
                        </tr>";
               }
             }
             if($null_r == 0){
              echo "<tr style = 'text-align:center;'>
              <th scope='row'><div  id='dimg'></th>
              <td></td>
              <td></td>
              <td style = 'font-size:20px;'><b>You have not selected any item yet.</b></td>
              <td></td>
              <td style = 'display:none;'></td>
              <td></td>
              </tr>";
             }
            

                        echo "<tr style = 'text-align:center;'>
                        <th scope='row'><a type='button' class='btn btn-warning' href='customer.php'><i class='fa-solid fa-angles-left'></i>  Continue Ordering</a></th>
                        <td></td>
                        <td></td>
                        <td style = 'padding-top:15px;'><b>Grand Total:</b></td>
                        <td style = 'padding-top:15px; font-weight: bold;' id = 'G_total'>".$grand_total."</td>";
                        if($null_r == 0){
                            echo "<td><a type='button' class='btn btn-success disabled' href='cart_proceeding.php'>Checkout  <i class='fa-solid fa-angles-right'></i></a></td>";
                        }
                        else{
                            echo "<td><a type='button' class='btn btn-success' href='cart_proceeding.php' disabled>Checkout  <i class='fa-solid fa-angles-right'></i></a></td>";
                        }
                    echo "</tr>
                        
                    </tbody>
                    </table>";
          $conn->close();

          // Print_r ($All_dishes);
      


echo "</div>


<div class='copyright'>
@DineOut ".date("Y")." Food Ordering System.
</div>";
?>
<!-- Delete the record on button click -->
<form id="Delete_from_cart" action="cart_items.php" method="POST" style="display:none;">
			<input type="number" id="cancel_item" name="cancel_item">
</form>
<!-- End = Delete the record on button click -->



   
    

    <!-- Button At the bottom to navigate at top: -->
    <button onclick="topFunction()" id="top_button"><i class="fa-solid fa-arrow-up"></i></button>



    
<script src="style/function.js"></script>
<script>

  


  delete_cart = document.getElementsByClassName('delete_cart');
    Array.from(delete_cart).forEach((element) => {
      element.addEventListener("click", (e) => {
		tr = e.target.parentNode.parentNode;
    let id_item = tr.getElementsByTagName("td")[4].innerText;
    cancel_item.value = Number(id_item);
    
        if (confirm("Are you sure you want to cancel it from cart!")) {	
            console.log(cancel_item.value);
			      let form = document.getElementById("Delete_from_cart");
            form.submit();
        }
        else {
          // console.log("no");
        }
      })
    })

  </script>
  </body>
</html>