<?php
session_start();
$success = false;
$served = false;
if(isset($_SESSION['loggedin_user']) && $_SESSION['loggedin_user']==true){

}
else{
  header("location: login.php");
}
$delivered_oorder = 0;
$request_bill = 0;
$data = 0;
if(isset($_POST['cancel_order_confirm'])){
    require 'partials/db_connect.php';
    $serial_id_order = $_POST['cancel_order_confirm'];
    $sql_z = "UPDATE `confirm_orders` SET `Status` = 'Canceled' WHERE `confirm_orders`.`S_No` = '$serial_id_order';";
			 if ($conn->query($sql_z) === TRUE) {
				$success = true;
			} else {
				// nothing
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
    <title>DineOut/Orders</title>
  </head>
  <body>
  <?php require 'partials/nav_bar.php'; 

   

  if($success){
    echo "<div class='container' style = 'position:relative; display: flex; justify-content: center; align-items: center;'>
  <div style = 'position:absolute; top:40%; z-index:2000; width:300px; height:100px; position: fixed;'>
     <div class='toast fade show'>
         <div class='toast-header'>
            <strong class='me-auto' style = 'color:green;'><i style='font-size:20px;' class='fa fa-clipboard-check'></i> <b>Success!</b></strong>
            <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
         </div>
         <div class='toast-body' style = 'text-align:center;'>
             <b>Order Canceled successfully.</b><br>
         </div>
     </div>
  </div>
  </div>
</div>";
}

?>





<div class="container mt-4">
<div class="alert alert-success text-center" id ="success-alert" role="alert">
Your request has been successfully reached to manager!
</div>
<div class="alert alert-danger text-center" id = "error-alert" role="alert">
Your request has not been successfully reached to manager because of some internal error!
</div>
<h4 style = "text-align:center;"><b>Current Orders</b></h4><hr>
<?php
 require 'partials/db_connect.php';
 $sqli_c = 'SELECT * FROM `confirm_orders`';
 $num_of_rows = 0;
 $result_c = mysqli_query($conn, $sqli_c);
 while($row_c = mysqli_fetch_assoc($result_c)){
    if($row_c['username']==$_SESSION['username_user']){    
      if(!($row_c['Status']=="Delivered") && !($row_c['Status']=="Canceled")){
        $num_of_rows++; 
      }
    }
 }
$conn->close();
if($num_of_rows > 0){
                    echo "<div class='table-responsive'>
                    <table class='table table-primary table-responsive'>
                    <thead class = 'table-dark'>
                        <tr>
                        <th scope='col' style = 'display:none;'></th>
                        <th scope='col'>Dishes</th>
                        <th scope='col'>Prices</th>
                        <th scope='col'>Quantities</th>
                        <th scope='col'>Subtotals</th>
                        <th scope='col' style = 'width:120px;'>Grand total</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Action</th>
                        </tr>
                    </thead>
                    <tbody>";
                    require 'partials/db_connect.php';
                    $sqli = 'SELECT * FROM `confirm_orders`';
                    $result = mysqli_query($conn, $sqli);
                        while($row = mysqli_fetch_assoc($result)){
                            if($row['username']==$_SESSION['username_user']){    
                              if(!($row['Status']=="Delivered") && !($row['Status']=="Canceled")){     
                                if($row['Status']=="Served"){
                                  $request_bill = 1;
                                  $served = true;
                                }      
                                if($row['Status']=="Request"){
                                  $request_bill = 1;
                                }
                                $data = 1;
                                $d_explode = explode(",", $row['Dishes']);
                                $P_explode = explode(",", $row['prices']);
                                $Q_explode = explode(",", $row['quantities']);
                                $S_totals = explode(",", $row['subtotals']);
                                      echo "<tr>
                                      <td style = display:none;'>".$row['S_No']."</td>
                                      <td style = 'padding-top:25px;'>"; for ($i=0; $i < count($d_explode); $i++){ echo $d_explode[$i]; echo "<br>"; } echo "</td>
                                      <td style = 'padding-top:25px;'>"; for ($i=0; $i < count($P_explode); $i++){ echo $P_explode[$i]; echo "<br>"; } echo "</td>
                                      <td style = 'padding-top:25px;'>"; for ($i=0; $i < count($Q_explode); $i++){ echo $Q_explode[$i]; echo "<br>"; } echo "</td>
                                      <td style = 'padding-top:25px;'>"; for ($i=0; $i < count($S_totals ); $i++){ echo $S_totals [$i]; echo "<br>"; } echo "</td>";
                                      echo "<td style = 'padding-top:25px; font-size:20px;'><b>".$row['grand_total']."</b></td>
                                      <td><button class='btn btn-secondary btn-sm' type='button' disabled style = 'margin-top:15px; margin-bottom:15px; width:105px;'>".$row['Status']."</button></td>
                                      <td>"; if($served){ $served = false;  echo "<button class='cancel_confirm_order btn btn-danger btn-sm' disabled style = 'margin-top:15px; margin-bottom:15px; width:80px;'><i class='fa fa-trash'></i> Cancel</button>";} else{ echo "<button class='cancel_confirm_order btn btn-danger btn-sm' style = 'margin-top:15px; margin-bottom:15px; width:80px;'><i class='fa fa-trash'></i> Cancel</button>";} echo "</td>
                                     </tr>


                                     <tr>
                                      <td style = 'display:none;'>".$row['S_No']."</td>
                                      <td >";
                                      if($request_bill==1){
                                        $request_bill = 0;
                                        echo "<button class='btn btn-warning Notify'><i class='fa-solid fa-code-pull-request'></i> Request for bill</button>";
                                      }
                                      else{
                                         echo "<button type='button' class='btn btn-warning' disabled><i class='fa-solid fa-code-pull-request'></i> Request for bill</button>";
                                      } echo "</td>
                                      <td><i class='fa fa-arrow-turn-up'></i></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr>";
                            
                              }
                            }
                        }
                        echo "</tbody>
                        </table>
                        </div>";
                        $conn->close();
    }
if($data == 0){
  echo "<div class='table-responsive'>
  <table class='table table-responsive'>
        <thead>
        <tr>
            <th scope='col' style = 'display:none;'></th>
            <th scope='col'>Dishes</th>
            <th scope='col'>Prices</th>
            <th scope='col'>Quantities</th>
            <th scope='col'>Subtotals</th>
            <th scope='col' style = 'width:120px;'>Grand total</th>
            <th scope='col'>Status</th>
            <th scope='col'>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr style = 'text-align:center;'>
               <td style = display:none;'>.</td>
               <td style = 'padding-top:25px;'>.</td>
               <td style = 'padding-top:25px;'>.</td>
               <td style = 'padding-top:25px;'>.</td>
               <td style = 'padding-top:25px;'>No confirmred order by you.</td>
               <td style = 'padding-top:25px;'></td>
               <td>.</td>
               <td>.</td>
               </tr>
        </tbody>
      </table>
      </div>";
}


                    echo "<h4 style = 'text-align:center; margin-top:50px;'><b>Previous Orders</b></h4><hr>
                    <div class='table-responsive'>
                    <table class='table table-hover table-primary table-responsive'>
                    <thead class='table-dark' style = 'text-align:center;>
                        <tr>
                        <th scope='col' style = 'display:none;'></th>
                        <th scope='col'>Order Date</th>
                        <th scope='col'>Status</th>
                        <th scope='col'>Invoice</th>
                        </tr>
                    </thead>
                    <tbody>";
                    require 'partials/db_connect.php';
                    $sqle = 'SELECT * FROM `confirm_orders`';
                    $result_f = mysqli_query($conn, $sqle);
                    while($row_s = mysqli_fetch_assoc($result_f)){
                      if($row_s['username']==$_SESSION['username_user']){    
                        if($row_s['Status']=="Delivered"){          
                          $delivered_oorder = 1;
                                echo "<tr style = 'text-align:center;'>
                                <td style = 'padding-top:25px; display:none;'>".$row_s['S_No']."</td>
                                <td style = 'padding-top:25px;'>".$row_s['Date']."</td>
                                <td><button class='btn btn-success' style = 'margin-top:8px; margin-bottom:8px; width:120px;'><i class='fa-solid fa-check'></i> Delivered</button></td>
                                <td><button class='invoice btn btn-info' style = 'margin-top:8px; margin-bottom:8px; width:105px;'><i class='fa-solid fa-file-invoice'></i> Invoice</button></td>
                                </tr>";
                        }
                      }
                  }
                    $conn->close(); 
                    echo "</tr>";

                     if($delivered_oorder == 0){
                      echo "<tr style = 'text-align:center;'>
                      <td style = 'padding-top:25px;'></td>
                      <td style = 'padding-top:25px;'>No your previous order found or you are new here.</td>
                      <td style = 'padding-top:25px;'></td>
                      </tr>";

                     }
                     ?>
                        
                        </tbody>
                        </table>
                    </div>                  
</div>

<div class="copyright">
<?php echo "@DineOut ".Date("Y")." Food Ordering System." ?>
</div>
   




   
    

  
<form id="cancel_order_confirm_form" action="cart_preview.php" method="POST" style="display:none;">
			<input type="number" id="cancel_order_confirm" name="cancel_order_confirm">
</form>

<form id="Invoice_order_form" action="invoice.php" method="POST" style="display:none;">
			<input type="number" id="ivoice_order_id" name="ivoice_order_id">
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

$(document).ready(function(){
  $("#success-alert").hide();
  $("#error-alert").hide();
  let notify = document.getElementsByClassName('Notify');
     Array.from(notify).forEach((element) => {
       element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode;
			  let serial = tr.getElementsByTagName("td")[0].innerText;
        $.post("user_post_request.php",
        {
          Serial_id: serial
        },
        function(data,status){
          if(data == "True"){
            $("#success-alert").fadeIn(1000);
            $("#success-alert").fadeOut(5000);
            let disable = tr.getElementsByTagName("td")[1].getElementsByTagName("button")[0];
            disable.setAttribute('disabled', 'disabled');
          } 
          else{
            $("#error-alert").fadeIn(1000);
            $("#error-alert").fadeOut(5000);
          } 
        });
    });
  });
});
 

  cancel_confirm_order = document.getElementsByClassName('cancel_confirm_order');
    Array.from(cancel_confirm_order).forEach((element) => {
      element.addEventListener("click", (e) => {
		tr = e.target.parentNode.parentNode;
    // console.log(tr);
		var cancel_confirm_order = tr.getElementsByTagName("td")[0].innerText;
    cancel_order_confirm.value = cancel_confirm_order;
            if (confirm("Are you sure you want to cancel this order!")){	
                  let form = document.getElementById("cancel_order_confirm_form");
                  form.submit();
            }
      })
    })


    Invoice_Order = document.getElementsByClassName('invoice');
    Array.from(Invoice_Order).forEach((element) => {
      element.addEventListener("click", (e) => {
		tr = e.target.parentNode.parentNode;
		var invoice = tr.getElementsByTagName("td")[0].innerText;
    ivoice_order_id.value = invoice;
        let form = document.getElementById("Invoice_order_form");
        form.submit();
            
      })
    })
</script>
  </body>
</html>