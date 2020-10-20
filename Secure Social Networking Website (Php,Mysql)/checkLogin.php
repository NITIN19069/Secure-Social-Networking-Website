<?php
session_start();
include "dbConnection.php";
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$select = "Select UserName from sign_up WHERE Email='$Email' and Password='$Password'";
$select1 = "Select * from authentication where Email ='$Email'";
$query = mysqli_query($con,$select);
$query1 = mysqli_query($con,$select1);
 

if (mysqli_num_rows($query)> 0)
{ if (mysqli_num_rows($query1)> 0)
{   
    $row1 = mysqli_fetch_array($query1);
	if ($row1['verified'] == "Yes")
	{
	session_start();
	$row = mysqli_fetch_array($query);
	$_SESSION["logged_in"]=true;
	$_SESSION["Username"] = $row['UserName'];
	
		
     header("Location:Home.php");
}
else
{
	session_start();
	$_SESSION["email"]=$Email;
	$_SESSION["otp_in"]=true;
	header("Location:enterOTP.php");
}
}
}	
else{
	
	header("location:index.php?m=??");
}


?>