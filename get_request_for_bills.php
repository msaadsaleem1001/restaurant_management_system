<?php
$count = 0;
$str = "";
require 'partials/db_connect.php';
    $sqli = 'SELECT * FROM `confirm_orders`';
    $result = mysqli_query($conn, $sqli);
        while($row = mysqli_fetch_assoc($result)){
            if($row['paid']=="Request"){
                $str .=$row['order_no']." ";
                $count++;
            }
        }
        $str .=$count;
        echo $str;
$conn->close();
?>