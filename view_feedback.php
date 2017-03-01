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

/* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
</style>
</head>
<body>
</body>
</html>

<?php require("admin_navigation.php"); echo '<br>'; ?>
<div class="container-fluid">
 <div class="row ">
  <div class="col-sm-1" style="background-color:white;">
	
  </div>
  <div class="col-sm-10"  style="background-color:#ff99ff;">
	<?php
	$result=$conn->query("select feedback,fdate from feedback");
	echo "<table class='table table-striped'><thead><tr><td>Feedback</td><td>Date Time</td></tr></thead><tbody>";
	while($row=$result->fetch_assoc()){
		echo "<tr><td>".$row['feedback']."<td>".$row['fdate']."</tr>";
	}
	echo "</tbody></table>";
	
	?>
		
  </div>
  <div class="col-sm-1" style="background-color:white;">
	
  </div>
 </div>
</div>

<?php echo '<br><br><br><br><br>'; require("footer.php"); ?>













