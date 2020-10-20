<?php
session_start();
include "dbConnection.php";
$otp = $_POST['otp'];
$newpwd = $_POST['password'];
$selectOTP= "Select * from authentication where forgotPwdOTP = '$otp'";
$queryOTP = mysqli_query($con,$selectOTP);
   $row = mysqli_fetch_array($queryOTP);
    if( mysqli_num_rows($queryOTP) >0)
   {
    if($otp==$row['forgotPwdOTP']){
	   $update="Update sign_up set Password = '$newpwd' where Email IN (SELECT Email from authentication where forgotPwdOTP = '$otp')";

	   
		   if( mysqli_query($con,$update))
		   {
			   header("Location:index.php?xyz=??");
			   
		   }
		   else
		 { 
           echo "Failed attempt to change password!"; 
	
		 }
	}
   }
	else{
		
		$message = "Invalid OTP. Please enter correct OTP";
    echo "<script type='text/javascript'>alert('$message');</script>";
		
	}
		 
		 

?>

