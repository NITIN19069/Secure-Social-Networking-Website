<?php
	session_start();
	include "dbConnection.php";
	include "Header.php";
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		?>
		<html>
		<style>
	
    body{
 background: #76b852;

  }
</style>
		<?php
		$Receiver=$_POST["Receiver"];
		$Sender=$_SESSION["Username"];
		$INSERT = "Insert into friendrequest (Sender,Receiver)values ('$Sender','$Receiver')";
		if(mysqli_query($con , $INSERT)){
			header("location:Home.php?msg=?");
			}
			else{
				echo "Not Sent";
			}
		}else{
	header("location:index.php");
	
}
?>