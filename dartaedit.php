<?php
session_start();
if(! isset($_SESSION["name"]))
{
  header("Location:index.php");
}
//unset($_SESSION["loginid"]);
$connect = mysqli_connect("localhost", "root", "");
$db=mysqli_select_db($connect,"dartacha");

$did=null;
$date=null;
$lettercount=null;
$letterdate=null;
$senderoffice=null;
$subject=null;
$recname=null;
$recsign=null;
$recdate=null;
$extra=null;
$file=null;
$genname=null;
$upname=null;
$cname=null;
$reamount=null;
$dueamount=null;
$tamount=null;
$result1=null;

?>

<!DOCTYPE html>
<html>
 <head>
  <title>darta chalani</title>
  <script>
function check()
{
  var a=document.getElementById("ddate").value;
  var b=document.getElementById("pnum").value;
  var c=document.getElementById("pdate").value;
  var d=document.getElementById("pname").value;
  var e=document.getElementById("sub1").value;
  var f=document.getElementById("recdate").value;
    var g=document.getElementById("dnum").value;
if(a==0 || b==0 || c==0 || d==0 || e==0|| g==0 || f==0)
  {
  alert("field cannot be empty");
  return false;
}
    return true;
}
</script>
  <link rel="stylesheet" href="style.css">
   
 </head>
 <body class="wrap">
  <?php


$indic=0;

if(isset($_REQUEST["id"]))
{
   if(is_numeric($_REQUEST["id"]))
     {
      $did=$_REQUEST["id"];
   $sql="select * from darta where did='".$did."'";
   $result1 = mysqli_query($connect, $sql);
 if($row = mysqli_fetch_assoc($result1))
 {
  $date=$row["date"];
  $lettercount=$row["lettercount"];
  $letterdate=$row["letterdate"];
  $senderoffice=$row["senderoffice"];
  $subject=$row["subject"];
  $recname=$row["recname"];
  $recsign=$row["recsign"];
  $recdate=$row["recdate"];
  $extra=$row["extra"];
}
  }
  else
  {
    $did=$_REQUEST["id"];
    $indic=1;
 $splitToArray = explode(".",$_REQUEST["id"]);
$did1=$splitToArray[0];
$did_new1=$splitToArray[1];
$sql="select * from darta_ext where did='".$did1."' and did_new='".$did_new1."'";
   $result1 = mysqli_query($connect, $sql);
 if($row = mysqli_fetch_assoc($result1))
 {
  $date=$row["date"];
  $lettercount=$row["lettercount"];
  $letterdate=$row["letterdate"];
  $senderoffice=$row["senderoffice"];
  $subject=$row["subject"];
  $recname=$row["recname"];
  $recsign=$row["recsign"];
  $recdate=$row["recdate"];
  $extra=$row["extra"];
}

  }
}


  ?>
  <div class="container">

    <h1 style="color: blue" align="center"><font size="45" face="array_fill">चिठ्ठी पुर्जी  दर्ता किताब</font></h1>
    <div align="right">Logged in as<font size="15"></font> <b><i><?php  echo $_SESSION["name"];    ?></i></b></font></div>
     <div align="right"><a href="out.php">Logout</a></i></b></font></div>
    <hr />
   
 <table border="1" align="center">
 	<form name="dinsert" method="POST" action="#" onsubmit="return check();" >
       <tr><td>दर्ता नं</td><td>:</td><td>
<select name="dnum" id="dnum">
  <option><?php echo $did;  ?></option>
</select>
       </td></tr>
 	<tr><td>दर्ता मिती</td><td>:</td><td><input type="text" name="ddate" id="ddate"  value=<?php echo $date; ?>></td></tr>
 	<tr><td>पत्र संख्या</td><td>:</td><td><input type="text" name="pnum" id="pnum" value=<?php echo $lettercount;  ?>></td></tr>
 	<tr><td>पत्र मिती</td><td>:</td><td><input type="text" name="pdate" id="pdate"  value=<?php echo $letterdate; ?>></td></tr>
 	<tr><td>पठाउने अफिसकाे नाम</td><td>:</td><td><textarea name="pname" id="pname"><?php echo $senderoffice; ?></textarea></td></tr>
 	<tr><td>विषय</td><td>:</td><td><textarea name="sub1" id="sub1"><?php echo $subject;  ?></textarea></td></tr>
 	<tr><td>कैफियत</td><td>:</td><td><textarea name="kaifiyat" id="kaifiyat" ><?php echo $extra;  ?></textarea></td></tr>
  <tr><td>बुझेकाे मिती</td><td>:</td><td><input type="text" name="recdate" id="recdate"  value=<?php echo $recdate; ?>></td></tr>

 	<tr><td align="center" colspan="3"><input type="submit" name="sub" value="edit"><a href="darta.php">Leave</a></td></tr>

 </form>
 </table>
 <?php
if(isset($_POST["sub"]))
{
  if($indic==0)
  {
 $didd=$_POST["dnum"];
$date1=$_POST["ddate"];
$lettercount=$_POST["pnum"];
$letterdate=$_POST["pdate"];
$senderoffice=$_POST["pname"];
$subject=$_POST["sub1"];
$recdate=$_POST["recdate"];
$extra=$_POST["kaifiyat"];

$sql1="UPDATE `darta` SET `date` = '".$date1."', `lettercount` = '".$lettercount."', `letterdate` = '".$letterdate."', `senderoffice` = '".$senderoffice."', `subject` = '".$subject."', `recdate` = '".$recdate."', `extra` = '".$extra."' WHERE `darta`.`did` = '".$didd."';";
mysqli_query($connect,$sql1)or die("error");
}
else
{
   $splitToArray = explode(".",$_POST["dnum"]);
$did1=$splitToArray[0];
$did_new1=$splitToArray[1];

  // $didd=$_POST["dnum"];
$date1=$_POST["ddate"];
$lettercount=$_POST["pnum"];
$letterdate=$_POST["pdate"];
$senderoffice=$_POST["pname"];
$subject=$_POST["sub1"];
$recdate=$_POST["recdate"];
$extra=$_POST["kaifiyat"];


$sql1="UPDATE `darta_ext` SET `lettercount` = '".$lettercount."', `letterdate` = '".$letterdate."', `senderoffice` = '".$senderoffice."', `subject` = '".$subject."',`recdate` = '".$recdate."', `extra` = '".$extra."' WHERE `darta_ext`.`did` = '".$did1."' and `darta_ext`.`did_new` = '".$did_new1."';";
mysqli_query($connect,$sql1)or die("error");


}
header("Location:darta.php");
}

 ?>

 
      <br />
      <br />
      <h3 style="color: blue" align="center"><font face="array_fill">चिठ्ठी पुर्जी  दर्ता किताब</font></h3>
      <hr />
      <br />
     </div>
   </div>
  </div>
 </body>
</html>

