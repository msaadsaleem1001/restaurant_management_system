<?php
if(isset($_GET['Order_no'])){
    require 'partials/db_connect.php';
    $Order_no = $_GET['Order_no'];
    $sqli = "SELECT * FROM confirm_orders where order_no='$Order_no'";
    $resulti = mysqli_query($conn, $sqli);
    $numi = mysqli_num_rows($resulti);
    $rowi = mysqli_fetch_assoc($resulti);
    $d_explode = explode(",", $rowi['Dishes']);
    $p_explode = explode(",", $rowi['prices']);
    $q_explode = explode(",", $rowi['quantities']);
    $s_explode = explode(",", $rowi['subtotals']);
    if ($numi == 1){
        echo "<div class='modal fade' id='bill_modal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content mt-4'>
        <div class='modal-header'>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
          <div id='print_modal' style= 'padding-top:30px; padding-right:30px; padding-bottom:30px; padding-left:30px;'>
            <div>
              <hr style='height:3px;'>
              <p style='text-align:center;'><b>*RECEIPT*</b></p>
              <hr style='height:3px;'>
              <p><b>Date:</b> ".date("Y/m/d h:i:sa")."</p><p><b>Order no:</b> ".$rowi['order_no']."</p>
              <h1><hr style='height:2px;'></h1>
            </div>
            <div class='modal-body'>
            <img src='images/stamp.png' alt='img' style='position:absolute; right:10px; width:300px; height:300px; opacity:0.2;'>
        <table class='table table-bordered'>
        <thead style='font-weight:bold;'>
          <tr>
            <th scope='col'>Items</th>
            <th scope='col'>Prices</th>
            <th scope='col'>Quantities</th>
            <th scope='col'>subtotals</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>"; for($i=0; $i < count($d_explode)-1; $i++){echo $d_explode[$i]; echo "<br>";} echo "</td>
            <td>"; for($i=0; $i < count($d_explode)-1; $i++){echo $p_explode[$i]; echo "<br>";} echo "</td>
            <td>"; for($i=0; $i < count($d_explode)-1; $i++){echo $q_explode[$i]; echo "<br>";} echo "</td>
            <td>"; for($i=0; $i < count($d_explode)-1; $i++){echo $s_explode[$i]; echo "<br>";} echo "</td>
          </tr>
          <tr>
            <td><b>Grand Total:</b></td>
            <td>.</td>
            <td>.</td>
            <td><b>".$rowi['grand_total']."</b></td>
          </tr>
      </tbody>
      </table>
            </div>
            <div>
              <h1><hr></h1>
              <p><b>Username:</b> ".$rowi['username']."</p><p><b>Method:</b> ".$rowi['Method']."</p><p><b>Order Time:</b> ".$rowi['Date']."</p>
              <h1><hr></h1>
              <h3 class='modal-title' style='text-align:center;'><b>Thank You!</b></h3>
              <h1><hr></h6>
            </div>
          </div>
          <div class='modal-footer'>
            <input type='number' id='paid_order_id' value='".$rowi['S_No']."' style='display:none;'>
              <button type='button' id='paid_order_btn' class='btn btn-success'>Paid and Print</button>
            </div>
          </div>
        </div>
      </div>";
    }
    else{
        echo "false";
    }
$conn->close();
}
?>