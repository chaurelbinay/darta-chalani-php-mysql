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
            var g=document.getElementById("file").value;

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
  <div class="container">

    <h1 style="color: blue" align="center"><font size="45" face="array_fill">चिठ्ठी पुर्जी  चलानी किताब</font></h1>
    <p> <a href="darta.php">darta</a></p>
    <div align="right">Logged in as<font size="15"></font> <b><i><?php  echo $_SESSION["name"];    ?></i></b></font></div>
     <div align="right"><a href="out.php">Logout</a></i></b></font></div>
    <hr />
    <table width="100%" style="margin-left:10%;"><tr><td>
 <table border="1">
 	<form name="cinsert" method="POST" enctype="multipart/form-data" action="chalaniinsert.php" onsubmit="return check();" >
  <tr><td>चलानी मिती</td><td>:</td><td><input type="text" name="cdate" id="cdate"  value="<?php echo $nda; ?>"><a href="chalaniexp.php">exception</a></td></tr>
  <tr><td>पत्र संख्या</td><td>:</td><td><input type="text" name="papercount" id="papercount"></td></tr>
  <tr><td>पत्र मिती</td><td>:</td><td><input type="text" name="paperdate" id="paperdate"  value="<?php echo $nda; ?>"></td></tr>

  <tr><td>विषय</td><td>:</td><td><input type="text" name="subject" id="subject"></td></tr>
   <tr><td>चलानी गर्ने अफिसकाे नाम</td><td>:</td><td><input type="text" name="sendoffice" id="sendoffice"></td></tr>
  <tr><td>कैफियत</td><td>:</td><td><input type="text" name="extra" id="extra"></td></tr>

 	<tr><td>फाइल</td><td>:</td><td><input type="file" name="fileup" id="file"></input></td></tr>
 	<tr><td align="center" colspan="3"><input type="submit" name="sub" value="submit"></td></tr>

 </form>
 </table>
 <td>
  <td>
    <table border="1">
  <form name="csearch" method="POST" action="#" >
     <tr><td>चलानी नं</td><td>:</td><td><input type="text" name="cid" id="cid"></td></tr>
  <tr><td>चलानी मिती</td><td>:</td><td><input type="text" name="cdate" id="cdate"></td></tr>
  <tr><td>पत्र संख्या</td><td>:</td><td><input type="text" name="papercount" id="papercount"></td></tr>
  <tr><td>पत्र मिती</td><td>:</td><td><input type="text" name="paperdate" id="paperdate"></td></tr>

  <tr><td>विषय</td><td>:</td><td><input type="text" name="subject" id="subject"></td></tr>
   <tr><td>चलानी गर्ने अफिसकाे नाम</td><td>:</td><td><input type="text" name="sendoffice" id="sendoffice"></td></tr>
  <tr><td>कैफियत</td><td>:</td><td><input type="text" name="extra"></td></tr>
  
    <tr><td align="center" colspan="3"><input type="submit" name="csearch" value="search"></td></tr>

 </form>
 </table>
  </td>
</tr>
 </table>
<hr />
<br />
    <hr />
    <table border=1 width="100%" name="abcd" id="abcd">
    	<tr style="color: white; background-color: green "><td colspan="2" align="center"><br/> चलानी</td><td colspan="2" align="center"><br/>चलानी हुने पत्रकाे</td><td rowspan="2" align="center">बिषय</td><td rowspan="2" align="center" ><br/>पत्र चलान गर्ने अफिसकाे नाम</td><td rowspan="2" align="center" ><br/>टिकट</td><td rowspan="2" align="center"><br/> कैफियत</td><td rowspan="2" align="center"><br/>फाइल</td><td rowspan="2" align="center"><br/>action</td></tr>

     <tr style="color: white; background-color: green "><td align="center">नम्बर</td><td align="center">मिती</td><td align="center">पत्र संख्या</td><td align="center">पत्र मिती</td></tr>
<?php
//echo md5("anita123");
$query = "SELECT * FROM chalani group by cid desc limit 20";
//code for search
if(isset($_POST["csearch"]))
{
  echo "clicked";
$cid=$_POST["cid"];
$cdate=$_POST["cdate"];
$papercount=$_POST["papercount"];
$paperdate=$_POST["paperdate"];
$subject=$_POST["subject"];
$sendoffice=$_POST["sendoffice"];
$extra=$_POST["extra"];


if($cid ==null && $cdate == null && $papercount == null && $paperdate == null && $subject ==null && $sendoffice == null && $extra == null)
{

}
else
{
$query = "SELECT * FROM `chalani` WHERE `cid` LIKE '%".$cid."%' AND `cdate` LIKE '%".$cdate."%' AND `papercount` LIKE '%".$papercount."%' AND `paperdate` LIKE '%".$paperdate."%' AND `subject` LIKE '%".$subject."%' AND `sendoffice` LIKE '%".$sendoffice."%' AND `extra` LIKE '%".$extra."%' group by cid desc";
}
}
//code for search end
 $result1 = mysqli_query($connect, $query);
 while($row = mysqli_fetch_assoc($result1))
 {
  $cid=$row["cid"];
$cdate=$row["cdate"];
$papercount=$row["papercount"];
$paperdate=$row["paperdate"];
$subject=$row["subject"];
$sendoffice=$row["sendoffice"];
$extra=$row["extra"];
$file=$row["file"];
$src="chalani/".$file;
   ?>
<tr><td align="center"><?php echo $cid   ?></td><td align="center"><?php echo $cdate   ?></td><td align="center"><?php echo $papercount   ?></td><td align="center"><?php echo $paperdate   ?></td><td align="center"><?php echo $subject   ?></td><td align="center"><?php echo $sendoffice   ?></td><td></td><td align="center"><?php echo $extra   ?></td><td align="center"><a href=<?php echo $src ?>><?php echo "file"  ?></a></td><td align="center"><a href="chalaniedit.php?id=<?php echo $cid; ?>">edit</a></td></tr>
   <?php
   $query2="select * from chalani_ext where cid='".$cid."'";
   $result2 = mysqli_query($connect, $query2);
 while($row1 = mysqli_fetch_assoc($result2))
 {
  $cid=$row1["cid"].".".$row1["cid_new"];
$cdate=$row1["cdate"];
$papercount=$row1["papercount"];
$paperdate=$row1["paperdate"];
$subject=$row1["subject"];
$sendoffice=$row1["sendoffice"];
$extra=$row1["extra"];
$file=$row1["file"];
$src="chalani/".$file;
   ?>
<tr><td align="center"><?php echo $cid   ?></td><td align="center"><?php echo $cdate   ?></td><td align="center"><?php echo $papercount   ?></td><td align="center"><?php echo $paperdate   ?></td><td align="center"><?php echo $subject   ?></td><td align="center"><?php echo $sendoffice   ?></td><td></td><td align="center"><?php echo $extra   ?></td><td align="center"><a href=<?php echo $src ?>><?php echo "file"  ?></a></td><td align="center"><a href="chalaniedit.php?id=<?php echo $cid; ?>">edit</a></td></tr>
<?php
}
    }

?>

    </table>
    <form><input type="button" name="prin" id="prin" value="Print Page" onClick="see();"></form>
    <div id="also">
      <br />
      <br />
      <br />
      <h3 style="color: blue" align="center"><font face="array_fill">चिठ्ठी पुर्जी  चलानी किताब</font></h3>
      <hr />
      <br />
     </div>
   </div>
  </div>
 </body>
</html>

