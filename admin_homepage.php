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
  
  <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
  
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
	li
	{
		text-decoration:none;
		color:white;
	}
	li a:hover
	{
		color:#4d004d;
		text-decoration:none;
	}
	
</style>
</head>
<body>
<div class="alert alert-success">
  <strong>Successful login as Admin!</strong>
</div>
<?php require("admin_navigation.php"); ?>
<div class="container-fluid">
 <div class="row ">
  <div class="col-sm-1" style="background-color:white;">
	
  </div>
  <div class="col-sm-10" >
	
		<div  >
		<p><h2>Welcome  <?php echo $_SESSION['credential']; ?></h2></p>
         </div> 
		
		<div class="col-sm-5" style="background-color:white;text-decoration:none">
			<?php require("search_bus.php"); ?>
		</div>
		
		<div class="col-sm-7" style="background-color:#e699ff;color:white"> 
			<BR>
			<ul class="nav nav-pills nav-justified" role="tablist">
				<li><a href="#addplace" data-toggle="modal" ><h4>Add Place</h4></a></li><br>
				<li><a href="#viewplace" data-toggle="modal" ><h4>View Place</h4></a></li><br>
				<li><a href="view_cancelled.php"  ><h4>View Booking</h4></a></li><br>
				<li><a href="view_feedback.php"   ><h4>View Feedback</h4></a></li><br>      
			</ul>
		
		
		</div>
		
		
  <!-- Modal1 -->
  <div class="modal fade" id="addplace" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Place</h4>
        </div>

        <div class="modal-body">
          <br>
          <form method="post" action="includes/addplace_process.php">
    <div class="form-group">
      <label for="src">Enter Source:</label>
      <input type="text" class="form-control" id="src" name="src">
    </div>
    <div class="form-group">
      <label for="des">Enter Destination:</label>
      <input type="text" class="form-control" id="des" name="des">
    </div>
	<button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>

        <div class="modal-footer">
    
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal2 -->
  <div class="modal fade" id="viewplace" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Place</h4>
        </div>

        <div class="modal-body">
          <?php 
			include_once 'includes/db_connect.php';			
			$sql="select * from place";
			$result=$conn->query($sql);
			echo"<table class=\"table table-striped\">
				<thead>
					<tr>
					<th>Source</th>
					<th>Destination</th>
					<th>Add Route</th>
					</tr>
				</thead>";
			
			while($row=$result->fetch_assoc()){
				echo "<tbody>
						<tr>
						<td>".$row['src']."</td>
						<td>".$row['des']."</td>
						<td><form method=\"get\" action=\"add_route.php\">
    <input type=\"hidden\" name=\"place_id\" value=".$row['place_id']."><input type=\"submit\"></form>
						</td>
						</tr>
					</tbody>";
			}
			echo"</table>";
			$conn->close();
		  ?>
          
		  
        </div>

        <div class="modal-footer">
    
        </div>
      </div>
      
    </div>
  </div>

  </div>
  <div class="col-sm-1 sidespace" style="background-color:white;">
	
  </div>
 </div>
</div>
<?php require("footer.php"); ?>
</body>
</html>