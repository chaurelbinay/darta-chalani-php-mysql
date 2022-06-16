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
  var a=document.getElementById("ddate").value;
  var b=document.getElementById("pnum").value;
  var c=document.getElementById("pdate").value;
  var d=document.getElementById("pname").value;
  var e=document.getElementById("sub1").value;
  var f=document.getElementById("recdate").value;
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

    <h1 style="color: blue" align="center"><font size="45" face="array_fill">चिठ्ठी पुर्जी  दर्ता किताब</font></h1>
    <p> <a href="chalani.php" style="text-align: right;">Chalani</a></p>
    <div align="right">Logged in as<font size="15"></font> <b><i><?php  echo $_SESSION["name"];    ?></i></b></font></div>
     <div align="right"><a href="out.php">Logout</a></i></b></font></div>
    <hr />

    <table width="100%" style="margin-left:10%;"><tr><td>
 <table border="1">
 	<form name="dinsert" method="POST" enctype="multipart/form-data" action="dartainsert.php" onsubmit="return check();" >
 	<tr><td>दर्ता मिती</td><td>:</td><td><input type="text" name="ddate" id="ddate"  value="<?php echo $nda; ?>"><a href="dartaexp.php">exception</a></td></tr>
 	<tr><td>पत्र संख्या</td><td>:</td><td><input type="text" name="pnum" id="pnum"></td></tr>
 	<tr><td>पत्र मिती</td><td>:</td><td><input type="text" name="pdate" id="pdate"  value="<?php echo $nda; ?>"></td></tr>
 	<tr><td>पठाउने अफिसकाे नाम</td><td>:</td><td><input type="text" name="pname" id="pname"></td></tr>
 	<tr><td>विषय</td><td>:</td><td><input type="text" name="sub1" id="sub1"></td></tr>
 	<tr><td>कैफियत</td><td>:</td><td><input type="text" name="kaifiyat"></td></tr>
  <tr><td>बुझेकाे मिती</td><td>:</td><td><input type="text" name="recdate" id="recdate"  value="<?php echo $nda; ?>"></td></tr>
 	<tr><td>फाइल</td><td>:</td><td><input type="file" name="fileup" id="file"></input></td></tr>
 	<tr><td align="center" colspan="3"><input type="submit" name="sub" value="submit"></td></tr>

 </form>
 </table>
 <td>
  <td>
    <table border="1">
  <form name="dsearch" method="POST" action="#" >
     <tr><td>दर्ता नं</td><td>:</td><td><input type="text" name="did" id="did"></td></tr>
  <tr><td>दर्ता मिती</td><td>:</td><td><input type="text" name="ddate" id="ddate"></td></tr>
  <tr><td>पत्र संख्या</td><td>:</td><td><input type="text" name="pnum" id="pnum"></td></tr>
  <tr><td>पत्र मिती</td><td>:</td><td><input type="text" name="pdate" id="pdate"></td></tr>
  <tr><td>पठाउने अफिसकाे नाम</td><td>:</td><td><input type="text" name="pname" id="pname"></td></tr>
  <tr><td>विषय</td><td>:</td><td><input type="text" name="sub1" id="sub1"></td></tr>
  <tr><td>कैफियत</td><td>:</td><td><input type="text" name="kaifiyat"></td></tr>
   <tr><td>बुझेकाे मिती</td><td>:</td><td><input type="text" name="recdate" id="recdate"></td></tr>
    <tr><td>बुझ्नेकाे नाम</td><td>:</td><td><input type="text" name="recname" id="recname"></td></tr>
    <tr><td align="center" colspan="3"><input type="submit" name="dsearch" value="search"></td></tr>

 </form>
 </table>
  </td>
</tr>
 </table>
<hr />
<br />
    <hr />
    <table border=1 width="100%" name="abcd" id="abcd">
    	<tr style="color: white; background-color: green "><td rowspan="2" align="center"><br/> दर्ता नं</td><td rowspan="2" align="center"><br/>दर्ता मिती</td><td colspan="2" align="center">प्राप्त भएकाे</td><td rowspan="2" align="center" ><br/>पठाउने अफिसकाे नाम</td><td rowspan="2" align="center" ><br/>विषय</td><td colspan="3" align="center">बुझिलिने फाटवाला</td><td rowspan="2" align="center"><br/> कैफियत</td><td rowspan="2" align="center"><br/>फाइल</td><td rowspan="2" align="center">Action</td></tr>

     <tr style="color: white; background-color: green "><td align="center">पत्र संख्या</td><td align="center">पत्र मिती</td><td align="center">नाम</td><td align="center">सहि</td><td align="center">मिती</td></tr>
