<?php
session_start();
if(isset($_SESSION['loggedin_Head_Chef']) && $_SESSION['loggedin_Head_Chef'] == true){

}
else{
  header("location: emp_dec.php");
}
$ready = false;
$pending = false;
$home = true;
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/5bb0aa3c76.js"></script>
	<script src="https://kit.fontawesome.com/6f3c4e01cb.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style/design.css">
        <title>Head Chef/DineOut</title>
        <link rel="icon" href="images/Icon.png" type="image/png">
	</head>
	<body>
	<?php require 'partials/head_pannel.php'; ?>
<div class="container content-bar" style="margin:auto; text-align:center;">
        <h2 style="font-family: fantasy;">Go through the operational window to perform operations!</h2><br><br><br>
        <div >
            <img src ="images/hc_logo.png" alt="head chef operations" style=" width: 50%;">
        </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</script>
<script src="style/main.js"></script>
<script>
	logout = document.getElementsByClassName('emp_head_chef_logout');
    Array.from(logout).forEach((element) => {
      element.addEventListener("click", (e) => {
        if (confirm("Are you sure to logout!")) {	
			    window.location.href = '/fyp/partials/logout_emp.php';
        }
        else {
          
        }
      })
    })
</script>
</body>
</html>