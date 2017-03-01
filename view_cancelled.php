<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
if(login_check() == false)
	header('Location:../bmb/login.php');
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
.row.content{height: auto;}
.sidespace {height: 100;}

/* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
</style>
</head>
<body>

<?php require("admin_navigation.php"); ?>
<div class="container-fluid">
 <div class="row ">
  <div class="col-sm-1 sidespace" style="background-color:white;">
	
  </div>
  <div class="col-sm-10"  style="background-color:#ff99ff;">
	
	<?php
	
	$result=$conn->query("select book_id,bus_id,bus_name,f_name,seat_no,b_date from booking where book_status=1");
	
	echo "<table class='table table-striped'>
			<thead>
			<tr>
			<th>Booking No</th>
			<th>Name</th>
			<th>Bus Name</th>
			<th>No.of Seat</th>
			<th>Cancel Booking</th></tr>
			</thead>
			<tbody>";
	
	while($row=$result->fetch_assoc()){
		echo"<tr><td>".$row['book_id']."</td><td>".$row['f_name']."</td><td>".$row['bus_name']."</td><td>".$row['seat_no']."</td><td><form method=\"post\" action=\"cancelled_sucess.php\">
				<input type=\"hidden\" name=\"book_id\" value=\"".$row['book_id']."\" >
				<input type=\"hidden\" name=\"bus_id\" value=\"".$row['bus_id']."\" >
				<input type=\"hidden\" name=\"b_date\" value=\"".$row['b_date']."\" >
				<input type=\"hidden\" name=\"seat_no\" value=\"".$row['seat_no']."\" >
				<input type=\"submit\">
				</form></td></tr>";
	}
	echo "</tbody></table>";
	
	?>
	
	
		
  </div>
  <div class="col-sm-1 sidespace" style="background-color:white;">
	
  </div>
 </div>
</div>
<?php require("footer.php"); ?>
</body>
</html>