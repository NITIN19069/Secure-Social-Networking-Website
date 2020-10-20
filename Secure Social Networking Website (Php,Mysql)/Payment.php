<?php

session_start();
if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) {
   include "dbConnection.php";
   $TypeUser=$_POST["TypeUser"];
   $OTP=$_POST["OTP"];
   $email = $_POST["Email"];
   if(isset($_POST['Type'])){
	   $type=$_POST['Type'];
   }
   else{
	   $type='none';
   }
   $selectOTP= "Select * from payement where otp = '$OTP' and email = '$email'";
   $queryOTP = mysqli_query($con,$selectOTP);
   $row = mysqli_fetch_array($queryOTP);
   if( mysqli_num_rows($queryOTP) >0)
   {
    if($OTP==$row['otp']){
	   $update="Update sign_up set Type_User='$TypeUser',Type_premium='$type' where UserName = '$_SESSION[Username]'";
	   if(mysqli_query($con , $update))
		{	$_SESSION['signed_in']=false;
			session_destroy();
			header("location:index.php");
		}
		else{
			
			$_SESSION['signed_in']=false;
			session_destroy();
			header("location:index.php?abc=??");
			
		}
   }
   else{
			$_SESSION['signed_in']=false;
			session_destroy();
			header("location:index.php?msg=payment not done");
     
   }
}
else{
	
	$message = "Invalid OTP/Email ID. Please enter correct details";
    echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
?>