<?php
$query = "SELECT * FROM darta group by did desc limit 20";
//code for search
if(isset($_POST["dsearch"]))
{
$did=$_POST["did"];
$date=$_POST["ddate"];
$lettercount=$_POST["pnum"];
$letterdate=$_POST["pdate"];
$senderoffice=$_POST["pname"];
$subject=$_POST["sub1"];
$recname=$_POST["recname"];
$recdate=$_POST["recdate"];
$extra=$_POST["kaifiyat"];
if($did ==null && $date == null && $lettercount == null && $letterdate == null && $senderoffice ==null && $subject == null && $recname == null && $recdate == null && $extra == null)
{

}
else
{
$query = "SELECT * FROM `darta` WHERE `did` LIKE '%".$did."%' AND `date` LIKE '%".$date."%' AND `lettercount` LIKE '%".$lettercount."%' AND `letterdate` LIKE '%".$letterdate."%' AND `senderoffice` LIKE '%".$senderoffice."%' AND `subject` LIKE '%".$subject."%' AND `recname` LIKE '%".$recname."%' AND `recdate` LIKE '%".$recdate."%' AND `extra` LIKE '%".$extra."%' group by did desc";
}
}
//code for search end
 $result1 = mysqli_query($connect, $query);
 while($row = mysqli_fetch_assoc($result1))
 {
  $did=$row["did"];
  $date=$row["date"];
  $lettercount=$row["lettercount"];
  $letterdate=$row["letterdate"];
  $senderoffice=$row["senderoffice"];
  $subject=$row["subject"];
  $recname=$row["recname"];
  $recsign=$row["recsign"];
  $recdate=$row["recdate"];
  $extra=$row["extra"];
   $file=$row["file"];
   $src="darta/".$file;
   ?>
<tr><td align="center"><?php echo $did   ?></td><td align="center"><?php echo $date   ?></td><td align="center"><?php echo $lettercount   ?></td><td align="center"><?php echo $letterdate   ?></td><td align="center"><?php echo $senderoffice   ?></td><td align="center"><?php echo $subject   ?></td><td align="center"><?php echo $recname   ?></td><td align="center"><?php echo $recsign   ?></td><td align="center"><?php echo $recdate   ?></td><td align="center"><?php echo $extra   ?></td><td align="center"><a href=<?php echo $src ?>><?php echo "file"  ?></a></td><td align="center"><a href="dartaedit.php?id=<?php echo $did; ?>">edit</a></td></tr>
   <?php

   $que="select * from darta_ext where did='".$did."'";
 $result2 = mysqli_query($connect, $que);
 while($row1 = mysqli_fetch_assoc($result2))
 {
   $did=$row1["did"].".".$row1["did_new"];
  $date=$row1["date"];
  $lettercount=$row1["lettercount"];
  $letterdate=$row1["letterdate"];
  $senderoffice=$row1["senderoffice"];
  $subject=$row1["subject"];
  $recname=$row1["recname"];
  $recsign=$row1["recsign"];
  $recdate=$row1["recdate"];
  $extra=$row1["extra"];
   $file=$row1["file"];
   $src="darta/".$file;
   ?>
<tr><td align="center"><?php echo $did   ?></td><td align="center"><?php echo $date   ?></td><td align="center"><?php echo $lettercount   ?></td><td align="center"><?php echo $letterdate   ?></td><td align="center"><?php echo $senderoffice   ?></td><td align="center"><?php echo $subject   ?></td><td align="center"><?php echo $recname   ?></td><td align="center"><?php echo $recsign   ?></td><td align="center"><?php echo $recdate   ?></td><td align="center"><?php echo $extra   ?></td><td align="center"><a href=<?php echo $src ?>><?php echo "file"  ?></a></td><td align="center"><a href="dartaedit.php?id=<?php echo $did; ?>">edit</a></td></tr>

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
      <h3 style="color: blue" align="center"><font face="array_fill">चिठ्ठी पुर्जी  दर्ता किताब</font></h3>
      <hr />
      <br />
     </div>
   </div>
  </div>
 </body>
</html>

