

<!DOCTYPE html>
<html>
<head>
  <title>darta chalani</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 40%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 40%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
 <br />
  <br />
   <br />
  <br />

<body onload=display_ct();>
  <?php

$connect = mysqli_connect("localhost", "root", "");
$db=mysqli_select_db($connect,"dartacha");
  ?>
  <?php
$y=date("Y");
$m=date("m");
$d=date("d");
  $ny=null;
   $nm=null;
    $nd=null;
    $nda= null;
$query="SELECT * FROM `dateconvert` WHERE `en_y` = $y AND `en_M` = $m AND `en_d` = $d ";
 $result1 = mysqli_query($connect, $query);
 if($row = mysqli_fetch_assoc($result1))
 {
  $ny=$row["ne_y"];
   $nm=$row["ne_m"];
    $nd=$row["ne_d"];
    $nda= $ny."/".$nm."/".$nd;
     }
  ?>
  <center style="color: green">
    <?php
echo $nda;

?>
<br />
  </center>
  <div id='ct' align="center" style="color: blue"></div>
<script type="text/javascript"> 
function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
var x = new Date()
document.getElementById('ct').innerHTML = x;
display_c();
 }
</script>
<form action="logintest.php" method="POST">
  <div class="imgcontainer">
  </div>
<center>
  <div class="container">
  	<?php
session_start();
if(isset($_SESSION["error"]))
{
echo $_SESSION["error"];
session_destroy();
}
?>
<br />
    <form onsubmit="return check();">
        <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" id="uname" required><br />

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required><br />
        
    <button type="submit" style="margin-left: 6%" name="sub">Login</button>
    </form>
  </div>
</center>
</form>
</body>
</html>