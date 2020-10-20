<?php
session_start();
include "dbConnection.php";
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
   $Prev_password=$_POST["previous"];
   $new_password=$_POST["new"];
   $select = "SELECT * FROM sign_up WHERE UserName = '$_SESSION[Username]'";
   $query = mysqli_query($con,$select);
   $row = mysqli_fetch_array($query);
   if ($row > 0){
	   $prev=$row["Password"];
	   if($prev==$Prev_password){
		   $update="Update sign_up Set Password='$new_password'where UserName = '$_SESSION[Username]'";
		   if(mysqli_query($con , $update))
		{
			header("location:home.php");
		}
		}else{
			header("location:settings.php?msg='??'");
			
		}
	   
   }
   }else{
	header("location:index.php");
	
}
?>