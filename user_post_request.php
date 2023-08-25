<?php
if(isset($_POST['Serial_id']))
{
require 'partials/db_connect.php';
    $id_no = $_POST['Serial_id'];
    $sql_u = "UPDATE `confirm_orders` SET `paid` = 'Request' WHERE `confirm_orders`.`S_No` = '$id_no';";
    if ($conn->query($sql_u) === TRUE) {
        echo "True";
    } else {
        echo "False";
    }
$conn->close();
}




if(isset($_POST['primary_no']))
{
require 'partials/db_connect.php';
    $primary_no = $_POST['primary_no'];
    $sql_i = "UPDATE `confirm_orders` SET `paid` = 'Paid' WHERE `confirm_orders`.`S_No` = '$primary_no';";
    if ($conn->query($sql_i) === TRUE) {
        echo "True";
    } else {
        echo "False";
    }
$conn->close();
}
?>