<?php
session_start();
if(isset($_SESSION['loggedin_manager']) && $_SESSION['loggedin_manager'] == true){

}
else{
  header("location: emp_dec.php");
}
$home = true;
$table = false;
$delivery = false;
?>
<!DOCTYPE html>
<html>
	<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/5bb0aa3c76.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="style/design.css?v=<?php echo time(); ?>">
    <title>Manager/DineOut</title>
    <link rel="icon" href="images/Icon.png" type="image/png">
	</head>
	<body>
	<?php require 'partials/manager_pannel.php'; ?>
<div class="container content-bar" style="margin:auto; text-align:center;">
        <h2 style="font-family: fantasy;">Go through the menu to perform tasks!</h2><br><br><br>
        <div >
            <img src ="images/Admin-task.webp" alt="Administrative Tasks" style=" width: 50%;">
        </div>
</div>
<form id="show_order_modal" action="manager_home.php" method="POST" style="display:none;">
			<input type="text" id="order_no_show_m" name="order_no_show_m">
</form>


<div id = "modal_parent">

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
<script src="style/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>   
  var span = document.getElementById('span_value');
  var prev = span.textContent;
$(document).ready(function(){
  const interval = setInterval(function() {
    $.get("get_request_for_bills.php", function(data){
        const fetchedata = data.split(" ");
        let len =fetchedata.length;
        let bellno =fetchedata[len-1];
              if(bellno > prev){
                  span.textContent = bellno;
                  prev = bellno;
              }
              else{
                  span.textContent = bellno;
              }
              const remove_list = document.getElementById("noti_list");
              while (remove_list.hasChildNodes()) {
                remove_list.removeChild(remove_list.firstChild);
              }
              for(i=0; i<=len-2; i++){
                    const item_list = document.createElement("li");
                    const anchor = document.createElement("a");
                    anchor.classList.add('dropdown-item', 'list_pointer');
                    const textnode = document.createTextNode(fetchedata[i]);
                    item_list.appendChild(anchor);
                    anchor.appendChild(textnode);
                    document.getElementById("noti_list").appendChild(item_list);
              }
    });
  }, 1000);


  $('#noti_list').on('click', '.list_pointer', function() {
    let current_no = $(this).text();
    $.get("get_request_bill.php",
        {
          Order_no: current_no
        },
        function(data,status){
          if(data != "false"){
            document.getElementById("modal_parent").innerHTML=data;
            $("#bill_modal").modal('show');
          }
        });
  });
});

$('#modal_parent').on('click', '#paid_order_btn', function() {
      $("#bill_modal").modal('show');
      let bill = $("#print_modal").html();
        let id_no = document.getElementById("paid_order_id").value;
        $.post("user_post_request.php",
        {
          primary_no: id_no
        },
        function(data,status){
          if(data == "True"){
            var mywindow = window.open('', 'PRINT', '');
            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(bill);
            mywindow.document.write('</body></html>');
            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/
            mywindow.print();
            mywindow.close();
          }  
        });
});

	logout = document.getElementsByClassName('emp_manager_logout');
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