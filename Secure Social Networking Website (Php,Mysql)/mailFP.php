<?php
session_start();
include "dbConnection.php";
$fpotp = rand(1000,9999); 
$sub="Password Change OTP";
$msg="The otp for changing password is $fpotp";
$rec=$_POST['Email'];
mail($rec,$sub,$msg);
$otpUpdate = "update authentication set forgotPwdOTP = '$fpotp' where Email = '$rec'";
if(mysqli_query($con,$otpUpdate))
{
	$_SESSION["fgt_pwd1"]=true;
	header("Location:forgotPwdOTP.php");
	
}
else
{
	header("location:fgtPwdSendEmail.php");
}
?>