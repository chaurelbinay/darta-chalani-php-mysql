<?php
session_start();
if(! isset($_SESSION["name"]))
{
  header("Location:index.php");
}
$connect = mysqli_connect("localhost", "root", "");
$db=mysqli_select_db($connect,"dartacha");

if(isset($_POST["sub"]))
{
//$cid=$_POST["cid"];
$cdate=$_POST["cdate"];
$papercount=$_POST["papercount"];
$paperdate=$_POST["paperdate"];
$subject=$_POST["subject"];
$sendoffice=$_POST["sendoffice"];
$extra=$_POST["extra"];
//$file="file";
$sql="INSERT INTO `chalani` (`cid`, `cdate`, `papercount`, `paperdate`, `subject`, `sendoffice`, `extra`) VALUES (NULL, '".$cdate."', '".$papercount."', '".$paperdate."', '".$subject."', '".$sendoffice."', '".$extra."');";
$path = $_FILES['fileup']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

mysqli_query($connect,$sql)or die("error");
$last_id = $connect->insert_id;

$path = "chalani/";
$name=$last_id.".".$ext;
    $path = $path . basename($name);
    if(move_uploaded_file($_FILES['fileup']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['fileup']['name']). 
      " has been uploaded";
     // header('Location:upload.php');
    } else{
        echo "There was an error uploading the file, please try again!";
    }
$sq="UPDATE `chalani` SET `file` = '".$name."' WHERE `chalani`.`cid` = $last_id;";
mysqli_query($connect,$sq) or die("error");
header('Location:chalani.php');
}
if(isset($_POST["sub1"]))
{
	$lett="a";

$lett="a";
$cid=$_POST["cid"];
$seq="select * from chalani where cid='".$cid."'";
 $req = mysqli_query($connect, $seq);
 if($row2 = mysqli_fetch_assoc($req))
 {
$seq1="select * from chalani_ext where cid='".$cid."'";
 $req1 = mysqli_query($connect, $seq1);
 while($row3 = mysqli_fetch_assoc($req1))
 {
$lett= chr(ord($row3["cid_new"])+1);
 }
$cdate=$_POST["cdate"];
$papercount=$_POST["papercount"];
$paperdate=$_POST["paperdate"];
$subject=$_POST["subject"];
$sendoffice=$_POST["sendoffice"];
$extra=$_POST["extra"];
//$file="file";
$sql="INSERT INTO `chalani_ext` (`id`, `cid`, `cid_new`, `cdate`, `papercount`, `paperdate`, `subject`, `sendoffice`, `extra`,`file`) VALUES (NULL, '".$cid."', '".$lett."', '".$cdate."', '".$papercount."', '".$paperdate."', '".$subject."', '".$sendoffice."', '".$extra."','abc');";

$path = $_FILES['fileup']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

mysqli_query($connect,$sql)or die("error");
$last_id = $connect->insert_id;

$path = "chalani/";
$name=$cid."_".$lett.".".$ext;
    $path = $path . basename($name);
    if(move_uploaded_file($_FILES['fileup']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['fileup']['name']). 
      " has been uploaded";
     // header('Location:upload.php');
    } else{
        echo "There was an error uploading the file, please try again!";
    }
$sq="UPDATE `chalani_ext` SET `file` = '".$name."' WHERE `chalani_ext`.`id` = $last_id;";
mysqli_query($connect,$sq) or die("error");
}
header('Location:chalaniexp.php');
}
?>