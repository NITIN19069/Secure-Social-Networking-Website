<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
include "dbConnection.php";
$message = $_POST['message'];
/*$postID = $_POST['$post_id'];
$userIDpost = $_POST['$user_id_p'];
$status_time = $_POST['$status_time'];*/
$sender=$_SESSION['Username'];
$receiver = $_POST['Receiver'];
if($receiver!="SELECT FRIENDS")
{
$insert = "Insert into pmessage values ('$sender','$receiver','$message',CURRENT_TIMESTAMP)";
if(mysqli_query($con,$insert))
		{
			header("location:Home.php");
		}
		else{
			echo "Get lost!";
}}
else
{
	header("location:CompMsg.php?error=??");
}
}
		else {
		header("location:index.php");	
		}
?>