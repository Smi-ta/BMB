<?php

include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();
if(login_check() == false)
	header('Location:../bmb/login.php');

$src=$_POST['src'];
$des=$_POST['des'];

$sql="insert into place(src,des)values('".$src."','".$des."')";
if($conn->query($sql)){
	header('Location:../admin_homepage.php');
}
else{
	echo "failed to add place";
	echo "to go to home page<a href=\"../admin_homepage.php\">click here</a>";
}

?>