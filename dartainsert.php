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
$date=$_POST["ddate"];
$lettercount=$_POST["pnum"];
$letterdate=$_POST["pdate"];
$senderoffice=$_POST["pname"];
$subject=$_POST["sub1"];
$recname="anita";
$recsign="anita";
$recdate=$_POST["recdate"];
$extra=$_POST["kaifiyat"];
//$file="file";
$sql="INSERT INTO `darta` (`did`, `date`, `lettercount`, `letterdate`, `senderoffice`, `subject`, `recname`, `recsign`, `recdate`, `extra`) VALUES (NULL, '".$date."', '".$lettercount."', '".$letterdate."', '".$senderoffice."', '".$subject."', '".$recname."', '".$recsign."', '".$recdate."', '".$extra."');";
$path = $_FILES['fileup']['name'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

mysqli_query($connect,$sql)or die("error");
$last_id = $connect->insert_id;

$path = "darta/";
$name=$last_id.".".$ext;
    $path = $path . basename($name);
    if(move_uploaded_file($_FILES['fileup']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['fileup']['name']). 
      " has been uploaded";
     // header('Location:upload.php');
    } else{
        echo "There was an error uploading the file, please try again!";
    }
$sq="UPDATE `darta` SET `file` = '".$name."' WHERE `darta`.`did` = $last_id;";
mysqli_query($connect,$sq) or die("error");
header('Location:darta.php');
}

if(isset($_POST["subexp"]))
{
	$lett="a";
$dnum=$_POST["dnum"];
$seq="select * from darta where did='".$dnum."'";
 $req = mysqli_query($connect, $seq);
 if($row2 = mysqli_fetch_assoc($req))
 {
$seq1="select * from darta_ext where did='".$dnum."'";
 $req1 = mysqli_query($connect, $seq1);
 while($row3 = mysqli_fetch_assoc($req1))
 {
$lett= chr(ord($row3["did_new"])+1);
 }
 
 echo $lett;
$date=$_POST["ddate"];
$lettercount=$_POST["pnum"];
$letterdate=$_POST["pdate"];
$senderoffice=$_POST["pname"];
$subject=$_POST["sub1"];
$recname="anita";
$recsign="anita";
$recdate=$_POST["recdate"];
$extra=$_POST["kaifiyat"];
echo $_FILES['fileup']['name'];
//$file="file";

$sql1="INSERT INTO `darta_ext` (`id`,`did`,`did_new`, `date`, `lettercount`, `letterdate`, `senderoffice`, `subject`, `recname`, `recsign`, `recdate`, `extra`) VALUES (NULL,'".$dnum."','".$lett."', '".$date."', '".$lettercount."', '".$letterdate."', '".$senderoffice."', '".$subject."', '".$recname."', '".$recsign."', '".$recdate."', '".$extra."');";
$path = $_FILES['fileup']['name'];

$ext = pathinfo($path, PATHINFO_EXTENSION);

mysqli_query($connect,$sql1)or die("error");
$last_id = $connect->insert_id;

$path = "darta/";
$name=$dnum."_".$lett.".".$ext;
    $path = $path . basename($name);
    if(move_uploaded_file($_FILES['fileup']['tmp_name'], $path)) {
      echo "The file ".  basename( $_FILES['fileup']['name']). 
      " has been uploaded";
     // header('Location:upload.php');
    } else{
        echo "There was an error uploading the file, please try again!";
    }
$sq="UPDATE `darta_ext` SET `file` = '".$name."' WHERE `darta_ext`.`id` = $last_id;";
mysqli_query($connect,$sq) or die("error");
header('Location:dartaexp.php');
}

}

?>