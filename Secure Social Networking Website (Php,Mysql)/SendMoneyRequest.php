<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   include "dbConnection.php";
	$receiver=$_POST['Receiver'];
	$Amount=$_POST['Amount'];
	
	$insertRequest="Insert into requestmoney (Sender,Receiver,Amount) values('$_SESSION[Username]','$receiver','$Amount')";
	if(mysqli_query($con , $insertRequest)){
		header("location:EWallet.php?msg=?");
	}
	else{
		header("location:EWallet.php?msg=??");
	}
   }
else{
  header("location:index.php");
  
}
?>