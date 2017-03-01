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
 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  
</script>
<style>
.row.content{height: auto;}
.sidespace {height: auto;}

/* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
</style>

</head>
<body>
<?php require("user_navigation.php"); ?>
<div class="container-fluid">
 <div class="row ">
  <div class="col-sm-1 sidespace">
	
  </div>
  <div class="col-sm-10"   style="background-color:#ff99ff;;">
	<?php
	
	$sql="select book_id,bus_id,seat_no,book_status
			from booking where email_id='".$_SESSION['email']."'";
	$result=$conn->query($sql);
	echo "<table class=\"table table-striped\">
			<thead><tr><td>Booking No<td>Total Seat<td>Booking Status<td>Cancel Booking</tr></thead>";
	
	while($row=$result->fetch_assoc()){
		echo "<tbody><tr><td>".$row['book_id']."<td>".$row['seat_no'];
		
		if($row['book_status']==0)
			echo "<td>booked<td>
		<form method=\"post\" action=\"".htmlspecialchars($_SERVER['PHP_SELF'])."\" >
		<input type=\"hidden\"  name=\"book_id\" value=\"".$row['book_id']."\">
		<input type=\"submit\" value=\"cancle\"></form>
		</tr>";
		elseif($row['book_status']==1)
			echo "<td>applied for cancelling<td>N.A</tr>";
		else
			echo"<td>cancelled<td>N.A</tr>";
		
	}
	echo "</tbody></table>";
	?>
	
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$book_id=$_POST["book_id"];
	
	if($conn->query("update booking set book_status=1 where book_id=".$book_id)){
		echo "<div class='alert alert-success'>";
		echo "<a href='user_cancle_book.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
		echo "<strong>Successfuly!</strong> applied for cancelled booking";
		echo "</div>";
	}
	else{
		echo "<div class='alert alert-warning'>";
		echo "<a href='user_cancle_book.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
		echo "<strong>Sorry!</strong> you cannot cancle this cancelled booking";
		echo "</div>";	
	}
}

?>
	
  </div>
  <div class="col-sm-1 sidespace">
	
  </div>
 </div>
</div>


<?php require("footer.php"); ?>
</body>
</html>
