<?php
session_start();
$connect = mysqli_connect("localhost", "root", "");
$db=mysqli_select_db($connect,"dartacha");
if(isset($_POST['sub']))
{
	$user=$_POST['uname'];
	$psw=$_POST['psw'];
	$que="select * from user where uname='".md5($user)."' and password='".md5($psw)."'";
	 $result1 = mysqli_query($connect, $que);
 if($row = mysqli_fetch_assoc($result1))
 {
 	$_SESSION["name"]=$row["name"];
 		header("Location:darta.php");
 	
 }
else
{
	$_SESSION["error"] ="invalid username and password";
		header("Location:index.php");
	
}
}
else
{
	header("Location:index.php");
}
?>

