<?php
session_start();
$c_emp = $_SESSION['username_emp'];
require 'db_connect.php';
$Sql_logout = "SELECT * FROM `staff` WHERE username = '$c_emp'";
$Sql_logout_result = mysqli_query($conn, $Sql_logout);
$sql_fetch = mysqli_fetch_assoc($Sql_logout_result);
    $id_of_emp = $sql_fetch['serial_no'];
    $sql_status = "UPDATE `staff` SET `Status` = 'Deactive' WHERE `staff`.`serial_no` = '$id_of_emp';";
            if ($conn->query($sql_status) === TRUE) {
                session_unset();
                session_destroy();
                header("location: /FYP/emp_dec.php");
                exit;
            }
            else{
                // nothing
            }

?>