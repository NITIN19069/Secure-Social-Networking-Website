<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
include "header.php";
include "dbConnection.php";
$Sender=$_POST["Sender"];
$select = "SELECT * FROM friendrequest WHERE Receiver = '$_SESSION[Username]' And Sender='$Sender'";
$query = mysqli_query($con,$select);
if (mysqli_num_rows($query) > 0){
$Insert = "Insert into friends (Sender,Receiver) values ('$Sender','$_SESSION[Username]')";
$Insert2 = "Insert into friends (Sender,Receiver) values ('$_SESSION[Username]','$Sender')";
$query=mysqli_query($con,$Insert2);
if(mysqli_query($con,$Insert)){
	$Delete="Delete from friendrequest where Receiver = '$_SESSION[Username]' And Sender='$Sender'";
	if(mysqli_query($con,$Delete)){
		header ("location:friends.php");
	}
}}}
else{
	header("location:index.php");
}
?>