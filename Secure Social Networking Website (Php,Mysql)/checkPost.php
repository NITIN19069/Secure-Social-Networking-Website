<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
include "dbConnection.php";
include "Header.html";
$status = $_POST['status'];
/*$postID = $_POST['$post_id'];
$userIDpost = $_POST['$user_id_p'];
$status_time = $_POST['$status_time'];*/
$user=$_SESSION["Username"];
$insert = "Insert into friend_post values ('$user','$user','$status',CURRENT_TIMESTAMP)";
if(mysqli_query($con , $insert))
		{
			header("location:viewPost.php");
		}
		else{
			echo "Post Not Added!";
}}
		else {
		header("location:index.php");	
		}
?>