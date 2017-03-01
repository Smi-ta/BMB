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

</style>
</head>
<body>
<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$book_id=$_POST["book_id"];
		$bus_id=$_POST["bus_id"];
		$no_seat=$_POST["seat_no"];
		$b_date=$_POST["b_date"];
		$st_day=strtotime($b_date);
		$day=date("D",$st_day);
		
		$result1=$conn->query("update booking set book_status=2 where book_id=".$book_id);
		$result2=$conn->query("update booking_ava_seats set ava_seat=ava_seat+".$no_seat." where bus_id=".$bus_id." and day='".$day."'");
		
		if($result1==true && $result2==true){
			echo "<div class='alert alert-success'>";
		echo "<a href=\"view_cancelled.php\" class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
		echo "<strong>Successfuly!</strong> booking has been cancelled refresh page to get updated";
		echo "</div>";
		}
	}
?>
</body></html>	
	