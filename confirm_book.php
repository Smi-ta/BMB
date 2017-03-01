<?php  
include_once 'includes/functions.php';

	sec_session_start();
	if(login_check() == false){
		header('Location:../bmb/login.php');
	}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<style>
.row.content{height: 400px}
.sidespace {height: 100%;}
/* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidespace {height:auto;}
      .row.content {height:auto;} 
    }
/* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
</style>

</head>
<body>
<?php require("navigation.php"); echo '<br>'; ?>
<div class="container-fluid">
 <div class="row ">
  <div class="col-sm-1 sidespace" style="background-color:white;">
	
  </div>
  <div class="col-sm-10" style="background-color:#ff99ff;">
	<?php
	include_once 'includes/db_connect.php';
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$bus_id=$_POST["bus_id"];
		$bdate=$_POST["bdate"];
		$day=$_POST["day"];
		$no_of_seat=$_POST["no_of_seat"];
		$email=$_SESSION['email'];
		
		$result=$conn->query("select bus_name from bus_route where bus_id=".$bus_id);/*to select the bus name*/
		$row=$result->fetch_assoc();
		$bus_name=$row['bus_name'];
		
		$sql1="select reg_id,f_name,l_name,email_id,address,city,pin,ph_no  
			from registered_user where email_id='".$email."'";		/*select from registerd_user and insert into booking*/
			
		$result1=$conn->query($sql1);
		$row=$result1->fetch_assoc();
		
		$sql2="insert into booking(reg_id,bus_id,bus_name,f_name,l_name,email_id,address,city,pin,ph_no,seat_no,
				b_date)
		values(".$row['reg_id'].",".$bus_id.",'".$bus_name."','".$row['f_name']."','".$row['l_name']."','".$row['email_id']."','".$row['address']."','".$row['city']."',".$row['pin'].",".$row['ph_no'].",".$no_of_seat.",'".$bdate."')";
		
		$result2=$conn->query($sql2);
		
		if($result2 == true){		/*booking done reduce seats and display receipt*/
					
			$result_check=$conn->query("select ava_seat from booking_ava_seats where bus_id=".$bus_id." and day='".$day."'");
		
			if($result_check->num_rows == 0){
			
				$result3=$conn->query("select total_seat from bus_route where bus_id=".$bus_id);
				$row_totalseat=$result3->fetch_assoc();
				$total_seat=$row_totalseat['total_seat'];
				$ava_seat=$total_seat-$no_of_seat;
				$conn->query("insert into booking_ava_seats(bus_id,day,ava_seat)values(".$bus_id.",'".$day."',".$ava_seat.")");
				echo "<h3>booking done</h3>";
			}
			else{
				$conn->query("update booking_ava_seats set ava_seat=ava_seat-".$no_of_seat." where bus_id=".$bus_id." and day='".$day."'");
				echo "<h3>booking done</h3>";
			}
			$result_price=$conn->query("select price_per_seat from bus_route where bus_id=".$bus_id);
			$row_price=$result_price->fetch_assoc();
			$total_price=($row_price['price_per_seat'])*($no_of_seat);
			
			echo "<table class=\"table table-striped\">
					<thead><tr colspan=2><td><h3>BUS MERA BUS E-TICKET</h3></td><tr></thead>
					<tbody>
						<tr><td>Registration No:</td><td>".$row['reg_id']."</td></tr>
						<tr><td>Bus Route No:</td><td>".$bus_id."</td></tr>
						<tr><td>Bus name:</td><td>".$bus_name."</td></tr>
						<tr><td>First Name:</td><td>".$row['f_name']."</td></tr>
						<tr><td>Last Name:</td><td>".$row['l_name']."</td></tr>
						<tr><td>Email Id</td><td>".$row['email_id']."</td></tr>
						<tr><td>Address:</td><td>".$row['address']."</td></tr>
						<tr><td>City:</td><td>".$row['city']."</td></tr>
						<tr><td>Pin:</td><td>".$row['pin']."</td></tr>
						<tr><td>Phone No:</td><td>".$row['ph_no']."</td></tr>
						<tr><td>Booked Seats:</td><td>".$no_of_seat."</td></tr>
						<tr><td>Travelling Date:</td><td>".$bdate."</td></tr>
						<tr><td>Price:</td><td>".$total_price."</td></tr></tbody></table>";
		}
		echo "<center><h4><B>Ticket booked.<br>Click here to go on <a href=\"user_homepage.php\">home page</a></h4></b></center>";
	}
?>
  </div>
  <div class="col-sm-1 sidespace" style="background-color:white;">
	
  </div>
 </div>
</div>
<?php echo '<br>'; require("footer.php"); ?>
</body>
</html>