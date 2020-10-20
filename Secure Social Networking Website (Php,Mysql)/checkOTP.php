<?php
include "dbConnection.php";
$email = $_POST['Email'];
$otp = $_POST['otp'];

$select = "Select * from authentication WHERE otp = '$otp' AND Email = '$email'";
$query = mysqli_query($con,$select);

if (mysqli_num_rows($query) > 0)
{ 
$insert = "Update authentication set verified='Yes' WHERE Email = '$email'";

if(mysqli_query($con,$insert))
	
{
$select1= "Select UserName from sign_up WHERE Email='$email'";
$query1 = mysqli_query($con,$select1);
	session_start();
	$_SESSION['otp_in']=false;
	$row = mysqli_fetch_array($query1);
	$_SESSION["logged_in"]=true;
	$_SESSION["Username"] = $row['UserName'];
	$update="UPDATE authentication SET login_count = 0 WHERE Email = '$email'";
	mysqli_query($con,$update);
	header("Location:Home.php");
}
else
{
	header("Location: enterOTP.php?msg=?");
	
	//echo "Invalid OTP";
}
}
else
{
header("Location: enterOTP.php?msg=?");	
//	$message = "Invalid OTP/Email ID. Please enter correct details";
//    echo "<script type='text/javascript'>alert('$message');</script>";
}
//else
//{
//	$message = "Invalid OTP/Email ID. Please enter correct details";
//    echo "<script type='text/javascript'>alert('$message');</script>";
//}

?>