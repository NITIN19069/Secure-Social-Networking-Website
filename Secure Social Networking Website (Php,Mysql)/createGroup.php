<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "dbConnection.php";
$gpName=$_POST["GroupName"];
$gpPrivacy=$_POST["PrivacyOfGroup"];
$gpType=$_POST["TypeOfGroup"];
if($gpPrivacy=="paid"){
$amt=$_POST["amount"];
$insert="Insert into groupinfo (GroupName,Admin,Type,Privacy,Amount) values('$gpName','$_SESSION[Username]','$gpType','$gpPrivacy','$amt')";
}
else{
	$insert="Insert into groupinfo (GroupName,Admin,Type,Privacy) values('$gpName','$_SESSION[Username]','$gpType','$gpPrivacy')";
}
if(mysqli_query($con , $insert)){
	header("location:group.php");
}
else{
	echo "Not created";
	
}
}else{
	header("location:index.php");
}
?>