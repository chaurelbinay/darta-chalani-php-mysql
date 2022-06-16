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
  var a=document.getElementById("cdate").value;
  var b=document.getElementById("papercount").value;
    var c=document.getElementById("paperdate").value;
      var d=document.getElementById("subject").value;
        var e=document.getElementById("sendoffice").value;
          var f=document.getElementById("extra").value;
            

if(a==0 || b==0 || c==0 || d==0 || e==0 || f==0)
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
      $cid=$_REQUEST["id"];
   $sql="select * from chalani where cid='".$cid."'";
  $result1 = mysqli_query($connect, $sql);
 while($row = mysqli_fetch_assoc($result1))
 {
  
$cdate=$row["cdate"];
$papercount=$row["papercount"];
$paperdate=$row["paperdate"];
$subject=$row["subject"];
$sendoffice=$row["sendoffice"];
$extra=$row["extra"];

echo $subject;
}
  }
  else
  {
    $cid=$_REQUEST["id"];
    $indic=1;
 $splitToArray = explode(".",$_REQUEST["id"]);
$cid1=$splitToArray[0];
$cid_new1=$splitToArray[1];
$sql="select * from chalani_ext where cid='".$cid1."' and cid_new='".$cid_new1."'";
   $result1 = mysqli_query($connect, $sql);
 if($row = mysqli_fetch_assoc($result1))
 {
 
$cdate=$row["cdate"];
$papercount=$row["papercount"];
$paperdate=$row["paperdate"];
$subject=$row["subject"];
$sendoffice=$row["sendoffice"];
$extra=$row["extra"];
}

  }
}


  ?>
  <div class="container">

    <h1 style="color: blue" align="center"><font size="45" face="array_fill">चिठ्ठी पुर्जी  चलानी किताब</font></h1>
 
    <div align="right">Logged in as<font size="15"></font> <b><i><?php  echo $_SESSION["name"];    ?></i></b></font></div>
     <div align="right"><a href="out.php">Logout</a></i></b></font></div>
    <hr />

 <table border="1" align="center">
    <form name="cinsert" method="POST" action="#" onsubmit="return check();" >
   <tr><td>चलानी नं</td><td>:</td><td><select name="cid" id="cid">
    <option><?php echo $cid; ?></option>
  </select></td></tr>
   <tr><td>चलानी मिती</td><td>:</td><td><input type="text" name="cdate" id="cdate"  value=<?php echo $cdate; ?>></td></tr>
  <tr><td>पत्र संख्या</td><td>:</td><td><input type="text" name="papercount" id="papercount" value=<?php echo $papercount; ?>></td></tr>
  <tr><td>पत्र मिती</td><td>:</td><td><input type="text" name="paperdate" id="paperdate" value=<?php echo $paperdate; ?>></td></tr>
  <tr><td>विषय</td><td>:</td><td><textarea name="subject" id="subject"><?php echo $subject; ?></textarea></td></tr>
   <tr><td>चलानी गर्ने अफिसकाे नाम</td><td>:</td><td><textarea name="sendoffice" id="sendoffice"><?php echo $sendoffice; ?></textarea></td></tr>
  <tr><td>कैफियत</td><td>:</td><td><textarea name="extra" id="extra"><?php echo $extra; ?></textarea></td></tr>

 	<tr><td align="center" colspan="3"><input type="submit" name="sub" value="edit"><a href="chalani.php">leave</a></td></tr>

 </form>
 </table>
<?php
if(isset($_POST["sub"]))
{
  if($indic==0)
  {
$cid=$_POST["cid"];
$cdate=$_POST["cdate"];
$papercount=$_POST["papercount"];
$paperdate=$_POST["paperdate"];
$subject=$_POST["subject"];
$sendoffice=$_POST["sendoffice"];
$extra=$_POST["extra"];

$sql1="UPDATE `chalani` SET `cdate` = '".$cdate."', `papercount` = '".$papercount."', `paperdate` = '".$paperdate."', `subject` = '".$subject."', `sendoffice` = '".$sendoffice."', `extra` = '".$extra."' WHERE `chalani`.`cid` = '".$cid."';";
mysqli_query($connect,$sql1)or die("error");
}
else
{
   $splitToArray = explode(".",$_POST["cid"]);
$cid1=$splitToArray[0];
$cid_new1=$splitToArray[1];
  // $didd=$_POST["dnum"];
//$cid=$_POST["cid"];
$cdate=$_POST["cdate"];
$papercount=$_POST["papercount"];
$paperdate=$_POST["paperdate"];
$subject=$_POST["subject"];
$sendoffice=$_POST["sendoffice"];
$extra=$_POST["extra"];

$sql1="UPDATE `chalani_ext` SET `cdate` = '".$cdate."', `papercount` = '".$papercount."', `paperdate` = '".$paperdate."', `subject` = '".$subject."', `sendoffice` = '".$sendoffice."', `extra` = '".$extra."' WHERE `chalani_ext`.`cid` = '".$cid1."' and `chalani_ext`.`cid_new` = '".$cid_new1."';";

mysqli_query($connect,$sql1)or die("error");
}
header("Location:chalani.php");
}

 ?>

    
      <br />
      <h3 style="color: blue" align="center"><font face="array_fill">चिठ्ठी पुर्जी  चलानी किताब</font></h3>
      <hr />
      <br />
     </div>
   </div>
  </div>
 </body>
</html>

