<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "header.php";
   include "dbConnection.php";
   $receiver=$_REQUEST['Receiver'];
	$Delete="Delete from friends where Sender = '$_SESSION[Username]' And Receiver='$receiver'";
	$Delete2="Delete from friends where Receiver = '$_SESSION[Username]' And Sender='$receiver'";
	$result=mysqli_query($con,$Delete);
	$result2=mysqli_query($con,$Delete2);
	if(mysqli_query($con,$Delete)){
		header("location:friends.php");
	}
}
else{
	header("location:index.php");
}?>